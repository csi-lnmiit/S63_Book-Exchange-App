<?php
    if(!isset($_SESSION)) session_start();

    $host = "localhost";
    $user = "root";
    $pwd = "784785";
    $db = "practice";
    $con = mysqli_connect($host,$user,$pwd,$db);

    if(mysqli_connect_errno()) {
        die("Error occured: " . mysqli_connect_error());
    }

    if(isset($_POST["submit"])) {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["pass"] = $_POST["pass"];

        $query = "select * from register where user='" . $_SESSION["name"] . "' and pass='" . $_SESSION["pass"] . "'";
        $result = mysqli_query($con,$query);
    }
?>

<html>
    <head>
        <title>Login</title>
    </head>

    <body>
        Log in<br><br>
        <form action="login.php" method="post">
            <label>Username: </label> <input type="text" name="name" value=""><br>
            <label>Password: </label> <input type="password" name="pass"><br><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php
            if(mysqli_fetch_assoc($result)) {
                echo("Login Succeded!");
            }
            else {
                echo("Username or password incorrect. Try again!");
            }
        ?>
    </body>
</html>
