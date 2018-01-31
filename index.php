<?php
	if (!isset($_SESSION)) session_start();
	require_once "connect.php";

	if($_POST["login"]) { //if user clicks on login
		$_SESSION["user"] = $_POST["user"];
		$_SESSION["pass"] = $_POST["pass"];
	}

	else if($_POST["signup"]) { //if user clicks on signup
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["email"] = $_POST["email"];
		$_SESSION["mobile"] = $_POST["mobile"];
		$_SESSION["user"] = $_POST["user"];
		$_SESSION["pass"] = $_POST["pass"];
		$_SESSION["level"] = 0;
		$_SESSION["point"] = 10;
	}
?>

<html>
	<head>
		<link rel="shortcut icon" type="image/png" href="Images/favicon.png">
		<title>Libromate</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body style="background-color:beige">
		<header style="height:100px;background-color:#6a1b9a;">
			<img src="Images/logo.png" style="height:100px;">
		</header>

		<img src="Images/book.jpg" style ="position:absolute;right:0px;">
		<div id="container" style ="position:absolute;left:835px;font-style:italic;font-size:40px;text-align:center;color:beige;font-family:serif;margin-top:210px;margin-left:20px;margin-right:20px;">
			There is no friend as loyal as a book
		</div>

		<div style="margin-top:80px;margin-left:190px;margin-right:210px;"><!--outer div start-->
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#login">Login</a></li>
                <li><a data-toggle="pill" href="#signup">Sign Up</a></li>
            </ul>

            <div class="tab-content"><!--tab pill start-->
                <div id="login" class="tab-pane fade in active">
                	<div class="row"><!--row start-->
                		<div class="col-md-6"><!--col-md-6 start-->
                			<div class="jumbotron"style="height:350px;padding-top:15px;background-color:palegreen;box-shadow:5px 5px 5px #c9c9c9;border-radius:5px"><!--login div start-->
								<div align="center"><img src="Images/user.png" style="width:150px;"></div>
								<form action="index.php" method="post" style="padding-left:75px;padding-right:75px;padding-top:15px;">
									<div class="input-group">
  										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  										<input type="text" class="form-control" name="user" placeholder="Username">
									</div>
									<div class="input-group">
								      	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								      	<input type="password" class="form-control" name="pass" placeholder="Password">
								    </div><br>
                					<button class="btn btn-block btn-success" type="submit" name="login">Login</button>
                				</form>
                			</div><!--login div end-->
                		</div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>

                <div id="signup" class="tab-pane fade">
                    <div class="row"><!--row start-->
                        <div class="col-md-6"><!--col-md-6 start-->
                            <div class="jumbotron"style="height:350px;padding-top:5px;background-color:lightblue;box-shadow:5px 5px 5px #c9c9c9;border-radius:5px"><!--signup div start-->
                                <form action="index.php" method="post" style="padding-left:75px;padding-right:75px;padding-top:50px;">
									<div class="input-group">
  										<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  										<input type="text" class="form-control" name="name" placeholder="Full Name">
									</div>
									<div class="input-group">
  										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  										<input type="email" class="form-control" name="email" placeholder="Email">
									</div>
									<div class="input-group">
  										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  										<input type="tel" class="form-control" name="mobile" placeholder="Mobile No">
									</div><br>
									<div class="input-group">
  										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  										<input type="text" class="form-control" name="user" placeholder="Username">
									</div>
									<div class="input-group">
								      	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								      	<input type="password" class="form-control" name="pass" placeholder="Password">
								    </div><br>
                					<button class="btn btn-block btn-primary" type="submit" name="signup">Sign Up</button>
                                </form>
                            </div><!--sign up div end-->
                        </div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>
            </div><!--tab pill end-->
        </div><!--outer div end-->

    	<footer class="jumbotron" style="height:100px;margin-top:78px;margin-bottom:0px;background-color:lightgrey">
			<div style="font-size:18px" align="center">Libromate © 2018  |  All rights reserved</div>
		</footer>
    </body>
</html>
