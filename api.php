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
	/*
	var_dump($data);
	echo "  :::  ";
	parse_str(file_get_contents("php://input"),$data2);
	var_dump($data2);*/
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$info = (parse_url($url, PHP_URL_QUERY));
	$data = json_encode(file_get_contents($info));
	var_dump($data);
	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
	var_dump($query);
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
