// Obtener el formulario, el mensaje de éxito, el modal y el botón para ver mensajes
const form = document.getElementById('contactForm');
const successMessage = document.getElementById('successMessage');
const modal = document.getElementById('messagesModal');
const closeModalBtn = document.querySelector('.close-btn');
const viewMessagesBtn = document.getElementById('viewMessagesBtn');
const messagesList = document.getElementById('messagesList');

// Array para almacenar los mensajes enviados
const messages = [];

// Añadir un evento al formulario para que se envíe correctamente
form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto (recarga de página)

    // Obtener los valores de los campos
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    // Validar que los campos no estén vacíos
    if (name === '' || email === '' || message === '') {
        alert('Por favor, completa todos los campos.');
    } else {
        // Guardar el mensaje en el array
        messages.push({ name, email, message });

        // Mostrar el mensaje de éxito
        successMessage.style.display = 'block';

        // Limpiar el formulario
        form.reset();

        // Ocultar el mensaje después de 3 segundos
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 3000);
    }
});

// Función para mostrar el modal con los mensajes enviados
viewMessagesBtn.addEventListener('click', function() {
    // Limpiar el contenido del modal
    messagesList.innerHTML = '';

    // Agregar los mensajes al modal
    messages.forEach(msg => {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message-item');
        messageDiv.innerHTML = `<strong>${msg.name}</strong> (${msg.email})<p>${msg.message}</p>`;
        messagesList.appendChild(messageDiv);
    });

    // Mostrar el modal
    modal.style.display = 'block';
});

// Cerrar el modal cuando se hace clic en el botón de cerrar
closeModalBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});

// Cerrar el modal si el usuario hace clic fuera del contenido del modal
window.addEventListener('click', function(e) {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
