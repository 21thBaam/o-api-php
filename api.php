<?php
require 'conexion.php';

header("HTTP/1.1 200 OK");

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $sql = "SELECT * FROM prueba";
    $result = mysqli_query($conn, $sql);
    $iteraciones=0;

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $resultado[$iteraciones] = array_merge($row);
            $iteraciones++;
        }
    } else {
        echo "0 results";
        $resultado = 0;
    }
    mysqli_close($conn);

    var_dump($resultado);
	/*
	$sth = mysqli_query("SELECT * FROM prueba");
	$rows = array();
	$iteraciones=0;
	$resultado[$iteraciones] = array_merge($row);
    $iteraciones++;
	while($r = mysqli_fetch_assoc($sth)) {
		echo "id: " . $r["id"]. " - Name: " . $r["nombre"]. " " . $r["apellido"]. "<br>";
		$rows[] = array_merge($r);
		$resultado[$iteraciones] = array_merge($row);
		$iteraciones++;
	}
	print json_encode($rows);
	var_dump($rows);
	
	echo "---------------";
	
	var_dump($resultado);*/
	
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$sql = "INSERT INTO prueba (nombre, apellido) VALUES('$_POST[nombre]', '$_POST[apellido]') ";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
	echo "PUT";
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
	echo "DELETE";
	exit();
}
?>
