<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>picture</title>

<link rel="stylesheet" href="css/photopile.css" />

<style>
.photopile-wrapper { width: 900px; margin: 50px auto; padding: 50px;}
ul.photopile li a img { border: 0 none;}
</style>

</head>

<body>
<!-- Demo  -->	
<div class="photopile-wrapper">
	<ul class="photopile">
	<?php
	
	$user='root';
	$password='';
	$db='mediavault';
	$connect=mysql_connect('localhost',$user,$password);
	mysql_set_charset('utf8',$connect);
	mysql_select_db($db);
	$result=mysql_query("select address from upload order by id");
	while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
		
			echo "<li><a href='$row[address]'/> </li>";
			echo "<li><img src='$row[address]'/> </li>";	
	//echo "<img src='$row[address]'/>";
	} 
?> 
	</ul>
</div>
<!-- Demo end -->

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery-ui-1.10.4.min.js"></script>
<script src="js/photopile.js"></script>


</body>
</html>