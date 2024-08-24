<?php

class AdminBean {
    private $id; 
    private $nombre;
    private $contraseña;
    private $correo; 
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}
?>

