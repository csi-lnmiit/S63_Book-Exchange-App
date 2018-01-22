<?php
	if (!isset($_SESSION)) session_start();
	require_once "connect.php";

	if($_POST["login"]) { //if user clicks on login

	}
	else if($_POST["signup"]) { //if user clicks on signup

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
		<div id="container" style ="position:absolute;left:835px;font-style:italic;font-size:40px;text-align:center;color:white;font-family:serif;margin-top:210px;margin-left:20px;margin-right:20px;">
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
                			<div class="jumbotron"style="height:350px;padding-top:5px;background-color:lightgreen;box-shadow:8px 8px 8px #c9c9c9;border-radius:5px 25%;"><!--login div start-->
                				<div align="center">
                    				<h3>Login</h3><br>
                    				<form action="index.php" method="post">
                    					Username : <input type="text" name="user"><br><br>
                    					Password : <input type="password" name="pass"><br><br>
                    					<input type="submit" name="login" value="Login">
                    				</form>
                				</div>
                			</div><!--login div end-->
                		</div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>

                <div id="signup" class="tab-pane fade">
                    <div class="row"><!--row start-->
                        <div class="col-md-6"><!--col-md-6 start-->
                            <div class="jumbotron"style="height:350px;padding-top:5px;background-color:lightblue;box-shadow:8px 8px 8px #c9c9c9;border-radius:5px 25%;"><!--signup div start-->
                                <div align="center">
                                    <h3>Sign Up</h3><br>
                                    <form action="index.php" method="post">
                                        Full Name : <input type="text" name="name"><br><br>
                                        E-Mail ID : <input type="email" name="email"><br><br>
										Mobile No. : <input type="tel" name="mobile"><br><br>
                                        Username : <input type="text" name="user"><br><br>
                                        Password : <input type="password" name="pass"><br><br>
                                        <input type="submit" name="signup" value="Sign Up">
                                    </form>
                                </div>
                            </div><!--sign up div end-->
                        </div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>
            </div>
        </div><!--outer div end-->

    	<footer class="jumbotron" style="height:100px;margin-top:78px;margin-bottom:0px;background-color:lightgrey">
			<div style="font-size:18px" align="center">Libromate © 2018  |  All rights reserved</div>
		</footer>
    </body>
</html>
