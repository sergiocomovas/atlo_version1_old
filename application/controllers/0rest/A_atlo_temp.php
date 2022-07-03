<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//http://wendy.log99.es/index.php/A_atlo_temp/index


class A_atlo_temp extends CI_Controller {

    public function index( )
    {

        echo 'Hello World! ';

    }



    public function hoy($tabla="at_temp_dias", $col="dias_date")
    {


        $this->load->database();

        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $aa = 
        "SELECT * FROM $tabla WHERE $col LIKE '$fecha'" ;

        $query = $this->db->query($aa);
        $row = $query->row();
        echo json_encode($row);
       

    }

    
    public function hoy_var($tabla="at_temp_dias", $col="dias_date")
    {


        $this->load->database();

        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $aa = 
        "SELECT * FROM $tabla WHERE $col LIKE '$fecha'" ;

        $query = $this->db->query($aa);       
        return $query->result_array();

       

    }

    public function manana($tabla="at_temp_dias", $col="dias_date")
    {


        $this->load->database();

        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $aa = 
        "SELECT * FROM $tabla WHERE $col LIKE '$fecha'" ;

        $query = $this->db->query($aa);
        $row = $query->row();
        $manana = $row->dias_id + 1; 

        $bb = 
        "SELECT * FROM $tabla WHERE `dias_id` = '$manana'" ;

        $query = $this->db->query($bb);
        $row = $query->row();


        echo json_encode($row);



    }

    public function manana_wod($dias_id)
    {

        $this->load->database();
        
        $cc=
        "SELECT * FROM `at_temp_wods` WHERE `dias_id` = $dias_id";

        $query = $this->db->query($cc);
        $row = $query->row();

        echo json_encode($row);
    }


    

    public function manana_clases($dias_id="89")
    {

        $this->load->database();
        
        $cc=
        "SELECT * FROM `at_temp_clases` WHERE `dias_id` = $dias_id ORDER BY `clases_hora` ASC ";

        $query = $this->db->query($cc);
        $row = $query->row();

        $respuesta = array(

            'err' => FALSE,
            'err_mensaje' => 'Ninguno',
            'total_registros' => $query->num_rows(),
            'datos' => $query->result()
    
        );

        //o poner $respuesta
        echo json_encode(
            $query->result()
        );
    }


    public function guardar_cambios($dias_id,$wods_id)
    {

        $this->load->database();
        date_default_timezone_set('Europe/Berlin');     
       
        echo $dias_id;
        echo $wods_id;
        echo $_POST['clases_hora1'];
        echo $_POST['clases_hora2'];
        echo $_POST['clases_hora3'];
        echo $_POST['clases_hora4'];
        echo $wods_texto = $_POST['wods_texto'];

        $delete = "DELETE FROM `at_temp_clases` WHERE `at_temp_clases`.`dias_id` = $dias_id";

        $this->db->query($delete);
        
        if ($_POST['clases_hora1']){

            $clases_hora = $_POST['clases_hora1'];

            $sql = "INSERT INTO at_temp_clases (dias_id, clases_hora) VALUES (".$this->db->escape($dias_id).", ".$this->db->escape($clases_hora).")";
            
            $this->db->query($sql);
            echo $this->db->affected_rows();

        }

        if ($_POST['clases_hora2']){

            $clases_hora = $_POST['clases_hora2'];

            $sql = "INSERT INTO at_temp_clases (dias_id, clases_hora) VALUES (".$this->db->escape($dias_id).", ".$this->db->escape($clases_hora).")";
            
            $this->db->query($sql);
            echo $this->db->affected_rows();

        }

        if ($_POST['clases_hora3']){

            $clases_hora = $_POST['clases_hora3'];

            $sql = "INSERT INTO at_temp_clases (dias_id, clases_hora) VALUES (".$this->db->escape($dias_id).", ".$this->db->escape($clases_hora).")";
            
            $this->db->query($sql);
            echo $this->db->affected_rows();

        }

        if ($_POST['clases_hora4']){

            $clases_hora = $_POST['clases_hora4'];

            $sql = "INSERT INTO at_temp_clases (dias_id, clases_hora) VALUES (".$this->db->escape($dias_id).", ".$this->db->escape($clases_hora).")";
            
            $this->db->query($sql);
            echo $this->db->affected_rows();

        }

        //ACTUALIZAR QUERY

        $update = "UPDATE `at_temp_wods` SET `wods_texto` = '".$wods_texto."' WHERE `at_temp_wods`.`wods_id` = $wods_id";

        $this->db->query($update);


        //VOLVER

        $this->load->helper('url');

        $redirect="https://atlo.es/se1/blank.php?MENSAJE=DATOS_GUARDADOS_CORRECTAMENTE";
        redirect($redirect);

    }


