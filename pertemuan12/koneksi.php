<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'pendaftaran_siswa';

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
?>