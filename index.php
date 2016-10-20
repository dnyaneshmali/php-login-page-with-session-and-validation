<?php


$servername = 'localhost';
$serveruser = 'root';
$serverpass = '';
$dbname = 'login_db';

//Create Connection
$conn = mysqli_connect($servername,$serveruser,$serverpass)or die("Failed to connect to MySQL: " . mysqli_error());
mysqli_select_db($conn, $dbname)or die("Failed to connect to MySQL: " . mysqli_error());

//Get values from form
//$uname = $_POST['uname'];
//$pass = $_POST['pass'];
	
//After submit	
if(isset($_POST['submit'])){

//Start Session
session_start();


//if(!empty($_POST['uname'])){

//Fire Query
$result = "SELECT * FROM user_login where first_name = '$_POST[uname]' AND password = '$_POST[pass]'";

//Execute Query
$query = mysqli_query($conn , $result);

//Fetch Result
$row = mysqli_fetch_array($query); 

//Compare values
	if(!empty($row['first_name']) AND !empty($row['password'])) 
	{ 
		$_SESSION['userName'] = $row['first_name']; 
		
		 header('location:welcome.php');
	} 
	else if(empty($_POST['uname']) AND empty($_POST['pass'])){
		echo"<script>alert('both');</script>";
			$usenamemsg = "Username should not be empty";
			$passmsg = "Password should not be empty";
			
	}
	else if(empty($_POST['uname'])){
		//echo"<script>alert('pass');</script>";
			$usenamemsg = "Username should not be empty";
	}
	else if(empty($_POST['pass'])){
		//echo"<script>alert('pass');</script>";
			$passmsg = "Password should not be empty";
	}
	else 
	{ 
	// header('location:index.php');
	 $msg ="Username Or Password is wrong";
	}	
}
//}

?>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="softinfology.com">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.1.js"></script> <!--Add Scripts-->
	<script type="text/javascript" src="js/bootstrap.js"></script> <!--Bootstrap Scripts-->
</head>
<body>
<div class="container container-table">
<div class="row vertical-center-row">
<div class="col-md-4 col-md-offset-4" style="border:solid 2px #ddd;">
<h3 class="text-center">Login Here</h3>
<form method="post" action="">
<div class="form-group">
<label>Enter Username</label>
<input class="form-control" type="text" name="uname" placeholder="Username">
<div class="validationmsg"><?php if(isset($usenamemsg)){echo $usenamemsg; }?></div>
</div>
<div class="form-group">
<label>Enter Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password">
<div class="validationmsg"><?php if(isset($passmsg)){echo $passmsg; }?></div>

</div>
<div class="form-group">
<input type="submit"class="btn btn-default" name="submit" value="Submit">
</div>
</form>
<div class="validationmsg"><?php if(isset($msg)){echo $msg; }?></div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>