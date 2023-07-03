<?php  

 include 'koneksiDB.php';
 
 $id = substr($_POST['layanan'],0,strpos($_POST['layanan'],'-')-1);
 //$id = substr($_POST['layanan'],0,strpos($_POST['layanan'],'-')-1);
 
 $query = mysqli_query($koneksi,"select * from daftar_surat where ds_id = '$id'");
 echo $id;
 
 if(mysqli_num_rows($query) > 0){
	 
	 while ($row = mysqli_fetch_assoc($query)) {

		 $id = $row['ds_id'];
		 $kode = $row['ds_kode'];
		 $layanan = $row['ds_layanan'];
		 //echo $kode;
	 }	 
 }
 
 
 
 $nik = $_POST['nik'];
 $status = 'Diterima';
 $keterangan = $_POST['keterangan'];
 $created_dt = date('Y-m-d');
 $created_by = $_POST['nik'];
 
 //$nik = '12341234';
 //$keterangan = 'itjgkhkh';
 //$created_by = '12341234';
 
 //$layanan = '11 - Surat Keterangan KTP Dalam Proses';
 //$keterangan = 'Keterangan';
 

  $query1 = "insert into pengajuan_surat (ps_dp_nik,ps_status,ps_ds_id,ps_ds_kode,ps_ds_layanan,ps_keterangan,created_by) values ('$nik','$status','$id','$kode','$layanan','$keterangan',$created_by)";
 
 if(mysqli_query($koneksi,$query1)){
 
 echo 'Data Submit Successfully';
 }
 else{
 
 echo 'Try Again';
 
 }

?>