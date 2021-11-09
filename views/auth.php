<?php
session_start();
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $isRestricted = true;
}?>
<!doctype html>
<html lang="en">
<head>
    <title>
        Authorization
    </title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--My own styles-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Imports external css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style>
        .container {
            width: 400px;
        }
    </style>

    <title>Login</title>
</head>
<body>

<div class="container">
    <h1>Login</h1>
    <form action="authHandler.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="field">
                <label>E-mail: <input type="email" name="email"><br></label>
            </div>
        </div>
        <div class="row">
            <div class="field">
                <label>Password: <input type="password" name="password"><br></label>
            </div>
        </div>
        <?php if($isRestricted) {
            echo "<div class=\"field\">";
            echo "You are already logged in! Want to <a href='login.php'>add user?</a>";
            echo "</div>";
            echo "<br>";
        }?>
        <input type="submit" class="btn" value="Login">
    </form>
</div>

</body>
</html>