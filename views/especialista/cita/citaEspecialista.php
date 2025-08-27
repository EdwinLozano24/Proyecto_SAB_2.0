<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
$id_usuario = $_SESSION['usuario']['id_usuario'];
$nombreUsuario = $_SESSION['usuario']['usua_nombre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Assets/css/layoutFinal/admin/layout1.css">
    <title>Atender Citas</title>
</head>
<body>
    <?php 
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/header.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/nav.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/asideCita.php');
    ?>
    <main class="main-content">
        <table id="EspecialistaCitas" class="table-custom">
            <thead>
                <tr>
                    <th>Usuario Solicitante</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Turno</th>
                    <th>Duracion</th>
                    <th>Consultorio Asignado</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cita as $cit): ?>
                    <tr>
                        <td><?= htmlspecialchars($cit['paciente_nombre']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_fecha']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_hora_inicio']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_hora_fin']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_turno']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_duracion']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_consultorio']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_motivo']) ?></td>
                        <td><?= htmlspecialchars($cit['cita_estado']) ?></td>
                        <td>
                            <a href="/controllers/CitaController.php?accion=view_update&id_cita=<?= $cita['id_cita'] ?>"
                                class="action-btn edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="/controllers/CitaController.php?accion=delete&id_cita=<?= $cita['id_cita'] ?>"
                                class="action-btn delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/footer.php');
    ?>
</body>
</html>