<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once "../modelo/ProyectosDao.php";
require_once "../modelo/ProyectosBean.php";

$op = isset($_GET["op"]) ? $_GET["op"] : null;
$objProyectosDAO = new ProyectosDAO();

switch ($op) {
    case 1: {
        // Listar todos los proyectos
        $list = $objProyectosDAO->obtenerTodosLosProyectos();
        echo json_encode($list);
        break;
    }
    case 2: {
        // Listar proyecto por ID
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        if ($id !== null) {
            $proyecto = $objProyectosDAO->obtenerProyectoPorId($id);
            echo json_encode($proyecto);
        } else {
            echo json_encode(["error" => "ID del proyecto no proporcionado"]);
        }
        break;
    }
    case 3: {
        // Agregar nuevo proyecto
        $titulo = isset($_GET["titulo"]) ? $_GET["titulo"] : null;
        $descripcion = isset($_GET["descripcion"]) ? $_GET["descripcion"] : null;
        $miembros = isset($_GET["miembros"]) ? $_GET["miembros"] : null;
        $curso = isset($_GET["curso"]) ? $_GET["curso"] : null;
        $fechaSubida = isset($_GET["fecha_subida"]) ? $_GET["fecha_subida"] : null;
        $fechaCulminacion = isset($_GET["fecha_culminacion"]) ? $_GET["fecha_culminacion"] : null;
        $entregable = isset($_FILES["entregable"]) ? $_FILES["entregable"] : null;
        $idRegistro = isset($_GET["id_registro"]) ? $_GET["id_registro"] : null;
    
        if ($titulo !== null && $descripcion !== null && $miembros !== null && $curso !== null && $fechaSubida !== null && $fechaCulminacion !== null && $idRegistro !== null) {
            $filePath = null;
    
            // Procesar el archivo entregable si existe
            if ($entregable !== null && $entregable['error'] == 0) {
                $filePath = "../entregables/" . basename($entregable["name"]);
                if (!move_uploaded_file($entregable["tmp_name"], $filePath)) {
                    echo json_encode(["error" => "Error al subir el archivo entregable"]);
                    break;
                }
            }
    
            $objProyectosBean = new ProyectosBean();
            $objProyectosBean->setTitulo($titulo);
            $objProyectosBean->setDescripcion($descripcion);
            $objProyectosBean->setMiembros($miembros);
            $objProyectosBean->setCurso($curso);
            $objProyectosBean->setFechaSubida($fechaSubida);
            $objProyectosBean->setFechaCulminacion($fechaCulminacion);
            $objProyectosBean->setEntregable($filePath);  // Puede ser null
            $objProyectosBean->setIdRegistro($idRegistro);
    
            $result = $objProyectosDAO->insertarProyecto($objProyectosBean);
    
            if ($result) {
                echo json_encode(["success" => "Proyecto agregado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al agregar el proyecto"]);
            }
        } else {
            echo json_encode(["error" => "Faltan parámetros necesarios"]);
        }
        break;
    }
    case 4: {
        // Actualizar proyecto
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        $titulo = isset($_GET["titulo"]) ? $_GET["titulo"] : null;
        $descripcion = isset($_GET["descripcion"]) ? $_GET["descripcion"] : null;
        $miembros = isset($_GET["miembros"]) ? $_GET["miembros"] : null;
        $curso = isset($_GET["curso"]) ? $_GET["curso"] : null;
        $fechaSubida = isset($_GET["fecha_subida"]) ? $_GET["fecha_subida"] : null;
        $fechaCulminacion = isset($_GET["fecha_culminacion"]) ? $_GET["fecha_culminacion"] : null;
        $entregable = isset($_FILES["entregable"]) ? $_FILES["entregable"] : null;
        $idRegistro = isset($_GET["id_registro"]) ? $_GET["id_registro"] : null;

        if ($id && $titulo && $descripcion && $miembros && $curso && $fechaSubida && $fechaCulminacion && $idRegistro) {
            $objProyectosBean = new ProyectosBean();
            $objProyectosBean->setId($id);
            $objProyectosBean->setTitulo($titulo);
            $objProyectosBean->setDescripcion($descripcion);
            $objProyectosBean->setMiembros($miembros);
            $objProyectosBean->setCurso($curso);
            $objProyectosBean->setFechaSubida($fechaSubida);
            $objProyectosBean->setFechaCulminacion($fechaCulminacion);
            $objProyectosBean->setIdRegistro($idRegistro);

            if ($entregable) {
                // Procesar el archivo entregable si se proporciona
                $filePath = "../entregables/" . basename($entregable["name"]);
                if (move_uploaded_file($entregable["tmp_name"], $filePath)) {
                    $objProyectosBean->setEntregable($filePath);
                } else {
                    echo json_encode(["error" => "Error al subir el archivo entregable"]);
                    break;
                }
            }

            $result = $objProyectosDAO->actualizarProyecto($objProyectosBean);

            if ($result) {
                echo json_encode(["success" => "Proyecto actualizado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al actualizar el proyecto"]);
            }
        } else {
            echo json_encode(["error" => "Faltan parámetros necesarios"]);
        }
        break;
    }
    case 5: {
        // Eliminar proyecto
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        if ($id !== null) {
            $result = $objProyectosDAO->eliminarProyecto($id);

            if ($result) {
                echo json_encode(["success" => "Proyecto eliminado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al eliminar el proyecto"]);
            }
        } else {
            echo json_encode(["error" => "ID del proyecto no proporcionado"]);
        }
        break;
    }
    case 6: {
        // Obtener proyectos por ID de Registro
        $idRegistro = isset($_GET["id_registro"]) ? $_GET["id_registro"] : null;
        if ($idRegistro !== null) {
            $proyectos = $objProyectosDAO->obtenerProyectosPorIdRegistro($idRegistro);
            echo json_encode($proyectos);
        } else {
            echo json_encode(["error" => "ID de Registro no proporcionado"]);
        }
        break;
    }
    default: {
        echo json_encode(["error" => "Operación no válida"]);
        break;
    }
}
?>