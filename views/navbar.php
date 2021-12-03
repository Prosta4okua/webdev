<?php
//session_start();
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $isRestricted = true;
}?>
<!doctype html>
<html lang="en">
<head>
    <title>
        Home
    </title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2-dist/css/bootstrap.css">
</head>
<body>
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<!--    <a class="navbar-brand" href="#">Navbar</a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller">Home</a>
            </li>
        </ul>
        <form class="d-flex mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <ul class="navbar-nav mx-3">
            <li class="nav-item">
                 <?php if (isset($isRestricted) && $isRestricted):?>
                     <a class="nav-link active" aria-current="page" href="#">Hello, <?php echo $_SESSION['username'] ?></a>
                 <?php else:?>
                     <a class="nav-link active" aria-current="page" href="?controller&action=auth">Sign In</a>
                 <?php endif;?>
            </li>
            <div class="vl"></div>
            <li class="nav-item">
                <?php if (isset($isRestricted) && $isRestricted):?>
                    <a class="nav-link active" aria-current="page" href="?controller=users&action=add">Sign out</a>
                <?php else:?>
                    <a class="nav-link active" aria-current="page" href="?controller=users&action=addForm">Sign up</a>
                <?php endif;?>
            </li>
        </ul>
    </div>
</div>
</nav>