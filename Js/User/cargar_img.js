document.getElementById('input-foto').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.querySelector('.imagen_subir');
            container.style.backgroundImage = `url(${e.target.result})`;
            container.style.backgroundSize = 'cover';
            container.style.backgroundRepeat = 'no-repeat';
            container.style.backgroundPosition = 'center';
        }
        reader.readAsDataURL(file);
    }
});