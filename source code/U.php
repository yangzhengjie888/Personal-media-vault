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
    'image/x-png'
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
  上传文件:
  <input name="upfile" type="file">
  <input type="submit" value="上传"><br>
  允许上传的文件类型为:<?php echo implode(',',$uptypes)?>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
    //是否存在文件
    {
         echo "您还没有选择文件!";
         exit;
    }

    $file = $_FILES["upfile"];
    if($max_file_size < $file["size"])
    //检查文件大小
    {
        echo "您选择的文件太大了!";
        exit;
    }

    if(!in_array($file["type"], $uptypes))
    //检查文件类型
    {
        echo "文件类型不符!".$file["type"];
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
        echo "同名文件已经存在了";
        exit;
    }

    if(!move_uploaded_file ($filename, $destination))
    {
        echo "移动文件出错";
        exit;
    }

    $pinfo=pathinfo($destination);
    $fname=$pinfo['basename'];
    echo " <font color=red>已经成功上传</font><br>完整地址:  <font color=blue>http://localhost/new/".$destination_folder.$fname."</font><br>";
    echo "<br> 大小:".$file["size"]." bytes";
	echo '<br>';
	//将数据插入到数据库中
	$dizhi = "http://localhost/new/"."$destination_folder"."$fname";
	$name = $file['name'];
	 $sql = "insert into upload(id,name,address) values ('NULL','$name','$address')";
	 mysql_query($sql);
	 echo  "数据插入成功";
}

?>
</body>

