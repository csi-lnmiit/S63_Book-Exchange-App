<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

	//connect to database
	require_once('db_connect.php');

	$flag = 0;

	//if edit profile is clicked
	if(isset($_GET['uid'])){
		$uid = $_GET['uid'];
		$query = "SELECT * FROM users WHERE id='$uid'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
	}

	//if update is clicked under edit profile
	if (isset($_POST["update_profile"])) {
		$uid = $_GET['uid'];
		$query = "SELECT * FROM users WHERE id='$uid'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);


			//if username is not NULL
			if(trim($_POST["name"])!=NULL){
	        	$name=$_POST["name"];
	        	$query="UPDATE users SET name='$name' WHERE id='$uid'";
				$result = mysqli_query($link,$query);
				$_SESSION["name"] = $name;
	        }
	     	//if password is not NULL and check if its < 6 chars
	     	if(trim($_POST["pass"])!=NULL && strlen($_POST["pass"])<6){
			    $flag=1;
			    $msg="Password should be of minimum 6 letters";
			}
			else if(trim($_POST["pass"])!=NULL && $flag==0){
				$pass = md5($_POST["pass"]);
				$query="UPDATE users SET password='$pass' WHERE id='$uid'";
				$result = mysqli_query($link,$query);
				$_SESSION["pass"] = $pass;
			}
			//if mobile is not NULL and check if its 10 digit
			if(trim($_POST["mobile"])!=NULL && !is_numeric($_POST["mobile"])){
			    $flag=1;
			    $msg="Invalid number.Enter digits.";
			}
			else if(trim($_POST["mobile"])!=NULL && strlen($_POST["mobile"])!=10){
			    $flag=1;
			    $msg="Invalid mobile number";
			}
			else if(trim($_POST["mobile"])!=NULL && $flag==0){
				
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
		

		if($flag)
	    {
	        echo '<div class="alert alert-danger alert-dismissable fade in" style="position:absolute;margin-top:425px;margin-left:410px;width:350px;">
	        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>';

	        unset($_POST);
	    }
	    else{
	    	//tranfer to profile.php
			header('location: profile.php');
	    }
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
						<div style="background-color: #3498DB;height: 100px">
							<div id="nav_text"><b>Edit Profile</b></div>
						</div>

						<div class="container-fluid">
							<br>
				    		<div style="font-size:30px;padding-left: 70px">Enter Details</div>
							<br>

				    		<div class="container" style="padding-left: 70px">
					  			<form action="edit_profile.php?uid=<?php echo $_SESSION["user_id"]; ?>" method="post">
								  	<!--display username-->
								  	<div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Username</span>
										<input type="text" disabled="disabled" class="form-control" style="width:250px;" name="uname" placeholder="<?php echo $_SESSION["user"];?>">
								    </div>
								    <!--edit name-->
								    <div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Name</span>
										<input type="text" class="form-control" style="width:250px;" name="name" placeholder="<?php echo $_SESSION["name"];?>">
								    </div>
								    <!--edit password-->
									<div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Password 
										</span>
										
										<span class="glyphicon glyphicon-alert" data-toggle="tooltip" title="Password should have minimum 6 characters" data-placement="bottom" style="color:#E74C3C;padding-top: 10px;padding-left: 5px"></span>	
										
										<input type="text" class="form-control" style="width:250px;" name="pass" placeholder="<?php echo $_SESSION["pass"];?>">

									</div>
									<!--edit mobile-->
								    <div class="input-group">
										<span class="input-group-addon" style="width: 100px;">Mobile
										</span>
										<span class="glyphicon glyphicon-alert" data-toggle="tooltip" title="Enter a valid 10-digit mobile number" data-placement="bottom" style="color:#E74C3C;padding-top: 10px;padding-left: 5px">									
										</span>
										<input type="text" class="form-control" style="width:250px;" name="mobile" placeholder="<?php echo $_SESSION["mobile"];?>">
								    </div>
								    <!--edit email-->
								    <div class="input-group">
										<span class="input-group-addon" style="width: 100px;">E-Mail</span>
										<input type="email" class="form-control" style="width:250px;" name="email" placeholder="<?php echo $_SESSION["email"];?>">
								    </div>
									<br>
								    <input class="btn btn-block btn-primary" type="submit" name="update_profile" value="Update" style="width:350px;">
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
			$(document).ready(function(){
    		$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
	</body>
</html>
