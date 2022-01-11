<?php
//session_start();
error_reporting(E_ERROR | E_PARSE);
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $isRestricted = true;
}
//print_r($_SESSION);
//die();
?>
<!--Початок navbar.php-->
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
    <script>

        const requestURL = '?controller&action=auth2';
        window.onload = () => {
            const form = document.getElementById('auth');
            form.addEventListener('submit', event => {
                event.preventDefault(); // зупиняє дію за замовчуванням
                console.log('submit');

                const formData = new FormData();
                formData.append('email', document.querySelector('input[name="email"]').value);
                formData.append('password', document.querySelector('input[name="password"]').value);
                // console.log(formData.values());
                // sendRequest('POST', '')
                // //{email: 'vasia', password: "ghg"}
                const request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                       console.log("request.readyState === 4");
                       //  console.log(typeof (request.response));
                        console.log(this.responseText)
                        console.log(typeof this.responseText)
                        let paragraph = document.getElementById("err");
                        if (this.responseText === "null") {
                            console.log("i don't understand this fucking world")
                           paragraph.innerHTML = "<p class='redText'> Password is incorrect </p>";
                           console.log(paragraph.textContent);
                       }
                        else {
                            console.log("request.readyState" + request.readyState);
                            // paragraph.innerHTML = "";
                            console.log("hehe")
                            const form = new FormData();
                            form.append('email', document.querySelector('input[name="email"]').value);
                            form.append('password', document.querySelector('input[name="password"]').value);
                            // request.open("POST", requestURL);
                            // request.send(form);
                            window.location.replace("");
                        }

                        console.log();
                        // callback(request.response)
                    }
                }
                request.open("POST", requestURL);
                request.send(formData);
                //
                // sendRequest('POST', requestURL, formData).then( data => {
                //     console.log(data);
                // }).catch( error => console.error(error));
            })
        }

        function sendRequest(method, url, body = null) {
            const headers = {
                'Content-Type': 'application/json'
            };
            return fetch(url, {
                method: method,
                body: JSON.stringify(body),
                headers: headers
            }).then( response => {
                return response.json()
            })
        }


    </script>
</head>
<body>
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>





<!--TODO поле для пошуку.-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<!--    <a class="navbar-brand" href="#">Navbar</a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller=users">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller=users&action=contact">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller=users&action=ajaxText">Ajax Test</a>
            </li>
<!--            <li class="nav-item">-->
<!--                <a class="btn" href="?controller=users">List of all Users</a>-->
<!--            </li>-->
        </ul>
<!--        <form action="?controller=roles&action=add" method="post" enctype="multipart/form-data">-->
<!--        <form class="d-flex mx-auto" action="?controller=users&action=addForm" method="post"  enctype="multipart/form-data">-->
            <form class="d-flex mx-auto" action="?controller=users&action=search" method="post">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="text" id="text">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <ul class="navbar-nav mx-3">
            <li class="nav-item">
                 <?php if (isset($_SESSION['auth']) && $_SESSION['auth']):?>
                     <form action="?controller=users&action=show&id=<?=$_SESSION['user']['userID']?>" method="post">
<!--                         text-->
                         <button class="nav-link active btn" type="submit" name="id" value="<?=$_SESSION['user']['userID']?>">Hello, <?php echo $_SESSION['user']['name'] . " " . $_SESSION['user']['surname'] ?></button>
                     </form>

<!--                <form action="?controller=users&action=show&id=--><?//=$_SESSION['user']['userID']?><!--" method="post">-->
<!--                    <button type="submit" class="nav-link active btn" aria-current="page">Hello, --><?php //echo $_SESSION['user']['name'] ?><!--</button>-->
<!--                </form>-->
                 <?php else:?>
<!--                     <a class="nav-link active" aria-current="page"  data-toggle="modal" data-target="#loginModal">Sign In</a>-->
                     <button type="button" class="nav-link active btn" data-bs-toggle="modal" data-bs-target="#modalForm">
                         Sign In
                     </button>
                 <?php endif;?>
            </li>
            <div class="vl"></div>
            <li class="nav-item">
                <?php if (isset($isRestricted) && $isRestricted):?>
                    <a class="nav-link active" aria-current="page" href="?controller&action=logout">Sign out</a>
                <?php else:?>
                    <a class="nav-link active" aria-current="page" href="?controller=users&action=addForm">Sign up</a>
                <?php endif;?>
            </li>
        </ul>
    </div>
</div>
</nav>
<!--<button type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#modalForm">-->
<!--    Authentication-->
<!--</button>-->

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bootstrap 5 Modal Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="auth" action="?controller&action=auth" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control" id="username" name="email" placeholder="Username" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>
                    <p id="err"></p>
                    <div class="modal-footer d-block">
                        <p class="float-start">Don't have an account? <a href="#">Sign Up</a></p>
                        <button type="submit" id="submit" class="btn btn-success float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Кінець navbar.php-->