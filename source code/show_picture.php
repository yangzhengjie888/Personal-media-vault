
<?php
	include "conn.php";
	$output = '';
	session_start();
	$userid=@$_SESSION['user_id'];
	$query = mysql_query("SELECT * FROM upload where user_id= '$userid'") or die("could not search");	
	$count = mysql_num_rows($query);
	if($count == 0){
		$output = 'There was no search result';
	} else {
		while($row = mysql_fetch_array($query)){
	      $fileaddress=$row['address'];
        
          $file=pathinfo($fileaddress);
          $filetype=$file['extension'];

          if( $filetype=='jpg'){

			$name = $row['name'];
			
            		
			$tmp=$row['address'];
			//$output .="<a href='$tmp' target='blank'><img src='$tmp' height = '300' width = '300' >";
			$output .= "<a href='$tmp' target='blank'><img src='$tmp' height = '300' width = '300' ><br>".$name."</a><form  method='post' action='/upload/delete.php' >
			   <input name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Delete'>
			  </form> <form  method='post' action='share.php' >
			   <input id='fileid' name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Share'><br>
			  </form>";
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

