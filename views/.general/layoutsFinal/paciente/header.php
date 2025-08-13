<?php
$nombreUsuario = $_SESSION['usuario']['usua_nombre'];
?>
    <header class="header">
            <div class="header-content">
                <div class="logo">SAB</div>
                <h1 class="header-title">Sistema de Gestión Odontológica</h1>
            </div>
            <div class="user-info">
                <div class="user-avatar">U</div>
                <button class="user-name-button"><?php echo htmlspecialchars($nombreUsuario); ?></button>
            </div>
        </header>