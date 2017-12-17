
<?php
	include "conn.php";
	$uptypes=array(
    'image/jpg',
    'image/png',
	'image/jpeg',
);
	$max_file_size=500000000000;     //上传文件大小限制, 单位BYTE   size limited
	$destination_folder="img/";
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

   if (!is_uploaded_file($_FILES['upfile']['tmp_name']))
    //是否存在文件   file exit of not
    {
         echo "<script>window.alert('Please select the files');
						  window.location.href='setting.php';
							</script>";
         
    }

    $file = $_FILES["upfile"];
    if($max_file_size < $file["size"])
    //检查文件大小    check the size of the files
    {
        echo "<script>window.alert('Fail to upload');
						  window.location.href='setting.php';
							</script>";
        
    }

    if(!in_array($file["type"], $uptypes))
    //检查文件类型   check the type of the files
    {
        echo "<script>window.alert('Please choose correct type of file: jpg,jpeg,png');
						  window.location.href='setting.php';
							</script>";
        
    }

    if(!file_exists($destination_folder))
    {
        mkdir($destination_folder);
    }

    $filename=$file["tmp_name"];
    $image_size = getimagesize($filename);
    $pinfo=pathinfo($file["name"]);
    $ftype=$pinfo['extension'];
    $destination = $destination_folder.time().".".$ftype;
    if (file_exists($destination) && $overwrite != true)
    {
        echo "This file has existed";
        
    }

    if(!move_uploaded_file ($filename, $destination))
    {
        echo "Fail to move the file";
        
    }

    $pinfo=pathinfo($destination);
    $fname=$pinfo['basename'];
	//将数据插入到数据库中   put the data into database
	$address = "$destination_folder"."$fname";    
	//$name = $file['name'];
	//$size = $file["size"];
	session_start();
	 $userid=$_SESSION['user_id']; 
	 @$sql3 = "delete from user_details where session_id='$userid' and name=''";
	$result3=mysql_query($sql3);
	$sql = "insert into user_details(icon,session_id) values ('$address','$userid')";
	mysql_query($sql);
	echo  "<script>window.alert('Head photo is uploaded successfully!')</script>";
}
?>

<?php echo "<script>window.location.href='setting.php'</script>"  ?>