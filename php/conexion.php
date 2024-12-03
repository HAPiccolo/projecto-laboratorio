<?php

$host = "localhost";
$user = "root";
$password = "noxon";
$database = "sanatorio";

$mysqli = new mysqli($host, $user, $password, $database);

// Verifcamos la conexion
if ($mysqli->connect_error) {
    die("Error de conexion: " . $mysqli->connect_error);
}
