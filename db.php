<?php

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'reciclaje_db';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8mb4');
?>
