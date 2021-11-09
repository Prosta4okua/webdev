<?php

function alert($message) {
    echo "<script>alert('$message');</script>";
}

class User {
    private string $name;
    private string $email;
    private string $gender;
    private string $image;

    public function __construct($name = '', $email = '', $gender = '', $image = '')
    {
        $this->name   = $name;
        $this->email  = $email;
        $this->gender = $gender;
        $this->image  = $image;
    }

    public static function uploadImage() : string{
        $target_dir = "C:\Users\Danylo\WebstormProjects\webdev\public\uploads\\";
        $target_file = $target_dir . $_FILES["photo"]["name"];
//        echo $target_file;
//        echo "<br>";
//        echo $_FILES["photo"]["name"];
//        die("huh");
        var_dump($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $isUploaded = false;
        $uploadOk = 1;
        $filePath = '';

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






//        var_dump($conn);
//        die("Upload image");

//        alert();


//        return "C:\Users\Danylo\WebstormProjects\webdev\public\uploads\\" . basename($_FILES["photo"]["name"]);
    }

    public function add($conn) {
//        var_dump( $_FILES["photo"] );
//        die("Hehe");
        $pathtoimg = self::uploadImage();
//        echo $pathtoimg;
//        die("hehehee");
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


    public static function update($conn, $id, $data) {
        //
    }
    public static function delete($conn, $id) {
        //
    }



}
