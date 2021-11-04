<?php
// code with validation will be here and saving user will be here
//    <!--Preventing some potential security threat like SQL Injection -->
    filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    echo "test";



?>

<!doctype html>
<html lang="en">
<title>
    Handler
</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--Imports external css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!--My own styles-->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .container {
            width: 400px;
        }
    </style>
</head>
<body style="padding-top: 3rem;">

<div class="container">
    <?php
    require 'uploads.php';
    require 'db.php';
//    require 'upload.php';

//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    echo "postphoto: " . $_POST["photo"] . "filepath" . $filePath;

    $pathToDatabase = "assets\public\databases\users.csv";
//    If any field is empty then prints error message
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["gender"])) {
        echo "<div class='redText'>Invalid data</div>";
    }
    else {
//      creating variables to save our result for convenience
        $name = $_POST["name"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
//        $filePath


//      prints user information
        echo "<b>User Added!</b><br>";
        echo "Name: "       . $name     .    "<br>";
        echo "Email: "      . $email    .    "<br>";
        echo "Gender: "     . $gender   .    "<br>";
//        echo "File path: "  . $filePath .    "<br>";
        if (empty($filePath)) {
            $filePath = "assets/public/images/Default.png";
            echo "File path: "  . $filePath .    "<br>";
            $filePath = "";
        }
        else
            echo "File path: "  . $filePath .    "<br>";

// id можно не вказувати, тому що auto increment
// пароль будемо встановлювати всім однаковий
        $password = 11111;
        $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
   VALUES ('$email', '$name','$gender', '$password', '$filePath')";
        echo $sql;
        $res = mysqli_query($conn, $sql);
        var_dump($res);
        die();
        if ($res) {
            $valid = true;
        }




//        Закоментовано, бо потрібно записувати тепер в БД, а не в файл
//        if (!file_exists($pathToDatabase)) {
//            file_put_contents($pathToDatabase, '');
//        }
//
//        // file mode = append
//        $fp = fopen($pathToDatabase, 'a') or die("Error creating the file " . $pathToDatabase);
//        fwrite($fp, "$name,$email,$gender,$filePath\n");
//        fclose($fp);


    }


    ?>









    <hr>
    <a class="btn" href="adduser.php">return back</a>
    <a class="btn" href="table.php">view list</a>
</div>
</body>
</html>
