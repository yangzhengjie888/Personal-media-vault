	
<script type="text/javascript">
	function myRename(){
		var fileid = document.getElementById("fileid").value;
		var filename = prompt("New file name","Please type name of files");
		if(filename!==null){
		<?

	include "conn.php";

	$result = mysql_query("SELECT * from upload where id ='fileid'");
	

	while($row=mysql_fetch_array($result)){
		$path =  $row['address'];
		$filepath= pathinfo($path);
		$filetype= $filepath['extension'];

		$result2 = mysql_query("UPDATE upload  SET name ='filename' where id='fileid' ");
		if($filetype=="jpg"){
			echo "<script>window.alert('The image file has been renamed successfully');
						  window.location.href='../show_picture.php';
							</script>";

		}
		if($filetype=="mp3"){
			echo "<script>window.alert('The song file has been renamed successfully');
						  window.location.href='../show_music.php';
							</script>";

		}
		if($filetype=="mp4"){
			echo "<script>window.alert('The video file has been renamed successfully');
						  window.location.href='../show_video.php';
							</script>";

		}
		if($filetype=="pdf"){
			echo "<script>window.alert('The pdf file has been renamed successfully');
						  window.location.href='../show_pdf.php';
							</script>";

		}


	}


	}


?>

		}
		
		</script>