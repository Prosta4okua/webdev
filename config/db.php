<?php
class Db {
    public function __construct(){
    }
    public function getConnect(){
        $conn = mysqli_connect("127.0.0.1", "root", "", "testdb");

        if (!$conn) {
            echo "Could not connect MySQL." . "<br>";
            echo "Код помилки errno: " . mysqli_connect_errno() . "<br>";
            echo "Текст помилки error: " . mysqli_connect_error() . "<br>";
            exit;
        }
        return $conn;
    }
}
