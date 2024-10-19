<?php
// Incluir la conexión a la base de datos
include 'db_connection.php';

// Obtener las citas del paciente
$query_citas = "SELECT titulo, fecha, especialidad, doctor FROM citas WHERE id_paciente = 1";
$result_citas = $conn->query($query_citas);

$citas = [];
if ($result_citas->num_rows > 0) {
    while ($row = $result_citas->fetch_assoc()) {
        $citas[] = [
            'title' => $row['titulo'],
            'start' => $row['fecha'],
            'description' => 'Consulta de ' . $row['especialidad'],
            'extendedProps' => [
                'specialty' => $row['especialidad'],
                'doctor' => $row['doctor']
            ]
        ];
    }
}

echo json_encode($citas);

// Cerrar la conexión a la base de datos
$conn->close();
?>
