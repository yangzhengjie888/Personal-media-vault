<?php
	include "conn.php";
	$output = '';
	
	session_start();
	$userid=@$_SESSION['user_id'];		
	$result = mysql_query("select * from upload where user_id='$userid' order by size")or die("die");
	
	$num_fields = mysql_num_fields($result); 	
	$j=0;
	$x=1;
		for($j=0;$j<$num_fields;$j++){
		$name = mysql_field_name($result, $j);
		@$object[$x][$name]=$row[$name];
			while($row = mysql_fetch_array($result)){
				$fileaddress=$row['address'];
				$fileid=$row['id'];
				$file=pathinfo($fileaddress);
				$filetype=$file['extension'];
					if( $filetype=='pdf'){			
						$name = $row['name'];           		
						$tmp=$row['address'];
						$output.="<a href='".$row['address']."' target='blank' /><img src='/img/pdf.png'><br/>".$row['name']."<br/></a><form  method='post' action='/images/delete.php' >
						<input name='id' type='hidden' value='$row[id]' />						
						</form>";
					}
					else if( $filetype=='jpg'){
						$name = $row['name'];
						$tmp=$row['address'];		
						$output .= "<div><a href='$tmp' target='blank'><img src='$tmp' height = '300' width = '300'><br>".$name."</a></div><form  method='post' action='/images/delete.php' >
						<input name='id' type='hidden' value='$row[id]' />
						</form>";
					}
					else if( $filetype=='mp3'){		
						$name = $row['name'];		
						$tmp=$row['address'];
						$output.="<audio width='300' height='220' controls='controls' controls='download'>
						<source src='".$row['address']."' type='video/mp4'></audio><br/>".$row['name']."<form  method='post' action='/images/delete.php' >
						<input name='id' type='hidden' value='$row[id]' />
						</form><br/><br/>";	
					}
					else if( $filetype=='mp4'){			
						$name = $row['name'];	
						$tmp=$row['address'];
						$output.="<video width='880' height='480' controls>
						<source src='".$row['address']."' type='video/mp4'></video><br/>".$row['name']."<br/><br/>	
						<form  method='post' action='/images/delete.php' >
						<input name='id' type='hidden' value='$row[id]' />
						</form>";
					}
			}	
			$x++;
		}			
	
?>

<html>
<body>

<?php

	include "home.php";
	
?>

</body>
</html>
