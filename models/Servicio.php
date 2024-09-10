<?php
namespace Model;
class Servicio extends ActiveRecord{
    protected static $tabla='servicios';
    protected static $columnaDb=['id','nombre','precio','descripcion'];
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;

    public function __construct($args=[]) {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->precio=$args['precio'] ?? '';
        $this->descripcion=$args['descripcion'] ?? '';
    }
    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][]='El campo nombre es obligatorio';
        }
        if(!$this->precio){
            self::$alertas['error'][]='El campo precio es obligatorio';
        }
        return self::$alertas;

    }
}
?>