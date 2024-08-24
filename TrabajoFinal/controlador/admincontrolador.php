<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once "../modelo/AdminDao.php";
require_once "../modelo/AdminBean.php";

$op = isset($_GET["op"]) ? $_GET["op"] : null;
$objAdminDao = new AdminDao();

switch ($op) {
    case 1: {
        // Listar todos los usuarios
        $list = $objAdminDao->ListAllUsers();
        echo json_encode($list);
        break;
    }
    case 2: {
        // Listar usuario por ID
        $id = isset($_GET["idUser"]) ? $_GET["idUser"] : null;
        if ($id !== null) {
            $objAdminBean = new AdminBean();
            $objAdminBean->setId($id);
            $user = $objAdminDao->ListUserById($objAdminBean);
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "ID de usuario no proporcionado"]);
        }
        break;
    }
    case 3: {
        // Listar usuario por nombre
        $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : null;
        $contraseña = isset($_GET["contraseña"]) ? $_GET["contraseña"] : null;
        if ($nombre !== null && $contraseña !== null) {
            $objAdminBean = new AdminBean();
            $objAdminBean->setNombre($nombre);
            $objAdminBean->setContraseña($contraseña);
            $list = $objAdminDao->ListUserByName($objAdminBean);
            echo json_encode($list);
        } else {
            echo json_encode(["error" => "Nombre de usuario o contraseña no proporcionados"]);
        }
        break;
    }
    case 4: {
        // Agregar nuevo usuario
        $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : null;
        $contraseña = isset($_GET["contraseña"]) ? $_GET["contraseña"] : null;
        $correo = isset($_GET["correo"]) ? $_GET["correo"] : null;

        if ($nombre !== null && $contraseña !== null && $correo !== null) {
            $objAdminBean = new AdminBean();
            $objAdminBean->setNombre($nombre);
            $objAdminBean->setContraseña($contraseña);
            $objAdminBean->setCorreo($correo);
            $result = $objAdminDao->AddUser($objAdminBean);

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
            $objAdminBean = new AdminBean();
            $objAdminBean->setId($id);
            $result = $objAdminDao->DeleteUser($objAdminBean);

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
        $correo = isset($_GET["correo"]) ? trim($_GET["correo"]) : null;
        $contraseña = isset($_GET["contraseña"]) ? trim($_GET["contraseña"]) : null;
    
        // Redirigir a la página de inicio de sesión si faltan datos
        if (empty($correo) || empty($contraseña)) {
            header('Location: ../index.php?error=datos_vacios');
            exit();
        }
        
        $objAdminBean = new AdminBean();
        $objAdminBean->setCorreo($correo);
        $objAdminBean->setContraseña($contraseña);

        $rs = $objAdminDao->estaRegistradoUsuario($objAdminBean);

        if ($rs) {
            // Redirigir a la página principal
            header('Location: ../vista/principal.php');
            exit(); // Asegura que no se ejecuta más código después de la redirección
        } else {
            // Redirigir a la página de inicio de sesión si el usuario no es encontrado
            header('Location: ../index.php?error=usuario_no_encontrado');
        }
        break;
    }
    default: {
        echo json_encode(["error" => "Operación no válida"]);
        break;
    }
}
?>
