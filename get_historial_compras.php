<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediconnect";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener el historial de compras
$sql = "SELECT m.nombre AS medicamento, f.nombre AS farmacia, h.fecha_compra AS fecha 
        FROM historial_compras h
        JOIN medicamentos m ON h.id_medicamento = m.id
        JOIN farmacias f ON h.id_farmacia = f.id";
$result = $conn->query($sql);

$historial = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $historial[] = $row;
    }
}

echo json_encode($historial);

$conn->close();
?>
