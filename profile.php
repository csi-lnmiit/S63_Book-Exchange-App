<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");
?>

<!--Display submitted form data -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Dashboard</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	</head>

	<body>
	    <!--top header-->
	    <header style="height:100px;background-color:#2D2E40;width:20%">
	        <img src="Images/logo.png" style="height:100px;">
	    </header>

	    <!--left column list -->
	    <div id="dashboard_left_col" class="col-md-3" style="padding-left: 0">
	        <ul>
				<br>
	            <p>MENU</p>
	            <li><a href="dashboard.php">
	                <span class="glyphicon glyphicon-home"></span>&emsp;Dashboard</a>
	            </li>
	            <li><a class="active" href="profile.php">
	                <span class="glyphicon glyphicon-user"></span>&emsp;Profile</a>
	            </li>
				<br>
	            <p>BOOKS</p>
	            <li><a href="#">
	                <span class="glyphicon glyphicon-plus"></span>&emsp;Add</a>
	            </li>
	            <li><a href="#">
	                <span class="glyphicon glyphicon-trash"></span>&emsp;Delete</a>
	            </li>
	            <li><a href="#">
	                <span class="glyphicon glyphicon-edit"></span>&emsp;Modify</a>
	            </li>
				<br>
	            <p>STATS</p>
	            <li><a href="#">
	                 <span class="glyphicon glyphicon-hourglass"></span>&emsp;Request status</a>
	             </li>
	            <li><a href="#">
	                 <span class="glyphicon glyphicon-book"></span>&emsp;Borrowed</a>
	            </li>
	            <br>
	            <p>SESSION</p>
	            <li><a href="logout.php">
	                <span class="glyphicon glyphicon-log-out"></span>&emsp;Logout</a>
	            </li>
	        </ul>
	    </div>

	    <div class="col-md-9">
	        <h3>Hello <?php echo htmlentities($_SESSION["user"]); ?>,</h3>
	        <p>Here is the information you have submitted:</p>
	        <ol>
	            <li><em>Name:</em> <?php echo $_SESSION["name"]?>
	            <li><em>E-Mail:</em> <?php echo $_SESSION["email"]?>
	            <li><em>Mobile:</em> <?php echo $_SESSION["mobile"]?>
	            <li><em>Points:</em> <?php echo $_SESSION["points"]?>
	            <li><em>Username:</em> <?php echo $_SESSION["user"]?>
	            <li><em>Password:</em> <?php echo $_SESSION["pass"]?>
	        </ol>

	    </div>
	</body>
</html>
