<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

	include 'count.php'; //shows badge notification
?>

<!--Display submitted form data -->
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
	    <link rel="stylesheet" type="text/css" href="CSS/style1.css">
	</head>


	<body>

		<div class="container-fluid">
			<div class="row"><!--start of row-->
				<div class="col-md-3" style="height: 100px";>
					<div class="row"><!--nested row starts-->
        				<div align="center" style="background-color: #1A1927"><!--libromate logo-->
        					<a href="dashboard.php"><img src="Images/logo.png" style="height:100px; "></a>
        				</div>
        				<div id="dashboard_left_col"><!--start of vertical navbar-->
					        <ul>
								<br>
					            <p>MENU</p>
					            <li><a href="dashboard.php">
					                <span class="glyphicon glyphicon-home"></span>&emsp;Dashboard</a>
					            </li>
					            <li><a class="active" href="profile.php">
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
					
				</div><!--end of col-md-2-->
				<div class="col-md-9" style="background-color: white;height: 100px;">
					<div class="row">
						<div style="background-color: #3498DB;height: 100px">
							<p id="my_profile_text"><b>My Profile</b></p>
						</div>
						<div class="container-fluid">
							<h3 style="font-size:30px;padding-left: 70px">Hello <?php echo htmlentities($_SESSION["user"]); ?>,</h3><br>
							<div class="row">
	        					
	        					<div class="col-md-1"></div>
								<div class="col-md-3 card">
								  <img src="Images/geek_pic.png" alt="John" style="width:100%;">
								  <h1><?php echo $_SESSION["name"]?></h1>
								  <p class="title"><?php echo $_SESSION["user"]?></p>
								  <p>Harvard University</p>
								</div><!--end of card-->

								<div class="col-md-7">
									<div class="container-fluid">
										<div class="row">
											<div style="background-color: #212F3D;height: 100px">
												
											</div>
											<div style="background-color: #D7DBDD;height: 250px">
												<div class="table-responsive" style="padding-left: 10px;padding-top:10px"> <!-- user info table -->
									                <table class="table" >
									    				<thead><!--table header start-->
									      					
									                        <tr>
									                            <td style="font-size:15px;"><b>Username</b></td>
									                            <td><?php echo $_SESSION["user"]?></td>
									                        </tr>

									                        <tr>
									                            <td style="font-size:15px;"><b>Password</b></td>
									                            <td><?php echo $_SESSION["pass"]?></td>
									                        </tr>

									                        <tr>
									                            <td style="font-size:15px;"><b>E-mail Id</b></td>
									                            <td><?php echo $_SESSION["email"]?></td>
									                        </tr>

									                        <tr>
									                            <td style="font-size:15px;"><b>Phone Number</b></td>
									                            <td><?php echo $_SESSION["mobile"]?></td>
									                        </tr>

									                        <tr>
									                            <td style="font-size:15px;"><b>Points</b></td>
									                            <td><?php echo $_SESSION["points"]?></td>
									                        </tr>

									                    </thead><!--table header close-->
									        		</table>
									            </div>  <!-- table div close -->
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>

							</div>

						</div>

					</div>
				</div><!--end of col-md-9 -->
			</div><!--end of row-->
		</div><!--end of container-fluid-->

	</body>
</html>