<?php
include "navbar.php";
include "access.php";

if (($access == -1)) {
    $_SESSION['alert']['logIn']=true;
    header("Location: ?users");
}
?>
<h1 class="text-center">Contact Us</h1>
<div class="container-md">
<form action="?controller=users&action=contactAdmin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="userID" value="<?=$_SESSION['user']['userID'];?>">
    <input
        type="text"
        id="addANote"
        class="form-control"
        name="usertext"
        placeholder="Type text here..."
    />
    <button class="btn btn-outline-success right" type="submit">Send message to admin</button><br>
</form>
</div>