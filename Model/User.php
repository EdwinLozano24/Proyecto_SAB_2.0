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
    public function create($nombre, $documento, $email, $password)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=db_sab_final;charset=utf8', 'root', '');
        $stmt = $pdo->prepare("INSERT INTO tbl_pacientes (paci_nombre, paci_num_documento, paci_correo_electronico, paci_contraseña) VALUES (?, ?, ?, ?)");
        //$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->execute([$nombre, $documento, $email, $password]);
    }
}