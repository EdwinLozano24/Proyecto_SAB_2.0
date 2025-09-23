// ===============================
// Declaración de variables
// ===============================
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

// Ajusta las cajas al cargar
ajustarCajas();

// Eventos de los botones
document.getElementById("btn__registrarse").addEventListener("click", register);
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);

// ===============================
// Funciones
// ===============================

// Ajusta solo las cajas traseras según el tamaño de pantalla
function ajustarCajas() {
    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

// Mostrar formulario de login
function iniciarSesion() {
    formulario_login.style.display = "block";
    formulario_register.style.display = "none";
    contenedor_login_register.style.left = "0px";

    if (window.innerWidth > 850) {
        contenedor_login_register.style.left = "10px";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

// Mostrar formulario de registro
function register() {
    formulario_register.style.display = "block";
    formulario_login.style.display = "none";
    contenedor_login_register.style.left = "0px";

    if (window.innerWidth > 850) {
        contenedor_login_register.style.left = "410px";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}