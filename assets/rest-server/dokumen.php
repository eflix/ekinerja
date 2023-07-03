<?php  

 include 'koneksiDB.php';  
 
 //$nik = '21474836';
 $nik = $_POST['nik'];

 $hasil = mysqli_query($koneksi,"SELECT * from data_dokumen where dd_dp_nik = '".$nik."'");

 $response = array(); 

if(mysqli_num_rows($hasil)> 0){

 while ($row = mysqli_fetch_array($hasil)) {
     array_push($response, array("dd_id"=>$row['dd_id'],"dd_jenis"=>$row['dd_jenis'],"dd_dokumen"=>$row['dd_dokumen']));
 }

 echo json_encode(array("dokumen"=>$response));

} 

?>