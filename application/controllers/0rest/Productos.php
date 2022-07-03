<?php

//info: los controllers no tienen cierre php

//clausula de protección:
defined('BASEPATH') OR exit('No direct script access allowed');

require( APPPATH.'/libraries/REST_Controller.php');
//si diera error añadir: use Restserver\Libraries\REST_Controller;
//si diera error sustituir por require_once 

//info: REST_Controller convierte la data en application/json; charset=utf-8 
//      ...que es la que usan los Servicios Rest.
//anteriormente era: class Clientes/Lineas extends CI_Controller {
class Productos extends REST_Controller {

    //contructor
    public function __construct(){

        //headers:
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        //...

        //inicializar contructor:
        parent:: __construct();
        //...
        
        //Load de servicios de la database:
        $this->load->database();
        //...

        //Load de Modelos:
        //$this->load->model('Cliente_model');
        //...

        //Otros Loads
        //...

    }//fin del contructor


    public function todos_get( $pagina = 0){
    //puede que no tenga valor, entonces será la página 0

        $pagina = $pagina * 10;

        $sql = "SELECT * FROM `productos` limit ".$pagina.", 10";
        $query = $this->db->query( $sql );
        
        $respuesta = array (

            'err' => FALSE,
            'err_mens' => null,
            'err_desc' => null,
            'productos' => $query -> result_array() 

        );

        $this->response( $respuesta );

    }

    public function por_tipo_get( $tipo='Vintage Cars', $pagina =0 ){

        $pagina = $pagina * 10;

        $sql = "SELECT *  FROM `productos` 
                WHERE `linea` 
                LIKE '%".$tipo."%'
                limit ".$pagina.", 10";

        $query = $this->db->query( $sql );

        $respuesta = array (
                    
                'err' => FALSE,
                'err_mens' => null,
                'err_desc' => null,
                'productos' => $query -> result_array() 
            );
                    
        $this->response( $respuesta );
    }

    
    public function buscar_get( $termino, $pagina = 0 ){

        $pagina = $pagina * 10;

        $sql = "SELECT *  FROM `productos` 
                WHERE `producto` 
                LIKE '%".$termino."%'
                limit ".$pagina.", 10";

        $query = $this->db->query( $sql );

        $respuesta = array (
                    
                'err' => FALSE,
                'err_mens' => null,
                'err_desc' => null,
                'productos' => $query -> result_array() 
            );
                    
        $this->response( $respuesta );

    }

}//Cierre de la clase   
