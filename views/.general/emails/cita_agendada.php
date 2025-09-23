<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cita agendada</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f2f2f2;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#329FAB;">
        <tr>
            <td align="center" style="padding:40px 20px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width:600px; background:#ffffff; border-radius:10px;">
                    <tr>
                        <td align="center" style="padding:30px 20px; color:#329FAB; font-size:28px; font-weight:600;">
                            📅 ¡Tu cita fue agendada con éxito!
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 30px; color:#555; font-size:16px; line-height:1.5;">
                            <p>Hola <strong><?= htmlspecialchars($paciente) ?></strong>,</p>
                            <p>Tu cita ha sido confirmada con los siguientes datos:</p>
                            <ul style="padding-left:20px;">
                                <li><strong>Fecha:</strong> <?= htmlspecialchars($fecha) ?></li>
                                <li><strong>Hora:</strong> <?= htmlspecialchars($hora_inicio) ?> - <?= htmlspecialchars($hora_fin) ?></li>
                                <li><strong>Especialista:</strong> <?= htmlspecialchars($especialista) ?></li>
                                <li><strong>Consultorio:</strong> <?= htmlspecialchars($consultorio) ?></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>