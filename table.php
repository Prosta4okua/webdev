<?php
session_start();
$isRestricted = false;
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $isRestricted = true;
}?>
<!doctype html>
<html lang="en">
<title>
    Handler
</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Imports external css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--My own styles-->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .container {
            width: 400px;
        }
    </style>
    <title></title>
</head>
<body style="padding-top: 3rem;">
<?php if($isRestricted):?>
<div class="container">

    <?php
    require 'db.php';
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $i = 0;
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $i++;
            $users[] = [
                'name'      => $row['name'],
                'email'     => $row['email'] ?? "",
                'gender'    => $row['gender'] ?? "",
                'filePath'  => $row['path_to_img'] ?? ""
            ];
            $myFile = pathinfo($row['filePath'] ?? "");
            if (empty($users[$i]['filePath']))
                $myFile['basename'] = "Default.png";
        }
    }

    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Gender</th>";
    echo "<th>Image</th>";
    echo "<tr>";
    for ($i = 0; $i < count($users); $i++) {
        if (!empty($users[$i]['email'])) {
            echo "<tr>";
            echo "<td>" . $users[$i]['name'] . "</td>";
            echo "<td>" . $users[$i]['email'] . "</td>";
            echo "<td>" . $users[$i]['gender'] . "</td>";
            $myFile = pathinfo($users[$i]['filePath']);
            if ($users[$i]['filePath'] == "")
                $myFile['basename'] = "Default.png";
            echo "<td>" . "<img src='" . "assets/public/images//" . $myFile['basename'] . "' alt='' width='50' height='50'" . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "<br><br>"
    ?>

    <a class="btn" href="login.php">return back</a>

</div>
<?php else:?>
<div class="container">
        <span>
           Content is restricted, please <a href="auth.php">Login</a>
       </span>
    <?php endif;?>
</body>
</html>
