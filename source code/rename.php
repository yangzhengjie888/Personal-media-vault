         


<?php
include "conn.php";
$output = '';

	$query = mysql_query("SELECT * FROM upload") or die("could not search");
	$count = mysql_num_rows($query);
	if($count == 0){
		$output = 'There was no search result';
	} else {
		while($row = mysql_fetch_array($query)){
			 $fileaddress=$row['address'];
          $fileid=$row['id'];

          $file=pathinfo($fileaddress);
          $filetype=$file['extension'];

          if( $filetype=='mp3'){

			
			$name = $row['name'];		
			$tmp=$row['address'];
			 $output.="<audio width='300' height='220' controls='controls' controls='download'>
            <source src='".$row['address']."' type='video/mp4'></audio><br/><p id='filename'>".$row['name']."</p><form  method='post' action='/images/delete.php' >
			   <input id='fileid' name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Delete'>
			  </form><button onclick='myRename()'>Rename</button>
			  <form method='post' action='share.php'>   <input id='fileid' name='id' type='hidden' value='$row[id]' /><input type='submit' value'Share'></form><br/><br/>";
			
		}
		
	}
	}

?>



<html>
<body>
  
	  <?php include "home.html";

?>
<script>
	
	function myRename(){
		var fileid = document.getElementById("fileid").value;
		var filename = prompt("New file name","Please type name of files");
		if(filename!=null){
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
						  window.location.href='../picture.php';
							</script>";

		}
		if($filetype=="mp3"){
			echo "<script>window.alert('The song file has been renamed successfully');
						  window.location.href='../uploadmusic.php';
							</script>";

		}
		if($filetype=="mp4"){
			echo "<script>window.alert('The video file has been renamed successfully');
						  window.location.href='../uploadvideo.php';
							</script>";

		}
		if($filetype=="pdf"){
			echo "<script>window.alert('The pdf file has been renamed successfully');
						  window.location.href='../uploadpdf.php';
							</script>";

		}


	}


	}


?>





		}

	}

</script>


</script>


</body>
</html>


