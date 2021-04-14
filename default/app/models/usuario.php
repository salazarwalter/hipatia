<?php 

/**
 * 
 */
class Usuario extends ActiveRecord
{
	

	public function initialize()
	{
		$this->validates_length_of("nombre", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
		$this->validates_length_of("nombre", "in: 15:40",
		      "too_short: El nombre debe tener al menos 15 caracteres",
		      "too_long: El nombre debe tener maximo 40 caracteres"
		   );
	}
        
        
        public function login() {
            $usu = trim(Input::post("usu"));
            $cla = trim(Input::post("cla"));
            
            $usu = base64_encode($usu);
            $cla = base64_encode($cla);
            $auth = new Auth("model", "class: usuario", "usu: $usu", "cla: $cla");
                    
                if ($auth->authenticate())
                {
                    return TRUE;
                } 
                else 
                {
                    return FALSE;
                }            
        }
        
        public function cambiarClave($clave1,$clave2,$clave3) {
            Session::set("cam-cla", "no");
            if(strlen($clave1)<9||strlen($clave2)<9||strlen($clave3)<9)
            {
                Flash::error("Las Claves No Pueden tener Menos de 9 Caracteres");
                return FALSE;
            }
            $clave1 = base64_encode($clave1);
            if($clave1!=Auth::get("cla"))
            {
                Flash::error("Las Claves Actual No Coincide con el usuario actual");
                return FALSE;
            }
            if($clave2!=$clave3)
            {
                Flash::error("Las Nuevas Claves Deben Ser Iguales");
                return FALSE;
            }
            $clave2 = base64_encode($clave2);
            $u=new Usuario();
            $usu=$u->find_by_id(Auth::get("id"));
            $usu->cla=$clave2;
            if(!$usu->update())
            {
                Flash::error("No se pudo Cambiar la clave. Intentelo Mas tarde");
                return FALSE;
            }
            Session::set("cam-cla", "ok");
            return true;
        }
}
 ?>