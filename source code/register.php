<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
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

	<h1 class="margin-bottom-15">Create Account</h1>
	<div class="container">
		<div class="col-md-12">			
			<form class="form-horizontal templatemo-create-account templatemo-container" role="form" action="#" method="post">
				<div class="form-inner">			
					<div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="Name" class="control-label">Name</label>
			            <input type="text" class="form-control" name ="name" placeholder="">		            		            		            
			          </div>  			                       
			        </div>	
					
			        <div class="form-group">
			          <div class="col-md-8">		          	
			            <label for="Email" class="control-label">Email</label>
			            <input type="text" class="form-control" name ="email" placeholder="">		            		            		            
			          </div>              
			        </div>	
							                
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
			            <input type="submit" value="Create account" class="btn btn-info">
			            <a href="login.html" class="pull-right">Login</a>
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

@$username = stripslashes(trim($_POST['name']));
@$password = $_POST['password'];
@$password_confirm = $_POST['password_confirm'];
@$email = trim($_POST['email']);
@$code = md5(trim($_POST['password']));
$regtime = time();
$token = md5($username.$code.$regtime); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后
//检测用户名是否存在

//@$num = mysql_num_rows($query);
if($username != null && $email != null && $password != null){
	$query = mysql_query("select * from user_information where username='$username'");
	$num = mysql_num_rows($query);
	if($password != $password_confirm){
		echo "<script>alert('Passwords are not the same!');</script>;";
	}
	if($num == 1){
		echo "<script>alert('This username has already exited!');</script>;";
	}
	else{
		echo "<script>alert('Successful! Please check your email and activate account!');</script>;";	
		$sql = "insert into user_information (username,password,email,token,token_exptime,regtime) values ('$username','$password','$email','$token','$token_exptime','$regtime')";
		mysql_query($sql);
		if(mysql_insert_id()){//写入成功，发邮件
			include_once("smtp.class.php");
			$smtpserver = "ssl://smtp.gmail.com"; //SMTP服务器
			$smtpserverport = 465; //SMTP服务器端口
			$smtpusermail = "mediavault42@gmail.com"; //SMTP服务器的用户邮箱
			$smtpuser = "mediavault42"; //SMTP服务器的用户帐号
			$smtppass = "19951115"; //SMTP服务器的用户密码
			$smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
			$emailtype = "HTML"; //信件类型，文本:text；网页：HTML
			$smtpemailto = $email;
			$smtpemailfrom = $smtpusermail;
			$emailsubject = "Account Activation";
			$emailbody = "Dear ".$username.":<br/>Thank you for registering your mediavault account.<br/>Please click the link to activate.<br/><a href='mediavault.wicp.net/active.php?verify=".$token."' target='_blank'>mediavault.wicp.net/active.php?verify=".$token."</a><br/>If you are not able to click the link, please copy it to your web browser for access，The link will be due within 24 hours。<br/>Have fun in the cloud!
			<br/><p style='text-align:right'>-------- MediaVault Team</p>";
			$rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		}
	exit;
	}
}
else{
	echo "<script>alert('The information below must be completed in FULL!');</script>;";
}


?>