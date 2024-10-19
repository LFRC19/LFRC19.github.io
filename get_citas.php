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

// Consulta para obtener las citas
$sql = "SELECT p.nombre AS paciente, c.fecha, c.hora 
        FROM citas c
        JOIN pacientes p ON c.id_paciente = p.id
        ORDER BY c.fecha, c.hora";
$result = $conn->query($sql);

$citas = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

echo json_encode($citas);

$conn->close();
?>
