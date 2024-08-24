<?php

require_once '../modelo/UsuarioBean.php';
require_once '../util/conexion.php';

class UsuarioDao {

    public function ListAllUsers() {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $sql = "SELECT * FROM registros";
            $rs = mysqli_query($con, $sql);
            $list = array();

            while ($row = mysqli_fetch_assoc($rs)) {
                array_push($list, array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombres' => isset($row['nombres']) ? $row['nombres'] : null,
                    'apellidos' => isset($row['apellidos']) ? $row['apellidos'] : null,
                    'telefono' => isset($row['telefono']) ? $row['telefono'] : null,
                    'escuela' => isset($row['escuela']) ? $row['escuela'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null,
                    'contrasena' => isset($row['contrasena']) ? $row['contrasena'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $list;
    }

    public function ListUserById(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $usuobj->getId());
            $sql = "SELECT * FROM registros WHERE id='$id'";
            $rs = mysqli_query($con, $sql);
            $user = null;

            if ($row = mysqli_fetch_assoc($rs)) {
                $user = array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombres' => isset($row['nombres']) ? $row['nombres'] : null,
                    'apellidos' => isset($row['apellidos']) ? $row['apellidos'] : null,
                    'telefono' => isset($row['telefono']) ? $row['telefono'] : null,
                    'escuela' => isset($row['escuela']) ? $row['escuela'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null,
                    'contrasena' => isset($row['contrasena']) ? $row['contrasena'] : null
                );
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $user;
    }

    public function ListUserByName(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $nombres = mysqli_real_escape_string($con, $usuobj->getNombres());
            $sql = "SELECT * FROM registros WHERE nombres='$nombres'";
            $rs = mysqli_query($con, $sql);
            $list = array();

            while ($row = mysqli_fetch_assoc($rs)) {
                array_push($list, array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombres' => isset($row['nombres']) ? $row['nombres'] : null,
                    'apellidos' => isset($row['apellidos']) ? $row['apellidos'] : null,
                    'telefono' => isset($row['telefono']) ? $row['telefono'] : null,
                    'escuela' => isset($row['escuela']) ? $row['escuela'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null,
                    'contrasena' => isset($row['contrasena']) ? $row['contrasena'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $list;
    }

    public function AddUser(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $nombres = mysqli_real_escape_string($con, $usuobj->getNombres());
            $apellidos = mysqli_real_escape_string($con, $usuobj->getApellidos());
            $telefono = mysqli_real_escape_string($con, $usuobj->getTelefono());
            $escuela = mysqli_real_escape_string($con, $usuobj->getEscuela());
            $correo = mysqli_real_escape_string($con, $usuobj->getCorreo());
            $contrasena = mysqli_real_escape_string($con, $usuobj->getContrasena());
            $sql = "INSERT INTO registros (nombres, apellidos, telefono, escuela, correo, contrasena) 
                    VALUES ('$nombres', '$apellidos', '$telefono', '$escuela', '$correo', '$contrasena')";
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function DeleteUser(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $usuobj->getId());
            $sql = "DELETE FROM registros WHERE id='$id'";
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function VerifyUser(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $correo = mysqli_real_escape_string($con, $usuobj->getCorreo());
            $contrasena = mysqli_real_escape_string($con, $usuobj->getContrasena());
            $sql = "SELECT * FROM registros WHERE correo='$correo' AND contrasena='$contrasena'";
            $rs = mysqli_query($con, $sql);
            $user = null;

            if ($row = mysqli_fetch_assoc($rs)) {
                $user = array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombres' => isset($row['nombres']) ? $row['nombres'] : null,
                    'apellidos' => isset($row['apellidos']) ? $row['apellidos'] : null,
                    'telefono' => isset($row['telefono']) ? $row['telefono'] : null,
                    'escuela' => isset($row['escuela']) ? $row['escuela'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null,
                    'contrasena' => isset($row['contrasena']) ? $row['contrasena'] : null
                );
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $user;
    }
    public function ListUsersByEmailAndPassword(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $correo = mysqli_real_escape_string($con, $usuobj->getCorreo());
            $contrasena = mysqli_real_escape_string($con, $usuobj->getContrasena());
            $sql = "SELECT * FROM registros WHERE correo='$correo' AND contrasena='$contrasena'";
            $rs = mysqli_query($con, $sql);
            $list = array();
    
            while ($row = mysqli_fetch_assoc($rs)) {
                array_push($list, array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombres' => isset($row['nombres']) ? $row['nombres'] : null,
                    'apellidos' => isset($row['apellidos']) ? $row['apellidos'] : null,
                    'telefono' => isset($row['telefono']) ? $row['telefono'] : null,
                    'escuela' => isset($row['escuela']) ? $row['escuela'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null,
                    'contrasena' => isset($row['contrasena']) ? $row['contrasena'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $list;
    }
    public function UpdateUser(UsuarioBean $usuobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $usuobj->getId());
            $nombres = mysqli_real_escape_string($con, $usuobj->getNombres());
            $apellidos = mysqli_real_escape_string($con, $usuobj->getApellidos());
            $telefono = mysqli_real_escape_string($con, $usuobj->getTelefono());
            $escuela = mysqli_real_escape_string($con, $usuobj->getEscuela());
            $correo = mysqli_real_escape_string($con, $usuobj->getCorreo());
            $contrasena = mysqli_real_escape_string($con, $usuobj->getContrasena());
    
            $sql = "UPDATE registros SET 
                    nombres='$nombres', 
                    apellidos='$apellidos', 
                    telefono='$telefono', 
                    escuela='$escuela', 
                    correo='$correo', 
                    contrasena='$contrasena' 
                    WHERE id='$id'";
    
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>