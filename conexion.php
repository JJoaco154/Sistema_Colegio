<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {$conexion = new mysqli("127.0.0.1:3306", "root", "root", "escuela"); // lugar, usuario, contraseña, nombre de la base de datos
} catch (mysqli_sql_exception $e) {
    // Esto te dirá si es la contraseña, el usuario o que la BD no existe
    die("Error de conexión: " . $e->getMessage());
}

?>