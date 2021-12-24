<?php
/**
 * $access
 * -1 = unauthorized user
 * 0  = user that locates on another user's page
 * 1  = user that locates on its own page
 * 2  = admin that can do everything
 */
$myPath = dirname(__DIR__) . '/vendor/autoload.php';
require $myPath;
use Model\Authorization;
use Model\User;

$isUserOnHisOwnPage = false;
if (isset($_SESSION['user'])) {
    $access=0;
    $_SESSION['user'] = (new User())::byId($this->conn, $_SESSION['user']['userID']);
//    print_r($user);
    if (
        isset($user->userID) && $user->userID != "" &&
        $_SESSION['user']['userID'] == $user->userID)
    {
        $access = 1;
        $isUserOnHisOwnPage = true;
    }
    if ($_SESSION['user']['roleID']==1) {
        $access = 2;
    }
}
else{
    $access = -1;
}