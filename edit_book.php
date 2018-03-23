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
	    <link rel="stylesheet" type="text/css" href="CSS/style1.css">
	</head>

	<body>

		<div class="container-fluid">
			<div class="row"><!--start of row-->
				<div class="col-md-3" >
					<div class="row"><!--nested row starts-->

        				<div align="center" style="background-color: #1A1927;"><!--libromate logo-->
        					<a href="dashboard.php"><img src="Images/logo.png" style="height:100px;"></a>
        				</div>

        				<div id="dashboard_left_col"><!--start of vertical navbar-->
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
					            		<span class="glyphicon glyphicon-hourglass"></span>&emsp;Borrowed
									 	<?php
									 		if($borrow!=0) {
												echo "<span class='badge'>$borrow</span>";
									 		}
									 	?>
								 	</a>
					            </li>
					            <li><a href="lent.php" class="active">
					                	<span class="glyphicon glyphicon-book"></span>&emsp;Lent
									 	<?php
									 		if($lent!=0) {
												echo "<span class='badge'>$lent</span>";
									 		}
									 	?>
									</a>
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
					    </div><!--end of vertical navbar-->
					</div><!--end of nested row-->
					
				</div><!--end of col-md-3-->
				<div class="col-md-9"><!--col-md-9 start-->
					<div class="container-fluid">
				    	<br>
				    	<div style="padding-top:50px;">
			            	<h2>Edit Book Details</h2>
			        	</div>
				    	<div class="container">
						  <!--edit book details form-->
						  <form action="edit_book.php?bid=<?php echo $row['bid']; ?>" method="post">
						  	<!--display book id-->
						  	<div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Book ID</span>
								<input type="text" disabled="disabled" class="form-control" style="width:250px;" name="bid" placeholder="<?php echo $row['bid'];?>">
						    </div>
						    <!--edit book name-->
						    <div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Book Name</span>
								<input type="text" class="form-control" style="width:250px;" name="bname" placeholder="<?php echo $old_bname;?>">
						    </div>
						    <!--edit author name-->
							<div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Author</span>
								<input type="text" class="form-control" style="width:250px;" name="author" placeholder="<?php echo $old_author;?>">
							</div>
							<br>
						    <input class="btn btn-block btn-success" type="submit" name="update" value="Update" style="width:100px;">
						  </form><!--end of form-->
						</div><!--end of container-->
				    </div>
				</div><!--end of col-md-9-->

			</div><!--end of row-->
		</div><!--end of container fluid-->

		<!--JS SCRIPTS-->
	    <script  type='text/javascript'>
	    	//popover script
	    	$("[data-toggle=popover]")
			.popover({html:true})
		</script>
	</body>
</html>