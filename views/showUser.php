<?php include_once "navbar.php"?>;
<?php
include_once 'app/Models/UserModel.php';
print_r($user);
$user = new User();
$roles = $user->getRoles($this->conn);
?>
<form action="?controller=users&action=edit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$user['userID']?>" />
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">
                    <h1 class="mb-4">Registration form</h1>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">
                                        <?php if($_SESSION['user']['role'] == 1):?>
                                        Your surname
                                        <?php else:?>
                                        User's surname
                                        <?php endif;?>
                                    </h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="text" name="surname" class="form-control form-control-lg" value="<?=$user['surname']?>" required/>
                                    </label>
                                </div>
                            </div>

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Your name</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="text" name="name" class="form-control form-control-lg" value="<?=$user['name']?>" required/>
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
                                        <input name="email" class="form-control form-control-lg" placeholder="example@example.com" value="<?=$user['email']?>" required/>
                                    </label>
                                </div>
                            </div>

                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="password" minlength="6" name="password" class="form-control form-control-lg" placeholder="Enter password..." required>
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Choose your gender</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" <?php if ($user['gender']=='male'):?>checked<?php endif;?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female" <?php if ($user['gender']=='female'):?>checked<?php endif;?> >
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Choose your role</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <?php
                                    //                                    var_dump($roles);
                                    //                                    die()
                                    //                                    ?>
                                    <select class="form-select" name="roles">
                                        <option selected>Open this select menu</option>
                                        <?php
                                        foreach ($roles as $role):
                                            echo "<option id='role' name='roles' value='".$role['id']."'>". $role['roleName'] . "</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Upload your photo</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="photo" accept="image/png, image/gif, image/jpeg">
                                    <div class="small text-muted mt-2">Upload your photo. Max file size 4 MB</div>
                                </div>
                            </div>

                            <hr class="myGreen">
                            <div class="px-5 py-4">
                                <button type="submit" class="btn root btn-lg btn-outline-success">Register</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>

<div class="container">
    <!-- Form to save User -->
    <h3>Show User Form</h3>
    <form action="?controller=users&action=edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$_SESSION['user']['userID']?>" />
        <div class="row">
            <div class="field">
                <label>Name: <input type="text" name="name" value="<?=$_SESSION['user']['name']?>"></label>
            </div>
        </div>
        <div class="row">
            <div class="field">
                <label>E-mail: <input type="email" name="email" value="<?=$_SESSION['user']['email']?>"><br></label>
            </div>
        </div>
        <div class="row">
            <div class="field">
                <label>Password: <input type="password" name="password" value="<?=$_SESSION['user']['password']?>"><br></label>
            </div>
        </div>
        <div class="row">
            <div class="field">
                <label>
                    <input class="with-gap" type="radio" name="gender" value="female" <?php if ($_SESSION['user']['gender']=='female'):?>checked<?php endif;?>/>
                    <span>Female</span>
                </label>
            </div>
            <div class="field">
                <label>
                    <input class="with-gap"  type="radio" name="gender" value="male" <?php if ($_SESSION['user']['gender']=='male'):?>checked<?php endif;?>/>
                    <span>Male</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Photo</span>
                    <input type="file" name="photo"  accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <input type="submit" class="btn" value="Save">
        <a class="btn" href="?controller=index">return back</a>
    </form>

</div>
<?php //else:?>
<!--    --><?php //include 'restrict.php'?>
<?php //endif;?>
</body>
</html>
