<?php
//Inicia una 'session' respuesta a URL logout
session_start();
if (isset($_GET['logout']))
{
    session_destroy();
    header('location: views/usuario/login.php');
}

//Vista por defecto del usuario (Login)
<<<<<<< HEAD
header('location: views/usuario/login.php');
=======
header('location: views/usuario/loginPaciente.php');
>>>>>>> d557cec7b510a167ad337177493a34bb5edbeda5
