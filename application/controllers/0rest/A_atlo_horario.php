<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class A_atlo_horario extends CI_Controller {

    public function index( )
    {
        //https://wendy.log99.es/index.php/A_atlo_horario/index
        echo 'Hola Mundo';

    }


    public function obtener_fecha(){

        //https://wendy.log99.es/index.php/A_atlo_horario/obtener_fecha
        //https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_fecha
        
        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_date` LIKE '$fecha'" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);
       

    }


   
    public function esta_semana_mix($manana, $semana, $any=null){



        if(!isset($any)) {
            $any = date('Y');
          }
       
    
       $this->load->database();

       $sql = 
       "SELECT * FROM `at_temp_dias` WHERE `dias_id` >= $manana AND `dias_semana` = $semana AND `dias_anyo` = $any order by `dias_id` asc " ;

       $query = $this->db->query($sql); 
       $resultado = $query->result();


       $semana_proxima = $semana+1; 


       $sql1 = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_semana` = $semana_proxima and `dias_anyo` =  $any order by `dias_id` asc  ";


        $query1 = $this->db->query($sql1); 
        $resultado1 = $query1->result();



        $resultado_mix = array_merge($resultado,$resultado1);




        echo json_encode(
            
           $resultado_mix
        );








    }

    public function esta_semana($manana, $semana, $any=null){

        //https://wendy.log99.es/index.php/A_atlo_horario/esta_semana/manana/semana_actual



        if(!isset($any)) {
             $any = date('Y');
           }
        
        


        $this->load->database();

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_id` >= $manana AND `dias_semana` = $semana AND `dias_anyo` = $any order by `dias_id` asc " ;

        $query = $this->db->query($sql); 


        
       

        echo json_encode(
            $query->result()
        
        );


        

       

    }

    public function semana_hoy($dia){

        //https://wendy.log99.es/index.php/A_atlo_horario/semana_hoy/103
        
        $this->load->database();

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_id` = $dia" ;

        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

    }

    //SELECT * FROM `at_temp_dias` WHERE `dias_id` = 103

    public function semana_proxima($semana_proxima, $any= null){

        if(!isset($any)) {
             $any = date('Y');
           }
        
        //https://wendy.log99.es/index.php/A_atlo_horario/semana_proxima

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_semana` = $semana_proxima and `dias_anyo` =  2019 " ;

        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

    }

    public function semana_proxima_max_min($semana_proxima,$any= null ){

        //https://wendy.log99.es/index.php/A_atlo_horario/semana_proxima_max_min
        
      
        //https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_proxima_max_min/


        if(!isset($any)) {
           $any = date('Y');
          }


        $this->load->database();

        $sql = 
        "SELECT MAX(dias_date) max, MIN(dias_date) min FROM `at_temp_dias` WHERE `dias_semana` = $semana_proxima and `dias_anyo` =  $any ";

        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

    }


    

    
    //SELECT * FROM `at_temp_dias` WHERE `dias_id` = 103

    public function semanas($esta_semana){

        //https://wendy.log99.es/index.php/A_atlo_horario/semana_proxima
        //https://v1.atlo.es/index.php/0rest/A_atlo_horario/semanas/34

        $semana_menos1  = $esta_semana-1;
        $semana_mas1    = $esta_semana+1;
        $semana_mas2    = $esta_semana+2; 
        $semana_mas3    = $esta_semana+3;

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE 
        
        `dias_semana` = $semana_menos1 OR 
        `dias_semana` = $esta_semana OR 
        `dias_semana` = $semana_mas1 OR 
        `dias_semana` = $semana_mas2 OR 
        `dias_semana` = $semana_mas3 
        
        ";

        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

    }

    public function obtener_clases_especiales($fecha){

        //https://wendy.log99.es/index.php/A_atlo_horario/obtener_clases_especiales

        $this->load->database();

        $sql = 
            "SELECT * FROM `at_def_clases` WHERE `at_def_clases`.`dias_id` > ".$fecha." AND `at_def_clases`.`nada_id` = 'ESPECIAL' ORDER BY `at_def_clases`.`dias_id` ASC" ;
                
        $query = $this->db->query($sql);
        
        echo json_encode(
            $query->result()
       );
        
    

    }

    public function obtener_clases_semanales($fecha){

        //https://wendy.log99.es/index.php/A_atlo_horario/obtener_clases

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_def_clases` WHERE `dias_id` = $fecha AND `clases_ocultar` = 'NO'  ORDER BY `at_def_clases`.`dias_id` ASC " ;
        
        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

    }
    

    public function obtener_clases($fecha){

        //https://wendy.log99.es/index.php/A_atlo_horario/obtener_clases

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_def_clases` WHERE `dias_id` = $fecha AND `at_def_clases`.`clases_ocultar` = 'NO'  ORDER BY `at_def_clases`.`dias_id` ASC " ;
        
        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

        

    }



}
?>