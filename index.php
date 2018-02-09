<?php
	session_start();

	if(isset($_SESSION["user"]))
		header("Location:dashboard.php");

	require_once('db_connect.php'); //connect to database

	$flag = 0;

	//if user clicks on login
	if(isset($_POST["login"])) {

		$username = $_POST['user'];
		$password = md5($_POST['pass']);
		$query = "select * from users where username='$username' and password='$password'";
        $newuser = mysqli_query($link,$query);

		if(trim($_POST["user"])==NULL){
            $flag=1;
            $msg="Username is required!";
        }
        else if(trim($_POST["pass"])==NULL){
            $flag=1;
            $msg="Password is required!";
        }
        else if(mysqli_num_rows($newuser)==0){
            $flag=1;
            $msg="Username or Password incorrect";
        }
        else {
			$row = mysqli_fetch_assoc($newuser);

            //generate unique user id
            $t = microtime(true);
            $micro = sprintf("%02d",($t - floor($t)) * 1000000);
            $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            $user_id="u".substr($d->format("ymdHisu"),0,14);

        	//declaration of global session variables
            $_SESSION["user_id"] = $row["uid"];
        	$_SESSION["user"] = $_POST["user"];
            $_SESSION["pass"] = md5($_POST["pass"]);
			$_SESSION["name"] = $row["name"];
            $_SESSION["email"] = $row["email"];
			$_SESSION["mobile"] = $row["mobile"];
			$_SESSION["level"] = $row["level"];
			$_SESSION["points"] = $row["points"];

			//transfer to dashboard
            if(mysqli_num_rows($newuser)>0)
        	   header("Location: dashboard.php");
        }
	}

	//if user clicks on sign up
	else if(isset($_POST["signup"])) {

        //generate unique user id
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        $user_id="u".substr($d->format("ymdHisu"),0,14);

		$username = $_POST["user"];
		$password = md5($_POST["pass"]);
		$name = $_POST["name"];
		$email = $_POST["email"];
		$mobile = $_POST["mobile"];
		$level = 0;
		$points = 10;

		//check duplicate username
		$query="select * from users where username='$username'";
        $newuser=mysqli_query($link,$query);

		if(trim($_POST["name"])==NULL)
        {
            $flag=1;
            $msg="Name is required!";
        }
        else if(trim($_POST["email"])==NULL)
        {
            $flag=1;
            $msg="Email is required!";
        }
        else if(trim($_POST["mobile"])==NULL)
        {
            $flag=1;
            $msg="Phone number is required!";
        }
        else if(trim($_POST["user"])==NULL)
        {
            $flag=1;
            $msg="Username is required!";
        }
        else if(trim($_POST["pass"])==NULL)
        {
            $flag=1;
            $msg="Password is required!";
        }
        else if(strlen($_POST["pass"])<6)
        {
            $flag=1;
            $msg="Password should be of minimum 6 letters";
        }
        else if(mysqli_num_rows($newuser)!=0)
        {
            $flag=1;
            $msg="Username already exists";
        }
        else if(!is_numeric($_POST["mobile"]) && strlen($_POST["mobile"])!=10)
        {
            $flag=1;
            $msg="Invalid mobile number ";
        }
        else {
        	//declaration of global session variables
            $_SESSION["user_id"] = $user_id;
        	$_SESSION["user"] = $_POST["user"];
            $_SESSION["pass"] = md5($_POST["pass"]);
			$_SESSION["name"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];
			$_SESSION["mobile"] = $_POST["mobile"];
			$_SESSION["level"] = 0;
			$_SESSION["points"] = 10;

      		//query to insert data to MySQL
			$sql = "insert into users (uid,name,username,password,mobile,email,level,points) values ('$user_id','$name','$username','$password','$mobile','$email','$level','$points')";
			$result = mysqli_query($link,$sql);

			//transfer to dashboard
            if(mysqli_num_rows($newuser)==0)
                header("Location: dashboard.php");
        }
	}

	//if any text field is missing or user/pass combination is incorrect
	if($flag)
    {
        echo '<div class="alert alert-danger alert-dismissable fade in" style="position:absolute;margin-top:580px;margin-left:200px;width:32%;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';

		unset($_POST);
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
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<header style="height:100px;background-color:#2D2E40;">
			<img src="Images/logo.png" style="height:100px;">
		</header>

		<img src="Images/book.jpg" style ="position:absolute;right:0px;">
		<div id="container" style ="position:absolute;left:835px;font-size:45px;text-align:center;color:beige;font-family:courier;margin-top:45px;margin-left:50px;margin-right:50px;font-variant:small-caps;">
			The more that you read, the more things you will know. The more that you learn, the more places you’ll go.
		</div>

		<div style="margin-top:70px;margin-left:200px;margin-right:200px;width:66%;"><!--outer div start-->
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#login">Login</a></li>
                <li><a data-toggle="pill" href="#signup">Sign Up</a></li>
            </ul>

            <div class="tab-content"><!--tab pill start-->
                <div id="login" class="tab-pane fade in active">
                	<div class="row"><!--row start-->
                		<div class="col-md-6"><!--col-md-6 start-->
                			<div class="jumbotron"style="height:350px;padding-top:15px;background-color:skyblue;box-shadow:5px 5px 5px #c9c9c9;border-radius:5px"><!--login div start-->
								<div align="center"><img src="Images/user.png" style="width:150px;"></div>
								<form action="index.php" method="post" style="padding-left:75px;padding-right:75px;padding-top:15px;">
									<div class="input-group">
  										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  										<input type="text" class="form-control" name="user" placeholder="Username" value="<?php echo htmlentities($user); ?>">
									</div>
									<div class="input-group">
								      	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								      	<input type="password" class="form-control" name="pass" placeholder="Password">
								    </div><br>
                					<input class="btn btn-block btn-primary" type="submit" name="login" value="Login">
                				</form>
                			</div><!--login div end-->
                		</div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>

                <div id="signup" class="tab-pane fade">
                    <div class="row"><!--row start-->
                        <div class="col-md-6"><!--col-md-6 start-->
                            <div class="jumbotron"style="height:350px;padding-top:5px;background-color:skyblue;box-shadow:5px 5px 5px #c9c9c9;border-radius:5px">
                                <!--signup div start-->
                                <form action="index.php" method="post" style="padding-left:75px;padding-right:75px;padding-top:30px;">
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
                					<input class="btn btn-block btn-primary" type="submit" name="signup" value="Sign Up">
                                    <input class="btn btn-block btn-primary" type="reset" name="reset" value="Reset">
                                </form>
                            </div><!--sign up div end-->
                        </div><!--col-md-6 end-->
                    </div><!--row end-->
                </div>
            </div><!--tab pill end-->
        </div><!--outer div end-->

    	<footer class="footer jumbotron" style="height:100px;margin-top:88px;margin-bottom:0px;background-color:lightgrey">
			<div style="font-size:18px" align="center">© Libromate 2018  |  All rights reserved</div>
		</footer>
    </body>
</html>
