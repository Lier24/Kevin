<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilosCSS.css" title="style"/>
    <title>Maquetación</title>
    <script>
        function ingresar() {
            const form = document.getElementById('loginForm');
            form.action = "controlador/admincontrolador.php";
            form.method = "GET";
            form.op.value = "6";
            form.submit();
        }

        function mostrarAlertas() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error')) {
                const error = urlParams.get('error');
                let mensaje = '';
                switch (error) {
                    case 'datos_vacios':
                        mensaje = 'No se ingresó ningún dato. Por favor, ingrese su correo y contraseña.';
                        break;
                    case 'usuario_no_encontrado':
                        mensaje = 'Usuario no encontrado. Verifique su correo y contraseña.';
                        break;
                    case 'conexion_fallida':
                        mensaje = 'No se pudo conectar a la base de datos.';
                        break;
                    case 'preparacion_fallida':
                        mensaje = 'Error al preparar la consulta.';
                        break;
                    case 'operacion_no_valida':
                        mensaje = 'Operación no válida.';
                        break;
                    default:
                        mensaje = 'Ocurrió un error desconocido.';
                        break;
                }
                alert(mensaje);
            }
        }

        window.onload = mostrarAlertas;
    </script>
</head>
<body>
    <header>
        <img src="Imagenes/Logo FIIS.png" alt="Logo">
    </header>
    <nav>
        <a href="#">Trabajando para crear profesionales que el mundo necesita</a>
    </nav>
    <div class="container">
        <div class="content">
            <img src="Imagenes/Oficinas.jpeg" alt="Foto de la Oficina" style="width:100%;height:auto;">
            <div class="content2">
                <img src="Imagenes/Laboratorio.jpeg" alt="Foto de Laboratorio" style="width:100%;height:auto;">
            </div>
        </div>
        <div class="login">
            <form id="loginForm">
                <input type="hidden" name="op">
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña">
                <button type="button" onclick="ingresar()">Ingresar</button>
            </form>
            <p>Síguenos también aquí</p>
            <p>
                <a href="#">Facebook</a> |
                <a href="#">Twitter</a> |
                <a href="#">Instagram</a>
            </p>
        </div>
    </div>
    <footer>
        <p>Copyright © 2024 Oficina de Investigación, Innovación y Emprendimiento. Todos los derechos reservados.</p>
    </footer>
</body>
</html>