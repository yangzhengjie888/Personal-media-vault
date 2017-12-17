<?php

	include "conn.php";

	if(isset($_POST['id'])){

		$id =$_POST['id'];
		$result =mysql_query("SELECT * FROM upload where id='$id'");

		while($row=mysql_fetch_array($result)){
			
			$path ="mediavault.wicp.net/".$row['address'];
			$filepath=pathinfo($path);
			$filename =$row['name'];
			@$filetype=$filepath['extension'];
			$filebasename =$filepath['basename'];
			$fileaddress = $filepath['dirname'];


			if($filetype=="mp3"){				
			echo "<script>window.prompt('The link of song','$path');
						  window.location.href='../show_music.php';
							</script>";

			}
			if($filetype=="mp4"){				
			echo "<script>window.prompt('The link of mp4','$path');
						  window.location.href='../show_video.php';
							</script>";

			}
			if($filetype=="pdf"){				
			echo "<script>window.prompt('The link of pdf','$path');
						  window.location.href='../show_pdf.php';
							</script>";

			}
			if($filetype=="jpg"){				
			echo "<script>window.prompt('The link of images','$path');
						  window.location.href='../show_picture.php';
							</script>";

			}


		}

	

	}

?>