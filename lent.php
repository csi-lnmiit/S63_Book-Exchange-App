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
	    <title>Lent</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	    <script type="text/javascript" src="JS/script.js"></script>

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
								<li><a href="browse.php">
					                <span class="glyphicon glyphicon-eye-open"></span>&emsp;Browse all</a>
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

				<?php
					include "topnav.php";
				?>

						<div class="container-fluid">
							<br>
							<div style="font-size:15px;padding-left: 70px">

								<?php
					                require_once('db_connect.php'); //connect with database

					                $query = "SELECT * FROM requests AS r, books AS b, users as u
											  WHERE b.bid=r.bid AND r.from_user=u.id AND r.to_user='" . $_SESSION['user_id'] . "'";
					                $result = mysqli_query($link,$query);

					                if(mysqli_num_rows($result)==0)
					                    echo nl2br("\nNo book share requests from others !!");
					                else
					                    echo nl2br("\nFollowing are the books requested by other users:");

					                echo nl2br("\n\n");
					            ?>

							</div>

							<div class="table-responsive" style="padding-left:70px;padding-right:50px">
				                <table class="table" align="center">
				    				<thead><!--table header start-->
				      					<tr>
				            				<th>S.No.</th>
				            				<th>Book Id</th>
				            				<th>Book Name</th>
				            				<th>Book Author</th>
				            				<th>Requested By</th>
											<th>Status</th>
				            				<th>Action</th>
				        				</tr>
				    				</thead><!--table header close-->

									<tbody>

					                    <!--fetch and display data from MySQL-->
					                    <?php
					                        $i=1;

					                        while($row = mysqli_fetch_array($result)) {

												if($row['rn'] == 1)
	 											   echo "<tr style='background-color:white'>";
	 										   	else
	 											   echo "<tr>";

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

												if($row["status"]==0) {
													echo "<td><button class='btn btn-warning' style='width:100px'>Pending</button></td>";
													echo "<td>
														 <a href='query.php?accept=" . $row['bid'] . "&from_user=" . $row['id'] . "'>
														 <input class='btn btn-primary' type='button' name='accept' value='Accept' style='width:70px'>
														 </a>
														 <a href='query.php?decline=" . $row["bid"] . "&from_user=" . $row['id'] . "'>
														 <input class='btn btn-primary' type='button' name='decline' value='Decline' style='width:70px'>
														 </a>
														 </td>";
												}
												else if($row["status"]==1) {
													echo "<td><button class='btn btn-success' style='width:100px'>Shared</button></td>";
													echo "<td><a href='query.php?cancel=" . $row['bid'] . "&from_user=" . $row['id'] . "'>
														  <input class='btn btn-primary' type='button' name='cancel' value='Cancel Accept' style='width:143px'>
														  </a></td>";
												}
												else if($row["status"]==2) {
													echo "<td><button class='btn btn-danger' style='width:100px'>Declined</button></td>";
													echo "<td><a href='query.php?delete=" . $row['bid'] . "&from_user=" . $row['id'] . "'>
														  <input class='btn btn-primary' type='button' name='delete' value='Delete Request' style='width:143px'>
													 	  </a></td>";
												}

												echo "</tr>";
					        	                ++$i;
					                        }
					                    ?>

									</tbody>
				                </table>
				            </div>
						</div>
				    </div>
				</div><!--end of col-md-9-->
			</div><!--end of row-->
		</div><!--end of container fluid-->

	</body>
</html>
