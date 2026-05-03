<?php

require_once "conexion.php";
require_once "Alumno.php"; // requiere_once sirve para incluir el archivo que contiene la clase Alumno
require_once "Curso.php";
require_once "Profe.php";   

$conexion; // crea una nueva instancia de la clase conexion para establecer la conexión con la base de datos
$mi_alumno1 = new Alumno(1234, "Joaquin", "Estefania", 20, 9);
$mi_alumno2 = new Alumno(1235, "Nacho", "Monte", 19, 9);

$mi_profe1 = new Profesor("Maria", "Gomez", 35, "Matematica");
$mi_profe2 = new Profesor("Juan", "Perez", 40, "Historia");

$mi_curso = new Curso("6to A");

// insertar alumno:
$id_alumno = $mi_alumno1->conectarAlumnoBaseDeDatos($conexion);

// insertar profesor:

$id_profe = $mi_profe1->conectarProfeBaseDeDatos($conexion);

// insertar curso:
$conexion->query("call insertarCurso('{$mi_curso->getNombre()}', $id_alumno, $id_profe)");
?>