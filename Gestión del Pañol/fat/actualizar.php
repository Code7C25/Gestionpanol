<?php
session_start();
include_once "funciones.php";

if (!puedeGestionarStock()) {
    header("Location: index.php");
    exit;
}
?>
<?php
include "conexion.php";

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$cantidad = $_POST["cantidad"];

$sql = "UPDATE productos 
        SET nombre='$nombre', precio='$precio', cantidad='$cantidad'
        WHERE id=$id";

$conexion->query($sql);

header("Location: index.php");