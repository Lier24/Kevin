<?php
class ProyectosBean {
    private $id;
    private $titulo;
    private $descripcion;
    private $miembros;
    private $curso;
    private $fechaSubida;
    private $fechaCulminacion;
    private $entregable; // Este será el archivo en formato binario
    private $idRegistro;

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getMiembros() {
        return $this->miembros;
    }

    public function setMiembros($miembros) {
        $this->miembros = $miembros;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getFechaSubida() {
        return $this->fechaSubida;
    }

    public function setFechaSubida($fechaSubida) {
        $this->fechaSubida = $fechaSubida;
    }

    public function getFechaCulminacion() {
        return $this->fechaCulminacion;
    }

    public function setFechaCulminacion($fechaCulminacion) {
        $this->fechaCulminacion = $fechaCulminacion;
    }

    public function getEntregable() {
        return $this->entregable;
    }

    public function setEntregable($entregable) {
        $this->entregable = $entregable;
    }

    public function getIdRegistro() {
        return $this->idRegistro;
    }

    public function setIdRegistro($idRegistro) {
        $this->idRegistro = $idRegistro;
    }
}
?>