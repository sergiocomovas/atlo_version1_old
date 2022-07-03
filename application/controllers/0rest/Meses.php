<?php

//clausula de protección

defined('BASEPATH') OR exit('No direct script access allowed');


class Meses extends CI_Controller {


        public function mes ( $mes ){

        //cargar helper

        $this->load->helper('utilidades');
        //hace referencia a carpeta helper utilidades_helper.php y lo carga


        //    $meses = array (
        //        'enero',
        //        'febrero',
        //        'marzo',
        //        'abril',
        //        'mayo',
        //        'junio',
        //        'julio',
        //        'agosto',
        //        'septiembre',
        //        'octubre',
        //       'noviembre',
        //        'diciembre'
        //    );
        // nota: -= resta 1 al mes.

        echo json_encode( obtener_mes ( $mes ));
        

        }



}