<?php
function showProductos(){
    $db = new PDO('mysql:host=localhost;dbname=gestionproductos;charset=utf8','root', '');

    $query = $db ->prepare('SELECT * FROM productos');
    $query -> execute();

    $productos = $query->fetchAll(PDO::FETCH_OBJ);

    echo "<ul>";
    echo "<pre>";
    var_dump($productos); 
    echo "</pre>";

}
echo "<h1> BASE DE DATOS + PHP </h1>"; 
showProductos(); 


