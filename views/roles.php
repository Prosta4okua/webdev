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
        List of roles
    </title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .container {
            width: 400px;
        }
    </style>
</head>
<body style="padding-top: 3rem;">
<?php if($isRestricted):?>
    <form action="?controller&action=logout" method="post" enctype="multipart/form-data">
        <input type="submit" class="btn right" value="Logout">
    </form>
    <div class="container">
        <div class="row">
            <table>
                <?php foreach ($roles as $role):?>
                    <tr>
                        <td>
                            <form action="?controller=roles&action=show&id=<?=$role['id']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$role['id']?>"><?=$role['id']?></button>
                            </form>
                        </td>
                        <td><?=$role['title']?></td>

                        <td>
                            <form action="?controller=roles&action=delete&id=<?=$role['id']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$role['id']?>">X</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
        <a class="btn" href="?controller=index">return back</a>
        <a class="btn right" href="?controller=roles&action=addForm">add new role</a>
        <br><br><br><br><br>
    </div>
<?php else:?>
    <?php include 'restrict.php'?>
<?php endif;?>
</body>
</html>
