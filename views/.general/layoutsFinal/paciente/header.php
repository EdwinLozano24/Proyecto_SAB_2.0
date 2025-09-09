<?php
$usua_nombre = $_SESSION['usuario']['usua_nombre'];
$id_usuario = $_SESSION['usuario']['id_usuario'];
?>
    <header class="header">
        <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
            <div class="header-content" onclick="window.location.href='/views/paciente/home/paciente_dashboard.php'" style="cursor: pointer;">
                <div class="logo">SAB</div>
                <h1 class="header-title">Sistema de Gestión Odontológica</h1>
            </div>
            
            <div class="user-info">
                <div class="user-avatar">U</div>
                <a href="/controllers/HomeController.php?accion=pacientePerfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" class="user-name-button"><?php echo htmlspecialchars($usua_nombre); ?></a>
            </div>
        </header>