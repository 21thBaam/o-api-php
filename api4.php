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
	$myfile = fopen("newfile.txt", "w+") or die("Unable to open file!");
	$txt = "\n";
	$post = file_get_contents('php://input');
	fwrite($myfile, $post);
	fwrite($myfile, $txt);
	$get_array = json_decode($post,true);
	fwrite($myfile, $get_array["nombre"]);
	fwrite($myfile, $txt);
	fwrite($myfile, $get_array["apellido"]);
	http_response_code(201);
	exit();
}
?>
