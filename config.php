<?php

$host = "localhost";
$dbname = "user_auth";
$username = "root";
$password = "";

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Error conectando a la base de datos: " . $connection->connect_error);
}

?>