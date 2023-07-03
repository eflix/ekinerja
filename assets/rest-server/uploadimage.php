<?php

include 'koneksiDB.php'; 

	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	//echo $nik;
	
	//mysqli_query($koneksi,"update user set image = '".$nik."' where username = 'admin'");
	
	$part = "./../img/profile/";
	//$filename = "img".rand(9,9999).".jpg";
	$filename = $nama."_".$nik.".jpg";

	mysqli_query($koneksi,"update user set image = '".$filename."' where username = '".$nik."'");
	
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

	echo json_encode($res);
	

 ?>