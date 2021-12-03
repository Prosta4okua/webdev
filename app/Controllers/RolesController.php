<?php
class RolesController {
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

    public function index()
    {
        include_once 'app/Models/RoleModel.php';

        // отримання користувачів
        $roles = (new Role())::all($this->conn);

        include_once 'views/roles.php';
    }

    public static function index2()
    {
        include_once 'app/Models/RoleModel.php';

        // отримання користувачів
        $roles = (new Role())::all($this->conn);

    }

    public function addForm(){
        include_once 'views/addRole.php';
    }

    public function add()
    {

        include_once 'app/Models/RoleModel.php';

        // блок з валідацією
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//        die("Title" . $title);
        if (trim($title) !== "") {
            // додати користувача
            $role = new Role($title);
            $role->add($this->conn);
        }
        header('Location: ?controller=roles');
    }

    public function delete() {
        include_once 'app/Models/RoleModel.php';
        // блок з валідацією
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new Role())::delete($this->conn, $id);
        }
        header('Location: ?controller=roles');
    }

    public function show() {
        include_once 'app/Models/RoleModel.php';

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            $role = (new Role())::byId($this->conn, $id);
        }
        include_once 'views/showRole.php';
    }

//    public static function showTwo() {
//        include_once 'app/Models/RoleModel.php';
//
//        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//        if (trim($id) !== "" && is_numeric($id)) {
//            $role = (new Role())::byId($this->conn, $id);
//        }
////        include_once 'views/showRole.php';
//    }



    public function edit() {
        include_once 'app/Models/RoleModel.php';



        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//        die($title);

        if (trim($title) !== "" && trim($id) !== "") {
            $role = new Role($title);
            $role->update($this->conn, $id, $role);
        }

        header('Location: ?controller=roles');
    }



}