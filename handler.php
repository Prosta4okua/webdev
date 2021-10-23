<?php
// code with validation will be here and saving user will be here
//    <!--Preventing some potential security threat like SQL Injection -->
    filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);




?>

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
//  TODO how to use not absolute path?
    $pathToDatabase = "C:\Users\Danylo\WebstormProjects\webdev\assets\public\databases\users.csv";
//    If any field is empty then prints error message
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["gender"])) {
        echo "<div class='redText'>Invalid data</div>";
    }
    else {
//      creating variables to save our result for convenience
        $name = $_POST["name"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];


//      prints user information
        echo "User Added";
        echo "Name: " . $name     . "<br>";
        echo "Email: " . $email   . "<br>";
        echo "Gender: " . $gender . "<br>";



//      creating a sheet, if sheet doesn't exist TODO doesn't work
        if (!file_exists($pathToDatabase)) {
            file_put_contents($pathToDatabase, '');
        }

        // file mode = append
        $fp = fopen($pathToDatabase, 'a') or die("Error creating the file " . $pathToDatabase);
        fwrite($fp, "$name,$email,$gender\n");
        fclose($fp);


    }
    ?>








    <hr>
    <a class="btn" href="adduser.php">return back</a>
    <a class="btn" href="table.php">view list</a>
</div>
</body>
</html>
