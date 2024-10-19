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

// Consulta para obtener los chats con los pacientes
$sql = "SELECT p.nombre AS paciente 
        FROM pacientes p 
        JOIN comunicacion c ON p.id = c.id_paciente";
$result = $conn->query($sql);

$comunicacion = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $comunicacion[] = $row;
    }
}

echo json_encode($comunicacion);

$conn->close();
?>
