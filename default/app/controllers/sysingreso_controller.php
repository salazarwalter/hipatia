<?php

/**
 * 
 * Controller por defecto si no se usa el routes
 *
 */

Load::model("dao/ingresoDao");

class SysingresoController extends AppController
{

/**************************    Para Registrarse Como usuario del sistema   ********************************/ 
    public function registro(){
        View::template("default_1");
        if(Input::hasPost("a")){
            $vector = Input::post("a");
            $user = new IngresoDao();
            if ($user->registrarme($vector)) {
                Redirect::to("../../sysingreso/registroSatisfactorio");
            } else {
                Flash::error($user->message);
            }
        }
    }
    public function confirmar($parametros) {
        View::template("default_1");
        $dao = new IngresoDao();
        if($dao->registroSatisfactorio($parametros)){
            Redirect::to("../../sysingreso/registroSatisfactorio");
        }else{
            Redirect::to("../../sysingreso/registroFallido");
        }
            die();
    }
    
    public function registroSatisfactorio($p=0) {
        View::template("default_1");
//        $dao = new IngresoDao();
//        if($dao->registroSatisfactorio($parametros)){
//                
//        }
//        Flash::info("Su Registro es satisfactorio. Hemos Enviado un Email a su Correo Electr&oacute;nico. Como &uacute;ltimo paso, ingrese a su  Correo y Confirme el Email");
    }    
    public function registroFallido($parametros) {
        View::template("default_1");
//        $dao = new IngresoDao();
//        if($dao->registroSatisfactorio($parametros)){
//                
//        }
//        Flash::info("Su Registro es satisfactorio. Hemos Enviado un Email a su Correo Electr&oacute;nico. Como &uacute;ltimo paso, ingrese a su  Correo y Confirme el Email");
    }    
    
/**************************    Para Ingresar Al sistema   ********************************/ 
/**************************    Para Ingresar Al sistema   ********************************/ 
/**************************    Para Ingresar Al sistema   ********************************/ 
    
    public function ingresar(){
        View::template("default_1");
        if(Input::hasPost("a")){
            
            $vector = Input::post("a");
            $user = new IngresoDao($vector);
            if ($user->ingresar($vector)) {
                Flash::info("Bienvenida Satisfactorio. ");
                Session::set("uno", "4");
                Session::set("dos", "54");
                Redirect::to("../../mismodulo/principal");
                //$this->enrutarLogin();

            }else
                Flash::error($user->message);
        }        
    }
    
 

    
    public function salir() {
        Auth::destroy_identity();
        Redirect::to("../../");
    }

//    public function login()
//    {
//    	View::template("default_1");
//        if(Input::hasPost("usu"))
//        {
//            $usu =new Usuario();
//            if ($usu->login())
//                {
//                    Redirect::to("../../sysmodulo/index");
//                    Session::set("uno", "2");
//                    Session::set("dos", "2");
//                    
//                } 
//                else 
//                {
//                    Flash::error("Usuario no reconocido por el sistema");
//                }            
//
//        }
//    }
//    
//    public function salir() {
//        Auth::destroy_identity();
//        Redirect::to("../../");
//        die();
//    }
//    
//    public function clave() {
//        if(Input::hasPost("clave1"))
//        {
//            $clave1= trim(Input::post("clave1"));
//            $clave2= trim(Input::post("clave2"));
//            $clave3= trim(Input::post("clave3"));
//            
//            $usu = new Usuario();
//            if($usu->cambiarClave($clave1,$clave2,$clave3))
//            {
//                //Flash::error("La Contraseña se Cambió Exitósamente.");
//                Redirect::to("../../sysusuario/claveok");
//            }
//        }
//        $this->titulo = "CAMBIAR CLAVE";
//    }
//    public function claveok() {
//        $this->titulo = "EXITOSA";
//    }
//    
//    public function datos() {
//        if(Input::hasPost("a"))
//        {
//            $vec = Input::post("a");
//            $vec["id"]= Crypto::d($vec["id"]);
////            print_r($vec);
////            die();
//           
//            $usu = new Persona();
//            if($usu->modificar($vec))
//            {
//                //Flash::error("La Contraseña se Cambió Exitósamente.");
//                Redirect::to("../../sysusuario/datosok");
//            }
//        }
//        $a=new Persona();
//        $this->a = $a->hallarXUsuario(Auth::get("id"));
//        $this->a->id = Crypto::e($this->a->id);
//        $this->titulo = "DATOS PERSONALES";
//    }
//    public function datosok() {
//        $this->titulo = "EXITOSA";       
//    }
//    public function foto() {
//        if(Input::hasPost("ok"))
//        {
////            print_r($_FILES["seleccionar"]["error"]);
//           
//            $usu = new Usuario();
//            if($usu->cambiarFotoPerfil())
//            {
//                Redirect::to("../../sysusuario/foto");
//            }
//        }
//        $this->titulo = "FOTO PREFIL";
//    }
//    public function quitarfoto() {
//        $this->titulo = "QUITAR FOTO";
//        if(Input::hasPost("ok"))
//        {
//            $usu = new Usuario();
//            if($usu->quitarFotoPerfil())
//            {
//
//                Redirect::to("../../sysusuario/quitarfotook");
//            }
//        }
//        
//    }
//    
//    public function quitarfotook() {
//        $this->titulo = "FOTO REMOVIDA";
//       
//    }
    
}
