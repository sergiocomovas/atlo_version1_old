<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index(){

        
        $data['title'] = 'Atlo Training Club ——— @atlobarbellclub Box Can Valero ——— El teu nou Gym a Palma de Mallorca';



        $this->load->view('!_html.php');


        $this->load->view('00_head', $data);

        $this->load->view('!_body.php');
        
        
        
        $this->load->view('10_carrusel2');
        $this->load->view('11_navegacion');
        
        $this->load->view('40_panel');
        
        //el 40 panel incluye vistas a:
        //$this->load->view('41_horario_g'); 
        



        $this->load->library('session');

        if($this->session->userdata('username') != "")
        {

        echo "";
            
        }else{  $this->load->view('51_info_redes'); }
        

        $this->load->view('48_horario_modal');

        $this->load->view('49_menu');

        $this->load->view('50_info_principal');

        $this->load->view('52_info_ofertas');

        $this->load->view('52_info_ofertas');

        $this->load->view('55_info_atp.php');
        
        //$this->load->view('57_info_apuntate.php');

        //$this->load->view('33_spartanos.php');
        //$this->load->view('59_info_comollegar.php');
        
        $this->load->view('80_cierre');

        $this->load->view('!_body_fin.php');

        $this->load->view('!_html_fin.php');


      
    }


}

?>