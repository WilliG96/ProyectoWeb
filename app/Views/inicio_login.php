<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Truck Workshop W&C</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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

        <!-- Mensaje de error solo si "error" está en la URL -->
        <div class="mensaje-error" id="mensaje-error" style="display: none;">
            Usuario o contraseña incorrectos.
        </div>
    </section>

    <script>
        // Mostrar el mensaje de error si la URL tiene "?error=1"
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('error') === '1') {
            document.getElementById('mensaje-error').style.display = 'block';

            // Ocultar el mensaje de error después de 3 segundos
            setTimeout(() => {
                document.getElementById('mensaje-error').style.display = 'none';
            }, 3000);
        }

        // Función "Recordarme"
        document.addEventListener("DOMContentLoaded", function() {
            const usuarioInput = document.getElementById('usuario');
            const recordarCheckbox = document.getElementById('recordarme');

            // Al cargar la página, verificar si el usuario está almacenado en LocalStorage
            if (localStorage.getItem('usuario')) {
                usuarioInput.value = localStorage.getItem('usuario');
                recordarCheckbox.checked = true; // Mantiene el checkbox seleccionado
            }

            // Guardar el usuario en LocalStorage si se activa la opción de "Recordarme"
            document.querySelector('form').addEventListener('submit', function() {
                if (recordarCheckbox.checked) {
                    localStorage.setItem('usuario', usuarioInput.value);
                } else {
                    localStorage.removeItem('usuario'); // Elimina el usuario si no está marcada la opción
                }
            });
        });
    </script>
</body>
</html>
