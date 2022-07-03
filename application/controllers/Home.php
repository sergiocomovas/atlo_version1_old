<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index(){

        $data['title'] = 'Atlo Training Club ——— @atlobarbellclub Box Can Valero ——— Som el Fucnional Fitness a Palma de Mallorca';
        
        $this->load->view('home2/1principal', $data);
    }

    public function premium_clases(){

        $this->load->view('42_horario_privado_ajax');
    }

    public function premium_wod(){

         $this->load->view('60_atl/60_atletas_paso1_v1');
    }

    public function premium_training(){

        $this->load->view('60_atl/60_atl_training_menu_v1');
    }

    public function premium_config(){

        $this->load->view('50_conf/50_index');


        
    }

    public function invitados_info(){

        echo "II";
    }

    public function invitados_info2(){

        echo "II2";
    }







}