<?php
require 'conexion.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sth = mysqli_query($conn,"SELECT * FROM estatus");
	$rows = array();
	while($r = mysqli_fetch_assoc($sth)) {
		$rows[] = array_merge($r);
	}
	print json_encode($rows);
	exit();
}

/*if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$sql = "INSERT INTO prueba (nombre, apellido) VALUES('$_POST[nombre]', '$_POST[apellido]') ";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
	echo "PUT";
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	echo "DELETE";
	exit();
}*/
?>