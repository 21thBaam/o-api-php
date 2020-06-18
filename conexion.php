<?php
    $servername = "iwqrvsv8e5fz4uni.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "el0gnvg0jiqbftm3";
    $password = "xb76s2sub1phyj7q";
    $dbname = "dspnarlgltkkzpxo";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
    echo "Conectado";
?>
