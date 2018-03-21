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
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	</head>

	<body>

	    <!--top header-->
	    <header style="height:100px;background-color:#1A1927;width:20%;position: fixed;">
	        <a href="dashboard.php">
                <img src="Images/logo.png" style="height:100px; margin-left:25px">
            </a>
	    </header>

	    <!--left column list -->
	    <div id="dashboard_left_col" class="col-md-3" style="padding-left: 0;padding-top:100px">
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
	    </div>

	    <div class="col-md-9">
	        <h3 style="font-size:30px;">Hello <?php echo htmlentities($_SESSION["user"]); ?>,</h3><br>

              <div class="table-responsive"> <!-- user info table -->
                <table class="table">
    				<thead><!--table header start-->
      					<tr>
                            <td style="font-size:20px;">Name</td>
                            <td><?php echo $_SESSION["name"]?></td>
                        </tr>

                        <tr>
                            <td style="font-size:20px;">Username</td>
                            <td><?php echo $_SESSION["user"]?></td>
                        </tr>

                        <tr>
                            <td style="font-size:20px;">Password</td>
                            <td><?php echo $_SESSION["pass"]?></td>
                        </tr>

                        <tr>
                            <td style="font-size:20px;">E-mail Id</td>
                            <td><?php echo $_SESSION["email"]?></td>
                        </tr>

                        <tr>
                            <td style="font-size:20px;">Phone Number</td>
                            <td><?php echo $_SESSION["mobile"]?></td>
                        </tr>

                        <tr>
                            <td style="font-size:20px;">Points</td>
                            <td><?php echo $_SESSION["points"]?></td>
                        </tr>

                    </thead><!--table header close-->
        		</table>
            </div>  <!-- table div close -->
	    </div>
	</body>
</html>
