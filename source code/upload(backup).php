<?php
/******************************************************************************

参数说明:
$max_file_size  : 上传文件大小限制, 单位BYTE
$destination_folder : 上传文件路径

******************************************************************************/
  include "conn.php";
//上传文件类型列表
$uptypes=array(
    'image/jpg',
    'image/jpeg',
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'application/pdf',
	'application/msword',
	'application/kswps'
    //'image/x-png'
);

$max_file_size=2000000;     //上传文件大小限制, 单位BYTE
$destination_folder="images/"; //上传文件路径
?>
<html>
<head>
<title>文件上传程序</title>
<style type="text/css">
<!--
body
{
     font-size: 9pt;
}
input
{
     background-color: #66CCFF;
     border: 1px inset #CCCCCC;
}
-->
</style>
</head>

<body>
<form enctype="multipart/form-data" method="post" name="upform">
  upload files:
  <input name="upfile" type="file">
  <input type="submit" value="上传"><br>
  These kinds of files were supported :<?php echo implode(',',$uptypes)?>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
    //是否存在文件
    {
         echo "Please select the files!";
         exit;
    }

    $file = $_FILES["upfile"];
    if($max_file_size < $file["size"])
    //检查文件大小
    {
        echo "Fail! The file is too large!";
        exit;
    }

    if(!in_array($file["type"], $uptypes))
    //检查文件类型
    {
        echo "This type of file is not supported!".$file["type"];
        exit;
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
        exit;
    }

    if(!move_uploaded_file ($filename, $destination))
    {
        echo "Fail to move the file";
        exit;
    }

    $pinfo=pathinfo($destination);
    $fname=$pinfo['basename'];
    echo " <font color=red>has been uploaded successfully</font><br>The address is:  <font color=blue>http://localhost/new/".$destination_folder.$fname."</font><br>";
    echo "<br> Size:".$file["size"]." bytes";
	echo '<br>';
	//将数据插入到数据库中
	$dizhi = "http://localhost/i"."$destination_folder"."$fname";
	$name = $file['name'];
	 $sql = "insert into upload(id,name,address) values ('NULL','$name','$dizhi')";
	 mysql_query($sql);
	 echo  "Successful!";
}

?>
</body>

