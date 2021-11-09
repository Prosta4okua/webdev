<?php
class User {
    private string $name;
    private string $email;
    private string $gender;

    public function __construct($name = '', $email = '', $gender = '')
    {
        $this->name   = $name;
        $this->email  = $email;
        $this->gender = $gender;
    }

    public static function byId($conn, $id)
    {
        $command = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($command);
        return $result->fetch_assoc();

    }

    public static function uploadImage() : string
    {
        // TODO how to delete absolute path here
        $target_dir = "C:\Users\Danylo\WebstormProjects\webdev\public\uploads\\";
//        $target_dir = "../public/uploads/";
        $target_file = $target_dir . $_FILES["photo"]["name"];
        var_dump($_FILES["photo"]["name"]);
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
        $pathtoimg = self::uploadImage();
        $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
           VALUES ('$this->email', '$this->name','$this->gender', '11111', '$pathtoimg')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
        return false;
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

//  TODO навіщо тут $data

    public static function update($conn, $id, $data)
    {
        /**
         * @var string $email
         * @var string $name
         * @var string $gender
         * @var string $pathtoimg
         */

        self::deleteImageByID($id);
        $pathtoimg = self::uploadImage();
        // TODO додати password знов
        $sql = "UPDATE `users` SET `email`='$email',`name`='$name',`gender`='$gender',`path_to_img`='$pathtoimg' WHERE id=$id";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
        return false;



    }
    public static function delete($conn, $id)
    {
        // deleting image
        self::deleteImageByID($id);

        // deleteing from DB
        $sql = "DELETE FROM users WHERE id=$id";
        echo "ID: " . $id;
//        die("hehe");
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function show($conn, $id)
    {
        $command = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($command);
        return $result->fetch_assoc();
    }


    private static function deleteImageByID ($id)
    {
        $command = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($command);
        $result = $result->fetch_assoc();
        if ($result['path_to_img'] !== "") {
            unlink("../public/uploads/" . $result['path_to_img']);
        }
    }




}
