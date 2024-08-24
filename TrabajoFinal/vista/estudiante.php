<?php
include_once '../util/Conexion.php';

$objc =  new ConexionBD();
$cn = $objc->getConexionBD();

// Proceso de eliminación
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM registros WHERE id = '$delete_id'";
    if (mysqli_query($cn, $delete_sql)) {
        echo "<script>alert('Registro eliminado correctamente.'); window.location.href='estudiante.php';</script>";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($cn);
    }
}

// Proceso de adición
if (isset($_POST['add_alumno'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $escuela = $_POST['escuela'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];
    
    // Nota: Asegúrate de usar hashing para contraseñas en producción
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $insert_sql = "INSERT INTO registros (nombres, apellidos, correo, escuela, telefono, contrasena) VALUES ('$nombre', '$apellido', '$correo', '$escuela', '$telefono', '$hashed_password')";
    if (mysqli_query($cn, $insert_sql)) {
        echo "<script>alert('Nuevo alumno agregado correctamente.'); window.location.href='estudiante.php';</script>";
    } else {
        echo "Error al agregar el alumno: " . mysqli_error($cn);
    }
}

$sql = "SELECT id, nombres, apellidos, correo, escuela, telefono FROM `registros`";
$rs = mysqli_query($cn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilosEstu.css" title="style"/>
    <title>Alumnos - Oficina de Investigación, Innovación y Emprendimiento</title>
</head>
<body>
    <header>
        <img src="../Imagenes/Logo FIIS.png" alt="Logo">
        <h1>Oficina de Investigación, Innovación y Emprendimiento</h1>
    </header>
    <main>
        <h2>Lista de Alumnos</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo Electrónico</th>
                        <th>Carrera</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($resultado = mysqli_fetch_array($rs)) {
                    ?>
                    <tr>
                        <td><?php echo $resultado['id'] ?></td>
                        <td><?php echo $resultado['nombres'] ?></td>
                        <td><?php echo $resultado['apellidos'] ?></td>
                        <td><?php echo $resultado['correo'] ?></td>
                        <td><?php echo $resultado['escuela'] ?></td>
                        <td><?php echo $resultado['telefono'] ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="delete_id" value="<?php echo $resultado['id']; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <!-- Formulario para agregar nuevo alumno -->
        <h2 style="text-align: center;">Agregar Nuevo Alumno</h2>
    <div class="container">
        <form method="POST" action="" class="agregar-alumno">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required><br>

            <label for="escuela">Carrera:</label>
            <input type="text" id="escuela" name="escuela" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit" name="add_alumno">Agregar Alumno</button>
        </form>
    </main>
    <footer>
        <p>Síguenos también aquí:</p>
        <p>
            <a href="#">Facebook</a> |
            <a href="#">Twitter</a> |
            <a href="#">Instagram</a>
        </p>
        <p>Copyright © 2024 Oficina de Investigación, Innovación y Emprendimiento. Todos los derechos reservados.</p>
    </footer>
</body>
</html>