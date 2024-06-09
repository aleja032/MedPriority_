document.getElementById('cita').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    const url = new URL(window.location);
    url.searchParams.set('success', '2');
    console.log("Navigating to URL with success=1:", url.toString());
    window.location.href = url.toString();
});

function showAlert(message, buttonText) {
    document.getElementById('alert-message').innerText = message;
    document.getElementById('close1').innerText = buttonText;
    document.getElementById('alerta').style.display = 'flex';
}

document.getElementById('close1').addEventListener('click', function() {
    document.getElementById('alerta').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    console.log("Current URL parameters:", Array.from(urlParams.entries()));
    if (urlParams.has('success')) {
        const success = urlParams.get('success');
        console.log("Success parameter value:", success);
        switch (success) {
            case '2':
                showAlert('Debe iniciar sesión', 'Ok');
                break;
            case '3':
                showAlert('Los datos ingresados son Incorrectos', 'Ok');
                break;
            default:
                showAlert('Hubo un problema al enviar la solicitud. Por favor, inténtelo nuevamente.', 'Ok');
                break;
        }
        // Limpiar los parámetros de la URL
        window.history.replaceState(null, null, window.location.pathname);
    }
});
