
<?php
    session_start();
    //unsetting and destroying the session
    session_unset();
    session_destroy();
    //redirecting to login
    header("Location:index.php");
?>
