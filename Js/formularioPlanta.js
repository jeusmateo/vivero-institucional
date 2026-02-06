async function autocompletarTrefle() {
    const nombreInput = document.getElementById('nombreCientifico');
    const query = nombreInput.value;
    
    if(!query) {
        alert("Escribe un nombre científico primero (Ej: Delonix regia)");
        return;
    }

    nombreInput.style.backgroundColor = "#e8f0fe";
    document.body.style.cursor = "wait";
    
    try {
        const res = await fetch(`Php/api_trefle.php?q=${query}`);
        const json = await res.json();

        if (json.data && json.data.length > 0) {
            const planta = json.data[0];
            
            // 1. NOMBRE CIENTÍFICO (Corregimos mayúsculas/escritura)
            document.getElementById('nombreCientifico').value = planta.scientific_name;

            // 2. FAMILIA (Manejo robusto: Objeto o Texto)
            const inputFamilia = document.getElementById('nombreFamiliaTexto');
            if (inputFamilia) {
                let fam = "Desconocida";
                if (planta.family) {
                    // Si Trefle manda objeto {id:..., name:'Fabaceae'} o string 'Fabaceae'
                    fam = (typeof planta.family === 'object' && planta.family.name) ? planta.family.name : planta.family;
                }
                inputFamilia.value = fam;
            }

            // 3. IMAGEN (Si existe)
            if (planta.image_url) {
                const previewDiv = document.getElementById("preview");
                previewDiv.innerHTML = `<img src="${planta.image_url}" style="max-width:100%; height:auto; border-radius:5px;" alt="Trefle Image">`;
                
                const inputOculto = document.getElementById('trefle_image_url');
                if (inputOculto) inputOculto.value = planta.image_url;
                
                file = null; // Limpiamos selección manual previa
            }
            
            // NOTA: Descripción y Usos NO se tocan, se dejan para llenado manual.
            alert("¡Datos básicos cargados de Trefle!\n(Nombre, Familia e Imagen)");

        } else {
            alert("No se encontró esa planta en Trefle.");
        }
    } catch (e) {
        console.error(e);
        alert("Error consultando Trefle.");
    } finally {
        nombreInput.style.backgroundColor = "white";
        document.body.style.cursor = "default";
    }
}