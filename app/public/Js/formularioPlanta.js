let file = null;

document.getElementById("dropZone").ondragover = function (ev) {
    ev.preventDefault();
    console.log("Arrastrando sobre la zona de drop");
}

document.getElementById("dropZone").ondrop = function (ev) {
    ev.preventDefault();
    console.log("Archivo arrastrado");

    // Verificar si hay más de un archivo
    if (ev.dataTransfer.files.length > 1) {
        alert("Solo se permite un archivo.");
        return;
    }

    // Verificar que sea una imagen
    if (!(ev.dataTransfer.files[0].type.startsWith("image/"))) {
        console.log("Fichero rechazado");
        alert("El archivo no es una imagen");
        return;
    }

    file = ev.dataTransfer.files[0];

    manageDroppedImage();
}

document.getElementById("plantaForm").onsubmit = function (ev) {
    const existingImage = document.querySelector("#preview>img");

    if (!file && !existingImage) {
        ev.preventDefault();
        alert("Debes agregar una imagen antes de enviar el formulario.");
        return false;
    }

    inputData = document.getElementsByTagName("input");

    for (let i = 0; i < inputData.length; i++) {
        if (inputData[i].type == "text" && inputData[i].value == "") {
            ev.preventDefault();
            alert("Debes poner texto aqui");
            inputData[i].focus();
            return false;
        }
    }

    if (document.getElementById("descripcion").value === "") {
        ev.preventDefault();
        alert("Debes poner texto aqui");
        document.getElementById("descripcion").focus();
        return false;
    }

    return true;
}

function manageDroppedImage() {
    const previewDiv = document.getElementById("preview");
    previewDiv.innerHTML = "";

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            previewDiv.appendChild(img);
        };
        reader.readAsDataURL(file);
    }

    // Agregar el archivo al input oculto
    const fileInput = document.getElementById("fileInput");
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    fileInput.files = dataTransfer.files;
}