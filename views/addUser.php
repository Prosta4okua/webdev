<title>Registration form</title>
<?php include "navbar.php";
?>
<form action="?controller=users&action=add" method="post" enctype="multipart/form-data">
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">
                    <h1 class="mb-4">Registration form</h1>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Your surname</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="text" name="surname" class="form-control form-control-lg" required/>
                                    </label>
                                </div>
                            </div>

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Your name</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="text" name="name" class="form-control form-control-lg" required/>
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
                                        <input onchange="mainInfo(this.value); type="email" name="email" class="form-control form-control-lg" placeholder="example@example.com" required/>
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
                                        <input type="password" minlength="6" name="password" class="form-control form-control-lg" placeholder="gfglfglf" required>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Confirm password</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <label>
                                        <input type="password" minlength="6" name="password2" class="form-control form-control-lg" placeholder="gfglfglf" required>
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
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female" checked>
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
</body>
</html>
