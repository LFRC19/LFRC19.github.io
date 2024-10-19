<?php
// Incluir la conexión a la base de datos
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos enviados desde AJAX
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $especialidad = $_POST['especialidad'];
    $doctor = $_POST['doctor'];

    // Verificar si es una cita nueva o edición
    if (isset($_POST['id'])) {
        // Actualizar una cita existente
        $id = $_POST['id'];
        $query_update = "UPDATE citas SET titulo = '$titulo', fecha = '$fecha', especialidad = '$especialidad', doctor = '$doctor' WHERE id = $id";
        if ($conn->query($query_update) === TRUE) {
            echo json_encode(['success' => 'Cita actualizada correctamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar la cita']);
        }
    } else {
        // Insertar una nueva cita
        $query_insert = "INSERT INTO citas (titulo, fecha, especialidad, doctor, id_paciente) VALUES ('$titulo', '$fecha', '$especialidad', '$doctor', 1)";
        if ($conn->query($query_insert) === TRUE) {
            echo json_encode(['success' => 'Cita agregada correctamente']);
        } else {
            echo json_encode(['error' => 'Error al agregar la cita']);
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
