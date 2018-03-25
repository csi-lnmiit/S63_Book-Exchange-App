<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

	require_once('db_connect.php'); //connect to database
	include 'count.php'; //shows badge notification

    if(isset($_POST["add"])){

        //generate unique book id
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        $bid="b".substr($d->format("ymdHisu"),0,14);

        $flag=0;
        $status=1;
        $owner=$_SESSION["user_id"];

        $bname=ucwords($_POST["bname"]);
        $bauthor=ucwords($_POST["bauthor"]);

        if(trim($_POST["bname"])==NULL){
            $flag=1;
            $msg="Book Name required";
        }
        else if(trim($_POST["bauthor"])==NULL){
            $flag=1;
            $msg="Author name required";
        }
        else {
            $query="insert into books(bid,bname,author,owner) values ('$bid','$bname','$bauthor','$owner')";
			$result = mysqli_query($link,$query);

            $success="Your Book added successfully";
            echo '<div class="alert alert-success" style="position:absolute;margin-top:330px;margin-left:425px;width:22%;">
     		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$success.'</div>';
        }

        if($flag){
            echo '<div class="alert alert-danger alert-dismissable fade in" style="position:absolute;margin-top:320px;margin-left:410px;width:292px">
        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';

			unset($_POST);
        }
    }
?>

<!--Display form to add new books -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Add</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="CSS/style1.css">
	</head>

	<script>
	    if ( window.history.replaceState ) {
	        window.history.replaceState( null, null, window.location.href );
	    }
    </script>

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
					            <li><a href="add.php" class="active">
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
							
							<div class="col-md-1"></div>

							<div class="topnav col-md-9">
								<div class="search-container">
									<form action="search.php" method="post">
										<input type="text" placeholder=" Search book name or author name ..." name="search_input" size="55%">
										<button type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
									</form>
								</div>
							</div>

							<div class="col-md-2" id="nav_image">
								<div class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">
										<img src="Images/geek_pic.png" alt="My Pic" style="width:35%;" >
  									<span class="caret" style="color: black"></span>
  									</a>
									<ul class="dropdown-menu">
										<li><p>Signed in as</p></li>
										<li><p><b><?php echo $_SESSION['user'];?></b></p></li>
										<li><a href="profile.php">Your Profile</a></li>
									    <li><a href="logout.php">Logout</a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="container-fluid">
							<br>
				    		<div style="font-size:30px;padding-left: 70px">Enter Book Details</div>
							<br>

							<div class="container" style="padding-left: 70px">
					        	<form action="add.php" method="post">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
										<input type="text" class="form-control" style="width:250px;" name="bname" placeholder="Book Name">
								    </div>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
										<input type="text" class="form-control" style="width:250px;" name="bauthor" placeholder="Author name">
									</div>
						            <br>
						           	<div style="float: left; width: 140px">
						        		<input class="btn btn-block btn-primary" type="submit" name="add" value="Add" >
						         	</div>
						          	<div style="float: right; width: 140px;margin-right:795px;">
						                <input class="btn btn-block btn-primary" type="reset" name="reset" value="Reset" >
						          	</div>
						        </form>
							</div>
				        </div>
				    </div>
				</div><!--end of col-md-9-->
			</div><!--end of row-->
		</div><!--end of container fluid-->
	</body>
</html>
