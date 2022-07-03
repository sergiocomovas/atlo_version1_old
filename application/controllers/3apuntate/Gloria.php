<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gloria extends CI_Controller {

    public function index(){

        
        $this->load->view('!_html');
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        $data['title'] = 'Alcanza La Gloria ——— @atlobarbellclub ——— El teu nou Gym a Palma de Mallorca';

        $this->load->view('00_head', $data);

        $this->load->view('!_body');

        $this->load->view('30_titulo');
        $this->load->view('31_gloria');
        
        
        $this->load->view('80_cierre');
        $this->load->view('!_body_fin');
        $this->load->view('!_html_fin');
    }


}

?>