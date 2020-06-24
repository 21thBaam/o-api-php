<?php
require 'conexion.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sth = mysqli_query($conn,"SELECT * FROM usuario");
	$rows = array();
	while($r = mysqli_fetch_assoc($sth)) {
		//echo "id: " . $r["id"]. " - Name: " . $r["nombre"]. " " . $r["apellido"]. "<br>";
		$rows[] = array_merge($r);
	}
	print json_encode($rows);
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$info = (parse_url($url, PHP_URL_QUERY));
	parse_str($info, $get_array);
	//print_r($get_array);
	echo "Nombre: ",$get_array["nombre"],"Apellido: ",$get_array["apellido"];
	//$sql = "INSERT INTO prueba SET nombre = '$get_array[nombre]', apellido = '$get_array[apellido]';
	$sql = "INSERT INTO prueba SET nombre = 1, apellido = 2;
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		$result->status = "success";
		$result->message = "User Added";
		print json_encode($result);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		$result->status = "failed";
		$result->message = "User Not Added";
		print json_encode($result);
	}
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
	echo "PUT";
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	//echo "DELETE";
	//parse_str(file_get_contents("php://input"),$data);
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$ok = parse_url($actual_link, PHP_URL_PATH);
	$urlParameter = str_replace("/api.php/", "", $ok);
	$sql = "DELETE FROM usuario WHERE idUsuario = '$urlParameter' ";
	if($conn->query($sql) === TRUE){
		$result->status = "success";
		$result->message = "User Deleted";
		print json_encode($result);
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
		$result->status = "failed";
		$result->message = "User Not Deleted";
		print json_encode($result);
	}
	exit();
}
?>
