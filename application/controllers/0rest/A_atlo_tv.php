<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class A_atlo_tv extends CI_Controller {

    public function extra($extra){

        //https://v1.atlo.es/index.php/0rest/A_atlo_tv/extra
        
        $this->load->database();

         $sql = "SELECT * FROM `at_def_entoprogram`,`at_def_entowod` WHERE `at_def_entoprogram`.`entowod_id`= `at_def_entowod`.`entowod_id` and `at_def_entowod`.`entowod_clase` like 'eXtra' and `at_def_entoprogram`.`dia_id`=".$extra;

        $query = $this->db->query($sql);
        $row = $query->row(); 
        echo json_encode($row);
        
    }

    public function clase_actual( )
    {
        //https://v1.atlo.es/index.php/0rest/A_atlo_tv/clase_actual

        date_default_timezone_set('Europe/Madrid');

        $horaminuto= date ("H:i:00");
        
        //02-11-19
        $fecha= date ("m-d-y");

        //SELECT * FROM `at_def_clases` WHERE `dias_date` LIKE '12-02-19' AND `clases_hora` < '12:00:00' AND `clases_ocultar` = 'NO' ORDER BY `at_def_clases`.`clases_id` ASC

        $this->load->database();

        $sql = "SELECT * FROM `at_def_clases` WHERE `dias_date` LIKE '".$fecha."' AND `clases_hora` <= '".$horaminuto."' AND `clases_ocultar` = 'NO' ORDER BY `at_def_clases`.`clases_id` DESC";

        $query = $this->db->query($sql);
        $row = $query->row(); 
        echo json_encode($row);

    }

    public function clase_siguiente( )
    {
        //https://v1.atlo.es/index.php/0rest/A_atlo_tv/index

        date_default_timezone_set('Europe/Madrid');

        $horaminuto= date ("H:i:00");
        
        //02-11-19
        $fecha= date ("m-d-y");

        //SELECT * FROM `at_def_clases` WHERE `dias_date` LIKE '12-02-19' AND `clases_hora` < '12:00:00' AND `clases_ocultar` = 'NO' ORDER BY `at_def_clases`.`clases_id` ASC

        $this->load->database();

        $sql = "SELECT * FROM `at_def_clases` WHERE `dias_date` LIKE '".$fecha."' AND `clases_hora` >= '".$horaminuto."' AND `clases_ocultar` = 'NO' ORDER BY `at_def_clases`.`clases_id` ASC";

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row); 

    }

    public function lista($id){


    }

}

?>