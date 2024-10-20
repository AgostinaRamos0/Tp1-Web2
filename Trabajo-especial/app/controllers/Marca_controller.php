<?php
require_once 'app/model/marca.model.php';
require_once 'app/view/marca.view.php';

class MarcaController{
    private $model;
    private $view;

    public function __construct($res){
        $this->model = new MarcaModel();
        $this->view = new MarcaView($res->user);
    }

    public function showHome(){
        $marca = $this->model->getMarcas();

        //mando las tareas a la vista
        return $this->view->showMarcas($marca);

    }

    // public function showMarcaDetail($ID_Marca){
    //     $marca = $this->model->getMarca($ID_Marca); 
    //     $this->view->showMarcaDetails($marca);
    // }

   
    public function addMarcas(){
         if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showError("Falta completar el nombre");
        }
        if (!isset($_POST['ID_Marcas']) || empty($_POST['ID_Marcas'])) {
            return $this->view->showError("Falta completar el id");
        }

        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError("falta completar descripcion");
        }

     
        $name = $_POST['name'];
        $ID_Marcas = $_POST['ID_Marcas'];
        $descripcion= $_POST['descripcion'];
        

        $id = $this->model->insertMarca($name,$ID_Marcas,$descripcion);

        // redirijo al home
        header('Location: ' . BASE_URL);

    }

    public function deleteMarca($id){
    //obtener marca por id
    $marca = $this->model->getMarca($id); 

    if (!$marca) {
        return $this->view->showError("No existe=$id");
    }

    //borro y redirijo
    $this->model->eraseMarca($id);

    header('Location: ' . BASE_URL);
    }
    public function finish($id) {
    $marca = $this->model->getMarca($id);

    if (!$marca) {
        return $this->view->showError("No existe =$id");
    }

    // actualiza 
    $this->model->updateMarca($id);

    header('Location: ' . BASE_URL);
    }
}


