<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_atlo_guardar_wod_izquierda extends CI_Controller {

    public function index(){
        
        //echo $_GET['date_invent'];



        if ( isset( $_GET['date_invent']) ) {


            $wod_desc = $_GET['date_invent'];
            $wod_cat = $_GET['date_invent2'];

            
            echo $wod_id = $_GET['date_invent3'];
            echo '<hr>';
            
            $wod_dia = $_GET['dia_id'];
            $wod_orden = $_GET['orden_num'];
   

            //$wod_orden = 99;
            //$wod_dia = 99; 


            if ($wod_cat == 'a'){ 

                $entowod_clases = "Improvement"; 
                $post_rx = 'disabled';
                $post_kg = 'disabled';
                $post_secs = 'disabled';
                $post_reps = 'disabled';

            }

            if ($wod_cat == 'b'){ 
                
                $entowod_clases = "Fuerza"; 
                $post_rx = 'disabled';
                $post_kg = '';
                $post_secs = 'disabled';
                $post_reps = 'disabled';

            }

            if ($wod_cat == 'c'){ 
                
                $entowod_clases = "Metcon (AMRAP)"; 
                $post_rx = '';
                $post_kg = 'disabled';
                $post_secs = 'disabled';
                $post_reps = '';

            }

            if ($wod_cat == 'd'){ 
                
                $entowod_clases = "Metcon (ASAP)"; 
                $post_rx = '';
                $post_kg = 'disabled';
                $post_secs = '';
                $post_reps = '';
                
            }

            if ($wod_cat == 'e'){ 
                
                $entowod_clases = "Medley";
                $post_rx = '';
                $post_kg = '';
                $post_secs = '';
                $post_reps = '';
                
            }

            if ($wod_cat == 'f'){ 
                
                $entowod_clases = "eXtra";
                $post_rx = '';
                $post_kg = '';
                $post_secs = '';
                $post_reps = '';
                
            }
        
            //Primer paso:
            //Mirar si existe dia_id.orden_num en la base de datos de entrenos
            //$aa = "SELECT * FROM `at_def_entoprogram` WHERE `entoprogram_orden` = $wod_orden AND `dia_id` = $wod_dia";
       
            $this->load->database();
        
            date_default_timezone_set('Europe/Berlin');     
            $fecha = date('Y-m-d H:i:s');  
            $hora = date('H:i:s');  
    
            $sql = 
            "SELECT * FROM `at_def_entoprogram` WHERE `entoprogram_orden` = '$wod_orden' AND `dia_id` = '$wod_dia'" ;
    
            $query = $this->db->query($sql);
            $row = $query->row();
            //echo json_encode($row);

            if (is_null($row)) {

                echo $hora; 
                echo '<br>WOD añadido correctamente.';
                echo "<br><i class='fas fa-check-square'></i><br> Núm. ";

                //si no existe es que se tiene que hay que insertar el resultado en las 2 bases de datos

                //INSERT INTO `at_def_entowod` (`entowod_id`, `entowod_timestamp`, `entowod_titulo`, `entowod_clase`, `entowod_hero`, `entowod_descripcion`, `entowod_post`, `post_rx`, `post_kg`, `post_secs`, `port_reps`) VALUES (NULL, 'current_timestamp().000000', NULL, 'Hola Mundo', NULL, '* Este es un ejemplo *', NULL, 'disabled', 'disabled', 'disabled', 'disabled');

                $sql = 
                "INSERT INTO at_def_entowod
                
                    (
                        entowod_timestamp, 
                        entowod_clase,
                        entowod_titulo,
                        entowod_descripcion, 
                        post_rx, 
                        post_kg,
                        post_secs,
                        post_reps

                    ) 
                    
                    VALUES 
                    
                    (
                    ".$this->db->escape($fecha).", 
                    ".$this->db->escape($entowod_clases).",
                    ".$this->db->escape("#ATP".$wod_dia.$wod_orden).",
                    ".$this->db->escape($wod_desc).",
                    ".$this->db->escape($post_rx).",
                    ".$this->db->escape($post_kg).",
                    ".$this->db->escape($post_secs).",
                    ".$this->db->escape($post_reps)."
                    
                    )";


                $this->db->query($sql);
                // echo $this->db->affected_rows();
                echo $wod_id = $this->db->insert_id();

                //insertar en la tabla 2
                //INSERT INTO `at_def_entoprogram` (`entoprogram_id`, `entoprogram_date`, `entoprogram_orden`, `dia_id`, `entowod_id`) VALUES (NULL, '19-99-11', '1', '1', '1');

                

                $sql = 
                "INSERT INTO at_def_entoprogram
                
                    (
                        
                        entoprogram_date,
                        entoprogram_orden, 
                        dia_id, 
                        entowod_id

                    ) 
                    
                    VALUES 
                    
                    (
                    ".$this->db->escape($fecha).", 
                    ".$this->db->escape($wod_orden).",
                    ".$this->db->escape($wod_dia).",
                    ".$this->db->escape($wod_id)."
                    
                    )";
                
                $this->db->query($sql);

                //echo "prueba";

               
                echo "<script>";

                echo "document.getElementById('entonum".$wod_dia.$wod_orden."').value = '".$wod_id."' ;";
                
                echo "document.getElementById('boton".$wod_dia.$wod_orden."').classList.remove('disabled');";

                //echo '$("#boton'.$wod_dia.$wod_orden.'").removeClass("disabled");';
              
                echo "</script>";



            }else{

                


                //update
                
                $this->load->database();
    
                date_default_timezone_set('Europe/Berlin');     
                //$fecha = date('Y-m-d');  


                if ($wod_cat == 'x'){

                    $data = array(
                        
                        'entowod_descripcion' => $wod_desc,
                        'entowod_timestamp' => $fecha
                        
                    );
                    

                }else{

                    $data = array(
                        'entowod_clase' => $entowod_clases,
                        'entowod_descripcion' => $wod_desc,
                      
                        'entowod_timestamp' => $fecha,
                        'post_rx' => $post_rx,
                        'post_kg' => $post_kg,
                        'post_secs' => $post_secs,
    
                        'post_reps' => $post_reps
                    );

                }

                //print_r( $data );
                
                //ESTO ES LO QUE FALLA  vv
                $this->db->where('entowod_id', $wod_id );
                
                $this->db->update('at_def_entowod', $data);
                //ESTO ES LO QUE FALLA  ^^
             

                echo $hora; 
                echo '<br>WOD actualizado correctamente.';
                

                echo "<script>";

                echo "document.getElementById('entonum".$wod_dia.$wod_orden."').value = '".$wod_id."' ;";
                
                echo "document.getElementById('boton".$wod_dia.$wod_orden."').classList.remove('disabled');";
              
                echo "</script>";


                // Produces:
                //
                //      UPDATE mytable
                //      SET title = '{$title}', name = '{$name}', date = '{$date}'
                //      WHERE id = $id


            }
                
            /*entoprogram_id | dia_id | entoprogram_orden | entowod_id
        
            select * from entoprogram_id weher dia_id = 1 and entoprogram_odren  = 2; 
        
            SI HAY RESULTADOS
        
            ==> UPTADE entowod
        
            SI NO HAY RESULTADOS
            
            ==> primero, añadir entowod
            ==> segundo, añadir entoprogram*/
        
        
        }else{
        
            echo "Sin guardar";
        
        }


    
    }



    public function ento($dia_id, $entoprogram_orden){

        //SELECT * FROM at_def_entowod a, at_def_entoprogram b where a.entowod_id = b.entowod_id and b.dia_id = 160 and b.entoprogram_orden = 1

        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  


     

        $sql = "SELECT * FROM at_def_entowod a, at_def_entoprogram b where a.entowod_id = b.entowod_id and b.dia_id = $dia_id and b.entoprogram_orden = $entoprogram_orden";

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);

    }





}