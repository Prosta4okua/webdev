<?php

?>
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

<div class="container">
    <?php
    $pathToDatabase = "assets\public\databases\users.csv";

    if (!file_exists($pathToDatabase)) {
        echo "<article class='redText'>Database file doesn't exist</article>";
    }
//    else {
//        $fp = fopen($pathToDatabase, 'r') or die("Error creating the file " . $pathToDatabase);
////        fread($fp, filesize($pathToDatabase));
//
////        $users[] = [
////            'name' => $user[0],
////            'email' => $user[1],
////            'gender' => $user[2]
////        ];
////        $user = explode(",", fread($fp, filesize($pathToDatabase)));
//        $user = fread($fp, filesize($pathToDatabase));
//        var_dump($user);
////
//        echo "<br>TEST</br>";
//        for ($i = 0; $i < count($user); $i += 3) {
//            $users[] = [
//                'name' => $user[$i],
//                'email' => $user[$i+1],
//                'gender' => $user[$i+2]
//            ];
//        }
//        print_r($users);
////        for





//    $row = 0;
//    $fp = fopen($pathToDatabase, 'r');
//    $heh = fread($pathToDatabase, count());
//    $data = file_get_contents($heh);
//    $user = explode("\n", $data);
//    for ($i = 0; $i < count($user); $i++) {
//        echo "$user[$i]" . "<br>";
//    }
////    $data = explode("\n", $fp);
//    echo "Heheh: " . $data . "<br>";
////    print_r("Hehe: " . $data . "<br>");
//
//        if (($fp = fopen($pathToDatabase, 'r')) != FALSE) {
//            $users[] = [
//                'name' => "",
//                'email' => "",
//                'gender' => ""
//            ];
//            echo fgetcsv($fp, 1000, ",");
//            while (($data = fgetcsv($fp, 1000, ",")) != FALSE) {
//                echo "TESTTTTTTTTTTTTT";
//                echo "Name: " . $data[$row*3];

//            }
//            print_r($users);
//            echo "TEST";
//        }
//        fclose($fp);
/*
    echo gettype(str_replace("\n", ",", file_get_contents($pathToDatabase)));
    echo gettype(file_get_contents($pathToDatabase));
*/
    $csv = str_getcsv(str_replace("\n", ",", file_get_contents($pathToDatabase)));
/*
    echo '<pre>';
    print_r($csv);
    echo '</pre>';
*/
    for ($i = 0; $i < count($csv); $i += 4) {
        $users[($i)/3] = [
                'name'      => $csv[$i],
                'email'     => isset($csv[$i+1]) ? $csv[$i+1] : "",
                'gender'    => isset($csv[$i+2]) ? $csv[$i+2] : "",
                'filePath'  => isset($csv[$i+3]) ? $csv[$i+3] : ""
                ];
    }

/*
    echo '<br>Test:<pre>';
    print_r($users);
    echo '</pre>';
*/
//    TODO delete warning showing
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



//    $csvFile = file_get_contents($pathToDatabase);
//    $csvFile = explode("\n", $csvFile);
//
////    $lines = explode("\n", $csvFile);
//
//    $users[] = array();
//    $index = 0;
//    echo "<br><br><br><br><br>";
//    foreach ((array) $csvFile as $user) {
//        echo $index . ":". $user . "<br>";
//        if (($index + 3) % 3 === 0) {
//            $users[$index]['name'] = str_getcsv($user);
//        }
//        elseif (($index + 3 + 2) % 3 === 0){
//            $users[$index]['email'] = str_getcsv($user);
//        }
//        else {
//            $users[$index]['gender'] = str_getcsv($user);
//        }
////            $users[] = [
////                'name' => str_getcsv($user),
////                'email' => str_getcsv($user),
////                'gender' => str_getcsv($user)
////        ];
//        $index++;
//    }
////    echo count($users);
////    var_dump($users);
//    echo "<br><br>TESTTTTTTTTTT<br><br>";
//    echo "<pre>";
//    print_r($users);
//    echo "</pre>";



    ?>








<!--    <hr>-->
    <a class="btn" href="adduser.php">return back</a>
</div>
</body>
</html>
