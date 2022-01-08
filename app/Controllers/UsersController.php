<?php
use Dotenv\Dotenv;
$myPath = dirname(__DIR__, 2) . '/vendor/autoload.php';
require $myPath;
use Model\Authorization;
use Model\User;
use Model\Comment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

class UsersController
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

    public function index()
    {
//        include_once 'app/Models/User.php';
//        die("text");

        // отримання користувачів
        $users = (new User())::all($this->conn);
        $user = new User();
        $roles = $user->getRoles($this->conn);
//        print_r($users);
//        die();

        include_once 'views/users.php';
    }


    public function addForm(){
//        include_once 'app/Models/User.php';
        $user = new User();
        $roles = $user->getRoles($this->conn);
        include_once 'views/addUser.php';
    }

    public function add()
    {
//        include_once 'app/Models/User.php';


        // блок з валідацією
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $roleID = filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['alert']['wrongEmailFormat'] = true;
            header('Location: ?controller=users');
        }
        if ($password != $password2) {
//            echo $password2 . $password;
//            die();
            $_SESSION['alert']['wrongPassword'] = true;
            header('Location: ?controller=users');
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

//        echo "name: " . $name . "<br>";
//        echo "email: " . $email . "<br>";
//        echo "password: " . $password . "<br>";
//        echo "gender: " . $gender . "<br>";
//        echo "surname: " . $surname . "<br>";
        echo "roleID: " . $roleID . "<br>";
//        echo $name . $email . $password . $gender . $surname . $roleID ."<br>";
//        die();


        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "" && trim($roleID) !== "") {
            // додати користувача
            $user = new User($name, $email, $gender, $password, $surname, $roleID);
            $user->add($this->conn);
            echo $name . $email . $password . $gender . "<br>";
        }
        header('Location: ?controller');
    }

    public function delete() {
//        include_once 'app/Models/User.php';
        // блок з валідацією
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new User())::delete($this->conn, $id);
        }
        header('Location: ?controller=users');
    }

    public function show() {
//        include_once 'app/Models/User.php';
//        include_once 'app/Models/Comment.php';

        $id = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $id = $_GET['id'];
//        echo $id;
//        die();
        if (trim($id) !== "" && is_numeric($id)) {
            $user = (new User())::byId($this->conn, trim($id));
            $comments = (new Comment())::allCommentsByID($this->conn, trim($id));
            $users = (new User())::all($this->conn);
            $roles = (new User())->getRoles($this->conn);
        }
//        print_r($user);
//        die();
        include_once 'views/showUser.php';
    }

    public function edit() {
//        include_once 'app/Models/User.php';

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $roleID = filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (trim($password) == "")
            $password = "old";
//        if (trim($roleID)   == "")
//            $roleID = 2;

        echo "<br>RoleID: " . $password . "<br>";
//        die();


        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($id) !== "" && trim($password) !== "" && trim($surname) !== "" && trim($roleID) !== "") {
            $user = new User($name, $email, $gender, $password);
            $user = new User($name, $email, $gender, $password, $surname, $roleID);
            $user->update($this->conn, $id, $user);
        }

        header('Location: ?controller=users');
    }

    public function search() {
//        include_once 'app/Models/User.php';
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//        echo $id;
//        die();
        if (trim($text) !== "" ) {
            $user = (new User())::search($this->conn, $text);
            if ($user == -1) {
                $_SESSION['alert']['notFound'] = true;
                echo $_SESSION['alert']['notFound'];
//                die();
//                include 'views/users.php';
                header('Location: ?controller=users');
            }
            else {
                $user = (new User())::byId($this->conn, $user);
                include_once 'views/showUser.php';
            }
        }



    }

    public function addComment()
    {
//        include_once 'app/Models/User.php';
//        include_once 'app/Models/Comment.php';

        $userID = filter_input(INPUT_POST, 'userID');
        $pageID = filter_input(INPUT_POST, 'pageID');
        $commentText = filter_input(INPUT_POST, 'comment');

        (new Comment())::addComment($this->conn, $pageID, $userID, $commentText);


//        echo date("h:i:sa");

//        die("works");


//        die();
            $str ='Location: ?controller=users&action=show&id=' . $pageID;
        header($str);
        include_once 'views/showUser.php';
    }

    public function deleteComment()
    {

//        include_once 'app/Models/User.php';
//        include_once 'app/Models/Comment.php';

        $commentID = filter_input(INPUT_POST, 'commentID');
        $pageID = filter_input(INPUT_POST, 'pageID');
        print_r($_POST);
        print_r($_GET);
//        die();

        (new Comment())::deleteCommentByID($this->conn, $commentID);

        $str ='Location: ?controller=users&action=show&id=' . $pageID;
        header($str);
    }

    public function contact() {
        include_once 'views/contact.php';
    }

    public function contactAdmin () {
        $msg = filter_input(INPUT_POST, 'msg');
        $email = filter_input(INPUT_POST, 'email');
        $theme = filter_input(INPUT_POST, 'theme');
        $name = filter_input(INPUT_POST, 'name');
//        echo "die";
//        die();
        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAutoTLS = false;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->Username = $_ENV['CONTACT_EMAIL']; // your gmail email
            $mail->Password = $_ENV['CONTACT_PASSWORD']; // app generated pwd
            $mail->From = $email;
            $mail->addAddress($_ENV['CONTACT_EMAIL']);
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $name.":" .$theme;
            $mail->Body = $msg;
            $res = $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function ajaxText() {
        include_once "views/ajaxText.php";
    }
}
