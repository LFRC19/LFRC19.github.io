<?php
// Incluir la conexión a la base de datos
include 'db_connection.php';

// Preparar el array para almacenar los resultados
$data = [];

// Obtener las próximas citas del paciente
$query_citas = "SELECT fecha_cita, hora_cita, estado FROM citas WHERE id_paciente = 1 ORDER BY fecha_cita ASC LIMIT 5";
$result_citas = $conn->query($query_citas);
$citas = [];
if ($result_citas->num_rows > 0) {
    while ($row = $result_citas->fetch_assoc()) {
        $citas[] = $row;
    }
}

// Obtener las notificaciones del usuario
$query_notificaciones = "SELECT mensaje, fecha_notificacion FROM notificaciones WHERE id_usuario = 1 ORDER BY fecha_notificacion DESC LIMIT 5";
$result_notificaciones = $conn->query($query_notificaciones);
$notificaciones = [];
if ($result_notificaciones->num_rows > 0) {
    while ($row = $result_notificaciones->fetch_assoc()) {
        $notificaciones[] = $row;
    }
}

// Guardar citas y notificaciones en el array $data
$data['citas'] = $citas;
$data['notificaciones'] = $notificaciones;

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión a la base de datos
$conn->close();
?>

