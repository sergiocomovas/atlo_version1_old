<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class A_ofertas extends CI_Controller {

    public function index( )
    {
        
        echo 'Hola Mundo';

    }

    public function semanal($dia_mes){


        switch ($dia_mes) {
            case "1":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;
            case "2":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;
            case "3":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;
            case "4":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;    
            case "5":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;   
            case "6":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;
            case "7":
                $mostrar = "principios";
                //$mostrar = "mediados";
                //$mostrar = "finales";
                break;
            case "8":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";
                break;
            case "9":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";
                break;    
            case "10":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";
                break;    
            case "11":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                    
                break;
            case "12":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                  
                break;
            case "13":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                  
                break;
            case "14":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";               
                break;    
            case "15":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";               
                break;    
            case "16":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                  
                break;
            case "17":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                 
                break;
            case "18":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                 
                break;
            case "19":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                  
                break;    
            case "20":
                //$mostrar = "principios";
                $mostrar = "mediados";
                //$mostrar = "finales";                
                break;   
            case "21":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";                 
                break;
            case "22":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";                 
                break;
            case "23":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";  
                break;
            case "24":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";  
                break;    
            case "25":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";  
                break;    
            case "26":
                //mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";
                break;
            case "27":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";
                break;
            case "28":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";
                break;
            case "29":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";
                break;    
            case "30":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";
                break;  
            case "31":
                //$mostrar = "principios";
                //$mostrar = "mediados";
                $mostrar = "finales";
                break;      
            
        }

        //ahora mostrar contiene el nombre del día:

        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        //https://v1.atlo.es/index.php/0rest/A_ofertas/semanal/1

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_ofertas1` WHERE `Of_Mostar` LIKE 'todo' OR `Of_Mostar` LIKE '$mostrar' ORDER BY `at_ofertas1`.`Of_ID` ASC" ;
        
        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );




    }



    
}
?>