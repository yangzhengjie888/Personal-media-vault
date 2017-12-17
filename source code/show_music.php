<?php
	include "conn.php";
	$output = '';
	session_start();
	$userid=@$_SESSION['user_id'];
	$query = mysql_query("SELECT * FROM upload where user_id='$userid'") or die("could not search");	
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
            <source src='".$row['address']."' type='video/mp4'></audio><br/><p id='filename'>".$row['name']."<form  method='post' action='/upload/delete.php' >
			   <input id='fileid' name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Delete'><br>
			  </form>
			  <form  method='post' action='share.php' >
			   <input id='fileid' name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Share'><br>
			  </form><br/><br/>";
			
		}
		
	}
	}

	
?>



<html>
<body>
		
	  <?php include "home.php";

?>



</body>
</html>


