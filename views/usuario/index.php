<?php
require_once '../../config/database.php';

$sql = "SELECT * FROM tbl_usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/admin/usuario.css">
    <title>Crud Usuarios</title>
</head>
<body>
    <h2>Usuarios Registrados</h2>
    <!-- <div style="text-align: center; margin-bottom: 15px;">
    <button onclick="toggleColumn(4)">Correo</button>
    <button onclick="toggleColumn(5)">Dirección</button>
    <button onclick="toggleColumn(11)">EPS</button>
    <button onclick="toggleColumn(13)">Estado</button>
    </div> -->
    <table>
        <tr>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Tipo Documento</th>
            <th>Correo Electronico</th>
            <th>Direccion</th>
            <th>Numero Contacto</th>
            <th>Sexo</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['usua_nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_documento']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_tipo_documento']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_correo_electronico']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_direccion']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_num_contacto']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_sexo']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_tipo']) ?></td>
                <td><?= htmlspecialchars($usuario['usua_estado']) ?></td>
                <td>
                    <a href="../../controllers/UsuarioController.php?accion=editar&id_usuario=<?=$usuario['id_usuario']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="../../controllers/UsuarioController.php?accion=eliminar&id_usuario=<?=$usuario['id_usuario']?>"><i class="fa-solid fa-trash"></i></a>
                </td>


            </tr>
            <?php endforeach; ?>
    </table>
    <!-- <script>
function toggleColumn(index) {
    const rows = document.querySelectorAll("table tr");
    rows.forEach(row => {
        const cells = row.querySelectorAll("th, td");
        if (cells[index]) {
            cells[index].style.display = 
                cells[index].style.display === "none" ? "" : "none";
        }
    });
}
</script> -->
</body>
</html>