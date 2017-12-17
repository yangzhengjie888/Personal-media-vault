<?php

	$conn = mysql_connect('localhost','root','');
	mysql_set_charset('utf8',$conn);
	mysql_select_db('mediavault');


	$fileid = $_GET['id'];

	$sql2 = "delete from upload where ='$fileid'";

	$result  = mysql_query($sql);
	
	if(isset($_GET['id'])){
	if(mysql_num_rows($result)==0){

		echo "<script>window.alert('No files are found');</script>"

	}


	
	while($row=mysql_fetch_array($result,MYSQL_ASSOC)){

	
			$temp=$row["address"];

		if(file_exists($_SERVER['DOCUMENT_ROOT'].$row["address"])){

	
			unlink($_SERVER['DOCUMENT_ROOT'].$row["address"]);
			
			$result2 = mysql_query($sql2);
			
			if(!file_exists($temp)){
			echo "<script>window.alert('The file has been deleted successfully');</script>";
			}
		}

		
		}
		
	}
	}

?>