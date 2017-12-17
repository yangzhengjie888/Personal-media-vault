
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

          if( $filetype=='mp4'){			
			$name = $row['name'];
			$id=$row['id'];            		
			$tmp=$row['address'];
			$output.="<video width='880' height='480' controls>
            <source src='".$row['address']."' type='video/mp4'></video><br/>".$row['name']."<br/><br/>			
			<form  method='post' action='/upload/delete.php' >
			<input name='id' type='hidden' value='$row[id]' />
			<input type='submit' value='Delete'><br>
			</form> <form  method='post' action='share.php' >
			   <input id='fileid' name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Share'><br>
			  </form>";
			  
			//$output .= "<div><a href='$tmp' target='blank'><img src='$tmp'><br>".$name."</a></div>";
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


