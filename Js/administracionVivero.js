// Archivo: Js/administracionVivero.js
const carpeta_fotos = 'data/'; 

window.onload = function () {
    cargarPlantas(""); 
};

function buscarPlantas(event) {
    event.preventDefault();
    const searchTerm = document.getElementById('barrabusqueda').value.trim();
    cargarPlantas(searchTerm);
}

function cargarPlantas(searchTerm) {
    const url = searchTerm ? `Php/leer.php?search=${encodeURIComponent(searchTerm)}` : "Php/leer.php";
    
    ejecutarPeticion(url, function (xhttp) {
        let listaPlantas = [];
        try {
            listaPlantas = JSON.parse(xhttp.response);
        } catch (e) { console.error(e); return; }

        const contenedor = document.getElementById('cardContainer');
        contenedor.innerHTML = "";
        
        if (!listaPlantas || listaPlantas.length === 0) {
            contenedor.innerHTML = "<p style='text-align:center; width:100%; margin-top:20px;'>No se encontraron plantas.</p>";
            return;
        }

        listaPlantas.forEach(function (planta) {
            // --- 1. PREPARACIÓN DE DATOS ---
            let id = planta.id_arbol;
            let nombreImagen = planta.nombre_imagen;
            
            // Imagen
            let imagenSrc = (!nombreImagen || nombreImagen === 'RSULogo.png') 
                            ? 'Recursos/img/RSULogo.png' 
                            : carpeta_fotos + nombreImagen;

            // Títulos: IGUAL QUE EN EL CATÁLOGO (Común arriba, Científico abajo)
            const titulo = planta.nombre_comun ? planta.nombre_comun : planta.nombre_cientifico;
            const subtitulo = planta.nombre_cientifico;

            // --- 2. PLANTILLA HTML (Idéntica al Catálogo) ---
            const newCard = document.createElement('div');
            newCard.classList.add('card'); 

            newCard.innerHTML = `
                <div style="width:100%; height:150px; overflow:hidden;">
                    <img src="${imagenSrc}" style="width:100%; height:100%; object-fit:cover;" 
                         alt="${titulo}"
                         onerror="this.onerror=null; this.src='Recursos/img/RSULogo.png';">
                </div>
                
                <h3>${titulo}</h3>
                
                <p style="font-size:0.9rem; color:#555; margin:5px 0;"><i>${subtitulo}</i></p>
                
                <div style="margin-top:10px;">
                     <button onclick="location.href='ficheroPlanta.php?id=${id}'" 
                            style="background-color:#002E5F; color:white; border:none; padding:8px 15px; border-radius:4px; cursor:pointer; font-weight:bold;">
                        Ver Ficha
                    </button>
                </div>

                <div style="padding-bottom:15px; display:flex; justify-content:center; gap:10px; margin-top:10px; border-top: 1px solid #eee; padding-top: 10px;">
                    <button onclick="location.href='formularioPlantas.php?accion=editar&id=${id}'" 
                            style="background-color:#28a745; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer; font-size: 0.8rem;">
                        ✏️ Editar
                    </button>
                    
                    <button onclick="confirmarEliminar(${id}, '${planta.nombre_cientifico.replace(/'/g, "\\'")}')" 
                            style="background-color:#dc3545; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer; font-size: 0.8rem;">
                        🗑️ Borrar
                    </button> 
                </div>
            `;
            
            contenedor.appendChild(newCard);
        });
    });
}

function confirmarEliminar(id, nombre) {
    if (confirm(`¿Eliminar "${nombre}"? Esta acción borrará la imagen y la quitará del catálogo.`)) {
        window.location.href = `Php/eliminarPlanta.php?id=${id}`;
    }
}