    public function clientes($activo="ACTIVO")
    {

        $this->load->database();
        
        $dd=
        "SELECT * FROM `at_temp_clientes` WHERE `clientes_activo` LIKE '".$activo."'  ORDER BY `at_temp_clientes`.`clientes_id` DESC";

        $query = $this->db->query($dd);
        $row = $query->row();

        $respuesta = array(

            'err' => FALSE,
            'err_mensaje' => 'Ninguno',
            'total_registros' => $query->num_rows(),
            'datos' => $query->result()
    
        );

        //o poner $respuesta
        echo json_encode(
            $query->result()
        );

    }


    public function desactivar_clientes($clientes_id)
    {
        $this->load->database();
        date_default_timezone_set('Europe/Berlin');   
        
        echo $clientes_id;
       

        //ACTUALIZAR QUERY

        $update = "UPDATE `at_temp_clientes` SET `clientes_activo` = 'NO' WHERE `at_temp_clientes`.`clientes_id` = $clientes_id";

        $this->db->query($update);
 
 
        //VOLVER
 
        $this->load->helper('url');

       
 
        $redirect="https://atlo.es/se1/pemai.php?MENSAJE=DATOS_BORRADOS&DESHACER=".$clientes_id;
        redirect($redirect);


    }


    public function deshacer_desactivar_clientes($clientes_id)
    {
        $this->load->database();
        date_default_timezone_set('Europe/Berlin');   
        
        echo $clientes_id;
       

        //ACTUALIZAR QUERY

        $update = "UPDATE `at_temp_clientes` SET `clientes_activo` = 'ACTIVO' WHERE `at_temp_clientes`.`clientes_id` = $clientes_id";

        $this->db->query($update);
 
 
        //VOLVER
 
        $this->load->helper('url');

 
        $redirect="https://atlo.es/se1/pemai.php?MENSAJE=DATOS_RECUPERDOS_CORRECTAMENTE";
        redirect($redirect);
    }

