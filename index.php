<html>
	<head>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<title>Libromate</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>

		<header style="height:100px;background-color:#164682">
			<img src="logo.png" style="height:100px;">
		</header>

		<div style="margin-top:50px;margin-left:100px;margin-right:300px;"><!--outer div start-->
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#login">Login</a></li>
                <li><a data-toggle="pill" href="#signup">Sign Up</a></li>
            </ul>
            
            <!--tab pill start-->
            <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                	<div class="row"><!--row start-->
                		<div class="col-md-6"><!--col-md-6 start-->
                			<div class="jumbotron"style="height:350px;padding-top:5px"><!--login div start-->
                				<div align="center">
                    				<h3>Login</h3><br>
                    				<form action="login.php" method="post">
                    					Username : <input type="text" name="user"><br><br>
                    					Password : <input type="password" name="pass"><br><br>
                    					<input type="submit" name="Login">
                    				</form>
                				</div>
                			</div><!--login div end-->
                		</div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>

                <div id="signup" class="tab-pane fade">
                    <div class="row"><!--row start-->
                        <div class="col-md-6"><!--col-md-6 start-->
                            <div class="jumbotron"style="height:350px;padding-top:5px"><!--sign up div start-->
                                <div align="center">
                                    <h3>Sign Up</h3><br>
                                    <form action="signup.php" method="post">
                                        Full Name : <input type="text" name="name"><br><br>
                                        E-Mail ID : <input type="email" name="email"><br><br>
                                        Username : <input type="text" name="user"><br><br>
                                        Password : <input type="password" name="pass"><br><br>
                                        <input type="submit" name="Sign Up">
                                    </form>
                                </div>
                            </div><!--sign up div end-->
                        </div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>
            </div>
        </div><!--outer div end-->
    </body>
</html>
