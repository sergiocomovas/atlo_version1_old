<?php

//clausula de protección

defined('BASEPATH') OR exit('No direct script access allowed');


class Tareas extends CI_Controller {

    public function alumnos_conteo(){

        $this->load->database();
       
        $sql = "SELECT * FROM `alumnos`";
        $query = $this->db->query($sql);
        $respuesta = $query->num_rows();
        echo "<h1>".$respuesta."</h1>";
                
          
    }//
    
    public function alumnos_listado(){

        $this->load->database();

        $sql = "SELECT *, (parcial1+parcial2+parcial3)/3 as promedio FROM `alumnos`";
        $query = $this->db->query($sql);

        $respuesta = array(
            
                        'err' => FALSE,
                        'err_mensaje' => 'Ninguno',
                        'total_registros' => $query->num_rows(),
                        'clientes' => $query->result()
            
                    );
            
        echo json_encode($respuesta);

    }//

}//FIN DE LA CLASE