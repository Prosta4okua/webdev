<?php
class Authorization{
    private string $email;
    private string $password;

    public function __constructor($email = '', $password = '')
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function auth($conn, $email, $password)
    {

        $users = self::all($conn);
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        foreach ($users as $user)
        {
//            print_r($user);
//            echo "<br>";
            if ($user['email'] == $email && password_verify($password, $user['password']))
            {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = $user;
                return true;
            }
        }
        die();
        $_SESSION['auth'] = false;
        $_SESSION['alert']['wrongData'] = true;
        return false;
//        var_dump( $result->fetch_assoc() );
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

    public static function logout()
    {
        $_SESSION['auth'] = false;
        empty($_SESSION['user']);
        session_destroy();
    }
}