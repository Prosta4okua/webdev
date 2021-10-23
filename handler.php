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
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
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
    if (empty($_POST["name"] )) {
        echo "<div class='redText'>Invalid data</div>";
    }
    else {
        echo "User Added";
        echo "Name: " . $_POST["name"];
        echo "<br>";
        echo "Email: " . $_POST["email"];
        echo "<br>";
        echo "Gender: " . $_POST["gender"];
    }
    ?>








    <hr>
    <a class="btn" href="adduser.php">return back</a>
    <a class="btn" href="table.php">view list</a>
</div>
</body>
</html>
