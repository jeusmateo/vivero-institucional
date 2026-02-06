// Ajustamos las rutas relativas desde app/Views/admin/
const RUTA_API = "../../Helpers/obtener_plantas.php";
const RUTA_IMAGENES = "../../public/img/";

window.onload = function () {
    // Al cargar la página, traemos todas las plantas (búsqueda vacía)
    cargarPlantas("");
};

function buscarPlantas(event) {
    event.preventDefault();
    const searchTerm = document.getElementById('barrabusqueda').value.trim();
    cargarPlantas(searchTerm);
}

function cargarPlantas(searchTerm) {
    // Si hay término de búsqueda, lo enviamos a la API
    const url = searchTerm 
        ? `${RUTA_API}?search=${encodeURIComponent(searchTerm)}` 
        : RUTA_API;

    console.log("Consultando API Admin en:", url);

    ejecutarPeticion(url, function (xhttp) {
        try {
            const listaPlantas = JSON.parse(xhttp.response);
            const cardContainer = document.getElementById('cardContainer');
            cardContainer.innerHTML = "";

            if (listaPlantas.length === 0) {
                cardContainer.innerHTML = "<p>No se encontraron plantas.</p>";
                return;
            }

            listaPlantas.forEach(function (planta) {
                const newCard = document.createElement('div');
                newCard.classList.add('card');

                const image = document.createElement('img');
                // Ruta correcta de la imagen
                image.setAttribute("src", RUTA_IMAGENES + planta.nombre_imagen);
                image.setAttribute("width", "270px");
                image.setAttribute("height", "150px");
                image.setAttribute("alt", planta.nombre_cientifico);
                
                // Evitamos el bucle infinito y ponemos el logo si falla
                image.onerror = function() { 
                    this.onerror = null; 
                    this.src = '../../public/img/RSULogo.png'; 
                };

                const plantName = document.createElement('h3');
                plantName.textContent = planta.nombre_cientifico;

                newCard.appendChild(image);
                newCard.appendChild(plantName);

                // Al hacer click, llevamos al formulario de edición
                // Nota: Asegúrate de que formularioPlantas.php esté en la misma carpeta (app/Helpers/)
                newCard.onclick = function () {
                location.href = "../../Helpers/formularioPlantas.php?accion=editar&id=" + planta.id_arbol;
                };
                cardContainer.appendChild(newCard);
            });
        } catch (e) {
            console.error("Error al procesar JSON en admin:", e);
            console.log("Respuesta bruta:", xhttp.response);
        }
    });
}