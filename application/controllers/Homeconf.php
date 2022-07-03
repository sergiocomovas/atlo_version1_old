<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeConf extends CI_Controller {

    public function index(){

        echo "Hola Mundo";
    }


    public function ficha_cliente(){


         $this->load->view('50_conf/52_conf_datos'); 

    }

    public function alta_sus(){

        $this->load->view('50_conf/53_alta_sus'); 
    }

    public function baja_sus(){

        //$this->load->view('50_conf/54_baja_sus');
        $this->load->view('45_ficha_especial');
        

    }


    public function oferta_sus(){
//https://v1.atlo.es/index.php/homeconf/oferta_sus
        echo "<h1>¡Espera!</h1>";
        echo "<h4>A partir del  14 de septiembre 2019, la normativa europea exigirá la autenticación reforzada de clientes (SCA) para muchos de los pagos en línea. </h4>";
        echo "<h4>¡POR FAVOR, PULSA <a target='_blank' href='https://api.whatsapp.com/send?phone=34615890787&text=ACTIVAR_OFERTA&source=&data='>AQUÍ</a> PARA ACTIVAR TU OFERTA O ESCRIBE A <a href='mailto:sergio@mallorcainterbox.com?subject=Activar%20Factura'>SERGIO@MALLORCAINTERBOX.COM!</a></h4>";

//ES70 2100 1051 9902 0010 9564
        //CONTUNUAR AQUI


    }

}
