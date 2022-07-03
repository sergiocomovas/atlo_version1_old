<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Valoraciones extends CI_Controller {

    public function index(){

        //https://v1.atlo.es/index.php/6atl/valoraciones
        echo "hola mundo";


        $this->load->view('atl/00_carro');

    }

    public function comprobar($destino,$id,$select,$usuario,$fecha,$valor){

        date_default_timezone_set('Europe/Madrid');
        $timestamp = date('Y-m-d G:i:s');$this->load->database();
        
        $sql="SELECT * FROM `at_def_valoraciones` WHERE `clientes_email` LIKE '".$usuario."' AND `dias_id` = ".$id   ;

        $query = $this->db->query($sql);
        $filas=$query->num_rows();

        if ($filas==0){
            

            $data = array(
                'val_autodate' => $timestamp,
                'clientes_email' => $usuario,
                'vale_fecha' => $fecha,
                'dias_id' => $id,
                'val_resumenwod' => $select,
                'val'.$destino => $valor
            );
            
            $this->db->insert('at_def_valoraciones', $data);
            // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date') 
            
            //INSERT INTO `at_def_valoraciones` (`val_id`, `val_autodate`, `clientes_email`, `vale_fecha`, `dias_id`, `val_resumenwod`, `val_carita`, `val_repor1`, `val_repor2`, `val_les1`, `val_les2`, `val_dud1`, `val_dud2`, `val_seg1`, `val_seg2`, `val_otros`) VALUES (NULL, '99-99-9999 99:99:99', 'catxo99@gmail.com', '12-12-1223', '1245', 'RESUMEN WOD RESUMEN WOD', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)

          

        
        }
     
    }

    public function principal(){

        $destino = $this->input->get('orden_destino');
        $id =$this->input->get('orden_id');
        $select = $this->input->get('orden_select');
        $usuario = $this->input->get('orden_orden');
        $fecha = $this->input->get('orden_fecha');
        $valor = $this->input->get('orden_valor');

        //COMPROBAR QUE EXISTE
        $this->comprobar($destino,$id,$select,$usuario,$fecha,$valor);


        if($destino == "_carita"){
            $this->caras_0($id,$usuario,$fecha,$valor);
        }
    }

    public function caras_0($id=NULL,$usuario=NULL,$fecha=NULL,$valor=NULL){ 
    
        //ACTUALIZAR DATOS
        //UPDATE `at_def_valoraciones` SET `val_carita` = '10' WHERE `at_def_valoraciones`.`val_id` = 7;

        $this->load->database();
        
        date_default_timezone_set('Europe/Madrid');
        $timestamp = date('Y-m-d G:i:s');
        
        $data = array(
            'val_carita' => $valor,
            'val_autodate' => $timestamp
        );


        $where = array(
            'clientes_email' => $usuario,
            'dias_id' => $id
        );
    
        $this->db->where($where);
        $this->db->update('at_def_valoraciones', $data);

        $this->caras_1($id,$valor);

    }

    public function caras_1($id=NULL,$valor=NULL){


        //if (IS_NULL($valor)){echo "Es nulo";};

        //PRIMER PASO
        //saber el total de rows con resultado
        //
        $this->load->database();

        $sql20 = "SELECT * FROM `at_def_valoraciones` WHERE `dias_id` = ".$id." AND `val_carita` = 20";
        $sql60 = "SELECT * FROM `at_def_valoraciones` WHERE `dias_id` = ".$id." AND `val_carita` = 60";
        $sql85 = "SELECT * FROM `at_def_valoraciones` WHERE `dias_id` = ".$id." AND `val_carita` = 85";
        $sql99 = "SELECT * FROM `at_def_valoraciones` WHERE `dias_id` = ".$id." AND `val_carita` = 99";        $sql00 = "SELECT * FROM `at_def_valoraciones` WHERE `dias_id` = ".$id." AND `val_carita` = 00";

        $query = $this->db->query($sql20);
        $filas20=$query->num_rows();
        $query = $this->db->query($sql60);
        $filas60=$query->num_rows();
        $query = $this->db->query($sql85);
        $filas85=$query->num_rows();
        $query = $this->db->query($sql99);
        $filas99=$query->num_rows();
        $query = $this->db->query($sql00);
        $filas00=$query->num_rows();

        $total = $filas20+$filas60+$filas85+$filas99+$filas00;

        if ($total==0){$total=1;}

        //Si TOTAL Es el 100
        //que % tiene el valor


        $total_filas20 = ($filas20 * 100)/$total;
        $total_filas60 = ($filas60 * 100)/$total;
        $total_filas85 = ($filas85 * 100)/$total;
        $total_filas99 = ($filas99 * 100)/$total;
        $total_filas00 = ($filas00 * 100)/$total;


        //https://v1.atlo.es/index.php/6atl/valoraciones/caras_1
        echo '<div class="progress">
            <div  role="progressbar"  style="background-color: lightsteelblue !important; width: '.$total_filas20.'%;" aria-valuenow="'.$total_filas20.'" aria-valuemin="0" aria-valuemax="100"></div>
            
            <div class="progress-bar" role="progressbar" style="background-color: limegreen !important; width: '.$total_filas60.'%;" aria-valuenow="'.$total_filas60.'" aria-valuemin="0" aria-valuemax="100"></div>
            
            
            <div  class="progress-bar" role="progressbar" style="background-color: gold !important; width: '.$total_filas85.'%;" aria-valuenow="'.$total_filas85.'" aria-valuemin="0" aria-valuemax="100"></div>

            <div class="progress-bar" role="progressbar" style="background-color: orangered !important; width: '.$total_filas99.'%;" aria-valuenow="'.$total_filas99.'" aria-valuemin="0" aria-valuemax="100"></div>

            <div class="progress-bar" role="progressbar" style="background-color: darkred !important; width: '.$total_filas00.'%;" aria-valuenow="'.$total_filas00.'" aria-valuemin="0" aria-valuemax="100"></div>



      </div>';

    if ($valor==00){$mens = "<a href='mailto:atlo@atlo.es'>Contacta con Atlo.</a>";}else{$mens="Gracias por Votar.";}

    echo "<div class='text-center'><code class='text-light'>Basado en ".$total." valoracion/es. ".$mens."</code> </div>";
    
    
    

    }




}