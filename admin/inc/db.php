<?php

	session_start();
	
	$host 	= "localhost";
	$user 	= "root";
	$pass 	= "";
	$dbname	= "ssv438project";


	// To connect a Database with the Project
	$db = mysqli_connect($host, $user, $pass, $dbname);

	if ( $db ){
		//echo "Database Connected Successfully with our Project";
	}
	else{
		die("Opps!!! Somehow the Database faild. " . mysqli_error($db) );
	}

?>