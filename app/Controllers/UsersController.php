<?php
class UsersController
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

    public function index()
    {
        include_once 'app/Models/UserModel.php';

        // отримання користувачів
        $users = (new User())::all($this->conn);

        include_once 'views/users.php';
    }

    public function addForm(){
        include_once 'views/addUser.php';
    }

    public function add()
    {
        include_once 'app/Models/UserModel.php';

        // блок з валідацією
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "") {
            // додати користувача
            $user = new User($name, $email, $gender, $_FILES['photo']['name']);
            $user->add($this->conn);
        }
        header('Location: ?controller=users');
    }
}
