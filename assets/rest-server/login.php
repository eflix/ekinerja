<?php
include 'koneksi.php'; 

$username=$_POST['username'];
//$pass=md5($_POST['password']);

$cr=mysqli_query($konek,"select * from user 
where username='".$username."' ");
$bcr=mysqli_num_rows($cr);
if($bcr>0){
    $successlog='User ditemukan';
    //convert message into json
    $successjson=json_encode($successlog);
    echo $successjson;
}else{
    $invalidmsg="User tidak ditemukan";
    $invalidjson=json_encode($invalidmsg);
    echo $invalidjson;
}

>?