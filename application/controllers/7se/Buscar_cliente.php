<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buscar_cliente extends CI_Controller {


    //https://v1.atlo.es/index.php/7se/nuevo_cliente
    public function index(){

        echo "<html>";
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        $data['title'] = 'Zona [ BUSCAR CLIENTE ]';
        
        
        $this->load->view('00_head', $data);
        echo "<body>";
        $this->load->view('c2_menu_navegacion');
        
        $this->load->view('c7_buscar_cliente');
        
        //$this->load->view('80_cierre');
        echo "</body>";
        echo "</html>";
    }


}