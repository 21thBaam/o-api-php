<?php
require 'conexion.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	/*$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	fwrite($myfile, $url);
	fwrite($myfile, $txt);
	$info = (parse_url($url, PHP_URL_QUERY));
	fwrite($myfile, $info);
	fwrite($myfile, $txt);*/
	$post = file_get_contents('php://input');
	var_dump($post);
	echo typeof($post);
	var_dump(json_decode($post));
	$get_array = json_decode($post,true);
	var_dump($get_array);
	echo "Nombre: ",$get_array["nombre"],"Apellido: ",$get_array["apellido"];
	http_response_code(201);
	exit();
}
?>
