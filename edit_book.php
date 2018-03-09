
<?php
	//connection to database
	require_once('db_connect.php');
	if(isset($_GET['edit'])){
		$bid = $_GET['edit'];
		$sql="SELECT bname,author FROM books WHERE bid='$bid'";
		mysqli_query($link,$sql);
		//header('location: modify.php');

	
	}

/*

*/

?>

<form action='edit_book.php'>
	    							<div class='form-group'>
	      								<label for='bname'>Book Name :</label>
	      								<input type='text' class='form-control' id='bname' placeholder='Enter book name' name='bname'>
	    							</div>
	    							<div class='form-group'>
	      								<label for='author'>Author :</label>
	      								<input type='text' class='form-control' id='author' placeholder='Enter author name' name='author'>
	    							</div>
	    							<button type='submit' class='btn btn-default'>Save</button>
	  							</form>