    public function nuevo_cliente()
    {

        $clientes_rango =           strtoupper (trim ($_POST['clientes_rango']));
        $clientes_nombrereal =      strtoupper (trim ($_POST['clientes_nombrereal']));
        $clientes_email =           strtoupper (trim ($_POST['clientes_email']));
        $clientes_wa =     strtoupper (trim ($_POST['clientes_wa']));
        $clientes_pre_wa =          strtoupper (trim ("ESP"));
        $clientes_nombrepublico =   strtoupper (trim ($clientes_nombrereal)); 
        $clientes_activo=           strtoupper (trim ("ACTIVO"));


        $this->load->database();
        date_default_timezone_set('Europe/Berlin');   

        //INSERT INTO `at_temp_clientes` (`clientes_id`, `clientes_email`, `clientes_pre_wa`, `clientes_wa`, `clientes_nombrepublico`, `clinetes_nombrereal`, `clientes_rango`, `clientes_activo`) VALUES (NULL, 'sergiorigo@yahoo.es', 'ESP', '971473535', 'SERGIO RIGO GONZÁLEZ', 'SERGIO RIGO GONZÁLEZ', '@', 'activo');

        $numero_random=mt_rand(1111111111,9999999999).mt_rand(1111111111,9999999999);

        $sql = "INSERT INTO at_temp_clientes 
        (clientes_id,
        clientes_email, 
        clientes_pre_wa,
        clientes_wa,
        clientes_nombrepublico,
        clientes_nombrereal,
        clientes_rango,
        clientes_activo) 
        
        
        VALUES 
        (
        ".$this->db->escape($numero_random).", 
        ".$this->db->escape($clientes_email).", 
        ".$this->db->escape($clientes_pre_wa).",
        ".$this->db->escape($clientes_wa).",
        ".$this->db->escape($clientes_nombrepublico).",
        ".$this->db->escape($clientes_nombrereal).",
        ".$this->db->escape($clientes_rango).",
        ".$this->db->escape($clientes_activo)."
        
        )";
            
        $this->db->query($sql);
        echo $this->db->affected_rows();

        //VOLVER
 
        $this->load->helper('url');

 
        $redirect="https://atlo.es/se1/pemai.php?MENSAJE=DATOS_GRABADOS_CORRECTAMENTE";
        redirect($redirect);

    }

    public function ver_entreno_hoy()
    {
        $hoy=$this->hoy_var();
        $hoy=$hoy[0]['dias_id'];

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_temp_wods` WHERE `dias_id` = $hoy";

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);


    }


    public function buscar_clientes($email, $tokken_numero, $dia)
    {
        
        //http://wendy.log99.es/index.php/A_atlo_temp/buscar_clientes/catxo99@gmail.com/5536242284343/89

        $this->load->database();

        $email=str_replace('AVAVAVAVA','@',$email);
 

        $numero = ($tokken_numero/615890787)/$dia;
        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_clientes` WHERE `clientes_id` = $numero AND `clientes_email` LIKE '".$email."' AND `clientes_activo` LIKE 'ACTIVO'" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);
       
    }

    public function reservar_entreno_hoy($clientes_id="", $dias_id="", $clientes_nombrepublico="", $clases_horas="AAAA")
    {

        if ($clases_horas=="AAAA"){    

            if (!$_POST['clases_hora']){echo "error"; break;}
            echo "<br>";
            echo $clases_id = $_POST['clases_hora']; 
        }else{

            $clases_id = $clases_horas;
        }

        $hoy_cadena=$this->wendy_dia();
        $hoy=$hoy_cadena[0]['dias_id'];

        if ($dias_id==$hoy){
            echo "_correcto";

        }else{
            echo "_error"; break; 

        }
      
        
        echo "<br>";
        echo $clientes_id; 

        echo "<br>";
        echo $dias_id; 


        //PONER A CERO TODOS LOS BORRADOS

        //ACTUALIZAR QUERY

        //

        $this->load->database();

        date_default_timezone_set('Europe/Berlin');         
        $autodate = date('Y-m-d H:i:s');  


        $update = "UPDATE `at_temp_listas` 
        SET 
        `listas_cont` = 0, 
        `listas_data1` = '🛳⤵',
        `listas_data2`  = '★☆☆☆☆',
        `listas_autodate` = '".$autodate."'
        WHERE `at_temp_listas`.`clientes_id` = '".$clientes_id."' 
        AND   `at_temp_listas`.`dias_id` = '".$dias_id."' ";

        $this->db->query($update);

        //INSERT INTO `at_temp_listas`  (NULL, '101', '40', '89', '1', '2018-06-17 02:04:00', 'SERGIO', 'OOOOX');

        $sql = "INSERT INTO `at_temp_listas`
        (`clientes_id`, `clases_id`, `dias_id`, `listas_cont`, `listas_autodate`, `listas_data1`, `listas_data2`) 
        
        VALUES 
        (
        ".$this->db->escape($clientes_id).", 
        ".$this->db->escape($clases_id).",
        ".$this->db->escape($dias_id).",
        '1',
        ".$this->db->escape($autodate).",
        ".$this->db->escape($clientes_nombrepublico).",
        '★★★★☆'
        )";
            
        $this->db->query($sql);
        echo $this->db->affected_rows();

        //VOLVER
        //($clientes_id="", $dias_id="", $clientes_nombrepublico="", $clases_horas="AAAA")
 
        $this->load->helper('url');

        $redirect="http://atlo.es/se1-reservas/index.php?".
        "CLIENTE=".$clientes_id."&".
        "DIA=".$dias_id."&".
        "CLASES_HORA=".$clase_horas."&".
        "NOMBRE_CLIENTE=".$clientes_nombrepublico.
        "&MENSAJE=DATOS_GRABADOS_CORRECTAMENTE";
        redirect($redirect);

    }

