<?php
class Documento {
    protected $id;
    protected $titulo;
    protected $lista_autores;
    protected $fecha_publicacion;
    protected $num_ejemplares;
    protected $descripcion;
    protected $materia;
    protected $tipo;

    public function __construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, $tipo) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->lista_autores = $lista_autores;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->num_ejemplares = $num_ejemplares;
        $this->descripcion = $descripcion;
        $this->materia = $materia;
        $this->tipo = $tipo;
    }

    public function __get($propiedad) {
        return $this->$propiedad ?? "Propiedad no encontrada";
    }

    public function __set($propiedad, $valor) {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }

    public function __toString() {
        return "Título: $this->titulo, Autor(es): $this->lista_autores, Tipo: $this->tipo";
    }
}

// COMO LLAMARLAS
// Crear un objeto
// $persona = new Persona("Carlos", 30, "12345678A");

// // Usar __toString
// echo $persona . "<br>";

// // Usar __get para acceder a un atributo privado
// echo "DNI: " . $persona->dni . "<br>";

// // Usar __set para modificar un atributo privado
// $persona->dni = "87654321B";
// echo "Nuevo DNI: " . $persona->dni . "<br>";

// // Destruir el objeto manualmente (opcional)
// unset($persona);

// RECORDEMOS QUE PAA LLAMAR A LOS GET O SET  SE USA LA FLECHITA, O SEA LA FLECHITA SE USA PARA LLAMAR
// A TRIBUTOS Y FUNCIONES, EJ DE FUNCIONES:
// echo $persona->decirHola(); // Hola, soy Carlos