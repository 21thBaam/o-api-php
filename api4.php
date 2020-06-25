<?php
require 'conexion.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$info = (parse_url($url, PHP_URL_QUERY));
	parse_str($info, $get_array);
	//print_r($get_array);
	//echo "Nombre: ",$get_array["nombre"],"Apellido: ",$get_array["apellido"];
	$sql = "INSERT INTO prueba SET nombre='$get_array[nombre]' apellido='$get_array[apellido]' ";
	if (mysqli_query($conn,$sql) === TRUE) {
		echo "New record created successfully";
		$result->status = "success";
		$result->message = "User Added";
		http_response_code(201);
		print json_encode($result);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		$result->status = "failed";
		$result->message = "User Not Added";
		http_response_code(500);
		print json_encode($result);
	}
	exit();
}
?>
