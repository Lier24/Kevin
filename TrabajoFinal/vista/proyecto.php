<?php
      include_once '../util/Conexion.php';

      $objc =  new ConexionBD();

      $cn = $objc->getConexionBD();

      $sql = "SELECT titulo,descripcion,miembros,curso,fecha_subida FROM `registros_proyecto`";
      $rs = mysqli_query($cn,$sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilosPro.css" title="style"/>
    <title>Alumnos - Oficina de Investigación, Innovación y Emprendimiento</title>
</head>
<body>
    <header>
        <img src="../Imagenes/Logo FIIS.png" alt="Logo">
        <h1>Oficina de Investigación, Innovación y Emprendimiento</h1>
    </header>
    <main>
        <h2>Lista de Proyectos</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Autor(es)</th>
                        <th>Curso</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                         <!-- aca va tu enlace para la base de datos :v  -->
                         <?php 
                          while($resultado = mysqli_fetch_array($rs)){
                         ?>
                         
                         <tr>

                            <td><?php echo $resultado['titulo']  ?></td>
                            <td><?php echo $resultado['descripcion']  ?></td>
                            <td><?php echo $resultado['miembros']  ?></td>
                            <td><?php echo $resultado['curso']  ?></td>
                            <td><?php echo $resultado['fecha_subida']  ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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
