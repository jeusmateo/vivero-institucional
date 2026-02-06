<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../../public/Css/inicioSesion.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <script>
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
</script>
</head>

<body>
<div class="contenedor">
    <div class="caja-login">
        <h2>Iniciar Sesión</h2>
        <!-- Mensaje de estado -->
        <div id="estado" class="mensaje-estado"></div>
        <form action="../../Helpers/validador.php" method="post" name="forma">
            <div class="contenedor-input">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="contenedor-input">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
            </div>
            <div class="contenedor-recordar">
                <input type="checkbox" id="recordarUsuario" name="recordarUsuario">
                <label for="recordarUsuario">Recordar Usuario</label>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
            <p class="enlace-registro">Regresar al inicio <a href="../home/index.html">Inicio</a></p>
        </form>
    </div>
</div>
</body>
</html>