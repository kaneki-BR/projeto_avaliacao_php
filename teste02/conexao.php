<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "bd_titan";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