    //
    public function ver_clientes_entreno_hoy($clientes_id="", $dias_id="", $listas_count="1")
    {
     
        //http://wendy.log99.es/index.php/A_atlo_temp/ver_clientes_entreno_hoy/101/89/1
        $this->load->database();

        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_listas` WHERE `clientes_id` = $clientes_id AND `dias_id` = $dias_id AND `listas_cont` = $listas_count ORDER BY `listas_cont` ASC ";

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);
       

    }

    public function ver_clientes_hora_hoy($clase_id="")
    {

        //http://wendy.log99.es/index.php/A_atlo_temp/ver_clientes_hora_hoy/32

        $this->load->database();

        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $sql = 
        " SELECT * FROM `at_temp_clases` WHERE `clases_id` = $clase_id";

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);
    
    }

    public function anular($clientes_id="", $dias_id="", $clientes_nombrepublico="")
    {

        //http://wendy.log99.es/index.php/A_atlo_temp/anulary/101/89


        $this->load->database();

        date_default_timezone_set('Europe/Berlin');         
        $autodate = date('Y-m-d H:i:s');  


        $update = "UPDATE `at_temp_listas` 
        SET 
        `listas_cont` = 0, 
        `listas_data1` = '🛳⤵',
        `listas_data2`  = '★☆☆☆☆',
        `listas_autodate` = '".$autodate."'
        WHERE `at_temp_listas`.`clientes_id` = '".$clientes_id."' 
        AND   `at_temp_listas`.`dias_id` = '".$dias_id."' ";

        $this->db->query($update);

        $this->load->helper('url');

        $redirect="http://atlo.es/se1-reservas/index.php?".
        "CLIENTE=".$clientes_id."&".
        "DIA=".$dias_id.
        "&MENSAJE=TODAS_LAS_CLASES_HAN_SIDO_ANULADAS";
        redirect($redirect);

    }

    public function wendy_dia(){

        //SELECT * FROM `at_temp_dias` WHERE `dias_date` LIKE '2018-06-18'


        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $aa = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_date` LIKE '$fecha'" ;

        $query = $this->db->query($aa);

        return $query->result_array();
        


    }


    public function wendy_informe_clientes(){

        
        $this->load->database();


        $aa = 
        "SELECT * FROM `at_temp_clientes` WHERE `clientes_activo` LIKE 'ACTIVO'";

        $query = $this->db->query($aa);

        return $query->result_array();
        


    }

    public function wendy_informe_wods($hoy){


        // 

        $this->load->database();


        $aa = 
        
        "SELECT * FROM `at_temp_wods` , `at_temp_clases` , `at_temp_dias` WHERE `at_temp_dias`.`dias_id` = `at_temp_clases`.`dias_id` AND `at_temp_dias`.`dias_id` = `at_temp_wods`.`dias_id` AND `at_temp_dias`.`dias_id` = $hoy";

        $query = $this->db->query($aa);

        return $query->result_array();
        



    }

    public function microdate(){

        date_default_timezone_set('Europe/Berlin');         
        $autodate = date('H:i:s.U');  
        return $autodate; 
       
    }

