<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$pdo = conectarBD();
$sql = "SELECT 
    c.*, 
    up.usua_nombre AS cita_paciente, 
    ue.usua_nombre AS cita_especialista, 
    co.cons_numero AS cita_consultorio
FROM tbl_citas AS c
INNER JOIN tbl_pacientes AS p ON c.cita_paciente = p.id_paciente
INNER JOIN tbl_usuarios AS up ON p.paci_usuario = up.id_usuario
INNER JOIN tbl_especialistas AS e ON c.cita_especialista = e.id_especialista
INNER JOIN tbl_usuarios AS ue ON e.espe_usuario = ue.id_usuario
INNER JOIN tbl_consultorios AS co ON c.cita_consultorio = co.id_consultorio
ORDER BY
    CASE c.cita_estado
        WHEN 'cumplida' THEN 1
        ELSE 2
    END";
$stmt = $pdo->query($sql);
$citas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Crud Citas</title>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- DataTables (versión compatible con Bootstrap 5) -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet" />
    <!-- Si usas CSS responsive de DataTables, puedes incluirlo; si no, tu .table-responsive CSS bastará -->
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <!-- Tu CSS personalizado -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudIndex.css';
    $cssUrl = '/assets/css/admin/crudIndex.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    }
    ?>
    <style>
        /* pequeñas defensas para que no se rompa el layout si falta algo */
        .table-custom {
            width: 100% !important;
            white-space: nowrap;
        }

        .dt-buttons .btn {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container-custom">
        <!-- Header -->
        <div class="header text-center mb-4">
            <div class="logo mb-2"><i class="fa-solid fa-calendar-days"></i></div>
            <h2>Citas Registradas</h2>
            <p class="subtitle">Gestión completa de las citas del sistema</p>
            <a href="/controllers/HomeController.php?accion=home" class="btn-custom btn-primary-custom mt-2">
                <i class="fa-solid fa-rotate-left"></i> Volver
            </a>
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="/controllers/CitaController.php?accion=view_store" class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-square-plus"></i> Nueva Cita
            </a>
            <div id="botonesExportacion"></div>
        </div>

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

        <div class="table-responsive"> <!-- contenedor que controla el scroll horizontal -->
            <table id="citaDatatable" class="table table-striped table-hover table-custom">
                <thead>
                    <tr>
                        <th>Usuario Solicitante</th>
                        <th>Especialista Encargado</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Turno</th>
                        <th>Duracion</th>
                        <th>Consultorio Asignado</th>
                        <th>Motivo</th>
                        <th>Observacion</th>
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
                            <td class="text-center">
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

    <!-- JS: jQuery primero -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Librerías para export (jszip, pdfmake) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- DataTables + Bootstrap 5 integration -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <!-- Responsive (opcional si quieres que DataTables también haga colapsos) -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Bootstrap bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const table = $('#citaDatatable').DataTable({
                // Si prefieres que el scroll lo haga CSS (.table-responsive),
                // puedes poner responsive: false y scrollX: false.
                // Aquí activo responsive + scrollX para máxima compatibilidad:
                responsive: true,
                scrollX: true,

                autoWidth: false,
                orderCellsTop: true,
                pageLength: 10,
                lengthMenu: [10, 20, 50, 100],

                columnDefs: [{
                        orderable: false,
                        searchable: false,
                        targets: -1
                    }, // acciones
                    {
                        className: 'align-middle',
                        targets: '_all'
                    }
                ],

                dom: "<'row mb-3'<'col-12'B>>" +
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                buttons: [{
                        extend: "excelHtml5",
                        text: '<i class="fa-solid fa-file-excel"></i>',
                        titleAttr: "Exportar a Excel",
                        className: "btn btn-success",
                        title: 'Citas registradas',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: "pdfHtml5",
                        text: '<i class="fa-solid fa-file-pdf"></i>',
                        titleAttr: "Exportar a PDF",
                        className: "btn btn-danger",
                        orientation: "landscape",
                        title: 'Citas registradas',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: "print",
                        text: '<i class="fa-solid fa-print"></i>',
                        titleAttr: "Imprimir",
                        className: "btn btn-warning",
                        orientation: "landscape",
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(win) {
                            const css = `
                                @page { size: landscape; }
                                body { font-size: 10pt; margin: 20px; }
                                h1 { text-align: center; font-size: 18pt; margin-bottom: 20px; }
                                table { border-collapse: collapse; width: 100%; }
                                th { background-color: #00AEEF !important; color: white !important; padding: 6px; text-align: center; }
                                td { padding: 6px; text-align: center; }
                                table, th, td { border: 1px solid #aaa; }
                            `;
                            const style = document.createElement('style');
                            style.type = 'text/css';
                            style.appendChild(document.createTextNode(css));
                            win.document.head.appendChild(style);

                            const h1 = win.document.querySelector('h1');
                            if (h1) h1.innerText = 'Citas Registradas';
                        }
                    }
                ],

                language: {
                    processing: "Procesando...",
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    search: "Buscar:",
                    loadingRecords: "Cargando...",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    aria: {
                        sortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sortDescending: ": Activar para ordenar la columna de manera descendente"
                    },
                    buttons: {
                        copy: "Copiar",
                        colvis: "Visibilidad",
                        collection: "Colección",
                        colvisRestore: "Restaurar visibilidad",
                        copyKeys: "Presione ctrl o ⌘ + C para copiar los datos. Escape para cancelar.",
                        copySuccess: {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %ds filas al portapapeles"
                        },
                        copyTitle: "Copiar al portapapeles",
                        csv: "CSV",
                        excel: "Excel",
                        pdf: "PDF",
                        print: "Imprimir",
                        pageLength: {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        }
                    },
                    thousands: ".",
                    decimal: ","
                }
            });

            // mueve los botones al contenedor externo si lo deseas
            table.buttons().container().appendTo('#botonesExportacion');

            // filtro externo por estado (coincidencia exacta)
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