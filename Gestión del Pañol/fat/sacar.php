<?php
session_start();
include "conexion.php";

if (strtolower(trim($_SESSION["rol"])) !== "alumno") {
    die("No sos alumno");
}

if (!isset($_POST["id"], $_POST["cantidad"])) {
    die("Faltan datos");
}

$id = (int) $_POST["id"];
$cantidad = (int) $_POST["cantidad"];

if ($cantidad <= 0) {
    die("Cantidad inválida");
}

// Traer producto
$consulta = $conexion->query("SELECT cantidad FROM productos WHERE id = $id");

if (!$consulta || $consulta->num_rows === 0) {
    die("Producto no encontrado");
}

$producto = $consulta->fetch_assoc();

if ($cantidad > $producto["cantidad"]) {
    die("Stock insuficiente");
}

$nuevoStock = $producto["cantidad"] - $cantidad;

// Actualizar stock
$update = $conexion->query(
    "UPDATE productos SET cantidad = $nuevoStock WHERE id = $id"
);

if (!$update) {
    die("Error al actualizar stock: " . $conexion->error);
}

// Guardar movimiento
$alumno = trim($_SESSION["nombre"] . " " . $_SESSION["apellido"]);

$insert = $conexion->query(
    "INSERT INTO movimientos (producto_id, alumno, cantidad)
     VALUES ($id, '$alumno', $cantidad)"
);

if (!$insert) {
    die("Error al registrar movimiento: " . $conexion->error);
}

header("Location: index.php");
exit;
