<?php
class Libro extends Documento {
    private $num_paginas;

    public function __construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, $num_paginas) {
        parent::__construct($id, $titulo, $lista_autores, $fecha_publicacion, $num_ejemplares, $descripcion, $materia, 'libro');
        $this->num_paginas = $num_paginas;
    }
}
