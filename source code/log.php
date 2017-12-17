<?php
$conn=mysql_connect("localhost","root","");
mysql_select_db("mediavault",$conn);
mysql_query("set names utf8");

//获取输入的信息
@$username = $_POST['name'];
@$password = $_POST['password'];
//获取用户信息
//$select=mysql_query("select * from user_information where (username='".$_POST['name']."'or email = '".$_POST['name']."')  and password='".$_POST['password']."' and status = 1",$conn);
//获取session的值
$select=mysql_query("select * from user_information where (username='".$_POST['name']."' or email = '".$_POST['name']."') and status = 1",$conn);
$query = mysql_query("select user_id,username from user_information where (username='".$_POST['name']."' or email = '".$_POST['name']."') and password = '$password'")
or die("fail");
//判断用户以及密码
if($row=mysql_num_rows($select)==1){
	if($row = mysql_fetch_array($query)){
		session_start();
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_id'] = $row['user_id'];
		echo "<script>alert('Successful!');window.location.href='home.php';</script>;";	
	}else{
		echo "<script>alert('Error Account!');window.location.href='login.html';</script>;";
	}
}
else{
	echo "<script>alert('Please activate your account!');window.location.href='login.html';</script>;";
}
?>

