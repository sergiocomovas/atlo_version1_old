<?php

//clausula de protección {{ obligatoria }} 
//no hay cierre de php
// clase 1
//http://wendy.log99.es/index.php/blog

defined('BASEPATH') OR exit('No direct script access allowed');


class Blog extends CI_Controller {

        public function index()
        {
                echo 'Hello World!';
        }

        public function comentarios ( $id ){


                if (!is_numeric($id)){

                        $respuesta = array(

                                'err' => true, 
                                'def' => 'Id no numérico'
                        );

                        echo json_encode($respuesta);

                        return; 
                }

                $comentarios = array (

                        array( 'id' => 0, 
                              'name' => 'Sergio'), 
                        array( 'id' => 1, 
                              'name' => 'Carlos'),
                        array( 'id' => 2, 
                              'name' => 'Marta')
                );

                if ( $id >= count($comentarios) OR $id<0){

                        $respuesta = array(
                                'err' => true, 
                                'def' => 'Id no asignado'
                        );
                                
                       echo json_encode($respuesta);
                                
                       return; 


                }

                echo json_encode ($comentarios[$id]);
                echo ("<br>");
                echo "Hola Mundo Comentarios"; 
        }



}
