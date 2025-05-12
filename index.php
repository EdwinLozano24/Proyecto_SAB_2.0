<?php
//Inicia una 'session' respuesta a URL logout
session_start();
if (isset($_GET['logout']))
{
    session_destroy();
    header('location: views/usuario/login.php');
}

//Vista por defecto del usuario (Login)
header('location: views/usuario/login.php');
