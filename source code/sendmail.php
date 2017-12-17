<?php
include_once("connect.php");

$email = stripslashes(trim($_POST['mail']));
$email = injectChk($email);
	
$sql = "select user_id,username,password from user_information where email='$email'";
$query = mysql_query($sql);
$num = mysql_num_rows($query);
if($num==0){//该邮箱尚未注册！
	echo 'Unregistered';
	exit;	
}else{
	$row = mysql_fetch_array($query);
	$getpasstime = time();
	$uid = $row['user_id'];
	$token = md5($uid.$row['username'].$row['password']);
	$url = "mediavault.wicp.net/reset.php?email=".$email."&token=".$token;
	$time = date('Y-m-d H:i');
	$result = sendmail($time,$email,$url);
	if($result==1){//邮件发送成功
		$msg = 'System has already sent you an email<br/>Please login you email box to reset you password';
		//更新数据发送时间
		mysql_query("update user_information set getpasstime=$getpasstime where user_id='$uid '");
	}else{
		$msg = $result;
	}
	echo $msg;
}

function sendmail($time,$email,$url){
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
    $emailsubject = "MediaVault - reset password";
    $emailbody = "Dear ".$email."：<br/>At ".$time.",you submitted the reset password request. Please click the link below to reset your password（24 hours valid）。<br/><a href='".$url."' target='_blank'>".$url."</a><br/>If the link cannot be clicked, Please copy it to your web browser to access in<br/>Have fun in the cloud!";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
	return $rs;
}

function injectChk($sql_str) { //防止注入
		$check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
		if ($check) {
			echo('Invalid characters');
			exit ();
		} else {
			return $sql_str;
		}
}
?>