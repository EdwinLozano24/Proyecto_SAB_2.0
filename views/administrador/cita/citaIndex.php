<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$pdo = conectarBD();

$sql = "
    SELECT c.*, 
           up.usua_nombre AS cita_paciente, 
           ue.usua_nombre AS cita_especialista, 
           co.cons_numero AS cita_consultorio
    FROM tbl_citas AS c
    INNER JOIN tbl_pacientes AS p 
        ON c.cita_paciente = p.id_paciente
    INNER JOIN tbl_usuarios AS up 
        ON p.paci_usuario = up.id_usuario
    INNER JOIN tbl_especialistas AS e 
        ON c.cita_especialista = e.id_especialista
    INNER JOIN tbl_usuarios AS ue 
        ON e.espe_usuario = ue.id_usuario
    INNER JOIN tbl_consultorios AS co 
        ON c.cita_consultorio = co.id_consultorio
    ORDER BY CASE c.cita_estado 
                WHEN 'cumplida' THEN 1 
                ELSE 2 
             END
";

$stmt = $pdo->query($sql);
$citas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Citas</title>

    <!-- CSS -->
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous">

    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudIndex.css';
    $cssUrl = '/assets/css/admin/crudIndex.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo 'CSS File not found at: ' . $cssPath;
    }
    ?>
</head>

<body>
    <div class="container-custom">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <h2>Citas Registradas</h2>
            <p class="subtitle">Gestión completa de las citas del sistema</p>
            <a href="/controllers/HomeController.php?accion=home" class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-rotate-left"></i> Volver
            </a>
        </div>

        <!-- Botón nueva cita y exportación -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="/controllers/CitaController.php?accion=view_store" class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-square-plus"></i> Nueva Cita
            </a>
            <div id="botonesExportacion"></div>
        </div>

        <!-- Filtro de estado -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="filtroEstado" class="form-label">Filtrar por Estado:</label>
                <select id="filtroEstado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="proceso">Proceso</option>
                    <option value="cumplida">Cumplida</option>
                    <option value="incumplida">Incumplida</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>
        </div>

        <!-- Tabla de citas -->
        <div class="table-responsive">
            <table id="citaDatatable" class="table-custom">
                <thead>
                    <tr>
                        <th>Usuario Solicitante</th>
                        <th>Especialista Encargado</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Turno</th>
                        <th>Duración</th>
                        <th>Consultorio Asignado</th>
                        <th>Motivo</th>
                        <th>Observación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($citas as $cita): ?>
                        <tr>
                            <td><?= htmlspecialchars($cita['cita_paciente']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_especialista']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_fecha']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_hora_inicio']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_hora_fin']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_turno']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_duracion']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_consultorio']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_motivo']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_observacion']) ?></td>
                            <td><?= htmlspecialchars($cita['cita_estado']) ?></td>
                            <td>
                                <a href="/controllers/CitaController.php?accion=view_update&id_cita=<?= $cita['id_cita'] ?>" class="action-btn edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="/controllers/CitaController.php?accion=delete&id_cita=<?= $cita['id_cita'] ?>" class="action-btn delete">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Inicialización DataTable -->
    <script>
        $(document).ready(function() {
            const table = $('#citaDatatable').DataTable({
                responsive: true,
                scrollX: true,
                buttons: [
                    // Botón Excel  
                    {
                        extend: "excelHtml5",
                        text: '<i class="fa-solid fa-file-excel"></i>',
                        titleAttr: "Exportar a Excel",
                        className: "btn btn-success me-1",
                        title: 'Citas registradas',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    // Botón PDF  
                    {
                        extend: "pdfHtml5",
                        text: '<i class="fa-solid fa-file-pdf"></i>',
                        titleAttr: "Exportar a PDF",
                        className: "btn btn-danger me-1",
                        orientation: "landscape",
                        title: 'Citas registradas',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    // Botón Imprimir  
                    {
                        extend: "print",
                        text: '<i class="fa-solid fa-print"></i>',
                        titleAttr: "Imprimir",
                        className: "btn btn-warning",
                        orientation: "landscape",
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    }
                ],
                dom: "<'row'<'col-12'B>>" +
                    "<'row mb-3'<'col-sm-6'l><'col-sm-6'f>>" +
                    "t" +
                    "<'row mt-3'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
                lengthMenu: [10, 20, 50, 100],
                language: {
                    processing: "Procesando...",
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    search: "Buscar:",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                }
            });

            // Mueve los botones al div superior  
            table.buttons().container().appendTo('#botonesExportacion');

            // Filtro por estado  
            $('#filtroEstado').on('change', function() {
                const estado = this.value;
                if (estado) {
                    table.column(10).search('^' + estado + '$', true, false).draw();
                } else {
                    table.column(10).search('').draw();
                }
            });
        });
    </script>
</body>

</html>