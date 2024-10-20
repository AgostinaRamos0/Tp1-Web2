<?php

class UserModel {
    private $db; 

    public function __contruct(){
        $this->db = new PDO('mysql:host=localhost;dbname=gestionproductos;charset=utf8','root', '');
    }

    public function getUserByEmail($email){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?'); 
        $query->execute([$email]); 

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user; 
    }
}