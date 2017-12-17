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
        
          $file=pathinfo($fileaddress);
          $filetype=$file['extension'];

          if( $filetype=='jpg'){

			$name = $row['name'];
			
            		
			$tmp=$row['address'];
			
			$output .= "<div><a href='$tmp' target='blank'><img src='$tmp'><br>".$name."</a></div><form  method='post' action='/images/delete.php' >
			   <input name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Delete'><br>
			  </form>";
		}
	
	}
	}

?>

<html>
<body>

	  
	  <?php include "home.html";

?>
</body>
</html>

