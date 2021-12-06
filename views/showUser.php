<?php include "navbar.php"?>;
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'app/Models/UserModel.php';
//print_r($user);
$roles = (new User())->getRoles($this->conn);
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true)
    $isRestricted = true;
include "access.php";

?>

<form action="?controller=users&action=edit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$user['userID']?>" />
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">
                    <h1 class="mb-4">User info</h1>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($isUserOnHisOwnPage == true):?>
                                            Your surname
                                        <?php else:?>
                                            User's surname
                                        <?php endif;?>
                                    </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <?php


                                    ?>
                                    <label>
                                        <input type="text" name="surname" class="form-control form-control-lg" value="<?=$user['surname']?>" required <?php if(!($access == 2 || $isUserOnHisOwnPage == true)):?>readonly<?php endif?>/>
                                    </label>
                                </div>
                            </div>
                            <hr>

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($isUserOnHisOwnPage == true):?>
                                            Your name
                                        <?php else:?>
                                            User's name
                                        <?php endif;?>
                                    </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="text" name="name" class="form-control form-control-lg" value="<?=$user['name']?>" required <?php if(!($access == 2 || $isUserOnHisOwnPage == true)):?>readonly<?php endif?>/>
                                    </label>
                                </div>
                            </div>

                            <hr class="myGreen">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Email address</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input name="email" class="form-control form-control-lg" placeholder="example@example.com" value="<?=$user['email']?>" required <?php if(!($access == 2 || $isUserOnHisOwnPage == true)):?>readonly<?php endif?>/>
                                    </label>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['user']) && (($_SESSION['user']['roleID']==1) || ($_SESSION['user']['userID']==$user['userID']))):?>
                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="password" minlength="6" name="password" class="form-control form-control-lg" placeholder="Enter password..." <?php if(!($access == 2 || $isUserOnHisOwnPage == true)):?>readonly<?php endif?>>
                                    </label>
                                </div>
                            </div>
                            <?php endif;?>

                            <hr>

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($isUserOnHisOwnPage == true):?>
                                            Your gender
                                        <?php else:?>
                                            User's gender
                                        <?php endif;?>
                                    </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" <?php if ($user['gender']=='male'):?>checked<?php endif;?> <?php if(!($access == 2 || $isUserOnHisOwnPage == true)):?>disabled<?php endif?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female" <?php if ($user['gender']=='female'):?>checked<?php endif;?> <?php if(!($access == 2 || $isUserOnHisOwnPage == true)):?>disabled<?php endif?>>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($isUserOnHisOwnPage == true):?>
                                            Your role
                                        <?php else:?>
                                            User's role
                                        <?php endif;?>
                                    </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <?php

//                                                                        die();
                                    //                                    ?>
                                    <select class="form-select" name="roles" <?php if ($access!=2):?>disabled<?php endif?>>
<!--                                        <option selected>Open this select menu</option>-->
                                        <?php
                                        foreach ($roles as $role):
                                            echo "<option id='role' name='roles' value='".$role['id']."' ";
                                            if (isset($_SESSION['user']) && $_SESSION['user']['roleID']==$role['id'])
                                                echo " selected";
                                            echo ">" . $role['roleName'];

                                            echo "</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-9 pe-5">

                                </div>
                            </div>

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($isUserOnHisOwnPage == true):?>
                                            Your photo
                                        <?php else:?>
                                            User's photo
                                        <?php endif;?>
                                    </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <?php $path = ($user['avatarName'] === "")? "../public/default/default.png" : "../public/uploads/" . $user['avatarName']?>
                                    <img src='<?=$path?>' width="50px"/>
                                </div>
                            </div>

                            <?php if ((isset($_SESSION['user']))&&(($_SESSION['user']['roleID']==1) || ($_SESSION['user']['userID']==$user['userID']))):?>
                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($_SESSION['user']['userID'] == $user['userID']):?>
                                            Upload your new photo
                                        <?php else:?>
                                            Upload user's new photo
                                        <?php endif;?>
                                        </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="photo" accept="image/png, image/gif, image/jpeg">
                                    <div class="small text-muted mt-2">
                                        <?php if($_SESSION['user']['userID'] == $user['userID']):?>
                                            Upload your photo.
                                        <?php else:?>
                                            Upload user's photo.
                                        <?php endif;?>
                                        Max file size 4 MB.

                                    </div>
                                </div>
                            </div>


                            <hr class="myGreen">
                            <div class="px-5 py-4">
                                <button type="submit" class="btn root btn-lg btn-outline-success">Edit info</button>
                            </div>
                            <?php endif;?>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>

<!--Секція коментарів-->
<?php
echo "<br><br><br><br><br>";
echo $access;
//print_r($user);
//die();
//$sesUSER = $_SESSION['user'];
function addComment ($comment) {

    echo "<div class='card p-3 mt-2'>
    <div class='d-flex justify-content-between align-items-center'>
        <div class='user d-flex flex-row align-items-center'> <img src='https://i.imgur.com/C4egmYM.jpg' width='30' class='user-img rounded-circle mr-2'> <span><small class='font-weight-bold text-primary mx-1'>olan_sams</small> <small class='font-weight-bold'>Loving your work and profile! </small></span> </div> <small>3 days ago</small>
    </div>
    <div class='action d-flex justify-content-between mt-2 align-items-center'>
        <div class='reply px-4'> <small>Remove</small> <span class='dots'></span> <small>Edit</small> <span class='dots'></span> <small>Like</small> </div>
        <div class='icons align-items-center'> <i class='fa fa-check-circle-o check-icon text-primary'></i> </div>
    </div>
</div>";
}
?>
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="mb-4">Comments</h1>
                <!--                початок коментарів-->
                <?php if ($access >= 0): ?>
                <div class="form-outline mt-0 mb-4">
                    <form action="?controller=users&action=addComment" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pageID" value="<?=$_SESSION['user']['userID'];?>">
                        <input type="hidden" name="userID" value="<?=$user['userID'];?>">
                        <input
                                type="text"
                                id="addANote"
                                class="form-control"
                                name="comment"
                                placeholder="Type comment..."
                        />
                        <button class="btn btn-outline-success right" type="submit">Add comment</button><br>
                    </form>
                </div>
                <?php endif;?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card p-3 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user d-flex flex-row align-items-center">
                                <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2">
                                <span><small class="font-weight-bold text-primary mx-1">olan_sams</small>
                                    <small class="font-weight-bold"><?=$comment->commentText?></small></span>
                            </div>
                            <small>3 days ago</small>
                        </div>
                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                            <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Edit</small> <span class="dots"></span> <small>Like</small> </div>
                            <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="card p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary mx-1">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Edit</small> <span class="dots"></span> <small>Like</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
                <div class="card p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary mx-1">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
                <!--                кінець коментарів-->
            </div>
        </div>
    </div>
</section>
</body>
</html>

