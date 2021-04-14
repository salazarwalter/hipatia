<?php 

/**
 * 
 */
class Modulo extends ActiveRecord
{
    public static $PRIVADO =array("N"=>"NO","S"=>"SI");

    public function initialize()
	{
            $this->validates_presence_of("modulo",array("message"=>"Debe Ingresar el nombre del Módulo"));
            $this->validates_presence_of("menu",array("message"=>"Debe Ingresar el Texto del Menú"));
            $this->validates_uniqueness_of("modulo",array("message"=>"Módulo ya ingresado"));
            $this->validates_presence_of("descripcion",array("message"=>"Debe Ingresar La Descripción del Módulo"));
            $this->validates_presence_of("logo",array("message"=>"Debe Ingresar la clase fa fa-xxx de font awesome"));
            $this->validates_presence_of("precio",array("message"=>"El precio debe ser numérico"));
	}
        
    public function agregar($vec) {
        $vec["modulo"] = trim($vec["modulo"]);
        $vec["descripcion"] = trim($vec["descripcion"]);
        $vec["logo"] = trim($vec["logo"]);
        $vec["menu"] = trim($vec["menu"]);
        $vec["precio"] = (float)$vec["precio"];
        try{
        if(!$this->create($vec))
        {
            return FALSE;
        }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Módulo");
            }
//            else
//                Flash::error();
            return FALSE;
        }
        return TRUE;
    }    
    
    public function modificar($vec) {
        $vec["id"] = (int)trim($vec["id"]);
        $vec["modulo"] = trim($vec["modulo"]);
        $vec["descripcion"] = trim($vec["descripcion"]);
        $vec["logo"] = trim($vec["logo"]);
        $vec["precio"] = (float)$vec["precio"];
        $vec["menu"] = trim($vec["menu"]);
        
        if(!$vec["id"])
        {
            Flash::error("ID Obj No Hallado");
            return false;
        }
        
        if($vec["precio"]<0)
        {
            Flash::error("El Precio no puede ser menor que cero");
            return false;
        }
        
        try{
            if(!$this->update($vec))
            {
                return FALSE;
            }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Módulo");
            }
//            else
//                Flash::error();
            return FALSE;
        }
        return TRUE;
    }    
    
    public function borrar($vec) {
        $vec["id"] = (int)trim($vec["id"]);
        
        if(!$vec["id"])
        {
            Flash::error("ID Obj No Hallado");
            return false;
        }
        
        $h= $this->hallar($vec["id"]);
        if(!$h)
        {
            Flash::error("Modulo No Hallado");
            return false;
        }
        
        
        try{
            if(!$this->delete($vec["id"]))
            {
                return FALSE;
            }
        } catch (Exception $k)
        {
            return FALSE;
        }
        return TRUE;
    }    
    
    public function hallar($modulo_id) {
        if(!$modulo_id)
        {
            Flash::error("ID Obj No Hallado");
            return false;
        }
        $mod =new Modulo();
        $h = $mod->find("id=".$modulo_id);
//        print_r($h);
//        die();
        if(count($h)==0)
        {
            Flash::error("Obj Modulo No Hallado");
            return false;
        }
        
        $h[0]->modulo_id = $modulo_id;
        
        return $h[0];
    }
    
}
 ?>