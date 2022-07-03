<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//HIDESEEK PLUGIN

class A_basic extends CI_Controller {


    public function index(){

        echo'<!doctype html>
        <html lang="en">
          <head>
            <title>ATLO/F1029</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          </head>
          <body><div class="container-fluid"><div class="row">';

        echo '<div class="col-2"><div style="position: sticky;
        top: 12px;" >
        
        
        <a href="#Z1">Fecha de Hoy</a><br><br>
        <a href="#Z2">Últimos Wods</a><br><br>
        <a href="#Z3"><strong>FEEDBACKS</strong></a><br><br>
        <a href="#Z4">Reservas de Clases</a><br><br>
        <a href="#Z5">Valoraciones</a><br><br>
        <a href="#Z6">Listado de Clientes</a><br><br>
        
        </div></div>';

        echo '<div class="col-10">';

        //---
        echo '<h3 id="Z1">FECHA DE HOY</h3>';
        echo file_get_contents('https://v1.atlo.es/index.php/0rest/A_basic/dias_id');
        echo '<hr>';

        //---
        echo '<h3 id="Z2">ÚLTIMOS WODS</h3>';
        echo file_get_contents('https://v1.atlo.es/index.php/0rest/A_basic/wod_orden/35');
        echo '<hr>';

        //---
        echo '<h3 id="Z3">ÚLTIMOS FEEDBACKS</h3>';
        echo file_get_contents('https://v1.atlo.es/index.php/0rest/A_basic/feedback_orden/15');
        echo '<hr>';

        //--https://v1.atlo.es/index.php/0rest/A_basic/reservas_orden
        echo '<h3 id="Z4">ÚLTIMAS RESERVAS DE CLASES</h3>';
        echo file_get_contents('https://v1.atlo.es/index.php/0rest/A_basic/reservas_orden/20');
        echo '<hr>';
       
        //--https://v1.atlo.es/index.php/0rest/A_basic/caritas_orden
        echo '<h3 id="Z5">ÚLTIMAS VALORACIONES (CARITAS)</h3>';
        echo file_get_contents('https://v1.atlo.es/index.php/0rest/A_basic/caritas_orden/20');
        echo '<hr>';
        
        //--https://v1.atlo.es/index.php/0rest/A_basic/clientes_orden/12
        echo '<h3 id="Z6">CLIENTES ORDEN</h3>';
        echo file_get_contents('https://v1.atlo.es/index.php/0rest/A_basic/clientes_orden/1000');
        echo '<hr>';
        

        


        echo '</div>';

          
              
          
           
        echo  '</div></div></body>
        </html>';

    }

    //SABER EL ID DEL DÍAS
    public function dias_id(){

        //https://v1.atlo.es/index.php/0rest/A_basic/dias_id
        $this->load->database();
        $this->load->library('table');
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_date` LIKE '$fecha'" ;

        $query = $this->db->query($sql);
        echo $this->table->generate($query);

    }
    
    //VER ENTRENOS SEGÚN EL ID
    //SELECT * FROM `at_def_entowod` ORDER BY `at_def_entowod`.`entowod_timestamp` DESC
    public function wod_orden($limite=500){

        //https://v1.atlo.es/index.php/0rest/A_basic/wod_orden
        $this->load->database();
        $this->load->library('table');
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_entowod` ORDER BY `at_def_entowod`.`entowod_timestamp` DESC LIMIT 0,".$limite ;

        $query = $this->db->query($sql);
        echo $this->table->generate($query);

    }

    //VER CLASES SEGÚN ORDEN DE LLEGADA
    //SELECT * FROM `at_def_listas` ORDER BY `at_def_listas`.`listas_autodate` DESC LIMIT 0,500
    public function reservas_orden($limite=100){

        //https://v1.atlo.es/index.php/0rest/A_basic/reservas_orden
        $this->load->database();
        $this->load->library('table');
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_listas` ORDER BY `at_def_listas`.`listas_autodate` DESC LIMIT 0,".$limite ;

        $query = $this->db->query($sql);
        echo $this->table->generate($query);

    }

    //VER CARITAS SEGÚN ORDEN DE LLEGADA
    //SELECT `val_id`, `clientes_email`,`vale_fecha`,`val_resumenwod`,`val_carita` FROM `at_def_valoraciones`ORDER BY `at_def_valoraciones`.`val_autodate` DESC
    public function caritas_orden($limite=100){

        //https://v1.atlo.es/index.php/0rest/A_basic/caritas_orden
        $this->load->database();
        $this->load->library('table');
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT `val_id`, `clientes_email`,`vale_fecha`,`val_resumenwod`,`val_carita` FROM `at_def_valoraciones`ORDER BY `at_def_valoraciones`.`val_autodate` DESC LIMIT 0,".$limite ;

        $query = $this->db->query($sql);
        echo $this->table->generate($query);

    }    


    //VER TODOS LOS ALUMNOS
    //SELECT * FROM `at_def_clientes` ORDER BY `at_def_clientes`.`clientes_orden` DESC
    public function clientes_orden($limite=100){

        //https://v1.atlo.es/index.php/0rest/A_basic/clientes_orden/12
        $this->load->database();
        $this->load->library('table');
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_clientes` ORDER BY `at_def_clientes`.`clientes_orden` DESC LIMIT 0,".$limite;

        $query = $this->db->query($sql);
        echo $this->table->generate($query);

    }    

    //VER VALORACIONES SEGÚN EL ALUMNO
    //SELECT * FROM `at_def_valor` ORDER BY `at_def_valor`.`valor_timedate` DESC
    public function feedback_orden($limite=100){

        //https://v1.atlo.es/index.php/0rest/A_basic/feedback_orden/20
        $this->load->database();
        $this->load->library('table');
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_valor` ORDER BY `at_def_valor`.`valor_timedate` DESC LIMIT 0,".$limite;

        $query = $this->db->query($sql);
        echo $this->table->generate($query);

    }    

    //SELECT * FROM `at_def_records_resultados` ORDER BY `at_def_records_resultados`.`resultados_id` DESC
    public function records_orden(){

        //https://v1.atlo.es/index.php/0rest/A_basic/feedback_orden/
        $this->load->database();
        $this->load->library('table');
                
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        
        $sql = "SELECT * FROM `at_def_records_resultados` ORDER BY `at_def_records_resultados`.`resultados_id` DESC";
                
        
        $query = $this->db->query($sql);
        echo $this->table->generate($query);
    
    }


} 
?>