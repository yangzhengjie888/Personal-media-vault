         


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
            <source src='".$row['address']."' type='video/mp4'></audio><br/>".$row['name']."<form  method='post' action='/images/delete.php' >
			   <input name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Delete'><br>
			  </form><br/><br/>";
			
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


