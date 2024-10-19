<?php
// Incluir la conexión a la base de datos
include 'db_connection.php';

// Obtener los datos del usuario con id_usuario = 1 (o el usuario logueado)
$query_user = "SELECT nombre, fecha_nacimiento, genero, correo, telefono, direccion, aseguradora, numero_poliza, fecha_vencimiento FROM usuarios WHERE id_usuario = 1";
$result_user = $conn->query($query_user);

if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
    echo json_encode($user_data);  // Devolver los datos en formato JSON
} else {
    echo json_encode(['error' => 'No se encontraron datos para este usuario']);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
