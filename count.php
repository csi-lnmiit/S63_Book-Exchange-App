<?php
    require_once('db_connect.php'); //connect with database

    $query = "select count(*) from requests where from_user='" . $_SESSION['user_id'] . "' and sn=1";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $borrow = $row['count(*)'];

    $query = "select count(*) from requests where to_user='" . $_SESSION['user_id'] . "' and rn=1";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $lent = $row['count(*)'];
?>
