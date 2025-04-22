<?php

// ATENCION! Este es el archivo para hacer el INSERT de los datos en la base de datos de las citas agendadas
// Disculpen el quilombo de archivos sueltos jaja

require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $motivo_cita = $_POST['motivoCita'] ?? '';
    $fecha_cita = $_POST['horaCita'] ?? '';
    $hora_cita = $_POST['hora'] ?? '';

    if (!empty($motivo_cita) && !empty($fecha_cita) && !empty($hora_cita)) {
        try {
            // Preparar la consulta SQL
            $stmt = $conn->prepare("INSERT INTO citas (motivo_cita, fecha_cita, hora_cita) 
                                   VALUES (:motivo_cita, :fecha_cita, :hora_cita)");

            // Bind parameters
            $stmt->bindParam(':motivo_cita', $motivo_cita);
            $stmt->bindParam(':fecha_cita', $fecha_cita);
            $stmt->bindParam(':hora_cita', $hora_cita);

            // Ejecutar la consulta
            $stmt->execute();

            // Redirigir a página de confirmación
            header('Location: confirmacion_cita.php');
            exit();
        } catch (PDOException $e) {
            echo "Error al agendar la cita: " . $e->getMessage();
        }
    } else {
        echo "Por favor, complete todos los campos del formulario.";
    }
} else {
    header('Location: formulario_cita.php');
    exit();
}
