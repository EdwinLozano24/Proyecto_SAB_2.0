<?php
require_once __DIR__ . '/../../controllers/CatalogoTratamientoController.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tratamientos</title>
</head>
<body>

<h2>Catálogo de Tratamientos</h2>
<table border="1">
    <tr>
        <th>Nombre</th><th>Costo</th><th>Estado</th><th>Duración</th><th>Categoría</th><th>Acciones</th>
    </tr>

    <?php foreach ($tratamientos as $tratamiento): ?>
    <tr>
        <td><?= htmlspecialchars($tratamiento['cat_nombre']) ?></td>
        <td><?= htmlspecialchars($tratamiento['cat_costos']) ?></td>
        <td><?= htmlspecialchars($tratamiento['cat_estado']) ?></td>
        <td><?= htmlspecialchars($tratamiento['cat_duracion']) ?></td>
        <td><?= htmlspecialchars($tratamiento['cat_categoria']) ?></td>
        <td>
            <a href="readTratamiento.php?cat_id=<?= $tratamiento['cat_id'] ?>">Ver</a> | 
            <a href="editarTratamiento.php?cat_id=<?= $tratamiento['cat_id'] ?>">Editar</a> | 
            <form action="../controllers/CatalogoTratamientoController.php" method="POST" style="display:inline;">
                <input type="hidden" name="cat_id" value="<?= $tratamiento['cat_id'] ?>">
                <button type="submit" name="eliminar">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="createTratamiento.php">Agregar nuevo tratamiento</a>

</body>
</html>
