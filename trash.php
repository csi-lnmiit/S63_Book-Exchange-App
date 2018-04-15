<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

	//if delete button is confirmed
	if(isset($_POST["delete"])){
		echo $_SESSION["bid"];
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
	    <title>Trash</title>
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
					            <li><a href="trash.php"  class="active">
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
							<div class="table-responsive" style="padding-left:70px;padding-right:50px">
				                <table class="table" align="center">
				    				<thead><!--table header start-->
				      					<tr>
					        				<th>S.No.</th>
					        				<th>Book Id</th>
					        				<th>Book Name</th>
					        				<th>Author</th>
					        				<th>Restore Book</th>
					        				<th>Delete Permanently</th>
				      					</tr>
				    				</thead><!--table header close-->

									<?php
						                require_once('db_connect.php'); //connect with database

						                $query = "select * from books b where b.trash='1' AND b.owner='".$_SESSION['user_id']."'";
						                $result = mysqli_query($link,$query);

						                if(mysqli_num_rows($result)==0)
						                    echo nl2br("Trash is empty !!\n");

						           		$i=1;
						                while($row = mysqli_fetch_array($result))
						                {
						            ?>

				            		<tbody><!--print table data-->
				      					<tr>
				        				<td><?php echo $i ?></td>
				        				<td><?php echo $row["bid"] ?></td>
				        				<td><?php echo $row["bname"] ?></td>
				        				<td><?php echo $row["author"] ?></td>
				        				<td>
				        					<a href="#" data-toggle="popover" data-trigger="focus" data-content="<a href='query.php?res=<?php echo $row['bid']; ?>'style='text-decoration:none;color:#27AE60'>confirm restore</a>">
				        					<span class='glyphicon glyphicon-refresh' style='color:#27AE60;font-size:25px;padding:5px;'></span>
				        					</a>
				        				</td>
				        				<td>
				        					<a href="#" data-toggle="popover" data-trigger="focus" data-content="<a href='query.php?del=<?php echo $row['bid']; ?>'style='text-decoration:none;color:#E74C3C'>confirm delete</a>">
				        					<span class='glyphicon glyphicon-trash' style='color:#E74C3C;font-size:25px;padding:5px;'></span>
				        					</a>
				        				</td>

				        				<?php ++$i; } ?> <!--php to increment S.NO. count of books-->

				      					</tr>

				    				</tbody>
				  				</table>
				  			</div><!--table responsive div close-->
						</div>
				    </div>
				</div><!--end of col-md-9-->
			</div><!--end of row-->
		</div><!--end of container fluid-->

	</body>
</html>
