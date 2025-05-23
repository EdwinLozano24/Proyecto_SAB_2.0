<?php
require_once '../models/Usuario.php';

$usuario = new Usuario($pdo);

$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'crear':
        include '../views/usuario/crear.php';
        break;
    case 'guardar':
           $usuario->crear
           (
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
    header("Location: ../../controllers/UsuarioController.php");
    break;
//     case 'editar':
//         $usua = $usuario->obtenerPorId($_GET['id_usuario']);
//         include '../views/usuario/editar.php';
//         break;
//     case 'actualizar':
//         $usuario->actualizar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad']);
//         header("Location: ../controllers/ProductoController.php");
//         break;
//     case 'eliminar':
//         $usuario->eliminar($_GET['id_usuario']);
//         header("Location: ../controllers/UsuarioController.php");
//         break;
    default:
        $usua = $usuario->obtenerTodos();
        include '../views/usuario/index.php';
        break;
    }
