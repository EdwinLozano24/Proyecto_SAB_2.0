<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear PQR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/layoutFinal/paciente/layout.css">
    <
        <?php
        $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/Assets/css/pqr/pqrCrear.css';
        $cssUrl = '/Assets/css/pqr/pqrCrear.css';
        if (file_exists($cssPath)) {
            echo '<link rel="stylesheet" href="' . $cssUrl . '">';
        } else {
            echo ' CSS File not fount at: ' . $cssPath . '';
        }
        ?>

        </head>

<body>
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>

    <main class="main-content">
        <div class="container-about">
                <h2 class="section-title">Crear PQR</h2>
                <form action="">
                </form>
            </section>
        </div>
        <div class="container">


            <form id="PqrsStore" method="POST" action="/controllers/PqrsController.php?accion=store">
                <div class="form-section">

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="pqrs_tipo">Tipo de Pqrs</label>
                            <select name="pqrs_tipo" id="pqrs_tipo" required>
                                <option value="" disabled selected>Seleccionar tipo...</option>
                                <option value="Petición">Petición</option>
                                <option value="Queja">Queja</option>
                                <option value="Reclamo">Reclamo</option>
                                <option value="Sugerencia">Sugerencia</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="pqrs_asunto">Asunto</label>
                            <input type="text" name="pqrs_asunto" id="pqrs_asunto" required>
                        </div>

                        <div class="form-group full-width">
                            <label for="pqrs_descripcion" id="form-label-descripcion">Descripcion</label>
                            <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255"
                                placeholder="Escriba su Pqrs..."></textarea>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </main>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>
</body>

</html>