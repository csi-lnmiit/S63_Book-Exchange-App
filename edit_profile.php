<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");
	//if edit profile is clicked
	if(isset($_GET['uid'])){
		//connect to database
		require_once('db_connect.php');
		$uid = $_GET['uid'];
		$query = "SELECT * FROM users WHERE id='$uid'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
	}
	//if update is clicked under edit profile 
	if (isset($_POST["update_profile"])) {
		require_once('db_connect.php');
		$uid = $_GET['uid'];
		$sql = "SELECT * FROM users WHERE id='$uid'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result);

		//if username is not NULL
		if(trim($_POST["uname"])!=NULL){
        	$uname=$_POST["uname"]; 
        	$query="UPDATE users SET username='$uname' WHERE id='$uid'";
			$result = mysqli_query($link,$query);
			$_SESSION["user"] = $uname;
        }
     	//if password is not NULL
		if(trim($_POST["pass"])!=NULL){
			$pass = $_POST["pass"];
			$query="UPDATE users SET password='$pass' WHERE id='$uid'";
			$result = mysqli_query($link,$query);
			$_SESSION["pass"] = $pass;
		}
		//if mobile is not NULL
		if(trim($_POST["mobile"])!=NULL){
			$mobile = $_POST["mobile"];
			$query="UPDATE users SET mobile='$mobile' WHERE id='$uid'";
			$result = mysqli_query($link,$query);
			$_SESSION["mobile"] = $mobile;
		}
		//if email is not NULL
		if(trim($_POST["email"])!=NULL){
			$email = $_POST["email"];
			$query="UPDATE users SET email='$email' WHERE id='$uid'";
			$result = mysqli_query($link,$query);
			$_SESSION["email"] = $email;
		}
		//tranfer to modify.php
		header('location: profile.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Profile</title>
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
					<div class="container-fluid">
				    	<br>
				    	<div style="padding-top:50px;">
			            	<h2>Edit Profile Details</h2>
			        	</div>
				    	<div class="container">
						  <!--edit book details form-->
						  <form action="edit_profile.php?uid=<?php echo $_SESSION["user_id"]; ?>" method="post">
						  	<!--display name-->
						  	<div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Name</span>
								<input type="text" disabled="disabled" class="form-control" style="width:250px;" name="name" placeholder="<?php echo $_SESSION["name"];?>">
						    </div>
						    <!--edit username-->
						    <div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Username</span>
								<input type="text" class="form-control" style="width:250px;" name="uname" placeholder="<?php echo $_SESSION["user"];?>">
						    </div>
						    <!--edit password-->
							<div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Password</span>
								<input type="text" class="form-control" style="width:250px;" name="pass" placeholder="<?php echo $_SESSION["pass"];?>">
							</div>
							<!--edit mobile-->
						    <div class="input-group">
								<span class="input-group-addon" style="width: 100px;">Mobile</span>
								<input type="text" class="form-control" style="width:250px;" name="mobile" placeholder="<?php echo $_SESSION["mobile"];?>">
						    </div>
						    <!--edit email-->
						    <div class="input-group">
								<span class="input-group-addon" style="width: 100px;">E-Mail</span>
								<input type="email" class="form-control" style="width:250px;" name="email" placeholder="<?php echo $_SESSION["email"];?>">
						    </div>
							<br>
						    <input class="btn btn-block btn-success" type="submit" name="update_profile" value="Update" style="width:100px;">
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