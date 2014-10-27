<?php 
	

$currency = '$';
$db_username = 'a5846718_cartuse';
$db_password = 'linbro11';
$db_name = 'a5846718_cart';
$db_host = 'mysql7.000webhost.com';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);

$connection = mysqli_connect($db_host,$db_username,$db_password,$db_name);

	if (mysqli_connect_errno()) {
		die ("Database Connection Failed" . 
			mysqli_connect_errno() . 
			" (" . mysqli_connect_errno() . ")"

		);
	}

?>