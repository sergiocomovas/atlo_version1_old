<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalia extends CI_Controller {

    public function index(){

        
        
  

        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        
        $this->load->view('p_promo_globalia');

    }


}

?>