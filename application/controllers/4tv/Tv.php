<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Tv extends CI_Controller {


    public function prueba_1(){
        
        $this->load->helper('url');
        $data['title'] = 'Atlo TV ——— @atlobarbellclub';
        $this->load->view('01_head_tv', $data);
        //https://v1.atlo.es/index.php/4tv/Tv/prueba_1
       
        $this->load->view('tv/f_tv_r1');
       //$this->load->view('80_cierre');


    }

    public function tv1(){


        $this->load->helper('url');
        $this->load->view('tv/f_tv1');
    }

    public function index(){


        //v1.atlo.es/index.php/4pizarra/pizarra

        $this->load->view('!_html');
        $this->load->helper('url');  
        $fecha = date('Y-m-d');  
        $data['title'] = 'Atlo TV ——— @atlobarbellclub';

        $this->load->view('01_head_tv', $data);
        
        $this->load->view('!_body_fin');
        $this->load->view('!_html_fin');


    }



}

?>