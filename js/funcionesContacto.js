function submitForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("correo").value;
    var message = document.getElementById("message").value;

    if (!validateName(name)) {
        alert("Por favor, ingrese un nombre válido.");
        return;
    }

    if (!validateEmail(email)) {
        alert("Por favor, ingrese un correo electrónico válido.");
        return;
    }

    if (!validateMessage(message)) {
        alert("Por favor, ingrese un mensaje válido.");
        return;
    }

    document.getElementById("contactForm").reset();
    document.getElementById("successMessage").innerHTML = "Mensaje enviado con éxito. ¡Gracias por contactarnos!";
}

function validateInput(inputType) {
    var inputElement = document.getElementById(inputType);
    var inputValue = inputElement.value;

    if (inputType === 'name' && !/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/.test(inputValue)) {
        inputElement.value = inputValue.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    } else if (inputType === 'email' && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/.test(inputValue)) {
        inputElement.value = inputValue.replace(/[^a-zA-Z0-9._%+-@.]/g, '');
    } else if (inputType === 'message' && !/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]+$/.test(inputValue)) {
        inputElement.value = inputValue.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]/g, '');
    }

    updateErrorMessage(inputType);
}

function updateErrorMessage(inputType) {
    var inputElement = document.getElementById(inputType);
    var errorElement = document.getElementById(inputType + 'Error');

    if (inputType === 'name' && !validateName(inputElement.value)) {
        errorElement.textContent = "Por favor, ingrese un nombre válido.";
    } else if (inputType === 'email' && !validateEmail(inputElement.value)) {
        errorElement.textContent = "Por favor, ingrese un correo electrónico válido.";
    } else if (inputType === 'message' && !validateMessage(inputElement.value)) {
        errorElement.textContent = "Por favor, ingrese un mensaje válido.";
    } else {
        errorElement.textContent = "";
    }
}

function validateName(name) {
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
    return regex.test(name) && name.length <= 50;
}

function validateEmail(email) {
    var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/;
    return regex.test(email) && email.length <= 30;
}

function validateMessage(message) {
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]+$/;
    return regex.test(message) && message.length <= 100;
}

var elementosNoPegar = document.querySelectorAll('.noPegar');
function validarCorreo() {
    var inputCorreo = document.getElementById('correo');
    var valorCorreo = inputCorreo.value;

    var patron = /^[A-Za-z0-9@._]+$/;

    if (!patron.test(valorCorreo)) {
        inputCorreo.value = valorCorreo.slice(0, -1);
    }
}