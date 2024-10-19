<?php

// Conexión a la base de datos

$host = 'localhost';
$dbname = 'mediconnect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener las recetas actuales
    $stmtActuales = $pdo->prepare("SELECT medicamento, dosis, duracion, doctor, fecha_prescripcion FROM recetas WHERE estado = 'actual'");
    $stmtActuales->execute();
    $recetasActuales = $stmtActuales->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener las recetas pasadas
    $stmtPasadas = $pdo->prepare("SELECT medicamento, dosis, duracion, doctor, fecha_prescripcion FROM recetas WHERE estado = 'pasada'");
    $stmtPasadas->execute();
    $recetasPasadas = $stmtPasadas->fetchAll(PDO::FETCH_ASSOC);

    // Respuesta en formato JSON
    echo json_encode([
        'actuales' => $recetasActuales,
        'pasadas' => $recetasPasadas
    ]);
    
} catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
}
?>
