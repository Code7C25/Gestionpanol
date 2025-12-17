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

$id = $_GET["id"];

$conexion->query("DELETE FROM productos WHERE id = $id");

header("Location: index.php");