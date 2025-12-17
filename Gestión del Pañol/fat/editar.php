<?php
session_start();
include_once "funciones.php";

if (!puedeGestionarStock()) {
    header("Location: index.php");
    exit;
}

include "conexion.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$resultado = $conexion->query("SELECT * FROM productos WHERE id = $id");
$producto = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2 class="titulo-form">Editar producto</h2>

<div class="form-wrapper">
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $producto["id"] ?>">

        <input type="text" name="nombre" value="<?= $producto["nombre"] ?>" required>
        <input type="number" name="precio" step="0.01" value="<?= $producto["precio"] ?>" required>
        <input type="number" name="cantidad" value="<?= $producto["cantidad"] ?>" required>

        <button type="submit" class="btn">Actualizar</button>
    </form>
</div>

</body>
</html>