    public function wendy_clientes($clientes_id="", $dias_id="", $clientes_nombrepublico="")

    {

        //http://wendy.log99.es/index.php/A_atlo_temp/wendy_clientes

     
     $hoy_cadena=$this->wendy_dia();
     $hoy=$hoy_cadena[0]['dias_id'];
     $dia_nombre=$hoy_cadena[0]['dias_nom'];
     $dia_fecha=$hoy_cadena[0]['dias_date'];

     $clientes=$this->wendy_informe_clientes(); 
     
     $wod_info=$this->wendy_informe_wods($hoy);

     foreach($clientes as $x => $x_value) 
        
        {

            $email_lista=$x_value['clientes_email'];
            $nombre_lista=$x_value['clientes_nombrereal']; 

            date_default_timezone_set('Europe/Berlin');         
        
            
            $this->load->library('email');

            $this->email->from('wendy@comovas.es','Sergio Rigo (Pruebas)');
            $this->email->to($email_lista, $nombre_lista);
            //$this->email->cc('another@another-example.com');
            //$this->email->bcc('them@their-example.com');

            $this->email->subject('Entreno de hoy '.$dia_nombre.' (Atlo)');

            
            $mensaje='
            <html>
            <head>

                <style>
                
                    .container {
                        border: 2px solid #dedede;
                        background-color: #f1f1f1;
                        border-radius: 5px;
                        padding: 10px;
                        margin: 10px 0;
                    }
                    
                
                    .darker {
                        border-color: #ccc;
                        background-color: #ddd;
                    }

                
                    .inventer {
                        border-color: #663399;
                        background-color: #E6E6FA;
                    }
                    
                
                    .container::after {
                        content: "";
                        clear: both;
                        display: table;
                    }
                    
                    
                    .container img {
                        float: left;
                        max-width: 64px;
                        width: 100%;
                        margin-right: 20px;
                        border-radius: 50%;
                    }

                    .texto1 {
                        font-size: large;
                    }

                    .texto2 {
                        color:red;
                    }
                    
                
                    .container img.right {
                        float: right;
                        margin-left: 20px;
                        margin-right:0;
                    }
                    
                

                    
                    </style>
            
            </head>
          

            <body>
            
                <div class="container">
                    <img src="https://atlo.es/w.jpg" alt="Avatar">
                    <p class="texto1">Hola humano '.$x_value['clientes_nombrereal'].' (número '.$x_value['clientes_id'].') soy Wendy el bot de CrossFit Atlo. 
                    Se te ha introducido como usuario en el Programa de Entrenamiento Privado (Atlo Training Plan - Preview). Eso significa que te tengo que informar de varias cosas. 
                    </p>
                    
                </div>

            <div class="container">
                <img src="https://atlo.es/w.jpg" alt="Avatar">
                <p class="texto1">Durante el día de hoy, se celebrarán las siguientes clases. Eres libre de apuntarte pulsando sobre <strong>los enlaces</strong>. </p>
                
            </div>';


            foreach($wod_info as $y => $y_value) 
        
            {
                $y=$y+1;

                $mensaje=$mensaje.
                '
                <div class="container inventer">
                <img src="https://atlo.es/cf.jpg" alt="Avatar">
                <p class="texto1">
                Clase de Crossfit '.$y.'<br>

                    <ul>
                        <li>Fecha: '.$dia_nombre.' '.$dia_fecha.' (AAAA-MM-DD)</li>
                        <li><big><big><big>Hora: '.$y_value['clases_hora'].' </big></big></big></li>
                        <li>Lugar: [ATLOBOX]-> Atlo Barbell Club, Can Valero.</li> 
                        <!--<li>Usuario: '.$x_value['clientes_id'].'</li>
                        <li>Id: '.$y_value['clases_id'].'</li>-->
                        <li>Para apuntarse: <a href="http://wendy.log99.es/index.php/A_atlo_temp/wendy_reservas/'.$x_value['clientes_id'].'/'.$hoy.'/'.$y_value['clases_id'].'/'.$x_value['clientes_nombrepublico'].'/">PULSA AQUÍ.</a></li>
                    </ul>

                </p>
                
                </div>
                ';

            }
            
            $mensaje=$mensaje.'

            <div class="container darker">
            <img src="https://atlo.es/ed.jpg" alt="Avatar" class="right">
            <p class="texto1">Hola soy tu entrenador Dávila de Atlo Barbell Club. Este es el entreno de hoy:<br><br>'.nl2br($wod_info[0]['wods_texto']).'</p>

            <p></p>
            
            </div>


            <div class="container">
                <img src="https://atlo.es/w.jpg" alt="Avatar">
                <p class="texto1">Puedes hacer la reserva ahora y, si cambias de opinión, puedes cancelar la reserva o cambiarla por otra hora que te vaya mejor. Para reservas, cambios y cancelaciones puedes pulsar sobre <a href="http://atlo.es/se1-reservas/index.php?CLIENTE='.$x_value['clientes_id'].'&DIA='.$hoy.'">ESTE ENLACE</a> que es válido para el día de hoy. </p>
                
            </div>

            <div class="container">
            <img src="https://atlo.es/w.jpg" alt="Avatar">
            <p class="texto1">Eso es todo. Mañana más. <br> See you very soon. // Salud y fuerza. //  To your health and strength!<br><br>
            -- ωeηdi *!<br><br>
            ComoVas.es<br>
            Casa Alto
            
            </div>
            
            <p class="texto2 texto1">¿Quieres ayudarnos? Hacerte seguidor nuestro en las redes sociales nos ayuda a llegar a más personas. ¡Siguenos en facebook e instragram para mantenerte al día! </p>

            <img src="http://atlo.es/publicidad.jpg" alt="Anuncio">

            <p>Recibe ayuda de un humano, escribiendo a sergio@mallorcainterbox.com <br> (C) ATLO MALLORCA </p>
            '; 

            $mensaje=$mensaje.'</body></html>';


            $this->email->message($mensaje);
            

            $this->email->send();
            
        
            //texto del correo electrónico
        
        }// fin forecah

    }

