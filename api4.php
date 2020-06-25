<?php
require 'conexion.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$post = file_get_contents('php://input');
	$get_array = json_decode($post, true);
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = "\n";
	fwrite($myfile, $post);
	fwrite($myfile, $txt);
	fwrite($myfile, $get_array["nombre"]);
	fwrite($myfile, $txt);
	fwrite($myfile, $get_array["apellido"]);
	fwrite($myfile, $txt);
	
	$sql = "INSERT INTO prueba SET nombre='$get_array[nombre]', apellido='$get_array[apellido]' ";
	if (mysqli_query($conn,$sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	exit();
}
?>
