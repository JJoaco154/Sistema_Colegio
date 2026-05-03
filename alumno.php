<?php
require_once __DIR__ . "/Persona.php"; // requiere_once sirve para incluir el archivo que contiene la clase Persona
require_once __DIR__ . "/Mostrable.php"; // requiere_once sirve para incluir el archivo que contiene la interfaz Mostrable
require_once __DIR__ . "/Evaluable.php"; // __DIR__ para obtener la ruta del directorio actual y concatenar con el nombre del archivo evaluavle.php para incluirlo y no genere error
require_once "conexion.php";
class Alumno extends Persona implements Evaluable, Mostrable, JsonSerializable { // la clase Alumno hereda de la clase Persona e implementa la interfaz Evaluable
    private int $legajo;
    private float $notaFinal;

    function __construct($legajo, $nombre, $apellido, $edad, $notaFinal) {
        $this->legajo = $legajo;
        parent::__construct($nombre, $apellido, $edad); // llama al constructor de la clase padre (Persona) para inicializar los atributos heredados
        $this->notaFinal = $notaFinal;
    }

    function getLegajo() {
        return $this->legajo;
    }

    function getNotaFinal() {
        return $this->notaFinal;
    }

    function setLegajo($legajo) {
        $this->legajo = $legajo;
    }
    function setNotaFinal($notaFinal) {
        $this->notaFinal = $notaFinal;
    }
    function aprobo() { // implementación del método aprobo() de la interfaz Evaluable
        if ($this->notaFinal >= 7){
            return "Aprobo crack";
        } else {
            return "No aprobo burro";
        }
    }
    function mostrar() { // implementación del método mostrar() de la interfaz Mostrable
        echo "Legajo: " . $this->legajo . "\n";
        echo "Nombre: " . $this->getNombre() . "\n"; // llama al método getNombre() de la clase padre (Persona) para obtener el nombre del alumno
        echo "Apellido: " . $this->getApellido() . "\n";
        echo "Edad: " . $this->getEdad() . "\n";
        echo "Nota Final: " . $this->aprobo() . "\n";
    }

    function esMayotEdad() {
        if ($this->getEdad() >= 18) {
            return true;
        } else {
            return false;
        }
    }

    public function jsonSerialize(): mixed { // implementación del método jsonSerialize() de la interfaz JsonSerializable para convertir el objeto Alumno a formato JSON
        return [
            "legajo" => $this->legajo,
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellido(),
            "edad" => $this->getEdad(),
            "notaFinal" => $this->notaFinal
        ];
    }

    public function conectarAlumnoBaseDeDatos($conexion) { // implementación del método conectarBaseDeDatos() de la interfaz Conectable para establecer una conexión con la base de datos
    
        $conexion->query("call insertarAlumno({$this->getLegajo()}, '{$this->getNombre()}', '{$this->getApellido()}', {$this->getEdad()}, {$this->getNotaFinal()}, @id_alumno)"); // ejecuta una consulta para insertar un nuevo alumno en la base de datos utilizando un procedimiento almacenado llamado insertarAlumno, pasando los valores de los atributos del objeto Alumno como parámetros de entrada y un parámetro de salida @id_alumno para obtener el id del alumno insertado
        $resultado = $conexion->query("SELECT @id_alumno as id_alumno"); // ejecuta una consulta para obtener el valor del parámetro de salida @id_alumno que contiene el id del alumno insertado en la base de datos
        $fila = $resultado->fetch_assoc(); // obtiene la fila del resultado de la consulta como un array asociativo y asigna el valor del campo id_alumno a la variable $idAlumno para poder usarlo posteriormente en el código
        $idAlumno = $fila['id_alumno']; // muestra el id del alumno insertado en la base de datos
        
        return $idAlumno; // devuelve el id del alumno insertado en la base de datos para poder usarlo posteriormente en el código
    }
}

?>