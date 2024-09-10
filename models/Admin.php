<?php
namespace Model;
class Admin extends ActiveRecord{
    protected static $tabla='citaservicio';
    protected static $columnaDb=['id','hora','cliente','email','telefono','servicio','precio'];
    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;
}



?>