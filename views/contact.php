<?php
include "navbar.php";
include "access.php";
//if (($access == -1)) {
//    $_SESSION['alert']['logIn']=true;
////    alert("You need to log in");
//    header("Location: ?users");
//    include_once "users.php";
//}
//echo $access;
//die();
?>
<h1 class="text-center">Contact Us</h1>
<div class="container-md">
    <form action="?controller=users&action=contactAdmin" method="post" enctype="multipart/form-data">
    <!-- Name input -->
    <div class="form-outline mb-4">
        <input type="text" id="form4Example1" class="form-control" name="name" required/>
        <label class="form-label" for="form4Example1">Name</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="form4Example2" class="form-control" name="email" required/>
        <label class="form-label" for="form4Example2">Email address</label>
    </div>

    <div class="form-outline mb-4">
        <input type="text" id="form4Example4" class="form-control" name="theme" required/>
        <label class="form-label" for="form4Example4">Theme</label>
    </div>

    <!-- Message input -->
    <div class="form-outline mb-4">
        <textarea class="form-control" id="form4Example3" rows="4" name="msg" required></textarea>
        <label class="form-label" for="form4Example3">Message</label>
    </div>


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Send</button>
</form>
</div>