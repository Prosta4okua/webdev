<?php require "navbar.php"?>

<h1 class="text-center">Welcome to our website!</h1>

<?php //if($isRestricted):?>
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
<?php //else:?>

<!--    --><?php //endif;?>
</body>
</html>