<?php
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $isRestricted = true;

    ?>
<!doctype html>
<html lang="en">
<head>
    <title>
        Add role
    </title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
    <form action="?controller&action=logout" method="post"">
        <input type="submit" class="btn right" value="Logout">
    </form>
    <div class="container">
        <!-- Form to add Role -->
        <h3>Add New Role</h3>
        <form action="?controller=roles&action=add" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="field">
                    <label>Title: <input type="text" name="title"></label>
                </div>
            </div>
            <input type="submit" class="btn" value="Add">
            <a class="btn" href="?controller=home">return back</a>
            <br><br>
        </form>

    </div>
<?php else:?>
    <?php include 'restrict.php'?>
<?php endif;?>
</body>
</html>
