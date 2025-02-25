<?php
class Multimedia extends Documento {
    private $soporte;

    public function __construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, $soporte) {
        parent::__construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, 'multimedia');
        $this->soporte = $soporte;
    }
}