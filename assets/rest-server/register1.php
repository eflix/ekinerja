<?php
include 'koneksiDB.php';

 // akun login (user)
 $name = $_POST['nama'];
 $email = '';
 $username = $_POST['nik'];
 $password = md5($_POST['password']);
 
 
 // data penduduk (data_penduduk)
$nik = $_POST['nik']; 
$noKK = $_POST['nokk'];
$gender = $_POST['gender'];
$tmptLhr = $_POST['tmptLhr'];
$tglLahir = $_POST['tglLhr'];
$alamat = $_POST['alamat'];
$rt = $_POST['rt'];
$rw = $_POST['rw'];
$desa = $_POST['desa'];
$kelurahan = $_POST['kelurahan'];
$kecamatan = $_POST['kecamatan'];
$kabupaten = $_POST['kabupaten'];
$provinsi = $_POST['provinsi'];
$agama = $_POST['agama'];
$status = $_POST['status'];
$pekerjaan = $_POST['pekerjaan'];
$warga = $_POST['warga'];
$created_dt = date('Y-m-d');

// insert akun untuk login
 $query = "insert into user (name,email,username,password) values ('$name','$email','$username','$password')"; 
if(mysqli_query($koneksi,$query)){
 
 echo 'Data Submit Successfully';
 
 }
 else{
 
 echo 'Try Again';
 
 } 
	
// insert data penduduk
 $query = "insert into data_penduduk (dp_nik,dp_no_kk,dp_nama,dp_gender,dp_tempat_lahir,dp_tanggal_lahir,dp_alamat,dp_rt,dp_rw,dp_desa,dp_kelurahan,dp_kecamatan,dp_kabupaten,dp_provinsi,dp_agama,dp_status_perkawinan,dp_pekerjaan,dp_kewarganegaraan,created_dt,created_by) values 
 ('$nik','$noKK','$name','$gender','$tmptLhr','$tglLahir','$alamat','$rt','$rw','$desa','$kelurahan','$kecamatan','$kabupaten','$provinsi','$agama','$status','$pekerjaan','$warga','$created_dt','$name')";
 if(mysqli_query($koneksi,$query)){
 
 echo 'Data Submit Successfully';
 
 }
 else{
 
 echo 'Try Again';
 
 } 
 
 // folder untuk dokumen
		if((file_exists('./../dokumen/'.$nik))&&(is_dir('./../dokumen/'.$nik))) { 
		 } else { 
		 	mkdir('./../dokumen/'.$nik);
		}
 
?>