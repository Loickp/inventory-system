<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'loick', 'test1234', 'inventory_system');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>