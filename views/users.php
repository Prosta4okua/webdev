<?php include "navbar.php"?>;
<?php
//echo $_SESSION['user']['roleID'];
?>
 <div class="container">
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Avatar</th>
                    <?php if ($_SESSION['user']['roleID'] == 1)
                        echo "<th>Delete</th>"
                    ?>

                </tr>
                <?php foreach ($users as $user):?>
                    <tr>
                        <td>
                            <form action="?controller=users&action=show&id=<?=$user['userID']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$user['userID']?>"><?=$user['userID']?></button>
                            </form>
                        </td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['surname']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['gender']?></td>

                        <td>
                            <?php
                            $index = gettype($user['roleID']);
                            echo $roles[$user['roleID']-1]['roleName'];
                            ?>
                        </td>
                        <?php $path = ($user['avatarName'] === "")? "../public/default/default.png" : "../public/uploads/" . $user['avatarName']?>
                        <td><img src='<?=$path?>' width="50px"/></td>
                        <?php if (($_SESSION['user']['roleID'] == 1) && ($_SESSION['user']['userID'] != $user['userID'])):?>
                        <td>

                            <form action="?controller=users&action=delete&id=<?=$user['userID']?>" method="post">
                                <button class="btn" type="submit" name="id" value="<?=$user['userID']?>">X</button>
                            </form>
                        </td>
                        <?php endif;?>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
        <a type="button" class="btn btn-secondary" href="?controller=index">Return back</a>
        <a type="button" class="btn btn-success right" href="?controller=users&action=addForm">Add new user</a>
        <br><br><br><br><br>
    </div>
<?php //else:?>
<!--    --><?php //include 'restrict.php'?>
<?php //endif;?>
</body>
</html>
