<?php
$conexion = new mysqli("localhost", "root", "", "stock");

if ($conexion->connect_error) {
    die("Error de conexión");
}