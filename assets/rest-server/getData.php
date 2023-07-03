<?php  
 include 'koneksiDB.php'; 
 $hasil         = mysqli_query($koneksi,"SELECT * FROM user");
 $json_response = array();
 
if(mysqli_num_rows($hasil)> 0){
 while ($row = mysqli_fetch_array($hasil)) {
     $json_response[] = $row;
 }
 echo json_encode(array('user' => $json_response));
} 
?>