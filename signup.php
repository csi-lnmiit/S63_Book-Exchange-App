<?php
if(!isset($_SESSION))
session_start();
?>

<!--php work start-->
<?php
    $servername="localhost";
    $username="SLP";
    $pwd="qwerty";
    $db="libromate";

    //connection start
    $conn=new mysqli($servername,$username,$pass,$db);

    //check connection
    if($conn->connect_error)
        die("connection failed: ".$conn->connect_error);
    
    $_SESSION["name"]=$_POST["name"];
    $_SESSION["email"]=$_POST["email"];
    $_SESSION["user"]=$_POST["user"];
    $_SESSION["pass"]=$_POST["pass"];
    