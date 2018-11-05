<?php
//This file contains the specific database configuration information. Edit as per requirements
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'projecttender');
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if(!$conn){
	echo "Unable to connect to database. Please try again later";
}
?>
