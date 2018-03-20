<?php
	session_start();
	require_once('db_connect.php'); //connect with database

	if(!isset($_SESSION["user"]))
		header("Location:index.php");
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
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	   	<link rel="stylesheet" type="text/css" href="CSS/search_nav.css">
	</head>

	<body>

	    <!--top header-->
	    <header style="height:100px;background-color:#1A1927;width:20%;position: fixed;">
	        <a href="dashboard.php">
                <img src="Images/logo.png" style="height:100px; margin-left:25px;">
            </a>
	    </header>

	    <!--left column list -->
	    <div id="dashboard_left_col" class="col-md-3" style="padding-left: 0;padding-top:100px"><!--col-md-3 start-->
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
	                 <span class="glyphicon glyphicon-hourglass"></span>&emsp;Borrowed</a>
	             </li>
	            <li><a href="lent.php">
	                 <span class="glyphicon glyphicon-book"></span>&emsp;Lent</a>
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
	    </div><!--col-md-3 end-->

	    <div class="col-md-9"><!--col-md-9 start-->
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
	        	if(isset($_POST["search"])) {
		        	$input = $_POST["search_input"];

					$query = "SELECT * FROM books AS b, users AS u
							  WHERE b.bname='" . $input . "' AND b.owner=u.id AND b.owner!='" . $_SESSION["user_id"] .
							  "' OR b.author='" . $input . "' AND b.owner=u.id AND b.owner!='" . $_SESSION["user_id"] . "'";
					$result = mysqli_query($link,$query);

		            if(mysqli_num_rows($result)==0)
		                echo nl2br("\nNo matching search found!!");
		            else
		            	echo nl2br("\n".mysqli_num_rows($result)." result(s) found.");

	            echo nl2br("\n\n");
				}
			?>

	    	<div class="table-responsive">
                <table class="table">
    				<thead><!--table header start-->
      					<tr>
	        				<th>S.No.</th>
	        				<th>Book Id</th>
	        				<th>Book Name</th>
	        				<th>Author</th>
	        				<th>Owner Id</th>
	        				<th>Owner Name</th>
	        				<th>Request Book</th>
        				</tr>
    				</thead><!--table header close-->

	                <!--fetch and display data from MySQL-->
	                <?php
	                    $i=1;
	                	while($row = mysqli_fetch_array($result)) {
	                ?>

	                <tbody><!--print table data-->
	      				<tr>
		        			<td><?php echo $i ?></td>
		        			<td><?php echo $row["bid"] ?></td>
		        			<td><?php echo $row["bname"] ?></td>
		        			<td><?php echo $row["author"] ?></td>
		       				<td><?php echo $row["id"] ?></td>
		        			<td><?php echo $row["name"] ?></td>
		        			<td>

								<?php
									$query = "select * from requests where bid='" . $row['bid'] . "' and rn=1 and status=0";
									$req = mysqli_query($link,$query);
									$query = "select * from requests where bid='" . $row['bid'] . "' and rn=1 and status=1";
									$acc = mysqli_query($link,$query);

									if(mysqli_num_rows($req))
										echo "Requested";

									else if(mysqli_num_rows($acc))
										echo "Accepted";

									else {
										echo "<a href='query.php?request="  . $row['bid'] . "&to_user=" . $row['id'] .
											 "'><input class='btn btn-primary' type='button' name='request' value='Request'>
										     </a>";
									}
								?>

		        			</td>

	        				<?php ++$i; } ?> <!--php to increment S.NO. count of books-->

						</tr>
					</tbody>
				</table>
			</div>
	    </div><!--col-md-9 end-->
	</body>
</html>
