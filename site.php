<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php error_reporting(E_ERROR | E_PARSE); ?>

    <form action="site.php" method="post">
        Password: <input type="password" name="password"> <br>
        <input type="submit">
    </form>
    <br>
    <br>


<?php
    echo $_POST["password"];

?>















<!--    Color: <input type="text" name="color"> <br>-->
<!--    Plural Noun: <input type="text" name="pluralNoun"> <br>-->
<!--    Celebrity: <input type="text" name="celebrity"> <br>-->
<?php
//    $color = $_GET["color"];
//    $pluralNoun = $_GET["pluralNoun"];
//    $celebrity = $_GET["celebrity"];
//    echo "There once was a $color that put to sea <br>";
//    echo "The name of the $pluralNoun was the <br>";
//    echo "The winds blew up, her $celebrity dipped down<br>";
//    echo "Oh blow, my bully boys, blow fdfd<br>";
//?>
<?php ////echo $_GET["num1"] + $_GET["num2"]?>













<!--<form action="site.php" method="">-->
<!--    Name: <input type="text" name="name">-->
<!--    <br>-->
<!--    Age: <input type="number" name="age">-->
<!--    <input type="submit">-->
<!--</form>-->
<!--<br>-->
<!--Your name is --><?php //echo $_GET["name"] ?>
<!--<br>-->
<!--Your age is --><?php //echo $_GET["age"] ?>


<!---->
<!--//    $characterName = "John";-->
<!--// $phrase = "Huhfhd gnnLNJGLFNGljngflngdlg";-->
<!--// $age = 30.4;-->
<!--// echo substr($phrase, 0, 5);-->
<!--//    $characterAge = 35;-->
<!--echo "There once was a $characterName that put to sea <br>";-->
<!--echo "The name of the ship was the $ <br>";-->
<!--echo "The winds blew up, her bow dipped down<br>";-->
<!--echo "Oh blow, my bully boys, blow (huh)<br>";-->


</body>
</html>