    public function wendy_reservas($clientes_id, $dias_id, $clases_id, $clientes_nombrepublico="")
    {

        //http://wendy.log99.es/index.php/A_atlo_temp/wendy_reservas/101/90/36/np

        echo "hola mundo 2";
        
        $hoy_cadena=$this->wendy_dia();
        $hoy=$hoy_cadena[0]['dias_id'];

        if ($dias_id==$hoy){
            echo "_correcto";
            
            $this->reservar_entreno_hoy($clientes_id, $dias_id, $clientes_nombrepublico, $clases_id);

        }else{
            echo "_error";

        }

    }

    public function buscar_clientes_dos($cliente, $dia)
    {
        
       

        $this->load->database();
 

        $numero = $cliente; 
        
        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_clientes` WHERE `clientes_id` = $numero AND `clientes_activo` LIKE 'ACTIVO'" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);
       
    }


    public function wendy_enlace($clientes_id, $dias_id, $clases_id)
    {

        echo "este enlace";
    }

    
    

    public function lista_hoy($dia='')
    {

        //http://wendy.log99.es/index.php/A_atlo_temp/lista_hoy/90
        $this->load->database();

        $bb = 
        "SELECT a.listas_data1, c.clases_hora, b.clientes_orden FROM at_temp_listas a, at_temp_clientes b, at_temp_clases c WHERE a.clientes_id = b.clientes_id AND c.clases_id = a.clases_id AND a.dias_id = '".$dia."' ORDER BY c.clases_hora ASC"  ;
      
        $query = $this->db->query($bb);
        $row = $query->row();
        
        echo json_encode(
            $query->result()
        );

        

    

    }

    

  





    







}
?>