<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

	//connect to database
	require_once('db_connect.php');

	$flag = 0;

	//if edit glyphicon is clicked
	if(isset($_GET['edit'])){
		$bid = $_GET['edit'];
		$query = "SELECT * FROM books WHERE bid='$bid'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
	}

	//if update is clicked under modify
	if (isset($_POST["update"])) {
		$bid = $_GET['edit'];
		$query = "SELECT * FROM books WHERE bid='$bid'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);

		if(trim($_POST["bname"])==NULL){
            $flag=1;
            $msg="Book Name required";
        }
        else if(trim($_POST["bauthor"])==NULL){
            $flag=1;
            $msg="Author name required";
        }
		else {

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

		if($flag)
	    {
	        echo '<div class="alert alert-danger alert-dismissable fade in" style="position:absolute;margin-top:355px;margin-left:410px;width:350px;">
	        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>';

			unset($_POST);
	    }
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
				<div class="col-md-3">
					<div class="row"><!--nested row starts-->
        				<div class="col-md-3" align="center" style="background-color:#1A1927;position:fixed"><!--libromate logo-->
        					<a href="dashboard.php"><img src="Images/logo.png" style="height:100px;"></a>
        				</div>

        				<div id="dashboard_left_col" style="padding-top:100px"><!--start of vertical navbar-->
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
					            <li><a href="lent.php">
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
					<div class="row">
						<div class="container-fluid" style="background-color: #3498DB;height: 100px">
							<div id="nav_text"><b>Edit a Book</b></div>
						</div>

						<div class="container-fluid">
							<br>
							<div style="font-size:30px;padding-left: 70px">Enter Book Details</div>
							<br>

					    	<div class="container" style="padding-left: 70px">
							  	<form action="edit_book.php?edit=<?php echo $row['bid']; ?>" method="post">
								  	<!--display book id-->
								  	<div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Book ID</span>
										<input type="text" disabled="disabled" class="form-control" style="width:250px;" name="bid" placeholder="<?php echo $row['bid']; ?>">
								    </div>
								    <!--edit book name-->
								    <div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Book Name</span>
										<input type="text" class="form-control" style="width:250px;" name="bname" placeholder="<?php echo $row['bname']; ?>">
								    </div>
								    <!--edit author name-->
									<div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Author</span>
										<input type="text" class="form-control" style="width:250px;" name="author" placeholder="<?php echo $row['author']; ?>">
									</div>
									<br>
								    <input class="btn btn-block btn-primary" type="submit" name="update" value="Update" style="width:350px;">
							  	</form><!--end of form-->
							</div><!--end of container-->
						</div>
				    </div>
				</div><!--end of col-md-9-->
			</div><!--end of row-->
		</div><!--end of container fluid-->

		<!--JS SCRIPTS-->
	    <script  type='text/javascript'>
			if ( window.history.replaceState ) {
				window.history.replaceState( null, null, window.location.href );
			}
		</script>
	</body>
</html>
