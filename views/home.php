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
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <div class="navbar-nav ms-5">
                <ul class="navbar-nav mx-3-0">
                    <a class="nav-link" href="#">My Text</a>
                </ul>
            </div>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<?php if($isRestricted):?>
    <form action="?controller&action=logout" method="post" enctype="multipart/form-data">
        <input type="submit" class="btn right" value="Logout">
    </form>
    <div class="container">
        <h3>Control Panel</h3>
        <div>
            <br>
            <a class="btn" href="?controller=users">List of all Users</a>
            <a class="btn" href="?controller=roles">List of all Roles</a>
        </div>
    </div>
<?php else:?>
<div class="container">
    <h3>Control Panel</h3>
    <form action="?controller&action=auth" method="post">
        <div class="row">
            <div class="field">
                <label>Email: <input type="email" name="email"></label>
            </div>
        </div>
        <div class="row">
            <div class="field">
                <label>Password: <input type="password" name="password"><br></label>
            </div>
        </div>
        <input type="submit" class="btn" value="Login">
    </form>
    <?php endif;?>
</div>
</body>
</html>