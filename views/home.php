<?php include "navbar.php"?>
<h1 class="text-center">Welcome to our cool website!</h1>

<?php if(isset($_SESSION['alert']['emailExists']) && ($_SESSION['alert']['emailExists'])):?>
    <script>
        alert("This email already exists");
    </script>
<?php endif;?>

<?php if(isset($_SESSION['alert']['registration']) && ($_SESSION['alert']['registration'])):?>
    <script>
        alert("You've successfully registered. Now you need to log in!");
    </script>
<?php endif;?>

<?php
$_SESSION['alert']['emailExists']=false;
$_SESSION['alert']['registration']=false;
?>

</body>
</html>
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
