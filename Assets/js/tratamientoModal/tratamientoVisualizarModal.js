
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("tratamientoModal");
    const closeBtn = document.querySelector(".modal-close");

    // Cuando hacen clic en Ver más
    document.querySelectorAll(".btn-vermas").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.getAttribute("data-id");

            fetch(`/views/paciente/tratamiento/tratamientoShow.php?id=${id}`)
                .then(res => res.json())
                .then(data => {
                    console.log("Respuesta del servidor:", data); // 👈 Debug
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    document.getElementById("modal-nombre").textContent = data.trat_nombre;
                    document.getElementById("modal-categoria").textContent = data.trat_categoria;
                    document.getElementById("modal-descripcion").textContent = data.trat_descripcion;
                    document.getElementById("modal-duracion").textContent = data.trat_duracion;
                    document.getElementById("modal-riesgos").textContent = data.trat_riesgos;
                    document.getElementById("modal-complejidad").textContent = data.trat_complejidad;
                    document.getElementById("modal-estado").textContent = data.trat_estado;

                    modal.style.display = "block";
                })
                .catch(err => console.error("Error en el fetch:", err));

        });
    });
    // Cerrar modal
    closeBtn.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });
});

