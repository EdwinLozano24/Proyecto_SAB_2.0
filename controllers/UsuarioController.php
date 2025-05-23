<?php
require_once '../models/Usuario.php';

$usuario = new Usuario($pdo);

$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'crear':
        include '../views/usuario/crear.php';
        break;
    case 'guardar':
        $usuario->crear($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad']);
        header("Location: ../controllers/ProductoController.php");
        break;
    case 'editar':
        $usua = $usuario->obtenerPorId($_GET['id_usuario']);
        include '../views/usuario/editar.php';
        break;
    case 'actualizar':
        $usuario->actualizar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad']);
        header("Location: ../controllers/ProductoController.php");
        break;
    case 'eliminar':
        $usuario->eliminar($_GET['id_usuario']);
        header("Location: ../controllers/UsuarioController.php");
        break;
    default:
        $usua = $usuario->obtenerTodos();
        include '../views/productos/index.php';
        break;
}
