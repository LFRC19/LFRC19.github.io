<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'mediconnect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener las farmacias
    $stmt = $pdo->prepare("SELECT nombre, direccion, telefono FROM farmacias");
    $stmt->execute();
    $farmacias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Respuesta en formato JSON
    echo json_encode($farmacias);
    
} catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
}
?>
