<?php

class HomeController
{
    private $model;

    public function __construct()
    {
        //$this->model = new Ejemplo();
    }
    
    public function Home()
    {

    
  
    
        // Conectar a la base de datos (si es necesario)
        $db = database::conect();
    
        // Cargar la vista de Home (esta vista debe existir en "View/Home/home.php")
        require_once "View/Home/home.php";
    }
}    