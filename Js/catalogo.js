// Archivo: Js/catalogo.js
const controladorUrl = "Php/buscarSolr.php"; 
const carpeta_fotos = 'data/'; 

window.onload = function () {
    cargarCatalogo(""); 
};

function buscarPlantas(event) {
    event.preventDefault(); 
    const input = document.getElementById('barrabusqueda');
    const termino = input.value.trim();
    cargarCatalogo(termino);
}

async function cargarCatalogo(terminoBusqueda) {
    const contenedor = document.getElementById('cardContainer');
    contenedor.innerHTML = '<div style="width:100%; text-align:center; padding:20px;">Cargando catálogo...</div>';

    try {
        let url = controladorUrl;
        if (terminoBusqueda) {
            url += `?q=${encodeURIComponent(terminoBusqueda)}`;
        }

        const respuesta = await fetch(url);
        const datos = await respuesta.json(); 

        contenedor.innerHTML = "";

        if (!datos || datos.length === 0) {
            contenedor.innerHTML = '<h3 style="text-align:center; width:100%;">No se encontraron resultados</h3>';
            return;
        }

        datos.forEach(planta => {
            // --- 1. LIMPIEZA DE DATOS (Solr Arrays) ---
            let id = Array.isArray(planta.id_arbol) ? planta.id_arbol[0] : (planta.id_arbol || planta.id);
            let nombreComun = Array.isArray(planta.nombre_comun) ? planta.nombre_comun[0] : planta.nombre_comun;
            let nombreCientifico = Array.isArray(planta.nombre_cientifico) ? planta.nombre_cientifico[0] : planta.nombre_cientifico;
            let nombreImagen = Array.isArray(planta.nombre_imagen) ? planta.nombre_imagen[0] : planta.nombre_imagen;
            
            // Limpieza de ID
            id = id.toString().split('_').pop();

            // Imagen
            let imagenSrc = (!nombreImagen || nombreImagen === 'RSULogo.png') 
                            ? 'Recursos/img/RSULogo.png' 
                            : carpeta_fotos + nombreImagen;

            // Títulos: SIEMPRE Común arriba, Científico abajo
            const titulo = nombreComun ? nombreComun : nombreCientifico;
            const subtitulo = nombreCientifico; 

            // --- 2. PLANTILLA HTML ---
            const card = document.createElement('div');
            card.classList.add('card'); 

            card.innerHTML = `
                <div style="width:100%; height:150px; overflow:hidden;">
                    <img src="${imagenSrc}" style="width:100%; height:100%; object-fit:cover;" 
                         alt="${titulo}" 
                         onerror="this.onerror=null; this.src='Recursos/img/RSULogo.png';">
                </div>
                
                <h3>${titulo}</h3>
                
                <p style="font-size:0.9rem; color:#555; margin:5px 0;"><i>${subtitulo}</i></p>
                
                <div style="padding-bottom:15px; margin-top:10px;">
                     <button onclick="location.href='ficheroPlanta.php?id=${id}'" 
                            style="margin-bottom:5px; background-color:#002E5F; color:white; border:none; padding:8px 15px; border-radius:4px; cursor:pointer; font-weight:bold;">
                        Ver Ficha
                    </button>
                </div>
            `;
            contenedor.appendChild(card);
        });

    } catch (error) {
        console.error("Error:", error);
        contenedor.innerHTML = '<p style="color:red; text-align:center;">Error de conexión.</p>';
    }
}