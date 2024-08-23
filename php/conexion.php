<?php

$mysqli = new $mysqli("localhost", "user", "password", "database");

// Verifcamos la conexion
if($mysqli->connect_error){
    die("Error de conexion: " . $mysqli->connect_error);
}

?>