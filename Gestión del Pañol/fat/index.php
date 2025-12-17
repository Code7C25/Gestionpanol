<?php
session_start();

include_once "conexion.php";
include_once "funciones.php";
?>
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
    exit;
}
?>
<?php
include "conexion.php";
$totalProductos = $conexion->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()["total"];

$stockTotal = $conexion->query("SELECT SUM(cantidad) AS total FROM productos")->fetch_assoc()["total"];

$valorTotal = $conexion->query("SELECT SUM(precio * cantidad) AS total FROM productos")->fetch_assoc()["total"];

$resultado = $conexion->query("SELECT * FROM productos");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Stock</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>


<div class="container">

    <div class="header">
        <h1>📦Stock</h1>
        <div style="display:flex; gap:10px;">
        <?php if (puedeGestionarStock()) { ?>
            <a href="agregar.php" class="btn">+ Agregar</a>
        <?php } ?>
        <?php if (strtolower(trim($_SESSION["rol"])) === "jefe de taller"): ?>
    <a href="notificaciones.php" class="btn">Notificaciones</a>
<?php endif; ?>

        <a href="logout.php" class="btn" style="background:#ef4444;">Salir</a>
    </div>

        <input 
    type="text" 
    id="buscador" 
    placeholder="Buscar producto..." 
    class="search">
<a href="exportar.php" class="btn">Exportar Excel</a>

    </div>
    <div class="dashboard">
    <div class="stat">
        <h3>Total productos</h3>
        <p><?= $totalProductos ?></p>
    </div>

    <div class="stat">
        <h3>Stock total</h3>
        <p><?= $stockTotal ?></p>
    </div>

    <div class="stat">
        <h3>Valor inventario</h3>
        <p>$<?= number_format($valorTotal, 2) ?></p>
    </div>
</div>

    <table class="table">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>

<?php while ($fila = $resultado->fetch_assoc()) { ?>
    <tr>
        <td><?= $fila["id"] ?></td>
        <td><?= $fila["nombre"] ?></td>
        <td>$<?= $fila["precio"] ?></td>
        <td class="<?= ($fila["cantidad"] <= 5) ? 'low-stock' : '' ?>">
            <?= $fila["cantidad"] ?>
        </td>

        <td class="actions">

            <!-- ALUMNO: solo sacar -->
            <?php if (strtolower(trim($_SESSION["rol"])) === "alumno"): ?>
                <form action="sacar.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $fila["id"] ?>">
                    <input type="number" name="cantidad" min="1" max="<?= $fila["cantidad"] ?>" required>
                    <button class="btn">Sacar</button>
                </form>
            <?php endif; ?>

            <!-- JEFE y DIRECTOR -->
            <?php if (puedeGestionarStock()): ?>
                <a href="editar.php?id=<?= $fila["id"] ?>" class="edit">Editar</a>
                <a href="eliminar.php?id=<?= $fila["id"] ?>" class="delete">Eliminar</a>
            <?php endif; ?>

        </td>
    </tr>
<?php } ?>
</table>


</div>
<script>
document.getElementById("buscador").addEventListener("keyup", function () {
    let texto = this.value.toLowerCase();
    let filas = document.querySelectorAll(".table tr");

    filas.forEach((fila, index) => {
        if (index === 0) return;

        let contenido = fila.textContent.toLowerCase();
        fila.style.display = contenido.includes(texto) ? "" : "none";
    });
});
</script>
</body>
</html>
