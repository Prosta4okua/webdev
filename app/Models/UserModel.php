<?php
class User {
    private string $name;
    private string $email;
    private string $gender;

    public function __construct($name = '', $email = '', $gender = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
    }

    public function add($conn) {
        $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
           VALUES ('$this->email', '$this->name','$this->gender', '11111', '')";
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
