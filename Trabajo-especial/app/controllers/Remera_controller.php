<?php
require_once 'app/controllers/Marca_controller.php';
require_once 'app/model/remera_model.php';
require_once 'app/view/remera_view.php';

class RemeraController {
    private $remeraModel;
    private $remeraView;
    private $marcaController;

    // public function __construct(){
    //     $this -> remeraModel = new Remeramodel();
    //     $this -> remeraView = new Remera_view();
    //     $this -> marcaController = new Marca_controller();
    // }

    public function showHome(){
        $remeras = $this -> remeraModel -> findAll(); // Aquí era $remeraModel
        $this -> remeraView -> showHome($remeras);
    }

    public function showProducts($id){
        $remeras = $this -> remeraModel -> getById($id); // Aquí era $remeraModel
        if(!$remeras){
            echo "no existe";
        }
        else{
            var_dump($remeras);
            $marca = $this -> marcaController -> getById($remeras -> id_marca);
        }
    }
}


?>