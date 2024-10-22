<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Truck Workshop W&C</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Incluir Bootstrap CSS -->
    <style>
        /* Estilo para el mensaje de error */
        .mensaje-error {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <section>
        <form method="post" action="<?= base_url('/login-chek') ?>" >
            <h1>Truck Workshop W&C</h1>
            <div class="cuadro-texto">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" id="usuario" name="usuario" required>
                <label for="usuario">Usuario</label>
            </div>
            <div class="cuadro-texto">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" id="contraseña" name="contraseña" required>
                <label for="contraseña">Contraseña</label>
            </div>
            <div class="recordar">
                <label>
                    <input type="checkbox" id="recordarme"> Recordarme
                </label>
            </div>
            <button type="submit">Iniciar</button>
        </form>

        <!-- Mensaje de error flotante -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje-error" id="mensaje-error">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
    </section>

    <script>
        // Mostrar el mensaje de error si existe
        const mensajeError = document.getElementById('mensaje-error');
        if (mensajeError) {
            mensajeError.style.display = 'block';

            setTimeout(() => {
                mensajeError.style.display = 'none';
            }, 3000);
        }

        // Función "Recordarme"
        document.addEventListener("DOMContentLoaded", function() {
            const usuarioInput = document.getElementById('usuario');
            const recordarCheckbox = document.getElementById('recordarme');

            if (localStorage.getItem('usuario')) {
                usuarioInput.value = localStorage.getItem('usuario');
                recordarCheckbox.checked = true; 
            }

            document.querySelector('form').addEventListener('submit', function() {
                if (recordarCheckbox.checked) {
                    localStorage.setItem('usuario', usuarioInput.value);
                } else {
                    localStorage.removeItem('usuario'); 
                }
            });
        });

        window.onload = function() {
            if (window.history.length > 1) {
                window.history.pushState(null, null, window.location.href);
                window.onpopstate = function () {
                    window.history.pushState(null, null, window.location.href);
                };
            }
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

