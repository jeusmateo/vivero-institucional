// Tu lógica JS original se mantiene casi igual
    const mensajePHP = "<?php echo $mensaje; ?>";
    document.addEventListener("DOMContentLoaded", function () {
        const panelEstado = document.getElementById("estado");
        const inputUsuario = document.getElementById("usuario");
        const checkboxRecordar = document.getElementById("recordarUsuario");

        // Ocultar mensaje con timer
        if (panelEstado.textContent.trim() !== "") {
            setTimeout(() => {
                panelEstado.style.opacity = "0";
                panelEstado.style.transition = "opacity 1s ease";
            }, 3000);
        }

        // LocalStorage Logic
        const usuarioGuardado = localStorage.getItem("usuarioRecordado");
        if (usuarioGuardado) {
            inputUsuario.value = usuarioGuardado;
            checkboxRecordar.checked = true;
        }

        document.forms["forma"].addEventListener("submit", function () {
            if (checkboxRecordar.checked) {
                localStorage.setItem("usuarioRecordado", inputUsuario.value);
            } else {
                localStorage.removeItem("usuarioRecordado");
            }
        });
    });