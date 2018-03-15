<?php
	session_start();
	//connect to database
	require_once('db_connect.php');

	//if confirm delete is clicked on modify
	if (isset($_GET['trash'])) {
		$bid = $_GET['trash'];
		$sql="UPDATE books b SET b.trash='1' WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: modify.php');
	}

	//if confirm delete is clicked on trash
	else if (isset($_GET['del'])) {
		$bid = $_GET['del'];
		$sql="DELETE FROM books WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: trash.php');
	}

	//if confirm resttore is clicked on trash
	else if (isset($_GET['res'])) {
		$bid = $_GET['res'];
		$sql="UPDATE books b SET b.trash='0' WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location:trash.php');
	}

	//if request is clicked on search
	else if(isset($_GET["request"])) {
		$bid = $_GET['request'];
		$to_user = $_GET['to_user'];
		$sql = "insert into requests values('" . $bid . "','" . $_SESSION['user_id'] . "','" . $to_user . "',0,1,0)";
		mysqli_query($link,$sql);
		header('location:search.php');
	}
?>
