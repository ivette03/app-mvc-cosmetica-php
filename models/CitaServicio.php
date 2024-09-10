<?php
namespace Model;
class CitaServicio extends ActiveRecord{
    protected static $tabla='citaservicio';
    protected static $columnaDb=['id','idCita','idServicio'];
    
    public $id;
    public $idCita;
    public $idServicio;

    public function __construct($args=[]) {
       $this->id=$args['id'] ?? null;
       $this->idCita=$args['idCita'] ?? '';
       $this->idServicio=$args['idServicio'] ?? '';
    }
}

?>