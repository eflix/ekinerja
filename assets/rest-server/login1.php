<?php  
 include 'koneksiDB.php'; 
 
 $username = $_POST['email'];
 $password = md5($_POST['password']);
 
 //$username = '09090909';
 //$password = md5('1234');
 
 //$username = '5372726';
 //$password = '188';

 $hasil  = mysqli_query($koneksi,"SELECT * FROM user where username = '".$username."' and password = '".$password."'");
 
 //$hasil  = mysql_query("SELECT * FROM user where username = '5372726' and password = '188'") or die(mysql_error());
 
 $response = array();

 

if(mysqli_num_rows($hasil)> 0){

 while ($row = mysqli_fetch_assoc($hasil)) {

	//echo $row['username'];
     $response['user']['nama'] = $row['name'];
	 $response['user']['username'] = $row['username'];
	 $response['user']['image'] = $row['image'];

 }

 echo json_encode($response);

} 

?>