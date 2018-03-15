<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Lent</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	   	<link rel="stylesheet" type="text/css" href="CSS/search_nav.css">
	</head>

	<body>

	    <!--top header-->
	    <header style="height:100px;background-color:#1A1927;width:20%;position: fixed;">
	        <a href="dashboard.php">
                <img src="Images/logo.png" style="height:100px; margin-left:25px;">
            </a>
	    </header>

	    <!--left column list -->
	    <div id="dashboard_left_col" class="col-md-3" style="padding-left: 0;padding-top:100px"><!--col-md-3 start-->
	        <ul>
				<br>
	            <p>MENU</p>
	            <li><a href="dashboard.php">
	                <span class="glyphicon glyphicon-home"></span>&emsp;Dashboard</a>
	            </li>
	            <li><a href="profile.php">
	                <span class="glyphicon glyphicon-user"></span>&emsp;Profile</a>
	            </li>
				<br>
	            <p>BOOKS</p>
	            <li><a href="add.php">
	                <span class="glyphicon glyphicon-plus"></span>&emsp;Add</a>
	            </li>
	            <li><a href="modify.php">
	                <span class="glyphicon glyphicon-edit"></span>&emsp;Modify</a>
	            </li>
				<br>
				<p>STATUS</p>
	            <li><a href="borrow.php">
	                 <span class="glyphicon glyphicon-hourglass"></span>&emsp;Borrowed</a>
	             </li>
	            <li><a class="active" href="lent.php">
	                 <span class="glyphicon glyphicon-book"></span>&emsp;Lent</a>
	            </li>
                <br>
                <p>SESSION</p>
	            <li><a href="logout.php">
	                <span class="glyphicon glyphicon-log-out"></span>&emsp;Logout</a>
	            </li>
                <li><a href="trash.php">
                    <span class="glyphicon glyphicon-trash"></span>&emsp;Trash</a>
                </li>
	        </ul>
	    </div><!--col-md-3 end-->

	    <div class="col-md-9"><!--col-md-9 start-->
	    	<div class="topnav"><!--search bar nav start-->
				<br>
				<div class="search-container">
				    <form action="search.php" method="post">
				      <input type="text" placeholder=" Search book name or author name ..." name="search_input" size="65%">
				      <button type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
				    </form>
				</div>
			</div><!--search bar nav end-->
	    </div><!--col-md-9 end-->
	</body>
</html>
