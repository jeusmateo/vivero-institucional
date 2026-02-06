const ruta_imagenes = '../../public/data/'; 

const RUTA_API = "../../Helpers/obtener_plantas.php"; 

window.onload = function () {
    cargarPlantas("");
};

function buscarPlantas(event) {
    event.preventDefault();
    const searchTerm = document.getElementById('barrabusqueda').value.trim();
    cargarPlantas(searchTerm);
}

function cargarPlantas(searchTerm) {
    // Construir la URL con o sin búsqueda
    const url = searchTerm 
        ? `${RUTA_API}?search=${encodeURIComponent(searchTerm)}` 
        : RUTA_API;

    console.log("Consultando API en:", url); 

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
                
                // Intentamos cargar la imagen real
                image.setAttribute("src", ruta_imagenes + planta.nombre_imagen);
                image.setAttribute("width", "270px");
                image.setAttribute("height", "150px");
                image.setAttribute("alt", planta.nombre_cientifico);

                // --- AQUÍ ESTÁ LA SOLUCIÓN AL LOOP ---
                image.onerror = function() { 
                    // 1. IMPORTANTE: Anulamos el evento para que no se repita infinitamente
                    this.onerror = null; 
                    
                    // 2. Ponemos una imagen que SABEMOS que existe (el logo de RSU)
                    // Si prefieres usar placeholder.png, asegúrate de crear ese archivo en esa carpeta
                    this.src = '../../public/img/RSULogo.png'; 
                }; 
                // -------------------------------------

                const plantName = document.createElement('h3');
                plantName.textContent = planta.nombre_cientifico; 

                newCard.appendChild(image);
                newCard.appendChild(plantName);

                newCard.onclick = function () {
                    // Ajusta si tu archivo ficheroPlanta está en otra ruta
                    location.href = "../ficheroPlanta.php?id=" + planta.id_arbol;
                }
                cardContainer.appendChild(newCard);
            });
        } catch (e) {
            console.error("Error al procesar JSON:", e);
            console.log("Respuesta del servidor:", xhttp.response);
        }
    });
}