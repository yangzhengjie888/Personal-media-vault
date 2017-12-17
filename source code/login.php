<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="icon" href="http://joeyrabbitt.com/favicon.ico" type="image/x-icon">
<style>a{TEXT-DECORATION:none }a:hover{TEXT-DECORATION:underline }</style>
</head>

<script language="javascript">
function checkit(){						//自定义函数
	if(form1.name.value==""){				//判断用户名是否为空
	        alert("Please input the username!");
   		    form1.name.select();
			return false;
         }		        		
       if(form1.pwd.value==""){			//判断密码是否为空
			alert("Please input the password!");
			form1.pwd.select();
			return false ;
		 }
		 	return true;
					 
}	
</script>
<body>

<?php
include("conn.php");
if(isset($_POST['name']) and $_POST['password']!=null){
	$select=mysql_query("select * from user_information where username='".$_POST['name']."' and password='".$_POST['password']."'",$conn);
	if($row=mysql_num_rows($select)==1){
		$_SESSION['name']=$_POST['name'];
		echo "<script>alert('Successful！');window.location.href='home.html';</script>;";	
	}else{
		echo "<script>alert('Error Account！');window.location.href='login.php';</script>;";	
	}
}
?>		 
			
<div class="wrapper">
	<div class="container">
		<h1>Welcome</h1>
		<form name="form" action="" method="post" >
			<input type="text" name = "name" placeholder="Username">
			<input type="password" name = "password" placeholder="Password">
			<button type="submit" id="login-button">Login</button></br></br>
			<a href="resetpassword.php"><font color = #FFFFFF ><B>Forget password?</B></font></p></a>
	</div>
	</div>	
		</form>
</div>
</body>
</html>


