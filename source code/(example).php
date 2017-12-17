	<?php
	$user='root';
	$password='';
	$db='mediavault';
	$connect=mysql_connect('localhost',$user,$password);
	mysql_set_charset('utf8',$connect);
	mysql_select_db($db);
	$result=mysql_query("select address from upload order by id");
	while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
		echo "<td><img src='$row[address]'/></td>"; 
	} 
	?>


