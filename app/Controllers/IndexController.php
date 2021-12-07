<?php
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
        include_once 'RolesController.php';
//        include_once 'views/home.php';
        include_once 'app/Models/UserModel.php';

        // отримання користувачів
        $users = (new User())::all($this->conn);
        $user = new User();
        $roles = $user->getRoles($this->conn);

        include_once 'views/users.php';
    }

    public function auth()
    {
        include_once 'app/Models/auth.php';

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        if (trim($email) !== "" && trim($password) !== "") {

            $auth = new Authorization();
            $auth->auth($this->conn, $email, $password);

        }

        header('Location: ?controller&action=index');
    }

    public function logout()
    {
        include_once 'app/Models/auth.php';
        $auth = new Authorization();
        $auth->logout();
        header('Location: ?controller');
    }
}
