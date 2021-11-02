<?php
session_start();
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $isRestricted = true;
}?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body{
            padding-top: 3rem;
        }
        .container {
            width: 400px;
        }
    </style>
</head>
<body>
<?php if($isRestricted):?>
    <form action="logout.php" method="post" enctype="multipart/form-data">
        <input type="submit" class="btn right" value="Logout">
    </form>
    <div class="container">
        <h3>Add New User</h3>
        <br action="handler.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="field">
                    <label>Name: <input type="text" name="name"></label>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <label>E-mail: <input type="email" name="email"><br></label>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <label>
                        <input class="with-gap" type="radio" name="gender" value="female"/>
                        <span>Female</span>
                    </label>
                </div>
                <div class="field">
                    <label>
                        <input class="with-gap"  type="radio" name="gender" value="male"/>
                        <span>Male</span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Photo</span>
                        <input type="file" name="photo" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
            <input type="submit" class="btn" value="Add">
        </form>
</div>


    <?php else:?>
    <div class="container">
        <span>
           Content is restricted, please <a href="auth.php">Login</a>
       </span>
    <?php endif;?>
</div>
</body>
</html>
