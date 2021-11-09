<!doctype html>
<html lang="en">
<head>
    <title>
        List of users
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

<div class="container">
    <div class="row">
        <table>
            <?php foreach ($users as $user):?>
                <tr><td><?=$user['name']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['gender']?></td>
                    <?php $pathh = ($user['path_to_img'] === "")? "../public/default/default.png" : "../public/uploads/" . $user['path_to_img']?>
                    <td><img src='<?=$pathh?>' width="50px"/></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
    <?php var_dump($users)?>
    <a class="btn" href="?controller=index">return back</a>
    <a class="btn right" href="?controller=users&action=addForm">add new user</a>
</div>
</body>
</html>
