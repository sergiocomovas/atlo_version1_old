<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WendyContacto extends CI_Controller {

    function index(){

        //https://v1.atlo.es/index.php/0rest/WendyContacto/

        echo $dato = $this->input->get('dato');

    }
}