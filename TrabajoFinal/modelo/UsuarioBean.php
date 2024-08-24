<?php

class UsuarioBean {
    private $id; 
    private $nombres;
    private $apellidos;
    private $telefono;
    private $escuela;
    private $correo; 
    private $contrasena;

    // Getters(captadores)
    public function getId() {
        return $this->id;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEscuela() {
        return $this->escuela;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    // Setters(colocadores)
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEscuela($escuela) {
        $this->escuela = $escuela;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }
}
?>