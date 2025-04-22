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

    public function register() {
        // Verificamos si el formulario fue enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nombre = $_POST['nombre'] ?? '';
                $documento = $_POST['documento'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
    
                $user = new User();
                $user->create($nombre, $documento, $email, $password);
                
                // Mostrar mensaje de éxito y redirigir después
                echo "<script type='text/javascript'>
                        alert('¡Usuario creado exitosamente!');
                        setTimeout(function(){
                            window.location.href = 'index.php?c=login&a=loginView';
                        }, 500);  // Redirige después de 2 segundos
                      </script>";
                exit;  // Termina la ejecución del script para evitar duplicados
            } catch (Exception $e) {
                // Si ocurre un error, mostrar el mensaje de error
                echo "<script type='text/javascript'>
                        alert('" . addslashes($e->getMessage()) . "');
                        window.location.href = 'index.php?c=login&a=loginView';
                      </script>";
                exit;
            }
        }
    }
}    
    


