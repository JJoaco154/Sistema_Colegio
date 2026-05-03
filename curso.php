<?php

require_once "Alumno.php";
require_once "Profe.php";
class Curso {
    private string $nombre;
    private array $ArrayAlumnos = [];

    private array $ArrayProfesores = [];

    function __construct($nombre){
        $this->nombre = $nombre;
        $this->ArrayAlumnos = [];
        $this->ArrayProfesores = [];
    }
    function getNombre() {
        return $this->nombre;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function AgregarAlumno($alumno){
        $this->ArrayAlumnos[] = $alumno;
    }

    function AgregarProfesor($profesor){
        $this->ArregloProfesores[] = $profesor;
    }

    /*function eliminarAlumno($alumno){
        foreach ($this->ArrayAlumnos as $key => $value) {
            if ($value->getLegajo() == $alumno->getLegajo()) {
                unset($this->ArrayAlumnos[$key]); // unset para eliminar el alumno del array
            }
        }
    }*/

    function mostrarAlumnos(){
        foreach ($this->ArrayAlumnos as $alumno){
            echo $alumno->getNombre() . " " . $alumno->getApellido() . " " . $alumno->getLegajo() . "\n";
        }
    }
    function mostrarProfesores(){
        foreach ($this->ArrayProfesores as $profesor){
            echo $profesor->getNombre() . " " . $profesor->getApellido() . " " . $profesor->getMateria() . "\n";
        }
    }
}
?>