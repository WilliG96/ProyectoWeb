<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #ebebeb; 
    background-image: url('<?php echo base_url('images/06.jpg'); ?>');
    background-size: cover;
    background-position: center; 
    background-repeat: no-repeat; 
    position: relative;
    overflow: hidden;
}

.container {
    position: relative;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
.carousel {
    width: 80%;
    height: 65%;
    border-radius: 25px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
    margin-top: 80px; 
}

.carousel .images {
    display: flex;
    transition: transform 0.5s ease;
    position: relative; 
}

.carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
    transition: transform 0.5s ease; 
}

.carousel img.active {
    transform: scale(1.2); 
}

/* Reflejo */
.carousel img::after {
    content: ""; 
    position: absolute;
    bottom: -100%; 
    left: 0;
    width: 100%;
    height: 100%; 
    background-image: inherit; 
    background-size: cover; 
    transform: scaleY(-1); 
    opacity: 0.5; 
    filter: blur(1px); 
    border-radius: 20px; 
    pointer-events: none; 
}

.carousel {
    background-color: white; 
    padding-bottom: 20px; 
}

/* Mensaje de Bienvenida */
.welcome-message {
    position: absolute;
    top: 2%; 
    text-align: center;
    color: black;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    width: 100%; 
}

.welcome-message h1 {
    font-size: 3rem;
    margin: 0; 
}

.welcome-message h2 {
    font-size: 1.5rem;
    margin-top: 0.5rem; 
}

/* Botones */
.buttons {
    position: absolute;
    top: 14%; 
    display: flex;
    justify-content: center;
    gap: 20px;
    width: 100%; 
}

.buttons a {
    padding: 10px 20px;
    background-color: black;
    color: white;
    font-family: bold;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2rem;
    transition: background-color 0.3s ease;
}

.buttons a:hover {
    background-color: #444;
}

/* Logo */
.logo {
    position: absolute;
    top: 10px;
    right: 5px;
}

.logo img {
    width: 200px; 
}

    </style>
</head>
<body>

    <div class="container">
        <!-- Logo en la esquina superior derecha -->
        <div class="logo">
            <img src="<?= base_url('Seguimiento/logo2.png'); ?>" alt="Logo">
        </div>

        <!-- Mensaje de Bienvenida -->
        <div class="welcome-message">
            <h1>BENVENIDO SOMOS TU TALLER DE CONFIANZA</h1>
        </div>

        <!-- Botones -->
        <div class="buttons">
            <a href="<?= base_url('Cliente'); ?>">VER TICKET</a>
            <a href="<?= base_url('historial'); ?>">HISTORIAL</a>
        </div>

        <!-- Carrusel de Imágenes -->
        <div class="carousel">
            <div class="images">
                <img src="<?= base_url('Seguimiento/1.jpg'); ?>" alt="Imagen 1">
                <img src="<?= base_url('Seguimiento/2.jpg'); ?>" alt="Imagen 2">
                <img src="<?= base_url('Seguimiento/3.jpg'); ?>" alt="Imagen 3">
                <img src="<?= base_url('Seguimiento/5.jpg'); ?>" alt="Imagen 4">
                <img src="<?= base_url('Seguimiento/6.jpg'); ?>" alt="Imagen 5">
                <img src="<?= base_url('Seguimiento/7.jpg'); ?>" alt="Imagen 6">
                <img src="<?= base_url('Seguimiento/8.jpg'); ?>" alt="Imagen 7">
            </div>
        </div>
    </div>

    <script>
let currentIndex = 0;
const images = document.querySelector('.carousel .images');
const imageElements = images.children;
const totalImages = imageElements.length;

// Inicializar la primera imagen como activa
imageElements[currentIndex].classList.add('active');

function changeImage() {
    // Quitar la clase active de la imagen actual
    imageElements[currentIndex].classList.remove('active');
    
    // Avanzar al siguiente índice
    currentIndex = (currentIndex + 1) % totalImages;
    
    // Añadir la clase active a la nueva imagen
    imageElements[currentIndex].classList.add('active');

    // Mover el carrusel
    images.style.transform = `translateX(${-currentIndex * 100}%)`;
}

// Cambiar imagen cada 4 segundos
setInterval(changeImage, 4000);

    </script>

</body>
</html>

