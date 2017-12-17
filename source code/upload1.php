<?php
/******************************************************************************

参数说明:   parameter description
$max_file_size  : 上传文件大小限制, 单位BYTE    size limited(Byte)
$destination_folder : 上传文件路径  file path

******************************************************************************/
  include "conn.php";   //mysql link page
//上传文件类型列表      type of files
	session_start();
$uptypes=array(
    'image/jpg',
    'image/png',
	'image/jpeg',
	'application/pdf',
	'application/kswps',
	'audio/mpeg',
	'audio/mp3',
	'video/mp4',
	
    //'image/x-png'
);

$max_file_size=500000000000;     //上传文件大小限制, 单位BYTE   size limited
$destination_folder="upload/"; //上传文件路径   upload path(change the "images")
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
    //是否存在文件   file exit of not
    {
         echo "<script>window.alert('Please select the files');
						  window.location.href='upload1.php';
							</script>";
         
    }

    $file = $_FILES["upfile"];
    if($max_file_size < $file["size"])
    //检查文件大小    check the size of the files
    {
        echo "<script>window.alert('Fail to upload');
						  window.location.href='upload1.php';
							</script>";
        
    }

    if(!in_array($file["type"], $uptypes))
    //检查文件类型   check the type of the files
    {
        echo "<script>window.alert('Please choose correct type of file : mp3,mp4, jpg,jpeg,png,pdf');
						  window.location.href='upload1.php';
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
    echo " <font color=red>This file has been uploaded successfully</font><br>The address is:  <font color=blue>".$destination_folder.$fname."</font><br>";
    echo "<br> Size:".$file["size"]." bytes";
	echo '<br>';
	//将数据插入到数据库中   put the data into database
	$address = "$destination_folder"."$fname";    
	$name = $file['name'];
	$size = $file["size"];
	
	$userid=$_SESSION['user_id'];
	
	$sql = "insert into upload(id,user_id,name,address,size) values ('NULL','$userid','$name','$address','$size')";
	mysql_query($sql);
	echo  "<script>window.alert('Successful!')</script>";
}
?>
<?php echo "<script>window.location.href='upload.php'</script>"   ?>
