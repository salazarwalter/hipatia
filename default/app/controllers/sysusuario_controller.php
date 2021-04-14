<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysusuarioController extends AppController
{

    public function login()
    {
    	View::template("default_1");
        if(Input::hasPost("usu"))
        {
            $usu =new Usuario();
            if ($usu->login())
                {
                    Redirect::to("../../sysmodulo/index");
                } 
                else 
                {
                    Flash::error("Usuario no reconocido por el sistema");
                }            

        }
    }
    
    public function salir() {
        Auth::destroy_identity();
        Redirect::to("../../");
        die();
    }
    
    public function clave() {
        if(Input::hasPost("clave1"))
        {
            $clave1= trim(Input::post("clave1"));
            $clave2= trim(Input::post("clave2"));
            $clave3= trim(Input::post("clave3"));
            
            $usu = new Usuario();
            if($usu->cambiarClave($clave1,$clave2,$clave3))
            {
                //Flash::error("La Contraseña se Cambió Exitósamente.");
                Redirect::to("../../sysusuario/claveok");
            }
        }
        if(Session::get("cam-cla")=="ok")
        {
            Flash::info("Se cambió exitósamente de Contraseña");
            Session::delete("cam-cla");
        }
        $this->titulo = "CAMBIAR CLAVE";
    }
    public function claveok() {
        $this->titulo = "EXITOSA";
    }
}
