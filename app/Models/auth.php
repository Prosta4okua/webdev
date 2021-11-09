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
//        TODO додати перевірку при додаванні користувача на наявність електронної пошти
//        $sql = "SELECT * FROM users WHERE email == '$email' and password == '$password'";
//        echo $result;
//        die("hahahgfdhs");


        $users = self::all($conn);
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        foreach ($users as $user)
        {
            if ($user['email'] == $email && $user['password'] == $password)
            {
                $_SESSION['auth'] = true;
                return;
//                die("IT WORKS!");
            }
        }
        $_SESSION['auth'] = false;
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
    }
}