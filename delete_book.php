<?php
	//connect to database
	require_once('db_connect.php');

	//if confirm delete is clicked
	if (isset($_GET['trash'])){
		$bid = $_GET['trash'];
		$sql="UPDATE books b SET b.trash='1' WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: modify.php');
	}
	else if (isset($_GET['del'])){
		$bid = $_GET['del'];
		$sql="DELETE FROM books WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: trash.php');
	}
	else if (isset($_GET['res'])){
		$bid = $_GET['res'];
		$sql="UPDATE books b SET b.trash='0' WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location:trash.php');
	}
?>
