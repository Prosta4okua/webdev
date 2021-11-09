<?php

class ImageModel
{
    public function __construct() {

//echo __FILE__;
//define ('SITE_ROOT', realpath(dirname(__FILE__)));
        $target_dir = "C:\Users\Danylo\WebstormProjects\webdev\assets\public\images\\";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $isUploaded = false;
        $filePath = '';

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                red_text("File is not an image.");
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            red_text("Sorry, file already exists.");
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["photo"]["size"] > 500000) {
            red_text("Sorry, your file is too large.");
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            red_text("Sorry,only JPG,JPEG,PNG&GIF files are allowed.");
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            red_text("Sorry, your image was not uploaded.");
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
//        echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.<br><br>";
                $filePath = $target_dir . basename($_FILES["photo"]["name"]);
                $filePath = basename($_FILES["photo"]["name"]);
                $isUploaded = true;
            } else {
                red_text("Sorry, there was an error uploading your file.");
            }
        }

        function red_text($text)
        {
            echo "<p style=\"color:red\">$text</p><br>";
        }

    }
}