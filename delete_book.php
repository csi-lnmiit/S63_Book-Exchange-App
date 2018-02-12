<?php
	//connect to database
	require_once('db_connect.php');

	//if confirm delete is clicked
	if (isset($_GET['del'])){
		$bid = $_GET['del'];
		$sql="DELETE FROM books WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: modify.php');
	}
?>
