<?php

	include "conn.php";
	
	if(isset($_POST['id'])){
	$fileid = $_POST['id'];

	$sql = "DELETE from recycle_bin where id ='$fileid'";
	
	$result  = mysql_query("SELECT * from recycle_bin where id='$fileid'");
	
	while($row=mysql_fetch_array($result)){

			$temp=$row["address"];
			$name =$row["name"];
			$path = pathinfo($temp);
			$basename=$path['basename'];
			$extension=$path['extension'];
			@unlink($basename);
			$result2 = mysql_query($sql);
			if(!file_exists($temp)){
				if($extension=="jpg"){
			echo "<script>window.alert('The file has been deleted successfully');
						  window.location.href='../show_bin.php';
							</script>";
				}
				if($extension=="mp4"){
			echo "<script>window.alert('The file has been deleted successfully');
						  window.location.href='../show_bin.php';
							</script>";
				}
				if($extension=="mp3"){
			echo "<script>window.alert('The file has been deleted successfully');
						  window.location.href='../show_bin.php';
							</script>";
				}
				if($extension=="pdf"){
			echo "<script>window.alert('The file has been deleted successfully');
						  window.location.href='../show_bin.php';
							</script>";
				}
			}
		}	
	}		
?>

