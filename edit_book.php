<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");
	//if edit glyphicon is clicked
	if(isset($_GET['edit'])){
		//connect to database
		require_once('db_connect.php');
		$bid = $_GET['edit'];
		$query = "SELECT * FROM books WHERE bid='$bid'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);

		$old_bname = $row['bname'];
		$old_author = $row['author'];
		
	}
	//if update is clicked under modify 
	if (isset($_POST["update"])) {
		require_once('db_connect.php');
		$bid = $_GET['bid'];
		$sql = "SELECT bname,author FROM books WHERE bid='$bid'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result);
		//if book name is not NULL
		if(trim($_POST["bname"])!=NULL){
        	$bname=$_POST["bname"]; 
        	$query="UPDATE books SET bname='$bname' WHERE bid='$bid'";
			$result = mysqli_query($link,$query);
        }
     	//if author name is not NULL
		if(trim($_POST["author"])!=NULL){
			$bauthor = $_POST["author"];
			 $query="UPDATE books SET author='$bauthor' WHERE bid='$bid'";
			$result = mysqli_query($link,$query);
		}
		//tranfer to modify.php
		header('location: modify.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Modify</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	</head>

	<body>

	    <!--top header-->
	    <header style="height:100px;background-color:#1A1927;width:20%;position: fixed;">
			<a href="dashboard.php">
                <img src="Images/logo.png" style="height:100px; margin-left:25px">
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
	            <li><a href="modify.php" class="active">
	                <span class="glyphicon glyphicon-edit"></span>&emsp;Modify</a>
	            </li>
				<br>
				<p>STATUS</p>
	            <li><a href="borrow.php">
	                 <span class="glyphicon glyphicon-hourglass"></span>&emsp;Borrowed</a>
	             </li>
	            <li><a href="lent.php">
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

	    <div class="col-md-9"><!-- col md 9 start-->
	    	<br>
	    	<div class="container">
			  
			  <form action="edit_book.php?bid=<?php echo $row['bid']; ?>" method="post">
			    <div class="form-group">
			      <label for="bname">Edit Email:</label>
			      <input type="text" class="form-control" id="bname" placeholder="<?php echo $old_bname;?>" name="bname">
			    </div>
			    <div class="form-group">
			      <label for="author">Edit Author :</label>
			      <input type="text" class="form-control" id="author" placeholder="<?php echo $old_author?>" name="author">
			    </div>

			    <input class="btn btn-block btn-primary" type="submit" name="update" value="Update" >
			  </form>
			</div>
	    </div><!--col md 9 end-->

	    <!--JS SCRIPTS-->
	    <script  type='text/javascript'>
	    	//popover script
	    	$("[data-toggle=popover]")
			.popover({html:true})
		</script>
	</body>
</html>
