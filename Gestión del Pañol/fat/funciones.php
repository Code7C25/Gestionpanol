<?php
function puedeGestionarStock() {
    return $_SESSION["rol"] === "Director" || $_SESSION["rol"] === "Jefe de Taller";
}
