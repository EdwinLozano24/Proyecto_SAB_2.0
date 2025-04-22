<?php 
//Incluimos los archivos necesarios
require_once "Model/User.php";
//Creamos la clase 'LoginController'
class LoginController
{
    //Creamos los metodos de la clase
    //Creamos el metodo 'LoginView' encargado de direccionar a la vista por defecto de la clase.
    public function LoginView()
    {
        $db = database::conect();
        require_once "View/Login/Login.php"; 
    }
    //Creamos el metodo 'LoginValidar' encargado de asignar, redirigir los datos proporcionados.
    public function LoginValidar()
    {
        $NumDocumento = $_POST['documento'];
        $Password = $_POST['password'];

        $UserModel = new User();
        $ValidUser = $UserModel->VerifyCredentials($NumDocumento, $Password);

        if ($ValidUser) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Usuario o contraseña incorrectos"]);
        }
    }

}