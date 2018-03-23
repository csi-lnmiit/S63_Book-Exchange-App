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
	    <title>Dashboard</title>
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
					            <li><a class="active" href="dashboard.php">
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

					        <h3 style="font-size:30px;padding-left: 70px">Hello <?php echo htmlentities($_SESSION["user"]); ?>,</h3>

				            <?php
				                require_once('db_connect.php'); //connect with database

				                $query = "select * from books b where b.trash='0' AND b.owner='".$_SESSION['user_id']."'";
				                $result = mysqli_query($link,$query);

				                if(mysqli_num_rows($result)==0)
				                    echo nl2br("\nOops !! you have not added any books recently");
				                else {
				                    echo nl2br("\nFollowing is the list of books you have added:");
				                }
				                echo nl2br("\n\n");
				            ?>

					    	<div class="table-responsive">

				                <table class="table" align="center" style="width: 800px" >
				    				<thead><!--table header start-->
				      					<tr>
					        				<th>S.No.</th>
					        				<th>Book Id</th>
					        				<th>Book Name</th>
					        				<th>Author</th>
				        				</tr>
				    				</thead><!--table header close-->

				                <!--fetch and display data from MySQL-->
				                <?php
				                    $i=1;

					                while($row = mysqli_fetch_array($result)) {
						                echo "<tr>";
						                echo "<td>" . $i . "</td>";
						                echo "<td>" . $row["bid"] . "</td>";
						                echo "<td>" . $row["bname"] . "</td>";
						                echo "<td>" . $row["author"] . "</td>";
						                echo "</tr>";
						                ++$i;
					                }
				            	?>

				                </table>

				            </div><!--end of responsive table-->
				        </div>
				    </div>
				</div><!--end of col-md-9-->
			</div><!--end of row-->
		</div><!--end of container fluid-->
	</body>
</html>