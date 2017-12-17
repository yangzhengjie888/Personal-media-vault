<?php

	include "conn.php";
	
	if(isset($_POST['id'])){
	$fileid = $_POST['id'];

	$sql = "insert into recycle_bin select * from upload where id ='$fileid'";
	$sql1 = "delete from upload where id ='$fileid'";
	
	$result  = mysql_query("SELECT * from upload where id='$fileid'");
	
	while($row=mysql_fetch_array($result)){

			$temp=$row["address"];
			$name =$row["name"];
			$path = pathinfo($temp);
			$basename=$path['basename'];
			$extension=$path['extension'];
	
			$result2 = mysql_query($sql);
			
			if(!file_exists($temp)){
				if($extension=="jpg"){
			echo "<script>window.alert('The file has been removed successfully');
						  window.location.href='../show_picture.php';
							</script>";
				}
				if($extension=="mp4"){
			echo "<script>window.alert('The file has been removed successfully');
						  window.location.href='../show_video.php';
							</script>";
				}
				if($extension=="mp3"){
			echo "<script>window.alert('The file has been removed successfully');
						  window.location.href='../show_music.php';
							</script>";
				}
				if($extension=="pdf"){
			echo "<script>window.alert('The file has been removed successfully');
						  window.location.href='../show_pdf.php';
							</script>";
				}
				$del = mysql_query($sql1);
			}
		}

		
		}
		

?>