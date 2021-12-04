<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class User {
    private string $surname;
    private string $name;
    private string $email;
    private string $password;
    private string $gender;
    private string $roleID;

    public function __construct($name = '', $email = '', $gender = '',$password = '',$surname = '',$roleID='')
    {
        $this->surname   = $surname;
        $this->email  = $email;
        $this->name   = $name;
        $this->password  = $password;
        $this->gender = $gender;
        $this->roleID = $roleID;
    }

    public static function byId($conn, $id)
    {
        $command = "SELECT * FROM users WHERE userID=$id";
        $result = $conn->query($command);
        return $result->fetch_assoc();

    }

    public static function uploadImage() : string
    {

//        $target_dir = "C:\Users\Danylo\Desktop\University\\3 term\WebDev\public\uploads\\";

        $target_dir = "\public\uploads\\";
        $dir = dirname(__DIR__, 2);

//        $dir .= $target_dir;
        $target_dir = $dir . $target_dir;
//        echo "Real path: " . realpath($dir);
//        die();
        $target_file = $target_dir . $_FILES["photo"]["name"];
        echo "photo: " . $_FILES["photo"]["name"] . "<br>";
        var_dump($_FILES["photo"]["name"]);
//        die();
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            $uploadOk = ($check !== false) ? 1 : 0;
        }

        if (file_exists($target_file) || ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            return $_FILES["photo"]["name"];
        }

        return "";
   }

    public function add($conn)
    {
        $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$this->email'");
        if ($res->num_rows != 0) {
//            TODO придумати спосіб зробити вивід повідомлення про те, що користувач вже існує
//            echo "Email already exists!";
            var_dump($res);
            echo "<br>" . $this->email;
            $_SESSION['alert']['emailExists'] = true;
//            echo gettype($res['num_rows']);
//            die();
            return false;
        }
        $avatarName = self::uploadImage();
        $sqlRequest =
            "INSERT INTO users(email, password, surname, name, gender, avatarName, roleID)
             VALUES ('$this->email', '$this->password','$this->surname', '$this->name', '$this->gender','$avatarName', '$this->roleID')";
        $res = mysqli_query($conn, $sqlRequest);

        if ($res) {
            $_SESSION['alert']['registration'] = true;
            return true;
        }
        return false;
    }

    public function getRoles($conn)
    {

        $sql = "SELECT * FROM roles";
        $result = $conn->query($sql); //виконання запиту
        if ($result->num_rows > 0) {
            $arr = [];
            while ( $db_field = $result->fetch_assoc() ) {
                $arr[] = $db_field;
            }
            return $arr;
        } else {
            return [];
        }
    }

    public static function all($conn) {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql); //виконання запиту
        if ($result->num_rows > 0) {
            $arr = [];
            while ( $db_field = $result->fetch_assoc() ) {
                $arr[] = $db_field;
            }
            return $arr;
        } else {
            return [];
        }
    }

    public static function update($conn, $id, $data)
    {
        /**
         * @var string $email
         * @var string $name
         * @var string $gender
         * @var string $pathtoimg
         */
        print_r($data);
//        echo "ID:" . $id . "<br>Name: " . $data->name . "<br>Email: " . $data->email . "<br>Gender: " . $data->gender;
        // TODO зробити перевірку на порожнє фото
//        $data->avatarName


//
//        if ($_SESSION['user']['userID'] == $id)
//        {
//            $_SESSION['user'] = $data;
//        }
        $sql = "UPDATE `users` SET `email`='$data->email',`name`='$data->name', `gender`='$data->gender',`surname`='$data->surname', `roleID`='$data->roleID' ";
        if ($data->password != "old")
            $data->password = password_hash($data->password, PASSWORD_DEFAULT);
            $sql .= ",`password`='$data->password'";
        if (isset($_FILES["photo"]["name"]) && trim($_FILES["photo"]["name"]) != "") {
            self::deleteImageByID($conn, $id);
            $pathtoimg = self::uploadImage();
            $sql .= ",`avatarName`='$pathtoimg'";
        }
        $sql .= " WHERE userID=$id";


        echo "<br>SQL: " . $sql . "<br>";
//        die("<br>Hehe");
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }

        return false;



    }
    public static function delete($conn, $id)
    {
        // deleting image
        self::deleteImageByID($conn, $id);

        // deleteing from DB
        $sql = "DELETE FROM users WHERE userID=$id";
        echo "ID: " . $id;
//        die("hehe");
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function show($conn, $id)
    {
        $command = "SELECT * FROM users WHERE userID=$id";
        $result = $conn->query($command);
        return $result->fetch_assoc();
    }

// TODO пофіксити щоб якщо нема ави, то можна завантажити
    private static function deleteImageByID ($conn, $id)
    {
        $command = "SELECT * FROM users WHERE userID=$id";
        $result = $conn->query($command);
        $result = $result->fetch_assoc();
        echo "<br>Result: " . $result['avatarName'] . "<br>";

        if (trim($result['avatarName']) !== "") {
//          TODO знов глобальний шлях(!) Можливо все норм, протестувати
            $target_dir = "\public\uploads\\";
            $dir = dirname(__DIR__, 2);
            $target_dir = $dir . $target_dir;
            $target_file = $target_dir . $result['avatarName'];
            echo "<br>Myphoto: " . $result['avatarName'] . "<br>";

//            unlink("C:/Users/Danylo/Desktop/University/3 term/WebDev/public/uploads" . $result['path_to_img']);
            /**
             * Якщо завантажили файл, то видаляємо старий
             */
//            echo "<br>Myphoto: " . $_FILES["photo"]["name"] . "<br>";
//            die();
            if (isset($_FILES["photo"]["name"]) && trim($_FILES["photo"]["name"]) != "")
                unlink($target_file);
//            die("heh");
        }
    }




}
