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
	$txt = "\n";
	$myfile = fopen("newfile.txt", "w+") or die("Unable to open file!");
	$post = file_get_contents('php://input');
	fwrite($myfile, $post);
	fwrite($myfile, $txt);
	parse_str($info, $get_array);
	fwrite($myfile, $get_array);
	fwrite($myfile, $txt);
	print_r($get_array);
	//print_r($get_array);
	//echo "Nombre: ",$get_array["nombre"],"Apellido: ",$get_array["apellido"];
	http_response_code(201);
	fclose($myfile);
	exit();
}
?>
