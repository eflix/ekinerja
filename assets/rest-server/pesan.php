<?php  

 include 'koneksiDB.php';
 
 $username = $_GET['nik'];
 
 $query = mysqli_query($koneksi,"select * from (select id,message_content as pesan1,'' as pesan2,username,message_time,recipient from user_chat_messages where username = ".$username." and recipient = 'admin' union all
											select id,'',message_content,username,message_time,recipient from user_chat_messages
											where username = 'admin' and recipient = ".$username."
											) pesan
											order by message_time asc");
	
	 $response = array();

 if(mysqli_num_rows($query) > 0){
	 
	 while ($row = mysqli_fetch_array($query)) {

		// echo $row['pesan1'].$row['pesan2'].'<br>';
		 array_push($response, array("id"=>$row['id'],"pesan1"=>$row['pesan1'],"pesan2"=>$row['pesan2'],"username"=>$row['username'],"message_time"=>$row['message_time'],"recipient"=>$row['recipient']));
		 //$kode = $row['ds_kode'];
		 //$layanan = $row['ds_layanan'];
		 //echo $kode;
	 }	 
	  echo json_encode(array("semuapesan"=>$response));
 }

?>