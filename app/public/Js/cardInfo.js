const cardList = [];

// se podrían añadir más atributos para crear al objeto
function CardInfo(title, image) {
    this.title = title;
    this.image = image;

    this.saveCardInfo = alertCardInfo;

    console.log("Objeto Carta creado");
    console.log(this);
}

function alertCardInfo() {
    console.log("Informacion de carta establecida");
    alert("Titulo: " + this.title + " Imagen: " + this.image);
}

function addCard() {
    const newCard = document.createElement('div');
    newCard.classList.add('card'); //agregar clase card a la nueva carta

    var image = document.createElement('img');
    image.setAttribute("src", "./Recursos/img/houseplant-7367379_1280.jpg");
    image.setAttribute("width", "270px");
    image.setAttribute("height", "150px");
    image.setAttribute("alt", "Flower");

    var plantName = document.createElement('h3');
    plantName.textContent = 'Carta';

    newCard.appendChild(image);
    newCard.appendChild(plantName);

    document.getElementById('cardContainer').appendChild(newCard);
}

function addCategory() {
    //<input type="button" value="Default" class="botonSeccion"></button>
    const newCategory = document.createElement('input');
    newCategory.classList.add('botonSeccion');

    newCategory.setAttribute("type", "button");
    newCategory.setAttribute("value", "Default");

    document.getElementById('seccionScroller').appendChild(newCategory);
}