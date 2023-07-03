<?php  

 include 'koneksi.php'; 

 $hasil         = mysql_query("SELECT * FROM tbl_dosen") or die(mysql_error());

 $response = array();

 

if(mysql_num_rows($hasil)> 0){

 while ($row = mysql_fetch_array($hasil)) {
     //$response[] = $row;
	 array_push($response, array("nama"=>$row['nama'],"id"=>$row['id'],"matkul"=>$row['matkul']));
 }

 echo json_encode(array("semuadosen"=>$response));

} 

?>