
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

          if( $filetype=='mp4'){

			
			$name = $row['name'];
			$id=$row['id'];
            		
			$tmp=$row['address'];
			 $output.="<video width='880' height='480' controls>
            <source src='".$row['address']."' type='video/mp4'></video><br/>".$row['name']."<br/><br/>
			
			<form  method='post' action='/images/delete.php' >
			   <input name='id' type='hidden' value='$row[id]' />
			  <input type='submit' value='Delete'><br>
			  </form>";
			  
			//$output .= "<div><a href='$tmp' target='blank'><img src='$tmp'><br>".$name."</a></div>";
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


