<?php
//Creamos la clase 'User'
class User
{
    //Definimos atributos
    private $pdo;
    //Generamos metodos
    public function __construct() 
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=db_sab_final;charset=utf8", "root", "");
    }
    
    public function VerifyCredentials($NumDocumento, $Password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_pacientes WHERE paci_num_documento = ? AND paci_contraseña = ?");
        $stmt->execute([$NumDocumento, $Password]);
        return $stmt->fetch() !== false;
    }
}