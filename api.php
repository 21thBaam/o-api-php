<?php
require '../logica/conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	echo "GET";
	
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	/*$sql = "INSERT INTO $_POST['dir'] (nombre, apellido) VALUES() ";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}*/
	echo "POST";
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
	echo "PUT";
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	echo "DELETE";
	exit();
}
?>
