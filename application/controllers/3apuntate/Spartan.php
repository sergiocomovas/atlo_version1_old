<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spartan extends CI_Controller {

    public function index(){

        
        $this->load->view('!_html');
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        $data['title'] = 'Curso Spartan Race ——— @atlobarbellclub';

        $this->load->view('00_head', $data);

        $this->load->view('!_body');

        $this->load->view('30_titulo');
        $this->load->view('33_spartanos');
        
        
        $this->load->view('80_cierre');
        $this->load->view('!_body_fin');
        $this->load->view('!_html_fin');
    }


}

?>