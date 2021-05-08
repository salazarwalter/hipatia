<?php 

/**
 * 
 */
class Perfil extends ActiveRecord
{
    public static $ADMIN=array("N"=>"NO","S"=>"SI");

	public function initialize()
	{
//		$this->validates_length_of("nombre", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
// 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
//		$this->validates_length_of("nombre", "in: 15:40",
//		      "too_short: El nombre debe tener al menos 15 caracteres",
//		      "too_long: El nombre debe tener maximo 40 caracteres"
//		   );
        $this->validates_presence_of("perfil", array("message"=>"Debe Ingresar el Perfil"));
        $this->validates_presence_of("precio", array("message"=>"Debe Ingresar el Precio"));
        $this->validates_presence_of("admin", array("message"=>"Debe Indicar si es un perfil Administrador"));
	}

    public function agregar($vec) {
        $vec["modulo_id"] = (int)trim($vec["modulo_id"]);
        $vec["perfil"]    = trim($vec["perfil"]);
        $vec["admin"]    = trim($vec["admin"]);
        $vec["precio"]    = (float)trim($vec["precio"]);
        if($vec["modulo_id"]<=0){
            Flash::error("Id de Modulo Incorecto");
            return FALSE;
        }
        if($vec["precio"]<0){
            Flash::error("El precio No puede ser menor que cero");
            return FALSE;
        }
        
        try{
        if(!$this->create($vec))
        {
            return FALSE;
        }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Perfil En este Módulo");
            }else                Flash::error ($k->getMessage ());
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function modificar($vec) {
        $vec["id"]          = (int)trim($vec["id"]);
        $vec["modulo_id"] = (int)trim($vec["modulo_id"]);
        $vec["perfil"]    = trim($vec["perfil"]);
        $vec["admin"]    = trim($vec["admin"]);
        $vec["precio"]    = (float)trim($vec["precio"]);
        if($vec["modulo_id"]<=0){
            Flash::error("Id de Modulo Incorecto");
            return FALSE;
        }
        if($vec["precio"]<0){
            Flash::error("El precio No puede ser menor que cero");
            return FALSE;
        }
        
        if($vec["id"] <= 0)
        {
            Flash::error("ID COntrolador No definido");
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
                Flash::error("Ya se Ingresó este Perfil En este Módulo");
            }
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function borrar($vec) {
        $vec["id"]        = (int)trim($vec["id"]);
        if($vec["id"] <= 0)
        {
            Flash::error("ID Perfil No definido");
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
        
    
    public function hallar($perfil_id) {
        $perfil_id =(int)$perfil_id;
        if($perfil_id <= 0)
        {
            Flash::error("ID Perfil No definido");
            return false;
        }
        $sql = "SELECT perfil.*, modulo.modulo,perfil.id as perfil_id "
                . "FROM perfil INNER JOIN modulo ON perfil.modulo_id = modulo.id "
                . "WHERE perfil.id = $perfil_id ";
        $lista = $this->find_all_by_sql($sql);
        if(count($lista)<1)
        {
            Flash::error("Objeto Perfil No Hallado");
            return false;
        }
        
        return $lista[0];
    }
    
    public function combo_perfilesXmodulo($param) {
        return $this->find("modulo_id={$param["modulo_id"]}");
    }
}
 ?>