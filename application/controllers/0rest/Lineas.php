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
class Lineas extends REST_Controller {

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


    public function index_get(){
        //no recibimos ningún parámetro

        $sql = "SELECT * FROM `lineas`";
        $query = $this->db->query( $sql );
        
        $respuesta = array (

            'err' => FALSE,
            'err_mens' => null,
            'err_desc' => null,
            'lineas' => $query -> result_array() 

        );

        $this->response( $respuesta );


    }

}//Cierre de la clase   
