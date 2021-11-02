<?php
session_start();


const ADMIN_EMAIL = 'admin@admin.com';
const ADMIN_PASSWORD = '111111';

filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$email = $_POST["email"];
$password = $_POST["password"];

if ($email == ADMIN_EMAIL && $password == ADMIN_PASSWORD) {
    header('Location: login.php');
    $_SESSION['auth'] = true;
}
else {
    header('Location: login.php');
    echo "Username or password is incorrect!</br>";
    $_SESSION['auth'] = false;
}
?>