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

// Obtener los datos del mensaje enviado
$sender = $_POST['sender'];
$message = $_POST['message'];
$timestamp = date('Y-m-d H:i:s');

// Insertar el mensaje en la base de datos
$sql = "INSERT INTO mensajes (sender, message, timestamp) VALUES ('$sender', '$message', '$timestamp')";

if ($conn->query($sql) === TRUE) {
    echo "Mensaje enviado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
