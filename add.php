<?php
	session_start();

	if(!isset($_SESSION["user"]))
		header("Location:index.php");

require_once('db_connect.php'); //connect to database
    if(isset($_POST["add"])){
        
        
        //generate unique user id
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        $bid="b".substr($d->format("ymdHisu"),0,14);
        
        $flag=0;        
        $status=1;
        $owner=$_SESSION["user_id"];
        
        
        $bname=$_POST["bname"];
        $bauthor=$_POST["bauthor"];
        
        if(trim($_POST["bname"])==NULL){
            $flag=1;
            $msg="Book Name required";
        }
        else if(trim($_POST["bauthor"])==NULL){
            $flag=1;
            $msg="Author name required";
        }
        else{
            $query="insert into books(bid,bname,author,owner,status) values ('$bid','$bname','$bauthor','$owner',$status)";
        
			$result = mysqli_query($link,$query);
        }
        
        if($flag){
            echo '<div class="alert alert-danger alert-dismissable fade in" style="position:absolute;margin-top:330px;margin-left:425px;width:22%;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';

		unset($_POST);
            
                
        } 
        
        
    }
?>



<!--Display form to add new books -->
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
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
	</head>

	<body>
	    <!--top header-->
	    <header style="height:100px;background-color:#1A1927;width:20%">
	        <img src="Images/logo.png" style="height:100px;">
	    </header>

	    <!--left column list -->
	    <div id="dashboard_left_col" class="col-md-3" style="padding-left: 0">
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
	            <li><a href="add.php" class="active">
	                <span class="glyphicon glyphicon-plus"></span>&emsp;Add</a>
	            </li>
	            <li><a href="#">
	                <span class="glyphicon glyphicon-trash"></span>&emsp;Delete</a>
	            </li>
	            <li><a href="modify.php">
	                <span class="glyphicon glyphicon-edit"></span>&emsp;Modify</a>
	            </li>
				<br>
	            <p>STATS</p>
	            <li><a href="#">
	                 <span class="glyphicon glyphicon-hourglass"></span>&emsp;Request status</a>
	             </li>
	            <li><a href="#">
	                 <span class="glyphicon glyphicon-book"></span>&emsp;Borrowed</a>
	            </li>
	            <br>
	            <p>SESSION</p>
	            <li><a href="logout.php">
	                <span class="glyphicon glyphicon-log-out"></span>&emsp;Logout</a>
	            </li>
	        </ul>
	    </div>

	    

        <!--form for adding books-->
        <div class="row col-md-9">
        <div style="padding-top:10px;padding-right:500px;padding-left:100px;">
            <h2 style="color:#868899;">Add Books</h2>
        </div>
        <form action="add.php" method="post" style="padding-left:100px;padding-right:300px;padding-top:30px;">
					<div class="input-group">
  						<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
  						<input type="text" class="form-control" style="width:250px;" name="bname" placeholder="Book Name">
				    </div>
					<div class="input-group">
  						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
  						<input type="text" class="form-control" style="width:250px;" name="bauthor" placeholder="Author name">
					</div>
                    <br>
                   <div style="float: left; width: 140px"> 
                		<input class="btn btn-block btn-primary" type="submit" name="add" value="Add" >
                  </div> 
                  <div style="float: right; width: 140px;margin-right:260px;">
                        <input class="btn btn-block btn-primary" type="reset" name="reset" value="Reset" >
                  </div>
          
                    
        </form>
        </div>    


	    
	</body>
</html>
