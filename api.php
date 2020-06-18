<?php
require '../logica/conexion.php';

$sql = "INSERT INTO ventas () VALUES() ";
if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>