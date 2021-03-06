<?php
require 'conexion.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sth = mysqli_query($conn,"CALL getUsers");
	$rows = array();
	while($r = mysqli_fetch_assoc($sth)) {
		//echo "id: " . $r["id"]. " - Name: " . $r["nombre"]. " " . $r["apellido"]. "<br>";
		$rows[] = array_merge($r);
	}
	print json_encode($rows);
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	/*$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$info = (parse_url($url, PHP_URL_QUERY));
	parse_str($info, $get_array);
	//print_r($get_array);
	//echo "Nombre: ",$get_array["nombre"],"Apellido: ",$get_array["apellido"];*/
	$post = file_get_contents('php://input');
	$get_array = json_decode($post, true);
	$sql = "CALL addUser('$get_array[idTipoUsuario]', '$get_array[idEstatus]', '$get_array[numeroTrabajador]', '$get_array[nombre]', '$get_array[apellidoPaterno]', '$get_array[apellidoMaterno]',
	'$get_array[usuario]', '$get_array[numeroOficina]', '$get_array[telefonoOficina]', '$get_array[telefonoCasa]', '$get_array[extension]', '$get_array[movil1]', '$get_array[movil2]', '$get_array[correo]')";
	if (mysqli_query($conn,$sql) === TRUE) {
		$result->status = "success";
		$result->message = "User Added";
		http_response_code(201);
		print json_encode($result);
	} else {
		$result->status = "failed";
		$result->message = "User Not Added";
		http_response_code(500);
		print json_encode($result);
	}
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$ok = parse_url($actual_link, PHP_URL_PATH);
	$urlParameter = str_replace("/api.php/", "", $ok);
	
	$post = file_get_contents('php://input');
	$get_array = json_decode($post, true);
	$sql = "CALL editUser('$get_array[idTipoUsuario]', '$get_array[idEstatus]', '$get_array[numeroTrabajador]', '$get_array[nombre]', '$get_array[apellidoPaterno]', '$get_array[apellidoMaterno]',
	'$get_array[usuario]', '$get_array[numeroOficina]', '$get_array[telefonoOficina]', '$get_array[telefonoCasa]', '$get_array[extension]', '$get_array[movil1]', '$get_array[movil2]', '$get_array[correo]', '$urlParameter')";
	if (mysqli_query($conn,$sql) === TRUE) {
		$result->status = "success";
		$result->message = "User Updated";
		http_response_code(201);
		print json_encode($result);
	} else {
		$result->status = "failed";
		$result->message = "User Not Updated";
		http_response_code(500);
		print json_encode($result);
	}
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	//echo "DELETE";
	//parse_str(file_get_contents("php://input"),$data);
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$ok = parse_url($actual_link, PHP_URL_PATH);
	$urlParameter = str_replace("/api.php/", "", $ok);
	$sql = "CALL deleteUser('$urlParameter')";
	if($conn->query($sql) === TRUE){
		$result->status = "success";
		$result->message = "User Deleted";
		print json_encode($result);
	}else{
		$result->status = "failed";
		$result->message = "User Not Deleted";
		print json_encode($result);
	}
	exit();
}
?>
