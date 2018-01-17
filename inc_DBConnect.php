<?php

// connect and select MYySQL pizza database

$servername = "localhost";
$username = "root";
$password = "";
$DBConnection = mysqli_connect($servername, $username, $password);

if ($DBConnection === FALSE)
{
	$error = "<p>Unable to connect to the database server.</p>\n";
	echo $error;
	exit;
}
else
{
	//sucessful connection to dbms
	$DBName = "pizza";
	$TableName = "orders";
	//select db in dbms
	if (!mysqli_select_db($DBConnection,$DBName))
	{
		$error = "<p>Unable to select the $DBName database!</p>";
		echo $error;
		exit;
	}
	echo "DEBUG PRINT : Database connection established.<br>";
}

?>
