
<!DOCTYPE html>
<html>
<head>
	<title>Reset Account</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="css\bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css\bootstrap-theme.min" rel="stylesheet" type="text/css">
	<link href="css\templatemo_style.css" rel="stylesheet" type="text/css">	
	<link rel="icon" href="http://joeyrabbitt.com/favicon.ico" type="image/x-icon">
</head>
<body class="templatemo-bg-gray">

	<h1 class="margin-bottom-15">Reset Account</h1>
	<div class="container">
		<div class="col-md-12">			
			<form class="form-horizontal templatemo-create-account templatemo-container" role="form" action="#" method="post">
				<div class="form-inner">					                
			        <div class="form-group">
			          <div class="col-md-6">
			            <label for="Password" class="control-label">Password</label>
			            <input type="password" class="form-control" name ="password" placeholder="">
			          </div>
			          <div class="col-md-6">
			            <label for="Password_Confirm" class="control-label">Confirm Password</label>
			            <input type="password" class="form-control" name ="password_confirm" placeholder="">
			          </div>
			        </div>			       
			        <div class="form-group">
			          <div class="col-md-12">
			            <input type="submit" value="Reset account" class="btn btn-info">
			          </div>
			        </div>	
				</div>				    	
		      </form>		      
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="templatemo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
	      </div>    
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once("connect.php");
@$token = stripslashes(trim($_GET['token']));
@$email = stripslashes(trim($_GET['email']));
$sql = "select * from user_information where email='$email'";


$query = mysql_query($sql);
$row = mysql_fetch_array($query);
if($row){
	$mt = md5($row['user_id'].$row['username'].$row['password']);
	if($mt==$token){
		if(time()-$row['getpasstime']>24*60*60){
			echo "<script>alert('The link is out of date!');window.location.href='resetpassword.php';</script>;";	
			//$msg = 'The link is out of date!';
		}else{
			//重置密码...
			//$msg = 'Please reset your password.';	
			@$password = $_POST['password'];
			@$password_confirm = $_POST['password_confirm'];
			if($password != null && $password_confirm != null && $password == $password_confirm){
				mysql_query("update user_information set password=$password where user_id=$row[user_id]");
				if(mysql_affected_rows($link)!=1) die(0);
				echo "<script>alert('Successful!');window.location.href='login.html';</script>;";	
				//$msg =  'Successful!';
			}
			else{
				echo "<script>alert('Please enter a right password!')</script>;";
			}
		}
	}else{
		echo "<script>alert('Invalid link');window.location.href='resetpassword.php';</script>;";	
		//$msg =  'Invalid link<br/>'.$mt.'<br/>'.$token;
	}
}else{
	echo "<script>alert('Wrong link!');window.location.href='resetpassword.php';</script>;";	
	//$msg =  'Wrong link!';	
}
//echo $msg;
?>


