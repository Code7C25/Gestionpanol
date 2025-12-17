<?php
session_start();
include "conexion.php";
include "funciones.php";

// Solo el jefe puede entrar
if (strtolower(trim($_SESSION["rol"])) !== "jefe de taller") {
    header("Location: index.php");
    exit;
}

// Traer movimientos con nombre del producto
$sql = "
    SELECT m.alumno, p.nombre AS producto, m.cantidad, m.fecha
    FROM movimientos m
    JOIN productos p ON m.producto_id = p.id
    ORDER BY m.fecha DESC
";

$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h1>🔔 Notificaciones</h1>
        <a href="index.php" class="btn">Volver</a>
    </div>

    <table class="table">
        <tr>
            <th>Alumno</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Fecha</th>
        </tr>

        <?php if ($resultado->num_rows === 0): ?>
            <tr>
                <td colspan="4" style="text-align:center;">
                    No hay movimientos registrados
                </td>
            </tr>
        <?php endif; ?>

        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($fila["alumno"]) ?></td>
            <td><?= htmlspecialchars($fila["producto"]) ?></td>
            <td><?= $fila["cantidad"] ?></td>
            <td><?= date("d/m/Y H:i", strtotime($fila["fecha"])) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
