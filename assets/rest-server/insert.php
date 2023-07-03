<?php
include 'koneksi.php'; 
 
 $name = $_POST['name'];
 $email = $_POST['email'];

 $Sql_Query = "insert into user (name,email) values ('$name','$email')";
 
 if(mysqli_query($konek,$Sql_Query)){
 
 echo 'Data Submit Successfully';
 echo $name;
 
 }
 else{
 
 echo 'Try Again';
 
 }
 mysqli_close($con);
?>