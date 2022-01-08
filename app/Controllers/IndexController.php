<?php
$myPath = dirname(__DIR__, 2) . '/vendor/autoload.php';
require $myPath;
use Model\Authorization;
use Model\User;
use Controller\RolesController;

class IndexController
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

    public function index()
    {
        // виклик відображення
//        include_once 'RolesController.php';
//        include_once 'views/home.php';
//        include_once 'app/Models/User.php';

        // отримання користувачів
        $users = (new User())::all($this->conn);
        $user = new User();
        $roles = $user->getRoles($this->conn);

        include_once 'views/users.php';
    }

    public function auth()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($email) !== "" && trim($password) !== "") {
            $auth = new Authorization();
            $auth->auth($this->conn, $email, $password);
        }
        header('Location: ?controller&action=index');
    }

    public function auth_api()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user = User::auth($this->conn, $email, $password);
        if (User::auth($this->conn, $email, $password)){
            $_SESSION['auth'] = true;
            $isAuthorized = true;
        }
        unset($user['password']);
        echo json_encode($user);
    }


    public function logout()
    {
//        include_once 'app/Models/Authorization.php';
        $auth = new Authorization();
        $auth->logout();
        header('Location: ?controller');
    }

    public function auth2()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (trim($email) != "" && trim($password) !== "") {
            $auth = new Authorization();

            $user =  json_encode($auth->auth($this->conn, $email, $password));
            echo $user;
            die();

        }

    }

}
