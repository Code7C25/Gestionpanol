<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

include "conexion.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=stock.xls");

echo "ID\tNombre\tPrecio\tCantidad\n";

$resultado = $conexion->query("SELECT * FROM productos");

while ($fila = $resultado->fetch_assoc()) {
    echo $fila["id"] . "\t" .
         $fila["nombre"] . "\t" .
         $fila["precio"] . "\t" .
         $fila["cantidad"] . "\n";
}