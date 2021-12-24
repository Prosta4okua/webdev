<?php include "navbar.php"?>
<?php
require "access.php";
function alert($text) {
    echo "<script>";
    echo "setTimeout(function () {";
    echo " alert('$text');";
//    echo    "console.log ($text);";
    echo "}, 10);";
    echo "</script>" . "<br>";
//    die();
}

function verify($var) {
    if (isset($var) == false)
        return false;
    else
        return $var;
}
//echo verify($_SESSION['alert']['emailExists']);
//die();
//echo verify($_SESSION['alert']['wrongData']);
//die();

if(verify($_SESSION['alert']['emailExists']))
{
    alert("This email already exists");
    $_SESSION['alert']['emailExists']=false;
}
if(verify($_SESSION['alert']['registration']))
{
    alert("You have successfully registered. Now you need to log in!");
    $_SESSION['alert']['registration']=false;
}

if(verify($_SESSION['alert']['wrongData']))
{
    alert("You have entered incorrect data!");
    $_SESSION['alert']['wrongData']=false;
//    echo "text";
//    die();
}

if(verify($_SESSION['alert']['notFound'])) {
    alert("Unfortunately, we didnt found this person. :c");
    $_SESSION['alert']['notFound'] = false;
}

if(verify($_SESSION['alert']['wrongEmailFormat']))
{
    alert("Invalid email format!");
    $_SESSION['alert']['wrongEmailFormat']=false;
}

if(verify($_SESSION['alert']['wrongPassword'])) {
    alert("Passwords do not match!");
    $_SESSION['alert']['wrongPassword'] = false;
}







?>


<?php






?>


 <div class="container">
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Avatar</th>
                    <?php if ($access == 2)
                        echo "<th>Delete</th>"
                    ?>

                </tr>
                <?php foreach ($users as $user):?>
                    <tr>
                        <td>
                            <form action="?controller=users&action=show&id=<?=$user['userID']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$user['userID']?>"><?=$user['userID']?></button>
                            </form>
                        </td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['surname']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['gender']?></td>

                        <td>
                            <?php
                            $index = gettype($user['roleID']);
                            echo $roles[$user['roleID']-1]['roleName'];
                            ?>
                        </td>
                        <?php $path = ($user['avatarName'] === "")? "../public/default/default.png" : "../public/uploads/" . $user['avatarName']?>
                        <td><img src='<?=$path?>' width="50px"/></td>
                        <?php

//                        die();
                        ?>
                        <?php if (($access == 2) && (isset($_SESSION['user'])) && ($_SESSION['user']['userID'] != $user['userID'])):?>
                        <td>

                            <form action="?controller=users&action=delete&id=<?=$user['userID']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$user['userID']?>"><?php echo $isUserOnHisOwnPage;?>X</button>
                            </form>
                        </td>
                        <?php endif;?>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
<!--        <a type="button" class="btn btn-secondary" href="?controller=index">Return back</a>-->
     <?php if($access==2):?>
     <a type="button" class="btn btn-success right" href="?controller=users&action=addForm">Sign up new user</a>
     <?php endif;?>
        <br><br><br><br><br>
    </div>
<?php //else:?>
<!--    --><?php //include 'restrict.php'?>
<?php //endif;?>
</body>
</html>
