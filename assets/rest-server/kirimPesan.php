<?php  

 include 'koneksiDB.php';
 
 $content = $_POST['content'];
 $username = $_POST['nik'];
 $recipient = 'admin';
 
 //$layanan = '11 - Surat Keterangan KTP Dalam Proses';
 //$keterangan = 'Keterangan';
 

  $query = "insert into user_chat_messages (message_content,username,recipient) values ('$content','$username','$recipient')";
 
 if(mysqli_query($koneksi,$query)){
 
 echo 'Data Submit Successfully';
 }
 else{
 
 echo 'Try Again';
 
 }

?>