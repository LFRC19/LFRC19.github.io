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

// Consulta para obtener las notificaciones de disponibilidad de medicamentos
$sql = "SELECT m.nombre AS medicamento, n.estado, f.nombre AS farmacia 
        FROM notificaciones_medicamentos n
        JOIN medicamentos m ON n.id_medicamento = m.id
        JOIN farmacias f ON n.id_farmacia = f.id";
$result = $conn->query($sql);

$notificaciones = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notificaciones[] = $row;
    }
}

echo json_encode($notificaciones);

$conn->close();
?>
