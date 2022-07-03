<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mallorca extends CI_Controller {

    public function index(){

        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');         

        echo "(C) MALLORCA INTERBOX ";
        $this->load->view('m_interbox.php');

    }


}

?>