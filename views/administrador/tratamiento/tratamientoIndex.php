<?php
require_once '../../../config/auth.php';
requiereSesion();
require_once __DIR__ . '/../../../config/database.php';
$pdo = conectarBD();
$sql = "SELECT * FROM tbl_tratamientos
        INNER JOIN tbl_categorias_tratamientos ON trat_categoria = id_categoria
        ORDER BY 
            CASE trat_estado
                WHEN 'Activo' THEN 1
                ELSE 2
        END";
$stmt = $pdo->query($sql);
$tratamientos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DATATABLES -->
    <link href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"
        integrity="sha384-5hBbs6yhVjtqKk08rsxdk9xO80wJES15HnXHglWBQoj3cus3WT+qDJRpvs5rRP2c" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet"
        integrity="sha384-DJhypeLg79qWALC844KORuTtaJcH45J+36wNgzj4d1Kv1vt2PtRuV2eVmdkVmf/U" crossorigin="anonymous">
    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Index Tratamientos</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudIndex.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudIndex.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
</head>

<body>
    <div class="container-custom">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <i class="fa-solid fa-kit-medical"></i>
            </div>
            <h2>Tratamientos Registrados</h2>
            <p class="subtitle">Gestión completa de los tratamientos del sistema</p>
            <a href="/proyecto_sab/controllers/HomeController.php?accion=home" class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-rotate-left"></i>
                Volver
            </a>
        </div>

        <!-- Botón nuevo usuario -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="/proyecto_sab/controllers/TratamientoController.php?accion=view_store"
                class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-square-plus"></i>
                Nuevo Tratamiento
            </a>
        </div>

        <table id="TratamientosDatatable" class="table-custom">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Duracion Por Sesion</th>
                    <th>Duracion Estimada</th>
                    <th>Posibles Riesgos</th>
                    <th>Descripcion</th>
                    <th>Complejidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tratamientos as $tratamiento): ?>
                    <tr>
                        <td><?= htmlspecialchars($tratamiento['trat_codigo']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_nombre']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['cate_nombre']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_duracion_minutos']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_duracion']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_riesgos']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_descripcion']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_complejidad']) ?></td>
                        <td><?= htmlspecialchars($tratamiento['trat_estado']) ?></td>
                        <td>
                            <a href="/proyecto_sab/controllers/TratamientoController.php?accion=view_update&id_tratamiento=<?= $tratamiento['id_tratamiento'] ?>"
                                class="action-btn edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="/proyecto_sab/controllers/TratamientoController.php?accion=delete&id_tratamiento=<?= $tratamiento['id_tratamiento'] ?>"
                                class="action-btn delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Datatables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"
        integrity="sha384-+mbV2IY1Zk/X1p/nWllGySJSUN8uMs+gUAN10Or95UBH0fpj6GfKgPmgC5EXieXG"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"
        integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"
        integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"
        integrity="sha384-LiV1KhVIIiAY/+IrQtQib29gCaonfR5MgtWzPCTBVtEVJ7uYd0u8jFmf4xka4WVy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.min.js"
        integrity="sha384-G85lmdZCo2WkHaZ8U1ZceHekzKcg37sFrs4St2+u/r2UtfvSDQmQrkMsEx4Cgv/W"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js"
        integrity="sha384-zlMvVlfnPFKXDpBlp4qbwVDBLGTxbedBY2ZetEqwXrfWm+DHPvVJ1ZX7xQIBn4bU"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.bootstrap5.min.js"
        integrity="sha384-BdedgzbgcQH1hGtNWLD56fSa7LYUCzyRMuDzgr5+9etd1/W7eT0kHDrsADMmx60k"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js"
        integrity="sha384-v0wzF6NECWiQyIain/Wacl6wEYr6NDJRus6qpckumPIngNI9Zo0sDMon5lBh9Np1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"
        integrity="sha384-+E6fb8f66UPOVDHKlEc1cfguF7DOTQQ70LNUnlbtywZiyoyQWqtrMjfTnWyBlN/Y"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js"
        integrity="sha384-FvTRywo5HrkPlBKFrm2tT8aKxIcI/VU819roC/K/8UrVwrl4XsF3RKRKiCAKWNly"
        crossorigin="anonymous"></script>

    <!-- Boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // 1) Inicializo DataTable con TODAS las opciones
            const table = $('#TratamientosDatatable').DataTable({
                    buttons: [{
                            extend: "excelHtml5",
                            text: '<i class="fa-solid fa-file-excel"></i>',
                            titleAttr: "Exportar a Excel",
                            className: "btn btn-success me-1",
                            title: 'Tratamientos registrados',
                            exportOptions: {
                                columns: ':visible:not(:last-child)'
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                                // Agrega estilo de cabecera (negrita)
                                $('row:first c', sheet).attr('s', '2'); // Negrita para la primera fila

                                // Aplica borde a todas las celdas
                                $('row c', sheet).attr('s', '25'); // Sólo funciona si el estilo 25 está definido por defecto
                            }
                    },
                    {
                        extend: "pdfHtml5",
                        text: '<i class="fa-solid fa-file-pdf"></i>',
                        titleAttr: "Exportar a PDF",
                        className: "btn btn-danger me-1",
                        orientation: 'landscape',
                        title: 'Tratamientos registrados',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(doc) {
                            doc.pageMargins = [20, 20, 20, 20];

                            doc.defaultStyle = {
                                fontSize: 10,
                                margin: [10, 10, 10, 10]
                            };

                            doc.content[0].margin = [0, 20, 0, 10];
                            doc.content[0].alignment = 'center';
                            doc.content[0].fontSize = 14;

                            doc.styles.tableHeader = {
                                bold: true,
                                fontSize: 11,
                                color: 'white',
                                fillColor: '#00AEEF',
                                alignment: 'center',
                                margin: [5, 5, 5, 5]
                            };

                            // Líneas suaves en la tabla
                            doc.content[1].layout = {
                                hLineWidth: function() {
                                    return 0.5;
                                },
                                vLineWidth: function() {
                                    return 0.5;
                                },
                                hLineColor: function() {
                                    return '#aaa';
                                },
                                vLineColor: function() {
                                    return '#aaa';
                                },
                                paddingLeft: function() {
                                    return 8;
                                },
                                paddingRight: function() {
                                    return 8;
                                },
                                paddingTop: function() {
                                    return 4;
                                },
                                paddingBottom: function() {
                                    return 4;
                                }
                            };
                        }
                    },
                    {
                        extend: "print",
                        text: '<i class="fa-solid fa-print"></i>',
                        titleAttr: "Imprimir",
                        className: "btn btn-warning",
                        orientation: "landscape",
                        title: "&nbsp",
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(win) {
                            // Forzar orientación horizontal
                            const css = `
            @page {
                size: landscape;
            }
            body {
                font-size: 10pt;
                margin: 20px;
                backgroud: #bde7f7ff;
            }
            h1 {
                text-align: center;
                font-size: 18pt;
                margin-bottom: 20px;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th {
                background-color: #00AEEF !important;
                color: white !important;
                padding: 6px;
                text-align: center;
            }
            td {
                padding: 6px;
                text-align: center;
            }
            table, th, td {
                border: 1px solid #aaa;
            }
        `;
                            const style = document.createElement('style');
                            style.type = 'text/css';
                            style.innerHTML = css;
                            win.document.head.appendChild(style);

                            // Cambiar el título visual impreso
                            const h1 = win.document.querySelector('h1');
                            if (h1) {
                                h1.innerText = 'Tratamientos Registrados';
                            }
                        }
                    }

                ],

                // Ubicación del contenedor de botones (sólo genera el <div> aquí,
                // luego lo moveremos al .mb-4)
                dom: "<'row'<'col-12'B>>" +
                "<'row mb-3'<'col-sm-6'l><'col-sm-6'f>>" +
                "t" +
                // <-- Aquí añadimos d-flex justify-content-end
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
                    decimal: ",",
                    infoThousands: ".",
                    stateRestore: {
                        removeTitle: "Remover Estado",
                        renameTitle: "Cambiar Nombre Estado"
                    }
                }
            });

        // 2) Muevo el contenedor de botones dentro de mi div.mb-4
        table.buttons().container().appendTo('.mb-4');
        });
    </script>

</body>

</html>