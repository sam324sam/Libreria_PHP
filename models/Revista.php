<?php
class Revista extends Documento {
    private $frecuencia;

    public function __construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, $frecuencia) {
        parent::__construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, 'revista');
        $this->frecuencia = $frecuencia;
    }
}