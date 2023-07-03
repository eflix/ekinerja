<?php

include 'koneksiDB.php'; 

	$nik = $_POST['nik'];
	$jenis = $_POST['jenis'];
	$dokumen = $_POST['dokumen'];
	//echo $nik;
	
	if((file_exists('./../dokumen/'.$nik))&&(is_dir('./../dokumen/'.$nik))) { 
		 } else { 
		 	//mkdir('http://aldae.ga/spsd/assets/dokumen/'.$nik);
		 	mkdir('./../dokumen/'.$nik);
		}
	
	mysqli_query($koneksi,"insert into data_dokumen (dd_dp_nik,dd_jenis,dd_dokumen) values ('$nik','$jenis','$dokumen')");
	//mysqli_query($koneksi,"insert into data_dokumen (dd_dp_nik,dd_jenis,dd_dokumen) values ('1','2','3')");
	
	$part = './../dokumen/'.$nik.'/';
	//$filename = "coba".rand(9,9999).".pdf";
	$filename = $dokumen;

	//mysqli_query($koneksi,"update user set image = '".$filename."' where username = '".$nik."'");
	
	$res = array(); 
	$kode = ""; 
	$pesan = ""; 


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_FILES['imageupload'])
		{
			$destinationfile = $part.$filename;
			if(move_uploaded_file($_FILES['imageupload']['tmp_name'], $destinationfile))
			{
				$kode = 1; 
				$pesan = "Berhasil Upload";
			}else
			{
				$kode = 0; 
				$pesan = "Gagal Upload";
			}
		}else{
			$kode = 0; 
			$pesan = "request error";
		}
	}else
	{
		$kode = 0; 
		$pesan = "Request tidak valid";
	}
	
	//echo $destinationfile;
	//echo ['imageupload']['tmp_name'];
	
	//$res['dest'] = $destinationfile;
	$res['kode'] = $_POST['nik']; 
	$res['pesan'] = $pesan;

	 //$res['user']['kode'] = $kode;
	 //$res['user']['pesan'] = $pesan;	

	echo json_encode($res);
	

 ?>