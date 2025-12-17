<?php
session_start();
session_destroy(); // asegura empezar limpio
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Ingreso</title>
<link rel="stylesheet" href="estilos.css">


<script>
function mostrarCampos() {
    let rol = document.getElementById("rol").value;

    document.getElementById("credenciales").style.display =
        (rol === "jefe" || rol === "director") ? "block" : "none";

    document.getElementById("alumno").style.display =
        (rol === "alumno") ? "block" : "none";
}
</script>
</head>
<body class="login-page">


<form action="validar.php" method="POST">
    <br>
    <img src="logo.png" alt="Logo" class="logo">
    <br><br>
<h2>Seleccionar rol</h2>
<br><br>
<select name="rol" id="rol" onchange="mostrarCampos()" required>
    <option value="">          Elegir rol          </option>
    <option value="jefe">Jefe de taller</option>
    <option value="director">Director</option>
    <option value="alumno">Alumno</option>
</select>

<br><br>

<div id="credenciales" style="display:none;">
    <input type="text" name="usuario" placeholder="Usuario"><br>
    <input type="password" name="password" placeholder="Contraseña">
</div>

<div id="alumno" style="display:none;">
    <input type="text" name="nombre" placeholder="Nombre"><br>
    <input type="text" name="apellido" placeholder="Apellido">
</div>

<br>
<button class="btn">Ingresar</button>

</form>

</body>
</html>
