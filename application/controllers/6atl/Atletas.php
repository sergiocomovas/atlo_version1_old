<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Atletas extends CI_Controller {

    public function index(){

        //https://v1.atlo.es/index.php/60_atl/atletas


        $this->load->view('!_html');
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  
        $data['title'] = 'Entrenos ——— @atlobarbellclub';

        $this->load->view('00_head', $data);

        $this->load->view('!_body');

        $this->load->view('30_titulo');
        $this->load->view('60_atl/60_atletas_paso1');
        
        
        $this->load->view('80_cierre');
        $this->load->view('!_body_fin');
        $this->load->view('!_html_fin');

    }

    public function marcar_fav(){

    
        $this->load->database();

        $sql = "UPDATE `at_def_entocust` SET `entocust_fav` = '1' WHERE `at_def_entocust`.`entocust_id` = ".$this->input->get('date_select'); 

        $this->db->query($sql);

        echo 'Marcar como Favorito <i class="far fa-check-circle"></i>';
     

    }

    public function marcar_basura(){

    
        $this->load->database();

        $sql = "UPDATE `at_def_entocust` SET `entocust_basura` = '1' WHERE `at_def_entocust`.`entocust_id` = ".$this->input->get('date_select'); 

        $this->db->query($sql);

        echo 'Marcar como Basura <i class="far fa-check-circle"></i>';
     

    }

    public function marcar_visto(){

        //https://v1.atlo.es/index.php/60_atl/atletas/marcar_visto



        echo 'Marcar como Visto <i class="far fa-check-circle"></i>';


        $this->load->database();

        $sql = "UPDATE `at_def_entocust` SET `entocust_visto` = '1' WHERE `at_def_entocust`.`entocust_id` = ".$this->input->get('date_select'); 

        $this->db->query($sql);
     

    }


    public function buscar($buscar,$username){

        $this->load->database();

        if($buscar == "BuscaFuerza"){$tipo="Atlo Fuerza"; $sql = "    SELECT * FROM `at_def_entocust` WHERE `entowod_clase` = 'Fuerza' AND `clientes_email` LIKE '".$username."' AND `entocust_basura` = FALSE ORDER BY `at_def_entocust`.`entocust_visto` ASC, `at_def_entocust`.`entowod_id` ASC";}

        if($buscar == "BuscaExtra"){ $tipo="Atlo eXta"; $sql = "   SELECT * FROM `at_def_entocust` WHERE `entowod_clase` = 'eXtra' AND `clientes_email` LIKE '".$username."' AND `entocust_basura` = FALSE ORDER BY `at_def_entocust`.`entocust_visto` ASC, `at_def_entocust`.`entowod_id` ASC";}

        if($buscar == "BuscaMetcon"){ $tipo="Atlo Metcon & Improvement"; $sql = "SELECT * FROM `at_def_entocust` WHERE `entowod_clase` NOT LIKE 'Fuerza' AND `entowod_clase` NOT LIKE 'eXtra' AND `clientes_email` LIKE '".$username."' AND `entocust_basura` = FALSE ORDER BY `at_def_entocust`.`entocust_visto` ASC, `at_def_entocust`.`entowod_id` ASC";}


        if($buscar == "Basura"){ $tipo="WODS EN LA BASURA"; $sql = "SELECT * FROM `at_def_entocust` WHERE `clientes_email` LIKE '".$username."' AND `entocust_basura` = TRUE ORDER BY `at_def_entocust`.`entocust_visto` ASC, `at_def_entocust`.`entowod_id` ASC";}

        if($buscar == "Fav"){ $tipo="FAVORITOS"; $sql = "SELECT * FROM `at_def_entocust` WHERE `clientes_email` LIKE '".$username."' AND `entocust_fav` = TRUE ORDER BY `at_def_entocust`.`entocust_visto` ASC, `at_def_entocust`.`entowod_id` ASC";}




        echo "<div class='mt-4 text-center'><h2>".$tipo."<h2></div><br>";



        $query = $this->db->query($sql);

        $data['data'] = $query->result();
        $data['tipo'] = str_replace(' ', '', trim($tipo));

        $this->load->view('60_atl/60_atletas_buscar_resultados',$data);


     

    


      

    }


    public function paso4(){

        $this->load->database();

        $id=$this->input->get('date_invent0');
        $this->input->get('date_invent1');
        $cat=$this->input->get('date_invent2');
        $minutos=$this->input->get('date_invent3');
        $segundos=$this->input->get('date_invent4');
        $enteros=$this->input->get('date_invent5');
        $decimales=$this->input->get('date_invent6');
        $this->input->get('date_invent7');
        $usuario=$this->input->get('date_invent8');
        $kg=$this->input->get('date_invent9');
        $fecha=$this->input->get('date_invent10');
    
        $segundos_t = ($minutos * 60) + $segundos; 
        $cadena = str_replace("~~Mis~Pesos~(Kg):\n...~~","",$this->input->get('date_invent1'));
    
        $data = array(
            'entowod_descripcion' => $cadena,
            'post_rx' => $cat,
            'post_secs' => $segundos_t, 
            'post_kg' => $kg,
            'post_reps_value' => $enteros.".".$decimales, 
            'entocust_fecha' => $fecha,
            'entowod_timestamp' => date("Y-m-d H:i:s")
        );
    
        //$this->db->where('entocust_id', $id);
        //$this->db->update('at_def_entocust', $data);
        
        $where = "entocust_id =".$id;
        $this->db->update('at_def_entocust', $data,$where);


        $this->email($data,$usuario);

        //UPDATE `at_def_entocust` SET `post_reps_value` = '1' WHERE `at_def_entocust`.`entocust_id` = 2;

        //$error = $this->db->error(); // Has keys 'code' and 'message'
     

        $this->load->view('60_atl/60_atletas_paso4');
        

    }

    public function email($data=NULL, $username=NULL){

        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d H:i:s');  
        //$semana = date('W');

        //$datos_clase = $this->detalles_clase($clase);


        $this->load->library('email');


        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot de Reservas)');
        $this->email->to($username);
        $this->email->bcc('strongestpalma+re1@gmail.com');
        //$this->email->bcc('jdds1985@gmail.com');

        $this->email->subject('Actualización WOD del '.$data['entocust_fecha'].': Tu Colección.');


        //ate_format(date_create($max_proxima_semana[0]['min']),"d/m")
        $this->email->message('
        <html>
        <body>
            <h3>Hola</h3>
            <p>Soy Wendy, el bot de la Casa Atlo.</p>

            <p>Has añadido un Resultado a un Entrenamiento ya almacenado en tus Colecciones.</p>'.
            
            '<hr><br>Entreno '.$data['entocust_fecha'].':<br>'.nl2br($data['entowod_descripcion']).

            '<br><br>Categoría:<br>'.$data['post_rx'].

            '<br><br>Tiempo:<br>'.$data['post_secs'].' segundo(s).'.

            '<br><br>Rodas y Reps:<br>'.$data['post_reps_value'].' ronda(s).'.

            '<br><br>Peso:<br>'.$data['post_kg'].' Kg.'.

            '<br><br>Fecha del Registro:<br>'.date("m-d-Y H:i:s").


            '

            <hr><p>Recuerda que puedes editar este registro tantas veces que quieras hasta que esté disponible. Accede, con tu cuenta Atlo, a tus colecciones para examinar, consultar y compartir todos los wods que hayas almacenado.</p>


            <p>E-Mail para soporte técnico: sergio@mallorcainterbox.com</p>
            
            <p>Gracias, Wendy</p>

        </body>
        </html>
        
        ');

        $this->email->send();

    }

    public function paso3(){

    //https://v1.atlo.es/index.php/60_atl/atletas/paso3

    $usuario= $this->input->get('orden_num');
    $wod_id= $this->input->get('date_select');
    $lafecha = $this->input->get('orden_lafecha');

    $this->load->database();

    $sql0 = "SELECT * FROM `at_def_entocust` WHERE `entowod_id` = ".$wod_id." AND `clientes_email` LIKE '".$usuario."'";


    $query = $this->db->query($sql0);
    $row = $query->row();

    if (isset($row)){

        $vale=TRUE;

    }else{

        $sql1 = 'SELECT * FROM `at_def_entowod` WHERE `entowod_id` = '.$wod_id.' ORDER BY `entowod_id` DESC';

        $query = $this->db->query($sql1);
        $re = $query->row();
    
        $data = array(
        'entocust_id'=> NULL,
        'entowod_id'=> $re->entowod_id, 
        'clientes_email'=> $usuario,
        'entowod_timestamp'=> $re->entowod_timestamp, 
        'entowod_titulo'=> $re->entowod_titulo, 
        'entowod_clase'=> $re->entowod_clase, 
        'entowod_hero'=> $re->entowod_hero, 
        'entowod_descripcion'=> $re->entowod_descripcion,
        'entowod_post'=> $re->entowod_post, 
        'entocust_fecha'=> $lafecha, 
        'post_rx'=> $re->post_rx,
        'post_kg'=> $re->post_kg, 
        'post_secs'=> $re->post_secs,
        'post_reps'=> $re->post_reps
        );
    
        $this->db->insert('at_def_entocust', $data);
    
    }


    $sql_2 = "SELECT * FROM `at_def_entocust` WHERE `entowod_id` = ".$wod_id." AND `clientes_email` LIKE '".$usuario."'";

    $query = $this->db->query($sql0);
    $row = $query->row_array();
    $data = $row;


    $this->load->view('60_atl/60_atletas_paso3', $data);

    }

    public function paso2(){


        //https://v1.atlo.es/index.php/60_atl/atletas/paso2

        $this->load->view('60_atl/60_atletas_paso2');
    }


    public function ver_voto($atleta='catxo99@gmail.com',$fecha='533'){

         //https://v1.atlo.es/index.php/6atl/atletas/ver_voto


        $sql = "SELECT * FROM `at_def_valoraciones` WHERE `clientes_email` LIKE '".$atleta."' AND `dias_id` = ".$fecha." ORDER BY `val_id` DESC LIMIT 1";


        $this->load->database();
        $query = $this->db->query($sql);
        $row = $query->row_array();
        echo $row['val_id'];

    }
   

    public function asistencias($atleta='alexisc17@hotmail.com',$limite='7'){

        //https://v1.atlo.es/index.php/60_atl/atletas/asistencias
        

        //COPIA EL ENTRENO DE UN WOD


        //Paso 0 --> id de hoy 
        $url = 'https://wendy.log99.es/index.php/A_atlo_horario/obtener_fecha';
        $data = file_get_contents($url);
        $fechas_parametros = json_decode($data, true);

        $hoy=$fechas_parametros['dias_id'];


        //Paso 1 --> Ver, todos los días, que un cliente ha asistido. 
        //


        $sql="SELECT DISTINCT dias_id FROM `at_def_listas` WHERE `clientes_id` LIKE '".$atleta."'  AND `dias_id` <= '".$hoy."' ORDER BY `dias_id` DESC LIMIT 0,".$limite; 

       
        $this->load->database();

        $query = $this->db->query($sql);
        
        //$row = $query->row();
        //echo json_encode($row);

        echo json_encode(
            $query->result()
        );



    }

    public function mostrar_dias($dias='316')
    
    {

        //https://v1.atlo.es/index.php/60_atl/atletas/mostrar_dias

        $sql="SELECT * FROM `at_def_clases` WHERE `dias_id` = ".$dias." ORDER BY `dias_id` ASC";


        $this->load->database();

        $query = $this->db->query($sql);
        
        $row = $query->row();
        $formatomalo=$row->dias_date;
       
        list($month, $date, $year) = explode('-',$formatomalo);
        

        

        $formatobueno = date("d-m-y", mktime(0, 0, 0, $month, $date, $year));    
        echo json_encode($formatobueno);
     



    }

}