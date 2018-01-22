<?php
    $host = 'localhost';
    $user = 'slp';
    $pwd = 'qwerty';
    $db = 'libromate';
    $con = mysqli_connect($localhost, $user, $pwd, $db); //connecting to database

    if (!$con) {
        die("Failed to connect!" . mysqli_error($con)); //kill page if not connected
    }
?>
