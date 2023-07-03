<?php  

 include 'koneksiDB.php';  

 $hasil = mysqli_query($koneksi,"SELECT distinct ds_id,ds_layanan FROM daftar_surat");

 $response = array(); 

if(mysqli_num_rows($hasil)> 0){

 while ($row = mysqli_fetch_array($hasil)) {
     array_push($response, array("ds_layanan"=>$row['ds_id'] . ' - ' . $row['ds_layanan']));
 }

 echo json_encode(array("layanansurat"=>$response));

} 

?>