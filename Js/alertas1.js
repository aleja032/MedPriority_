/* Mensaje de debe inciar sesión
function alertasesion() {
    Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success"
      });

} */
//-----------------alerta inicia sesion-----------
const agendar= document.querySelector('#cita');
const c= document.querySelector('#alerta');
const cierra = document.querySelector('#close');

function abrir1() {
    console.log("pROBLEMA");
    c.style.display = 'flex';
    c.style.visibility = 'visible';
    document.body.style.overflow = 'hidden';
}
function cerrar2() {
    c.style.display = 'none';
    c.style.visibility = 'hidden';
    document.body.style.overflow = 'auto';
}
agendar.addEventListener('click', abrir1);
cierra.addEventListener('click', cerrar2);