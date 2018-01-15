<?php
	$servername = "localhost";
	$username = "root";
	$pass = "josaa2598";
	$db="signup";

// Create connection
$conn = new mysqli($servername, $username, $pass,$db);
// Check connection
	if ($conn->connect_error) {
   	 	die("Connection failed: " . $conn->connect_error);
				}

	else echo "connected successfully";

//$query="create table register(name varchar(20),password varchar(20))";
//mysqli_query($conn,$query);
	$name=$_POST["name"];
	$password=$_POST["password"];
		if($name==null || $password==null)
			echo "error";
		else{
			$query="insert into register values('" . $name . "','" . $password . "')";
			mysqli_query($conn,$query);
		    }



?> 
<html>
<body>

<form action="database.php" method="post">
Name: <input type="text" name="name"><br>
Passord: <input type="text" name="password"><br>
<input type="submit">
</form>

</body>
</html> 

<?php
$conn->close();
?>
