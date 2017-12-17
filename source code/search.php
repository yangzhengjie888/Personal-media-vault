
<?php
include "conn.php";
$output = '';

	session_start();
	$userid=@$_SESSION['user_id'];
	//$query = mysql_query("SELECT * FROM upload where user_id='$userid'") or die("could not search");

if(isset($_POST['search'])){
	if($_POST['search']==""){
	
	$output ="<script>window.alert('Please enter keyword before searching');</script>"; }
	
	else{
	
    $searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	
	$query = mysql_query("SELECT * FROM upload WHERE name LIKE '%$searchq%' and user_id='$userid'") or die("could not search");
	$count = mysql_num_rows($query);
	if($count == 0){
		$output = 'There was no search result';
	} else {
		while($row = mysql_fetch_array($query)){
			$name = $row['name'];
			 $fileaddress=$row['address'];
			 $tmp=$row['address'];
          $fileid=$row['id'];

          $file=pathinfo($fileaddress);
          $filetype=$file['extension'];

          if( $filetype=='pdf'){

		  $output .= "<div><a href='$tmp' target='blank'><img src='/img/pdf.png'><br>".$name."</a></div><br/><br/>";
		  }
		  if($filetype=='mp4'){
			$output.="<video width='880' height='480' controls>
            <source src='".$row['address']."' type='video/mp4'></video><br/>".$row['name']."<br/><br/>";
			  
		  }
			if($filetype=='mp3'){
			 $output.="<audio width='300' height='220' controls>
            <source src='".$row['address']."' type='video/mp4'></audio><br/>".$row['name']."<br/><br/>";
			}
			if($filetype=='jpg'){
			$output .= "<div><a href='$tmp' target='blank'><img src='$tmp' height = '300' width = '300'><br>".$name."</a></div><br/><br/>";
		}
		
		}
	}
}
}
?>

<html>
<body>


<?php 

include "home.php"; 

?>

</body>
</html>

