<?php
function conectarBD()
{
    $host = 'localhost';
    $db = 'proyecto_sab';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        return new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
    } catch (\PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
function conectarBD_MySQLi()
{
    $host = 'localhost';
    $db   = 'proyecto_sab';
    $user = 'root';
    $pass = '';
    
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Conexión MySQLi fallida: " . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');

    return $conn;
}
