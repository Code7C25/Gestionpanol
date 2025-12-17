<?php
session_start();
include_once "funciones.php";

if (!puedeGestionarStock()) {
    header("Location: index.php");
    exit;
}

include "conexion.php";

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$cantidad = $_POST["cantidad"];

$sql = "INSERT INTO productos (nombre, precio, cantidad)
        VALUES ('$nombre', '$precio', '$cantidad')";

$conexion->query($sql);

header("Location: index.php");