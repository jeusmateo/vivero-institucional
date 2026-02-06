function ejecutarPeticion(url, accion) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            accion(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}