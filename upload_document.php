<?php
// Incluir la conexión a la base de datos
include 'db_connection.php';

// Verificar si se subió un archivo
if (isset($_FILES['medical-document']) && $_FILES['medical-document']['error'] == 0) {
    $file_name = $_FILES['medical-document']['name'];
    $file_tmp = $_FILES['medical-document']['tmp_name'];

    // Definir la ruta donde se guardará el archivo
    $file_dest = 'uploads/' . $file_name;

    // Mover el archivo a la carpeta de destino
    if (move_uploaded_file($file_tmp, $file_dest)) {
        echo json_encode(['success' => 'Documento subido exitosamente']);
    } else {
        echo json_encode(['error' => 'Error al subir el documento']);
    }
} else {
    echo json_encode(['error' => 'No se recibió ningún documento']);
}
?>
