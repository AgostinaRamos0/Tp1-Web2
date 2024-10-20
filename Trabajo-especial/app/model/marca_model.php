<?php

class MarcaModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=gestionproductos;charset=utf8','root', '');
    }
 
    public function getMarcas() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $marca = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $marca;
    }
 
    public function getMarca($id) {    
        $query = $this->db->prepare('SELECT * FROM marcas WHERE id = ?');
        $query->execute([$id]);   
    
        $marca = $query->fetch(PDO::FETCH_OBJ);
    
        return $marca;
    }
 
    public function insertMarca($name, $description, $id, $finished = false) { 
        $query = $this->db->prepare('INSERT INTO marcas (nombre, descripcion, id, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$name, $description, $id, $finished]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraseMarca($id) {
        $query = $this->db->prepare('DELETE FROM marcas WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateMarca($id) {        
        $query = $this->db->prepare('UPDATE marcas SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }
}
