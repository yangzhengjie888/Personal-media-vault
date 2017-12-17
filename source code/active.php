<?php
include_once("connect.php");

$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();

$query = mysql_query("select user_id,token_exptime from user_information where status='0' and token ='$verify'");
$row = mysql_fetch_array($query);
if($row){
	if($nowtime>$row['token_exptime']){ //30min
		echo "<script>alert('Out of date, please try again!');window.location.href='register.php';</script>;";
	}else{
		mysql_query("update user_information set status=1 where user_id=".$row['user_id']);
		if(mysql_affected_rows($link)!=1) die(0);
		echo "<script>alert('Successful!');window.location.href='login.html';</script>;";
	}
}else{
	echo "<script>alert('Error!');window.location.href='register.php';</script>;";
}
?>
