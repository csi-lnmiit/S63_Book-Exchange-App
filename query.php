<?php
	session_start();

	//connect to database
	require_once('db_connect.php');

	//if confirm delete is clicked on modify
	if (isset($_GET['trash'])) {
		$bid = $_GET['trash'];
		$sql="UPDATE books b SET b.trash='1' WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: modify.php');
	}

	//if confirm delete is clicked on trash
	else if (isset($_GET['del'])) {
		$bid = $_GET['del'];
		$sql="DELETE FROM books WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location: trash.php');
	}

	//if confirm restore is clicked on trash
	else if (isset($_GET['res'])) {
		$bid = $_GET['res'];
		$sql="UPDATE books b SET b.trash='0' WHERE bid='$bid'";
		mysqli_query($link,$sql);
		header('location:trash.php');
	}

	//if request is clicked on search
	else if(isset($_GET["request"])) {
		$bid = $_GET['request'];
		$to_user = $_GET['to_user'];
		$sql = "delete from requests where bid='" . $bid . "' and to_user='" . $to_user . "'";
		mysqli_query($link,$sql);
		$sql = "insert into requests values('" . $bid . "','" . $_SESSION['user_id'] . "','" . $to_user . "',0,1,0)";
		mysqli_query($link,$sql);
		header('location:borrow.php');
	}

	//if return is clicked on borrow
	else if(isset($_GET["return"])) {
		$bid = $_GET['return'];
		$to_user = $_GET['to_user'];
		$sql = "delete from requests where bid='" . $bid . "' and to_user='" . $to_user . "'";
		mysqli_query($link,$sql);
		header('location:borrow.php');
	}

	//if accept is clicked on lent
    else if(isset($_GET["accept"])) {
        $bid=$_GET['accept'];
		$to_user = $_GET['to_user'];
        $sql="UPDATE requests SET sn=1,rn=0,status=1 WHERE bid='$bid' and to_user='$to_user'";
        mysqli_query($link,$sql);
        header('location:lent.php');
    }

	//if decline is clicked on lent
    else if(isset($_GET["decline"])) {
        $bid=$_GET['decline'];
		$to_user = $_GET['to_user'];
        $sql="UPDATE requests SET sn=1,rn=0,status=2 WHERE bid='$bid' and to_user='$to_user'";
        mysqli_query($link,$sql);
        header('location:lent.php');
    }

	//if cancel is clicked on lent
    else if(isset($_GET["cancel"])) {
        $bid=$_GET['cancel'];
		$to_user = $_GET['to_user'];
        $sql="UPDATE requests r SET r.sn=0,r.rn=1,status=0 WHERE bid='$bid' and to_user='$to_user'";
        mysqli_query($link,$sql);
        header('location:lent.php');
    }
?>
