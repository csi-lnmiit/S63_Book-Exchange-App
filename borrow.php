<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

	include 'count.php'; //shows badge notification
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Borrowed</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="CSS/style1.css">
	   	<link rel="stylesheet" type="text/css" href="CSS/search_nav.css">
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
					            <li><a href="borrow.php" class="active">
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
						<div class="row">
							<div class="topnav"><!--search bar nav start-->
								<br>
								<div class="search-container">
								    <form action="search.php" method="post">
								      	<input type="text" placeholder=" Search book name or author name ..." name="search_input" size="65%">
								      	<button type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
								    </form>
								</div>
							</div><!--search bar nav end-->

				            <?php
				                require_once('db_connect.php'); //connect with database

				                $query = "SELECT * FROM requests AS r, books AS b, users as u
										  WHERE b.bid=r.bid AND u.id=b.owner AND r.to_user=u.id AND r.from_user='" . $_SESSION['user_id'] . "'";
				                $result = mysqli_query($link,$query);

				                if(mysqli_num_rows($result)==0)
				                    echo nl2br("\nYou have not requested any book yet!!");
				                else
				                    echo nl2br("\nFollowing are the books requested by you:");

				                echo nl2br("\n\n");
				            ?>


					    	<div class="table-responsive">
				                <table class="table" style="width: 900px;" align="center">
				    				<thead><!--table header start-->
				      					<tr>
				            				<th>S.No.</th>
				            				<th>Book Id</th>
				            				<th>Book Name</th>
				            				<th>Book Author</th>
				            				<th>Lender Details</th>
				            				<th>Status</th>
											<th>Action</th>
				        				</tr>
				    				</thead><!--table header close-->

				                    <!--fetch and display data from MySQL-->
				                    <?php
				                        $i=1;

				                        while($row = mysqli_fetch_array($result)) {
				        	                echo "<tr>";

											if($row['sn']==1) {
												echo "<td><span class='label label-primary'>NEW</span>" . $i . "</td>";
											}
											else
				        	                	echo "<td>" . $i . "</td>";

				        	                echo "<td>" . $row["bid"] . "</td>";
				        	                echo "<td>" . $row["bname"] . "</td>";
				        	                echo "<td>" . $row["author"] . "</td>";

											if($row['status'] == 1) {

												$info_query = "SELECT * from users AS u,requests AS r,books AS b WHERE u.id='".$row['id']."' AND r.bid=b.bid";
												$info_result = mysqli_query($link,$info_query);
												$info = mysqli_fetch_array($info_result);
									?>

												<td>
													<a href='#' data-toggle='popover' data-trigger='focus' data-content="
													Email: <?php echo $info['email'] ?><br>
													Mobile: <?php echo $info['mobile']; ?>">
														<?php echo $info['name']; ?>
													</a>
												</td>

									<?php
											}
											else {
												echo "<td>" . $row["name"] . "</td>";
											}

											if($row["status"] == 0) {
												echo "<td><button class='btn btn-warning'>Pending</button></td>";
												echo "<td><a href='query.php?return=" . $row['bid'] . "&to_user=" . $row['id'] .
													 "'><input class='btn btn-primary' type='button' name='cancel' value='Cancel Request'>
													 </a></td>";
											}
											else if($row["status"] == 1) {
												echo "<td><button class='btn btn-success'>Accepted</button></td>";
												echo "<td><a href='query.php?return=" . $row['bid'] . "&to_user=" . $row['id'] .
													 "'><input class='btn btn-primary' type='button' name='return' value='Return Book'>
													 </a></td>";
											}
											else if($row["status"] == 2) {
												echo "<td><button class='btn btn-danger'>Declined</button></td>";
												echo "<td><a href='query.php?request=" . $row['bid'] . "&to_user=" . $row['id'] .
													 "'><input class='btn btn-primary' type='button' name='request' value='Request Again'>
													 </a></td>";
											}

				        	                echo "</tr>";
				        	                ++$i;
				                        }
				                    ?>

				                </table>
				            </div>
						</div>
				    </div>
				</div><!--end of col-md-9-->
				<?php
					$sql="UPDATE requests SET sn=0 WHERE from_user='" . $_SESSION['user_id'] . "'";
					mysqli_query($link,$sql);
				?>				
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