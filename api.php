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
	$sql = "INSERT INTO usuario SET 
	idTipoUsuario='$get_array[idTipoUsuario]', idEstatus='$get_array[idEstatus]', numeroTrabajador='$get_array[numeroTrabajador]', nombre='$get_array[nombre]', 
	apellidoPaterno='$get_array[apellidoPaterno]', apellidoMaterno='$get_array[apellidoMaterno]', usuario='$get_array[usuario]', numeroOficina='$get_array[numeroOficina]', 
	telefonoOficina='$get_array[telefonoOficina]', telefonoCasa='$get_array[telefonoCasa]', extension='$get_array[extension]', movil1='$get_array[movil1]', movil2='$get_array[movil2]', 
	correo='$get_array[correo]'
	";
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
	$sql = "UPDATE usuario SET 
	idTipoUsuario='$get_array[idTipoUsuario]', idEstatus='$get_array[idEstatus]', numeroTrabajador='$get_array[numeroTrabajador]', nombre='$get_array[nombre]', 
	apellidoPaterno='$get_array[apellidoPaterno]', apellidoMaterno='$get_array[apellidoMaterno]', usuario='$get_array[usuario]', numeroOficina='$get_array[numeroOficina]', 
	telefonoOficina='$get_array[telefonoOficina]', telefonoCasa='$get_array[telefonoCasa]', extension='$get_array[extension]', movil1='$get_array[movil1]', movil2='$get_array[movil2]', 
	correo='$get_array[correo]' WHERE idUsuario='$urlParameter'
	";
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
	$sql = "DELETE FROM usuario WHERE idUsuario = '$urlParameter' ";
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
