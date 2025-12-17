<?php
session_start();
include_once "funciones.php";

if (!puedeGestionarStock()) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2 class="titulo-form">Agregar producto</h2>

<div class="form-wrapper">
    <form action="guardar.php" method="POST" class="container">

        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Precio</label>
        <input type="number" name="precio" step="0.01" required>

        <label>Cantidad</label>
        <input type="number" name="cantidad" required>

        <button type="submit" class="btn">Guardar</button>
    </form>

    <a href="index.php" class="titulo-form">← Volver</a>
</div>
</body>
</html>
