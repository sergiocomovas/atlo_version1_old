<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PruebaAjax extends CI_Controller {

    public function index(){

        
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        $this->load->view('00_head');
        $this->load->view('11_navegacion');
        $this->load->view('31_gloria_2');
        $this->load->view('80_cierre.php');
    }


}

?>