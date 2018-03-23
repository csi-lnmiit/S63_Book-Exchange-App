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
					            <li><a href="modify.php" class="active">
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
							<div id="nav_text"><b>Modify or Delete a Book</b></div>
						</div>

						<div class="container-fluid">
							<br>
					    	<div class="table-responsive" style="padding-left:70px;padding-right:30px">
				                <table class="table" align="center">
				    				<thead><!--table header start-->
				      					<tr>
					        				<th>S.No.</th>
					        				<th>Book Id</th>
					        				<th>Book Name</th>
					        				<th>Author</th>
					        				<th>Edit Book</th>
					        				<th>Delete Book</th>
				      					</tr>
				    				</thead><!--table header close-->

									<?php
						                require_once('db_connect.php'); //connect with database

						                $query = "select * from books b where b.trash='0' AND b.owner='".$_SESSION['user_id']."'";
						                $result = mysqli_query($link,$query);

						                if(mysqli_num_rows($result)==0)
						                    echo nl2br("You don't have any books in your repository\n");

						           		$i=1;
						                while($row = mysqli_fetch_array($result)) {
						            ?>

				            		<tbody><!--print table data-->
				      					<tr>
					        				<td><?php echo $i ?></td>
					        				<td><?php echo $row["bid"] ?></td>
					        				<td><?php echo $row["bname"] ?></td>
					        				<td><?php echo $row["author"] ?></td>
					        				<td>
					        					<a href="edit_book.php?edit=<?php echo $row['bid']; ?>" >
					        						<span class='glyphicon glyphicon-edit' style='font-size:25px;padding:5px;'></span>
					        					</a>
					        				</td>
					        				<td>
					        					<a href="#" data-toggle="popover" data-trigger="focus" data-content="<a href='query.php?trash=<?php echo $row['bid']; ?>'style='text-decoration:none;color:#E74C3C'>Move to trash</a>">
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

	    <!--JS SCRIPTS-->
	    <script  type='text/javascript'>
	    	//popover script
	    	$("[data-toggle=popover]")
			.popover({html:true})
		</script>
	</body>
</html>
