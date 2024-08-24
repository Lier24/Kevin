<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once "../modelo/UsuarioDao.php";
require_once "../modelo/UsuarioBean.php";

$op = isset($_GET["op"]) ? $_GET["op"] : null;
$objUserDao = new UsuarioDao();

switch ($op) {
    case 1: {
        // Listar todos los usuarios
        $list = $objUserDao->ListAllUsers();
        echo json_encode($list);
        break;
    }
    case 2: {
        // Listar usuario por ID
        $id = isset($_GET["idUser"]) ? $_GET["idUser"] : null;
        if ($id !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setId($id);
            $user = $objUserDao->ListUserById($objUserBean);
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "ID de usuario no proporcionado"]);
        }
        break;
    }
    case 3: {
        // Listar usuario por nombre
        $nombres = isset($_GET["nombres"]) ? $_GET["nombres"] : null;
        if ($nombres !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setNombres($nombres);
            $list = $objUserDao->ListUserByName($objUserBean);
            echo json_encode($list);
        } else {
            echo json_encode(["error" => "Nombres de usuario no proporcionados"]);
        }
        break;
    }
    case 4: {
        // Agregar nuevo usuario
        $nombres = isset($_GET["nombres"]) ? $_GET["nombres"] : null;
        $apellidos = isset($_GET["apellidos"]) ? $_GET["apellidos"] : null;
        $telefono = isset($_GET["telefono"]) ? $_GET["telefono"] : null;
        $escuela = isset($_GET["escuela"]) ? $_GET["escuela"] : null;
        $correo = isset($_GET["correo"]) ? $_GET["correo"] : null;
        $contrasena = isset($_GET["contrasena"]) ? $_GET["contrasena"] : null;

        if ($nombres !== null && $apellidos !== null && $telefono !== null && $escuela !== null && $correo !== null && $contrasena !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setNombres($nombres);
            $objUserBean->setApellidos($apellidos);
            $objUserBean->setTelefono($telefono);
            $objUserBean->setEscuela($escuela);
            $objUserBean->setCorreo($correo);
            $objUserBean->setContrasena($contrasena);
            $result = $objUserDao->AddUser($objUserBean);

            if ($result) {
                echo json_encode(["success" => "Usuario agregado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al agregar el usuario"]);
            }
        } else {
            echo json_encode(["error" => "Faltan parámetros necesarios"]);
        }
        break;
    }
    case 5: {
        // Eliminar usuario
        $id = isset($_GET["idUser"]) ? $_GET["idUser"] : null;
        if ($id !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setId($id);
            $result = $objUserDao->DeleteUser($objUserBean);

            if ($result) {
                echo json_encode(["success" => "Usuario eliminado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al eliminar el usuario"]);
            }
        } else {
            echo json_encode(["error" => "ID de usuario no proporcionado"]);
        }
        break;
    }
    case 6: {
        // Verificar usuario por correo y contraseña
        $correo = isset($_GET["correo"]) ? $_GET["correo"] : null;
        $contrasena = isset($_GET["contrasena"]) ? $_GET["contrasena"] : null;

        if ($correo !== null && $contrasena !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setCorreo($correo);
            $objUserBean->setContrasena($contrasena);
            $user = $objUserDao->VerifyUser($objUserBean);

            if ($user !== null) {
                echo json_encode(["success" => "Usuario verificado correctamente", "user" => $user]);
            } else {
                echo json_encode(["error" => "Usuario no encontrado"]);
            }
        } else {
            echo json_encode(["error" => "Correo y contraseña no proporcionados"]);
        }
        break;
    }
    case 7: {
        // Listar usuarios por correo y contraseña
        $correo = isset($_GET["correo"]) ? $_GET["correo"] : null;
        $contrasena = isset($_GET["contrasena"]) ? $_GET["contrasena"] : null;
    
        if ($correo !== null && $contrasena !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setCorreo($correo);
            $objUserBean->setContrasena($contrasena);
            $users = $objUserDao->ListUsersByEmailAndPassword($objUserBean);
            
            if (!empty($users)) {
                echo json_encode($users);
            } else {
                echo json_encode(["error" => "No se encontraron usuarios con los datos proporcionados"]);
            }
        } else {
            echo json_encode(["error" => "Correo y contraseña no proporcionados"]);
        }
        break;
    }
    case 8: {
        // Actualizar usuario
        $id = isset($_GET["idUser"]) ? $_GET["idUser"] : null;
        $nombres = isset($_GET["nombres"]) ? $_GET["nombres"] : null;
        $apellidos = isset($_GET["apellidos"]) ? $_GET["apellidos"] : null;
        $telefono = isset($_GET["telefono"]) ? $_GET["telefono"] : null;
        $escuela = isset($_GET["escuela"]) ? $_GET["escuela"] : null;
        $correo = isset($_GET["correo"]) ? $_GET["correo"] : null;
        $contrasena = isset($_GET["contrasena"]) ? $_GET["contrasena"] : null;
    
        if ($id !== null && $nombres !== null && $apellidos !== null && $telefono !== null && $escuela !== null && $correo !== null && $contrasena !== null) {
            $objUserBean = new UsuarioBean();
            $objUserBean->setId($id);
            $objUserBean->setNombres($nombres);
            $objUserBean->setApellidos($apellidos);
            $objUserBean->setTelefono($telefono);
            $objUserBean->setEscuela($escuela);
            $objUserBean->setCorreo($correo);
            $objUserBean->setContrasena($contrasena);
            $result = $objUserDao->UpdateUser($objUserBean);
    
            if ($result) {
                echo json_encode(["success" => "Usuario actualizado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al actualizar el usuario"]);
            }
        } else {
            echo json_encode(["error" => "Faltan parámetros necesarios"]);
        }
        break;
    }
    default: {
        echo json_encode(["error" => "Operación no válida"]);
        break;
    }
}
?>