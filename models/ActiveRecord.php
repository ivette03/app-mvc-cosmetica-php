<?php

namespace Model;
class ActiveRecord{
    protected static $db;
    //mi base de datos
    protected static $columnaDb = [];
    //errores
    protected static $alertas = [];
    //tabla
    protected static $tabla='';

    public $id;
   
   
    //definir la conexion a la bd
    public static function setDB($database){
        self::$db = $database;
    }
    public static function setAlertas($tipo,$mensaje){
        static::$alertas[$tipo][]=$mensaje;

    }
   
    public static function getAlertas(){
        return static::$alertas;
    }
    public function validar(){
        static::$alertas=[];
        return static::$alertas;
    }
    public function guardar(){
        if(!is_null($this->id)){
            return $this->actualizar();    
        }
        return false;

    }
    public function atributos(){
        $atributos=[];
        foreach(static::$columnaDb as $columna){
            if($columna === 'id')continue;
            $atributos[$columna]=$this->$columna;
        }
        return $atributos;
    }
    //SANITIZAR ATRIBUTOS
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizando = [];
        foreach($atributos as $key => $value){
            $sanitizando[$key] = self::$db->real_escape_string($value);
        }
        return $sanitizando;
    }
    
    //metodo crear
    public function crear($redirectUrl = null) {
        $atributos = $this->sanitizarAtributos();
    
        // Prepara la consulta
        $campos = implode(', ', array_keys($atributos));
        $valoresPlaceholder = implode(', ', array_fill(0, count($atributos), '?'));
    
        $query = "INSERT INTO " . static::$tabla . " ($campos) VALUES ($valoresPlaceholder)";
         // Registra los atributos y la consulta para depuración
       
        $stmt = self::$db->prepare($query);
    
        if ($stmt === false) {
            throw new \Exception("Error al preparar la consulta: " . self::$db->error);
        }
    
        // Vincula los valores
        $valores = array_values($atributos);
        $tipos = str_repeat('s', count($valores)); // Asumiendo que todos los valores son strings
        $stmt->bind_param($tipos, ...$valores);
    
        $resultado = $stmt->execute();
       
        if ($resultado) {
            $this->id = self::$db->insert_id; 
        } else {
            throw new \Exception("Error en la consulta: " . $stmt->error);
        }
    
        return [
            'resultado' => $resultado,
            'id' => self::$db->insert_id
        ];
    }
    
    public function eliminar(){
        $query="DELETE FROM " . static::$tabla . " where id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado=self::$db->query($query);
    
        return $resultado;
    }
     
    //   public function setImagen($imagen)
    //   {
    //       if(isset($this->id)){
    //           if ($this->imagen) {
    //              $this->borrarImagen();
    //           }
    //       }
          
    //       // Asignar la nueva imagen
    //       $this->imagen = $imagen;
    //   }
    //   //eliminando imagen
    //   public function borrarImagen(){
    //       $rutaImagenAnterior = CARPETA_IMAGENES . $this->imagen;
    //       if (file_exists($rutaImagenAnterior)) {
    //           unlink($rutaImagenAnterior);
    //       }
  
    //   }   
  
      public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    

   public static function consultarSQL($query){
    $resultado=self::$db->query($query);
    $array=[];
    while($registro=$resultado->fetch_assoc()){
        $array[]=static::crearObjeto($registro);
    }
    //liberar memoria
    $resultado->free();
    //retornar los resultados
    return $array;
   }
   public static function find($id){
    $query="SELECT * FROM " . static::$tabla . " WHERE id=${id}";
    $resultado=self::consultarSql($query);
    return array_shift($resultado);
    }   
    public static function where($columna,$valor){
        $query="SELECT * FROM " . static::$tabla . " WHERE ${columna}='${valor}'";
        $resultado=self::consultarSql($query);
        return array_shift($resultado);
    }  
    public static function sql($consulta){
        $query=$consulta;
        $resultado=self::consultarSql($consulta);
        return $resultado;
    }  
    public static function crearObjeto($registro){
        $objeto=new static;
        foreach($registro as $key=>$value){
            if(property_exists($objeto, $key)){
                $objeto->$key=$value;
            }
        }
        return $objeto;
    }
    // public function eliminarImagen(){
    //     $rutaImagenAnterior=CARPETA_IMAGENES . $this->imagen;
    //     if(file_exists($rutaImagenAnterior)){
    //         unlink($rutaImagenAnterior);
    //     }
    // }

    public function actualizar(){
        $atributos=$this->sanitizarAtributos();
        $valores=[];
        foreach($atributos as $key=>$value){
            $valores[]="{$key}='{$value}'";
        }
        $query="UPDATE ". static::$tabla . " SET "; // corrected
        $query.= implode(", ", $valores); // corrected
        $query.= " WHERE ID = '". self::$db->escape_string($this->id) ."'"; // corrected
        $query.= " LIMIT 1 ";
        $resultado=self::$db->query($query);
        return $resultado;
    }
    
    public function sincronizar($args=[]){
        foreach($args as $key=>$value){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key=$value;
            }
        }
        
    }
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
}
?>