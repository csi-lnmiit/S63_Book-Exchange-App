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

        $query = "insert into register values('" . $_SESSION["name"] . "','" . $_SESSION["pass"] . "')";
        mysqli_query($con,$query);
    }
?>

<html>
    <head>
        <title>Register</title>
    </head>

    <body>
        Sign up<br><br>
        <form action="register.php" method="post">
            <label>Username: </label> <input type="text" name="name" value=""><br>
            <label>Password: </label> <input type="password" name="pass"><br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>

<?php
    mysqli_close($con);
?>
