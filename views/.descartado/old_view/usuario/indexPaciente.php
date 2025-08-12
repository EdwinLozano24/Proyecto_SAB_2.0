<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

<?php if (!empty($usuarios)): ?>
    <ul>
        <?php foreach ($usuarios as $user): ?>
            <li>
                <a href="AuthController.php?id=<?php echo $user['paci_num_documento']; ?>">
                    <?php echo htmlspecialchars($user['paci_nombre']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay usuarios registrados.</p>
<?php endif; ?>
</body>
</html>