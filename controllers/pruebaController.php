<?php
// C:\xampp\htdocs\proyecto_sab\controllers\UsuarioController.php

// 1. Incluye el archivo de conexión a la base de datos
// La ruta aquí debe ser correcta para llegar a tu database.php
// Asumo que tu controllers está un nivel por debajo de la raíz del proyecto,
// y config está al mismo nivel que controllers. Ajusta si es diferente.
require_once __DIR__ . '/../config/database.php';

// 2. Llama a tu función para obtener la conexión PDO
// Esto asignará el objeto PDO a la variable $pdo
$pdo = conectarBD();

// 3. Ahora incluye tu modelo Usuario
require_once '../models/Usuario.php';

// 4. Pasa la conexión PDO al constructor de tu modelo Usuario
// Ahora $pdo ya está definida y contiene el objeto de conexión
$usuario = new Usuario($pdo);

// El resto de tu lógica para manejar las acciones (crear, guardar, etc.) está bien
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'crear':
        include '../views/usuario/usuarioStore.php';
        break;
    case 'guardar':
        // Asegúrate de que el método 'crear' en tu modelo 'Usuario' esté bien definido
        // y que reciba todos estos parámetros.
        $usuario->crear(
            $_POST['usua_nombre'],
            $_POST['usua_tipo_documento'],
            $_POST['usua_documento'],
            $_POST['usua_correo_electronico'],
            $_POST['usua_num_contacto'],
            $_POST['usua_num_secundario'],
            $_POST['usua_direccion'],
            $_POST['usua_fecha_nacimiento'],
            $_POST['usua_sexo'],
            $_POST['usua_rh'],
            $_POST['usua_eps'],
            $_POST['usua_tipo'],
            $_POST['usua_password']
        );
        header("Location: ../controllers/UsuarioController.php");
        exit(); // Siempre usa exit() después de un header Location
        break;

    case 'editar':
        $usua = $usuario->obtenerPorId($_GET['id_usuario']);
        include '../views/usuario/editar.php';
        break;

    case 'actualizar':
        $usuario->actualizar(
            $_POST['usua_nombre'],
            $_POST['usua_tipo_documento'],
            $_POST['usua_documento'],
            $_POST['usua_correo_electronico'],
            $_POST['usua_num_contacto'],
            $_POST['usua_num_secundario'],
            $_POST['usua_direccion'],
            $_POST['usua_fecha_nacimiento'],
            $_POST['usua_sexo'],
            $_POST['usua_rh'],
            $_POST['usua_eps'],
            $_POST['usua_tipo'],
            $_POST['usua_password'],
            $_POST['usua_estado'],
            $_POST['id_usuario']
        );
        header("Location: ../controllers/UsuarioController.php");
        exit(); // Siempre usa exit() después de un header Location
        break;

    case 'eliminar':
        $usuario->eliminar($_GET['id_usuario']);
        header("Location: ../controllers/UsuarioController.php");
        exit(); // Siempre usa exit() después de un header Location
        break;

    default:
        $usua = $usuario->obtenerTodos();
        include '../views/usuario/index.php';
        break;
}
?>