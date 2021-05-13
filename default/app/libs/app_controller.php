<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todos las controladores heredan de esta clase en un nivel superior
 * por lo tanto los métodos aquií definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
abstract class AppController extends Controller
{

    final protected function initialize()
    {
//        Auth::destroy_identity();
        if(Auth::is_valid()) //esta autenticado?
        {
            $con = $this->controller_name;
            $act = $this->action_name;
            if(!Usuario::tieneAcceso($con,$act))
            {
                die("No tiene acceso $con $act");
            }
            Usuario::obtenerFotoPerfil();
            $menu = new Menu() ;
            
        }
    }

    final protected function finalize()
    {
        
    }

}
