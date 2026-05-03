<?php

require_once __DIR__ . "/Persona.php"; 
require_once __DIR__ . "/Mostrable.php";

class Profesor extends Persona implements Mostrable, JsonSerializable {
    private string $materia;

    function __construct($nombre, $apellido, $edad, $materia) {
        parent::__construct($nombre, $apellido, $edad);
        $this->materia = $materia;
    }

    function getMateria() {
        return $this->materia;
    }

    function setMateria($materia){
        $this->materia = $materia;
    }
    function mostrar() { // implementación del método mostrar() de la interfaz Mostrable
        echo "Nombre: " . $this->getNombre() . "\n"; // llama al método getNombre() de la clase padre (Persona) para obtener el nombre del alumno
        echo "Apellido: " . $this->getApellido() . "\n";
        echo "Edad: " . $this->getEdad() . "\n";
        echo "Materia: " . $this->getMateria() . "\n";
    }

    public function jsonSerialize(): mixed {
        return [
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellido(),
            "edad" => $this->getEdad(),
            "materia" => $this->materia
        ];
    }

    public function conectarProfeBaseDeDatos($conexion) { // implementación del método conectarBaseDeDatos() de la interfaz Conectable para establecer una conexión con la base de datos     
        
        $conexion->query("call insertarProfe('{$this->getNombre()}', '{$this->getApellido()}', {$this->getEdad()}, '{$this->getMateria()}', @id_profesor)"); 
        $resultado = $conexion->query("SELECT @id_profesor as id_profesor"); 
        $fila = $resultado->fetch_assoc(); 
        $idProfesor = $fila['id_profesor']; 
        
        return $idProfesor; 
    }
}

?>