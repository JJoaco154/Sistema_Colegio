<?php

require_once "Alumno.php"; // requiere_once sirve para incluir el archivo que contiene la clase Alumno
require_once "Curso.php";
require_once "Profe.php";   

$mi_alumno1 = new Alumno(1234, "Joaquin", "Estefania", 20, 9.5);
$mi_alumno1->Mostrar();

$mi_alumno2 = new Alumno(1235, "Nacho", "Monte", 19, 9.5);
$mi_alumno2->Mostrar();

$mi_profe1 = new Profesor("Maria", "Gomez", 35, "Matematica");
$mi_profe2 = new Profesor("Juan", "Perez", 40, "Historia");

/*$ArregloAlumnos = []; // arrays de objetos

if ($mi_alumno1->esMayotEdad() == true) {
    $ArregloAlumnos[] = $mi_alumno1;
} 

if ($mi_alumno2->esMayotEdad() == true) {
    $ArregloAlumnos[] = $mi_alumno2;
}

echo "Alumnos mayores de edad: ";
foreach ($ArregloAlumnos as $alumno) { // foreach para recorrer el array de objetos y mostrar el nombre y apellido de cada alumno mayor de edad
    echo $alumno->getNombre() . " " . $alumno->getApellido() . "\n";
}*/

$mi_curso = new Curso("6to A");
$mi_curso->AgregarAlumno($mi_alumno1);
$mi_curso->AgregarAlumno($mi_alumno2);
$mi_curso->AgregarProfesor($mi_profe1);
$mi_curso->AgregarProfesor($mi_profe2);
echo "Curso: " . $mi_curso->getNombre() . "\n";
echo "Alumnos: " . "\n";
$mi_curso->mostrarAlumnos();
echo "Profesores: " . "\n";
$mi_curso->mostrarProfesores();

// usar archivo JSON para guardar los datos de los alumnos y profesores 

$ruta = __DIR__ . "/Alumnos_Profes.json"; // aca encuantra la ruta exacta del archivo json, en este caso Alumnos_Profes.json

/*$json1 = json_encode($mi_alumno1); // json_encode para convertir el objeto alumno1 a formato json de PHP a JSON
$json2 = json_encode($mi_alumno2);
$json3 = json_encode($mi_profe1);
$json4 = json_encode($mi_profe2);

json_decode para convertir el json a formato de PHP de JSON a PHP
$alumno1_json = json_decode($json1);

file_put_contents("Alumnos_Profes.json", $json1 . $json2 . $json3 . $json4); // file_put_contents para guardar el json en un archivo llamado Alumnos_Profes.json
file_get_contents("Alumnos_Profes.json"); // file_get_contents para leer el contenido del archivo */  

$datos = []; // aca creo el arreglo con los datos para el json futuro, el metodo jsonSerialize() se llama solo y sirve para convertir en json al objeto PHP
$datos[] = $mi_alumno1;
$datos[] = $mi_alumno2;
$datos[] = $mi_profe1;
$datos[] = $mi_profe2;

$json = json_encode($datos, JSON_PRETTY_PRINT); // json_encode para convertir el array de objetos a formato json, de PHP a JSON
file_put_contents($ruta, $json); // file_put_contents para guardar el json en un archivo llamado Alumnos_Profes.json, la variable ruta contiene la ruta del archivo json

echo "Archivo guardado en: " . $ruta;
?>