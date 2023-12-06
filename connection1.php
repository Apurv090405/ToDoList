<?php

$conn = "";

try {
	$servername = "localhost";
	$dbname = "todo_list";
	$username = "root";
	$password = "";

	$conn = new PDO(
		"mysql:host=$servername; dbname=todo_list",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Sorry, Connection failed: " . $e->getMessage();
}

?>
