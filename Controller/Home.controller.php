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
        $db = database::conect();
        require_once "View/Home/home.php";
    }
}