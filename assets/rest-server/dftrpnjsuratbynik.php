<?php  

 include 'koneksiDB.php'; 
 
 $nik = $_GET['nik'];
 //$nik = '987654321';
 

 $hasil = mysqli_query($koneksi,"SELECT * FROM pengajuan_surat where ps_dp_nik = '".$nik."'");
 //$hasil = mysql_query("SELECT * FROM pengajuan_surat") or die(mysql_error());

 $response = array();

 

if(mysqli_num_rows($hasil)> 0){

 while ($row = mysqli_fetch_array($hasil)) {
     //$response[] = $row;
	 array_push($response, array("ps_id"=>$row['ps_id'],"ps_dp_nik"=>$row['ps_dp_nik'],"ps_ds_layanan"=>$row['ps_ds_layanan'],"ps_ds_kode"=>$row['ps_ds_kode'],"ps_keterangan"=>$row['ps_keterangan'],"ps_status"=>$row['ps_status']));
 }

 echo json_encode(array("semuasurat"=>$response));

} 

?>