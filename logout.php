<?php
    session_start();

    //intializing all session variables to null
    $_SESSION=array();

    //setting cookies to null
    if(isset($_COOKIE[$_SESSION])) {
        setcookie($_SESSION, '', time() - 42000, '/');
    }

    session_destroy();
    
    //redirecting to login
    header("Location:index.php");
?>
