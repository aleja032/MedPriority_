//Permite cambiar los contenedore
// Obtener referencias a los enlaces y sections
const sections = {
    grafica: document.querySelector('#contain_grafica'),
    citas_programadas: document.querySelector('#contain_citas_programadas'),
    lista_espera: document.querySelector('#contain_lista_espera'),
    historial_citas: document.querySelector('#contain_historialCitas'),
    modificar_datos: document.querySelector('#modificar'),


};

const links = {
    grafica: document.querySelector('#dash'),
    citas_programadas: document.querySelector('#citas_programadas'),
    lista_espera: document.querySelector('#lista_espera'),
    historial_citas: document.querySelector('#historial_citas'),
    modificar_datos: document.querySelector('#modificar_datos'),
};

// Función para mostrar una sección y ocultar las demás
function showSection(activeSection) {
    for (let section in sections) {
        if (section === activeSection) {
            sections[section].style.display = 'flex';
            sections[section].style.visibility = 'visible';
        } else {
            sections[section].style.display = 'none';
            sections[section].style.visibility = 'hidden';
        }
    }
}

// Agregar eventos a los enlaces
links.grafica.addEventListener('click', () => showSection('grafica'));
links.citas_programadas.addEventListener('click', () => showSection('citas_programadas'));
links.lista_espera.addEventListener('click', () => showSection('lista_espera'));
links.historial_citas.addEventListener('click', () => showSection('historial_citas'));
links.modificar_datos.addEventListener('click', () => showSection('modificar_datos'));




// Por defecto, mostramos la sección de Agendar citas al cargar la página
showSection('add_cita');
