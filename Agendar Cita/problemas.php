

<?php
// ATENCION!: ESTE ARCHIVO ES PARA HACER EL INSERT OSEA AGREGAR LOS DATOS DEL problemaCita.php 
// a la base de datos para que no se confundan


// Incluir el archivo de conexión
require 'conexion2.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del textarea
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO problemas (descripcion) VALUES ('$descripcion')";
    
    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Problema registrado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
    
    // Cerrar conexión
    $conexion->close();
    
    // Redireccionar después de 2 segundos
    header("refresh:2; url=problemas.html");
} else {
    echo "Acceso no permitido.";
}
?>