<?php

class MarcaView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showMarcas($marcas) {
        $count = count($marcas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/lista_tareas.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

}
