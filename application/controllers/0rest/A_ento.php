<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class A_ento extends CI_Controller 
{

    public function index(){

        echo "hola mundo";

    }


    public function historial_completo(){

        $this->load->database();

        $sql = "SELECT * FROM `at_def_entowod` WHERE `entowod_clase` LIKE '%Metcon%' and `entowod_descripcion` LIKE '%MRAP%'" ;

        $query = $this->db->query($sql);
        
        echo json_encode(
            $query->result()
        );

    }



}


?>