<html>
<body>
<?php
        
    $conn = mysql_connect('localhost','root','');
    mysql_set_charset('utf8',$conn);
    mysql_select_db('mediavault');

     $fileid = $_GET['id'];
     $sql = "select * from upload where ='" . $fileid . "'";  
     $result = mysql_query($sql);
     

     
 
    if(!mysql_num_rows($result){

        echo "<script>window.alert('No files are found') </script>";

    }  

    while($row=mysql_fetch_array($result,MYSQL_ASSOC)){

        $filesize=filesize($row['address']);
        $filename=$row['name'];
        $fileaddress=$row['address'];

        Header("Content-type:text/html;charset=utf-8");
        Header("Content-Description : File Transfer");
        Header("Content-type: application/octet-stream"); 
        Header("Content-Disposition: attachment; filename=".$filename); 
        Header("Accept-Ranges: bytes"); 
        Header("Accept-Length:".$filesize);
        ob_clean();
        readfile($row['address']);


    }


    
 ?>
 </body>
 </html>


