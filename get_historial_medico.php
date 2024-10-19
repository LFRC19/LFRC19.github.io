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

// Consulta para obtener el historial médico
$sql = "SELECT p.nombre AS paciente, c.fecha, c.diagnostico 
        FROM consultas c
        JOIN pacientes p ON c.id_paciente = p.id
        ORDER BY c.fecha DESC";
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
