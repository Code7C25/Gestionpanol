<?php
session_start();

$rol = $_POST["rol"] ?? "";

// JEFE
if ($rol === "jefe") {
    if ($_POST["usuario"] === "Walter" && $_POST["password"] === "1234") {
        $_SESSION["usuario"] = "Walter";
        $_SESSION["rol"] = "Jefe de Taller";
        header("Location: index.php");
        exit;
    }
}

// DIRECTOR
if ($rol === "director") {
    if ($_POST["usuario"] === "Pablo" && $_POST["password"] === "1234") {
        $_SESSION["usuario"] = "Pablo";
        $_SESSION["rol"] = "Director";
        header("Location: index.php");
        exit;
    }
}

// ALUMNO
if ($rol === "alumno") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"])) {
        $_SESSION["usuario"] = $_POST["nombre"] . " " . $_POST["apellido"];
        $_SESSION["rol"] = "alumno";
        header("Location: index.php");
        exit;
    }
}

// FALLÓ
header("Location: login.php");
exit;
