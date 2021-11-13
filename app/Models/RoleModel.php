<?php
class Role {
    private string $title;

    public function __construct ($title = '') {
        $this->title = $title;
    }

    public static function byId($conn, $id)
    {
        $command = "SELECT * FROM roles WHERE id=$id";
        $result = $conn->query($command);
        return $result->fetch_assoc();
    }

    public function add($conn)
    {
        $sql = "INSERT INTO roles (title)
           VALUES ('$this->title')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
        return false;
    }

    public static function all($conn) {
        $sql = "SELECT * FROM roles";
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

    public static function update($conn, $id, $data)
    {
        /**
         * @var string $title
         */

        $sql = "UPDATE `roles` SET `title`='$data->title' WHERE id=$id";

        echo $sql;
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }

        return false;
    }

    public static function delete($conn, $id)
    {
        // deleteing from DB
        $sql = "DELETE FROM roles WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function show($conn, $id)
    {
        $command = "SELECT * FROM roles WHERE id=$id";
        $result = $conn->query($command);
        return $result->fetch_assoc();
    }


}