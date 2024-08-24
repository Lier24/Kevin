<?php

require_once '../modelo/ProyectosBean.php';
require_once '../util/conexion.php';

class ProyectosDao {

    public function obtenerTodosLosProyectos() {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $sql = "SELECT * FROM registros_proyecto";
            $rs = mysqli_query($con, $sql);
            $proyectos = array();

            while ($row = mysqli_fetch_assoc($rs)) {
                array_push($proyectos, array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'titulo' => isset($row['titulo']) ? $row['titulo'] : null,
                    'descripcion' => isset($row['descripcion']) ? $row['descripcion'] : null,
                    'miembros' => isset($row['miembros']) ? $row['miembros'] : null,
                    'curso' => isset($row['curso']) ? $row['curso'] : null,
                    'fecha_subida' => isset($row['fecha_subida']) ? $row['fecha_subida'] : null,
                    'fecha_culminacion' => isset($row['fecha_culminacion']) ? $row['fecha_culminacion'] : null,
                    'entregable' => isset($row['entregable']) ? $row['entregable'] : null,
                    'id_registro' => isset($row['id_registro']) ? $row['id_registro'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $proyectos;
    }

    public function obtenerProyectoPorId($id) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $id);
            $sql = "SELECT * FROM registros_proyecto WHERE id='$id'";
            $rs = mysqli_query($con, $sql);
            $proyecto = null;

            if ($row = mysqli_fetch_assoc($rs)) {
                $proyecto = array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'titulo' => isset($row['titulo']) ? $row['titulo'] : null,
                    'descripcion' => isset($row['descripcion']) ? $row['descripcion'] : null,
                    'miembros' => isset($row['miembros']) ? $row['miembros'] : null,
                    'curso' => isset($row['curso']) ? $row['curso'] : null,
                    'fecha_subida' => isset($row['fecha_subida']) ? $row['fecha_subida'] : null,
                    'fecha_culminacion' => isset($row['fecha_culminacion']) ? $row['fecha_culminacion'] : null,
                    'entregable' => isset($row['entregable']) ? $row['entregable'] : null,
                    'id_registro' => isset($row['id_registro']) ? $row['id_registro'] : null
                );
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $proyecto;
    }

    public function insertarProyecto(ProyectosBean $proyecto) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $titulo = mysqli_real_escape_string($con, $proyecto->getTitulo());
            $descripcion = mysqli_real_escape_string($con, $proyecto->getDescripcion());
            $miembros = mysqli_real_escape_string($con, $proyecto->getMiembros());
            $curso = mysqli_real_escape_string($con, $proyecto->getCurso());
            $fechaSubida = mysqli_real_escape_string($con, $proyecto->getFechaSubida());
            $fechaCulminacion = mysqli_real_escape_string($con, $proyecto->getFechaCulminacion());
            $entregable = mysqli_real_escape_string($con, $proyecto->getEntregable());
            $idRegistro = mysqli_real_escape_string($con, $proyecto->getIdRegistro());

            $sql = "INSERT INTO registros_proyecto (titulo, descripcion, miembros, curso, fecha_subida, fecha_culminacion, entregable, id_registro) 
                    VALUES ('$titulo', '$descripcion', '$miembros', '$curso', '$fechaSubida', '$fechaCulminacion', '$entregable', '$idRegistro')";
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function actualizarProyecto(ProyectosBean $proyecto) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $proyecto->getId());
            $titulo = mysqli_real_escape_string($con, $proyecto->getTitulo());
            $descripcion = mysqli_real_escape_string($con, $proyecto->getDescripcion());
            $miembros = mysqli_real_escape_string($con, $proyecto->getMiembros());
            $curso = mysqli_real_escape_string($con, $proyecto->getCurso());
            $fechaSubida = mysqli_real_escape_string($con, $proyecto->getFechaSubida());
            $fechaCulminacion = mysqli_real_escape_string($con, $proyecto->getFechaCulminacion());
            $entregable = mysqli_real_escape_string($con, $proyecto->getEntregable());
            $idRegistro = mysqli_real_escape_string($con, $proyecto->getIdRegistro());

            $sql = "UPDATE registros_proyecto SET 
                    titulo='$titulo', 
                    descripcion='$descripcion', 
                    miembros='$miembros', 
                    curso='$curso', 
                    fecha_subida='$fechaSubida', 
                    fecha_culminacion='$fechaCulminacion', 
                    entregable='$entregable',
                    id_registro='$idRegistro' 
                    WHERE id='$id'";
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function eliminarProyecto($id) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $id);
            $sql = "DELETE FROM registros_proyecto WHERE id='$id'";
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function obtenerProyectosPorIdRegistro($idRegistro) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $idRegistro = mysqli_real_escape_string($con, $idRegistro);
            $sql = "SELECT * FROM registros_proyecto WHERE id_registro='$idRegistro'";
            $rs = mysqli_query($con, $sql);
            $proyectos = array();

            while ($row = mysqli_fetch_assoc($rs)) {
                array_push($proyectos, array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'titulo' => isset($row['titulo']) ? $row['titulo'] : null,
                    'descripcion' => isset($row['descripcion']) ? $row['descripcion'] : null,
                    'miembros' => isset($row['miembros']) ? $row['miembros'] : null,
                    'curso' => isset($row['curso']) ? $row['curso'] : null,
                    'fecha_subida' => isset($row['fecha_subida']) ? $row['fecha_subida'] : null,
                    'fecha_culminacion' => isset($row['fecha_culminacion']) ? $row['fecha_culminacion'] : null,
                    'entregable' => isset($row['entregable']) ? $row['entregable'] : null,
                    'id_registro' => isset($row['id_registro']) ? $row['id_registro'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $proyectos;
    }
}
?>