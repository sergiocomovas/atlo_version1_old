<?php

//clausula de protección
//los controllers no tienen cierre php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once
require( APPPATH.'/libraries/REST_Controller.php');
//use Restserver\Libraries\REST_Controller;


//class Clientes extends CI_Controller {
class Clientes extends REST_Controller {

    /*public function antiguo(){
        
                $data = array(
        
                    'nombre' => 'fernando herrera',
                    'contacto' => 'yolanda flores',
                    'direccion' => 'residencial villa de las hadas'
                
                );
        
                //$data['nombre'] = strtoupper($data['nombre']);
                //$data['contacto'] = strtoupper($data['contacto']);
        
                $this->load->helper('utilidades');
                //carga capitalizar_arreglo
                
                $campos_capitalizar = array ("nombre","contacto");
                //de la celda: nombre y contacto.
                $data = capitalizar_arreglo ($data, $campos_capitalizar);
        
                echo json_encode ($data); 
        
        
                
            }
    */


    //comienza aquí

    public function __construct(){

        parent:: __construct();        
        $this->load->database();

        //CARGAMOS, ADEMÁS EL MODELO
        $this->load->model('Cliente_model');

    }

    
    public function cliente_get(){
               
       $cliente_id = $this->uri->segment(3); 


       //validar segmento

       if ( !isset( $cliente_id)){


        $respuesta = array( 'err'=>TRUE,
                            'err_mens'=>'ID?',
                            'cliente'=>null


        );

        $this-> response (   $respuesta, REST_Controller::HTTP_BAD_REQUEST  ); 

        return;
       }



       $cliente = $this->Cliente_model->get_cliente( $cliente_id ); 

       // Validar que el cliente esté en la tabla

       if ( isset ($cliente) ){

        unset( $cliente->telefono1 );
        unset( $cliente->telefono2 );

        $respuesta = array( 'err'=>FALSE,
                            'err_mens'=>'Ninguno',
                            'cliente' => $cliente
        );

        $this-> response (   $respuesta  );   

       }else{

        $respuesta = array( 'err'=>TRUE,
                            'err_mens'=>'ID '.$cliente_id.' no existe',
                            'cliente' => null 
            );
        
        $this-> response (   $respuesta, REST_Controller::HTTP_NOT_FOUND  );   
               

       }//cierra el if/else
       //http://wendy.log99.es/index.php/clientes/cliente/199?format=xml

      
                
       //echo $cliente_id; 
    }



    /*
    public function cliente_antiguo($id){

        //cargar el modelo

        $this -> load -> model ('Cliente_model'); 

        $cliente = $this -> Cliente_model -> get_cliente($id);
        
        echo json_encode($cliente); 
    }
    */

    public function cliente_put() {

        $data = $this->put();

        //libreria form validation
        //https://codeigniter.com/user_guide/libraries/form_validation.html#rule-reference

        //cargar form validation
        $this -> load -> library ('form_validation');

        //qué data vamos a utilizar?
        $this -> form_validation -> set_data ( $data );
        
        //primera regla manuales
        //$this ->  form_validation -> set_rules ( "correo", "correo electronico", "required|valid_email" );
        //$this ->  form_validation -> set_rules ( "nombre", "nombre", "required|min_length[4]" );
        //arreglo de configuracion en un archivo de configuración
        //...



        if  ( $this -> form_validation-> run( 'cliente_put') ){

            //regresará un TRUE (todo bien)
            $cliente = $this -> Cliente_model -> set_datos ( $data );

            $respuesta = $cliente-> insert(); 
            
            if ( $respuesta['err'] ){

                $this->response ( $respuesta, REST_Controller::HTTP_BAD_REQUEST ); 


            }else{

                $this-> response ( $respuesta );


            }



            

        }else{

            //regresará un FALSE (algo mal)
            //$this-> response ("Alguna regla ha ido mal");

            $respuesta = array(

                'err' => TRUE,
                'err_mens' => 'Fallo en las reglas de validación',
                'err_deta' =>  $this->form_validation->get_errores_arreglo(),
                'cliente' => null
            );

            $this-> response ( $respuesta, REST_Controller::HTTP_BAD_REQUEST );   

        }
        
        
        //$this -> response ( $data ); 

    }//cliente_put

}