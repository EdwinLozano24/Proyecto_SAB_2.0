document.getElementById("btn__registrarse").addEventListener("click", register);
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
window.addEventListener("resize", anchoPantalla);

//declaracion de variables
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");


function anchoPantalla() {
    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
    }
}

anchoPantalla ();

function iniciarSesion() {

    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";

    }
}
//////////////////////////////////////////////////////////////////////////////////////////
document.getElementById("loginForm").addEventListener("submit", async function(e) {
    e.preventDefault(); // Evita envío tradicional

    const documento = document.getElementById("documento").value;
    const password = document.getElementById("password").value;

    const formData = new FormData();
    formData.append("documento", documento);
    formData.append("password", password);

    try {
        const response = await fetch("index.php?c=Login&a=LoginValidar", {
            method: "POST",
            body: formData
        });

        // Verifica si la respuesta fue exitosa
        if (!response.ok) {
            throw new Error('Error en la conexión al servidor');
        }

        const result = await response.json();

        if (result.success) {
            window.location.href = "index.php?c=Home&a=Home";
        } else {
            document.getElementById("error").innerText = result.message;
        }
    } catch (error) {
        document.getElementById("error").innerText = "Hubo un error en la solicitud: " + error.message;
    }
});
///////////////HISTORIAL
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab");
    const panel = document.querySelector(".panel-historial");
    const inputSintoma = document.getElementById("sintoma");
    const textareaNotas = document.getElementById("notas");
  
    // Crear contenedor extra para el contenido de tabs
    const infoExtra = document.createElement("div");
    infoExtra.className = "info-tab";
    panel.appendChild(infoExtra);
  
    const contenidoTabs = {
      "Resumen del paciente": "<p>Información general del paciente.</p>",
      "Condición del paciente": "<p>Diagnóstico actual y condiciones médicas.</p>",
      "Observaciones Médicas": "<p>Observaciones escritas por el médico.</p>",
      "Motivos del paciente": "<p>Razones de la consulta actual.</p>",
      "Ordenes Médicas": "<p>Medicamentos, exámenes u órdenes asignadas.</p>"
    };
  
    tabs.forEach(tab => {
      tab.addEventListener("click", () => {
        const titulo = tab.textContent;
        infoExtra.innerHTML = `
          <h2>${titulo}</h2>
          ${contenidoTabs[titulo] || "<p>Sin contenido disponible.</p>"}
        `;
      });
    });
  
    // Validación
    function validarCampos() {
      if (inputSintoma.value.trim() === "" || textareaNotas.value.trim() === "") {
        alert("Por favor, complete todos los campos.");
        return false;
      }
      return true;
    }
  
    // Guardado automático en localStorage
    inputSintoma.addEventListener("input", () => {
      localStorage.setItem("sintoma", inputSintoma.value);
    });
  
    textareaNotas.addEventListener("input", () => {
      localStorage.setItem("notas", textareaNotas.value);
    });
  
    inputSintoma.value = localStorage.getItem("sintoma") || "";
    textareaNotas.value = localStorage.getItem("notas") || "";
  
    // Manejo del envío del formulario
    const form = document.getElementById("form-historial");
  
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      if (validarCampos()) {
        alert("¡Formulario enviado correctamente!");
        form.reset();
        localStorage.removeItem("sintoma");
        localStorage.removeItem("notas");
      }
    });
  });
