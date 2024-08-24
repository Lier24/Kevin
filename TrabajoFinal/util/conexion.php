<?php
class ConexionBD {
    const servidor = "localhost"; 
    const usuario = "root"; 
    const password = ""; 
    const bd = "proyectoapp_bd"; 

    private $cn = null;

    public function getConexionBD() {
        try {
            $this->cn = mysqli_connect(self::servidor, self::usuario, self::password, self::bd); 
            if (mysqli_connect_errno()) {
                throw new Exception("Error en la conexión: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $this->cn;
    }
}
?>
