<?php

require_once '../modelo/AdminBean.php';
require_once '../util/conexion.php';

class AdminDao {
    
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
                    'nombre' => isset($row['nombre']) ? $row['nombre'] : null,
                    'contraseña' => isset($row['contraseña']) ? $row['contraseña'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $list;
    }

    public function ListUserById(AdminBean $adminobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $adminobj->getId());
            $sql = "SELECT * FROM registros WHERE id='$id'";
            $rs = mysqli_query($con, $sql);
            $user = null;

            if ($row = mysqli_fetch_assoc($rs)) {
                $user = array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombre' => isset($row['nombre']) ? $row['nombre'] : null,
                    'contraseña' => isset($row['contraseña']) ? $row['contraseña'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null
                );
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $user;
    }

    public function ListUserByName(AdminBean $adminobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $correo = mysqli_real_escape_string($con, $adminobj->getCorreo());
            $contraseña = mysqli_real_escape_string($con, $adminobj->getContraseña());
            $sql = "SELECT * FROM registros WHERE correo='$correo' AND contraseña='$contraseña'";
            $rs = mysqli_query($con, $sql);
            $list = array();

            while ($row = mysqli_fetch_assoc($rs)) {
                array_push($list, array(
                    'id' => isset($row['id']) ? $row['id'] : null,
                    'nombre' => isset($row['nombre']) ? $row['nombre'] : null,
                    'contraseña' => isset($row['contraseña']) ? $row['contraseña'] : null,
                    'correo' => isset($row['correo']) ? $row['correo'] : null
                ));
            }
            mysqli_close($con);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $list;
    }

    public function estaRegistradoUsuario(AdminBean $adminobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $correo = mysqli_real_escape_string($con, $adminobj->getCorreo());
            $contraseña = mysqli_real_escape_string($con, $adminobj->getContraseña());
            $sql = "SELECT * FROM registros_profesor WHERE correo='$correo' AND contrasena='$contraseña'";
            $rs = mysqli_query($con, $sql);

            if (mysqli_fetch_assoc($rs)) {
                mysqli_close($con);
                return true;
            } else {
                mysqli_close($con);
                return false;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function AddUser(AdminBean $adminobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $nombre = mysqli_real_escape_string($con, $adminobj->getNombre());
            $contraseña = mysqli_real_escape_string($con, $adminobj->getContraseña());
            $correo = mysqli_real_escape_string($con, $adminobj->getCorreo());
            $sql = "INSERT INTO registros (nombre, contraseña, correo) VALUES ('$nombre', '$contraseña', '$correo')";
            $result = mysqli_query($con, $sql);
            mysqli_close($con);
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function DeleteUser(AdminBean $adminobj) {
        try {
            $objc = new ConexionBD();
            $con = $objc->getConexionBD();
            $id = mysqli_real_escape_string($con, $adminobj->getId());
            $sql = "DELETE FROM registros WHERE id='$id'";
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
