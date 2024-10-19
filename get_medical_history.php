<?php
// Incluir la conexión a la base de datos
include 'db_connection.php';

// Preparar el array para almacenar los resultados
$data = [];

// Obtener las visitas médicas previas
$query_visitas = "SELECT doctor, especialidad, fecha_visita FROM visitas_medicas WHERE id_paciente = 1 ORDER BY fecha_visita DESC";
$result_visitas = $conn->query($query_visitas);
$visitas = [];
if ($result_visitas->num_rows > 0) {
    while ($row = $result_visitas->fetch_assoc()) {
        $visitas[] = $row;
    }
}

// Obtener los resultados de exámenes y diagnósticos
$query_resultados = "SELECT examen, fecha_examen, resultado FROM examenes WHERE id_paciente = 1 ORDER BY fecha_examen DESC";
$result_resultados = $conn->query($query_resultados);
$resultados = [];
if ($result_resultados->num_rows > 0) {
    while ($row = $result_resultados->fetch_assoc()) {
        $resultados[] = $row;
    }
}

// Obtener la información de alergias y condiciones crónicas
$query_condiciones = "SELECT nombre_condicion FROM condiciones WHERE id_paciente = 1";
$result_condiciones = $conn->query($query_condiciones);
$condiciones = [];
if ($result_condiciones->num_rows > 0) {
    while ($row = $result_condiciones->fetch_assoc()) {
        $condiciones[] = $row;
    }
}

// Guardar todos los datos en el array $data
$data['visitas'] = $visitas;
$data['resultados'] = $resultados;
$data['condiciones'] = $condiciones;

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión a la base de datos
$conn->close();
?>
