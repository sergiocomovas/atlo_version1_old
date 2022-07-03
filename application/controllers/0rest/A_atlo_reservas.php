<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class A_atlo_reservas extends CI_Controller {

    public function index( )
    {
        //https://wendy.log99.es/index.php/A_atlo_reservas/index
        'Hola Mundo A_atlo_reservas';

    }


    public function ver_entreno($id_clases){

        //199
        
        //https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/199


        //SELECT * FROM `at_def_entoprogram`, `at_def_entowod` WHERE `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entoprogram`.`dia_id` = 198 AND `at_def_entowod`.`entowod_descripcion` != '' ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC
    
        $this->load->database();
    
        $sql = 
        "
        SELECT * FROM `at_def_entoprogram`, `at_def_entowod` WHERE `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entoprogram`.`dia_id` = ".$id_clases." AND `at_def_entowod`.`entowod_descripcion` != '' ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC
        ";
    
        $query = $this->db->query($sql);
    
        echo json_encode(
            $query->result()
        );
    
    }

    public function retornar_dia($id){

        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_id` = ".$id;

        $query = $this->db->query($sql);
        $row = $query->row();
        return $row;


        //SELECT * FROM `at_temp_dias` WHERE `dias_id` = 193

    }


    public function retornar_clase($id){

        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_clases` WHERE `clases_id` =".$id;

        $query = $this->db->query($sql);
        $row = $query->row();
        return $row;


        //SELECT * FROM `at_temp_dias` WHERE `dias_id` = 193

    }

    public function escribir_correo($username,$dia,$accion,$clase){


            $clase = $this->retornar_clase($clase);
            $dia = $this->retornar_dia($dia);


            date_default_timezone_set('Europe/Berlin');     
            $fecha = date('Y-m-d H:i:s');  
            //$semana = date('W');

            //$datos_clase = $this->detalles_clase($clase);
    
    
            $this->load->library('email');
            $this->load->helper('url');
    
    
            $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot de Reservas)');
            $this->email->to($username);
            $this->email->bcc('strongestpalma@gmail.com');
            $this->email->bcc('jdds1985@gmail.com');
    
            $this->email->subject('Confirmación de reservar');
    

            //ate_format(date_create($max_proxima_semana[0]['min']),"d/m")
            $this->email->message('
            <html>
            <body>
                <h3>Hola</h3>
                <p>Soy Wendy, el bot de la Casa Atlo.</p>
    
                <p>Te confirmo tu reserva</p>
    
                <ul>
                
                <li>Nombre de usuario: '.$username.'</li>
                <li>Acción: '.$accion.'</li>
                <li>Fecha: '.$dia->dias_nom.' '.date_format(date_create($dia->dias_date),"d/m").'</li>
                <li>Clase: '.$clase->clases_tipo.' - '.substr($clase->clases_hora,0,5).' ('.$clase->clases_id.')</li>
    
                </ul>

                <p>Puedes anular/modificar o volver a reservar tus clases a través de https://v1.atlo.es/</p>
    
    
                <p>E-Mail para soporte técnico: sergio@mallorcainterbox.com</p>
                
                <p>Gracias, Wendy</p>
    
            </body>
            </html>
            
            ');
    
            $this->email->send();
    

    }

    



    public function def_lista_cancelar($retorno){

        //608
        ///https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_cancelar/catxo99@gmail.com/608

        $this->load->database();

        //UPDATE `at_def_listas` SET `listas_cont` = '0', `listas_data1` = 'BARCO FLECHA', `listas_data4` = '*' WHERE `at_def_listas`.`listas_id` = 16;

        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d G:i:s');  

        $cliente = $this->input->post('clientes_id');
        $id_clase = $this->input->post('clases_id');


        $set = array(
            'clientes_id' => 'XXX'.$cliente,
            'listas_cont' => '0',
            'listas_data1' => '🚢⤵',
            'listas_data4' => $fecha
        );

        $where = array(
            'clientes_id' => $cliente,
            'clases_id' => $id_clase
        );
        
        $this->db->where($where);
        $this->db->update('at_def_listas', $set);

        //
        // escribir_correo($username,$dia,$accion,$clase)
        $this->escribir_correo($this->input->post('clientes_id'),$this->input->post('dias_id'),'CLASE ANULADA CORRECTAMENTE',$this->input->post('clases_id')   );

        //RETORNO
        if ($retorno == "sin_retorno"){}else{
        $this->load->helper('url');                $mensaje="CLASE_ANULADA_CORRECTAMENTE_(ID_".$this->input->post('clases_id').")";
        $redirect=$this->input->post('retorno').'?MENSAJE='.$mensaje.'#'.$retorno;
        redirect($redirect);
        }
        
    }

    public function def_lista_dias_estas($cliente,$id_dias){

        ///https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_dias_estas/catxo99@gmail.com/192
    
    
        $this->load->database();

        //desconozco el id de la clase

        //SELECT * FROM `at_def_listas` WHERE `clientes_id` LIKE 'catxo99@gmail.com' AND `dias_id` = 193 ORDER BY `listas_id` DESC

        //de aquí quiero clases_id

        $sql = "SELECT * FROM `at_def_listas` WHERE `clientes_id` LIKE '".$cliente."' AND `dias_id` LIKE '".$id_dias."' ORDER BY `listas_id` DESC";

        $query = $this->db->query($sql);
    

        $datax = json_encode(
            $query->row()
        );


        $lista_datax = json_decode($datax, false);

        $id_clases = $lista_datax->clases_id; 



        //SELECT * FROM `at_def_clases`, `at_def_listas` WHERE `at_def_clases`.`dias_id` = `at_def_listas`.`dias_id` AND `at_def_listas`.`clientes_id` LIKE 'catxo99@gmail.com' AND `at_def_listas`.`dias_id` LIKE '193' AND `at_def_clases`.`clases_id` LIKE '627'

        $sql="SELECT * FROM `at_def_clases`, `at_def_listas` WHERE `at_def_clases`.`dias_id` = `at_def_listas`.`dias_id` AND `at_def_listas`.`clientes_id` LIKE '".$cliente."' AND `at_def_listas`.`dias_id` LIKE '".$id_dias."' AND
        `at_def_clases`.`clases_id` LIKE '".$id_clases."'";

    
        $query = $this->db->query($sql);
    
        echo json_encode(
            $query->row()
        );
    
    }


    public function def_lista_estas($cliente,$id_clase){

    ///https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_estas/catxo99@gmail.com/611


    //SELECT * FROM `at_def_listas` WHERE `clientes_id` LIKE 'catxo99@gmail.com' AND `clases_id` LIKE '611'

    $this->load->database();

    $sql = 
    "SELECT * FROM `at_def_listas` WHERE `clientes_id` LIKE '".$cliente."' AND `clases_id` LIKE '".$id_clase."' ";

    $query = $this->db->query($sql);

    echo json_encode(
        $query->row()
    );

    }

    public function def_lista_lista($clase)
    {

        //https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_lista/611/

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_def_listas` WHERE `clases_id` LIKE '".$clase."'" ;

        $query = $this->db->query($sql);
        echo json_encode(
            $query->result()
        );

    }

    public function def_lista_lista_sinbarco($clase)
    {

        //https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_lista/611/

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_def_listas` WHERE `clases_id` LIKE '".$clase."'" ;

        //$clase = "20662";

        $sql = 
        "SELECT *  FROM `at_def_listas` WHERE `clases_id` LIKE '".$clase."'  AND `listas_cont` = 1 ORDER BY `at_def_listas`.`listas_autodate`  ASC";

        $query = $this->db->query($sql);
        echo json_encode(
            $query->result()
        );

    }

    public function def_delete_rapido($cliente,$dia,$no_ret=NULL){

        //https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_delete_rapido/catxo99@gmail.com/199/

        $this->load->database();

            $where = array(
                'clientes_id' => $cliente,
                'dias_id' => $dia
            );
            
            $this->db->where($where);
            $this->db->delete('at_def_listas');

            //RETORNO
            if($no_ret=='no_retorno'){
            $this->load->helper('url');

            $mensaje="ACCIÓN_COMPLETADA_CORRECTAMENTE";

            $redirect= 'https://v1.atlo.es/index.php/home?MENSAJE='.$mensaje.'#manana'.$dia;
            redirect($redirect);
            }

        }

    

    public function def_lista_diario($retorno,$accion = null){
        //https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_diario/añadir/

        //"DELETE FROM `at_def_listas` WHERE `at_def_listas`.`listas_id` = 91"?

        if ($accion == "borrado" or $accion == "borrar_noret"){

            $this->load->database();

            $where = array(
                'clientes_id' => $this->input->post('clientes_id'),
                'dias_id' => $this->input->post('dias_id')
            );
            
            $this->db->where($where);
            $this->db->delete('at_def_listas');
        }
       

        $this->load->database();

        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d G:i:s');  


        $data = array(

        
        'clientes_id' => $this->input->post('clientes_id'),
        'clases_id' => $this->input->post('clases_id'),
        'dias_id' => $this->input->post('dias_id'),
        'listas_cont' => $this->input->post('listas_cont'),
        'listas_autodate' => $fecha,
        'listas_data1' => $this->input->post('listas_data1'),
        'listas_data2' => $this->input->post('listas_data2'),
        'listas_data3' => $this->input->post('listas_data3'),
        'listas_data4' => $this->input->post('listas_data4')

        );

        
    
        $this->db->insert('at_def_listas', $data);

        //ESCRIBIR CORREO
        //escribir_correo($username,$dia,$accion,$clase)
        $this->escribir_correo($this->input->post('clientes_id'),$this->input->post('dias_id'),'RESERVA DE CLASE',$this->input->post('clases_id'));

        //RETORNO
        if ($retorno == "sin_retorno"){}else{
        $this->load->helper('url');
        $mensaje="_CLASE_RESERVADA_CORRECTAMENTE_(ID_".$this->input->post('clases_id').")";
        $redirect= $this->input->post('retorno').'?MENSAJE='.$mensaje.'#'.$retorno;
        redirect($redirect);
        }


    }


    public function comprobar_codigo($codigo, $clases_tipo)
    {

        $this->load->database();

        $codigo = trim($codigo);

        // ORDER BY `codigos_id` ASC

        $sql = 
        "SELECT * FROM `at_def_codigos` WHERE `codigos_codigo` = $codigo AND `clases_tipo` LIKE '".$clases_tipo."'" ;

        $query = $this->db->query($sql);
        return $query->row();

    }

    public function comprobar_email($email)
    {

        $this->load->database();

        $sql = 
        "SELECT * FROM `at_temp_clientes` WHERE `clientes_email` LIKE '".$email."'" ;

        $query = $this->db->query($sql);
        return $query->row();

    }

    public function datos_clase($clase)
    {
        $this->load->database();

        $sql = 
        "SELECT * FROM `at_def_clases` WHERE `clases_id` = $clase" ;

        $query = $this->db->query($sql);
        return $query->row();

    }

    public function actualizar_codigos($codigo,$veces){

        $this->load->database();

        date_default_timezone_set('Europe/Berlin');         
        $fecha = date('Y-m-d G:i:s');  

        $veces = $veces+1; 

        //ACTUALIZAR QUERY

        $update = "UPDATE `at_def_codigos` SET 
        
        `codigos_usado` = '".$veces."',
        `codigos_autodate` = '".$fecha."'
        
        WHERE `at_def_codigos`.`codigos_id` = $codigo";

        $this->db->query($update);
    }

    public function nuevo_cliente($email)
    {
        $this->load->database();
        date_default_timezone_set('Europe/Berlin');
        $fecha = date('Y-m-d'); 

        $clientes_rango = "NO";
        $clientes_nombrereal = "Desconocido ".$fecha;
        $clientes_email = $email; 
        $clientes_wa = "";
        $clientes_pre_wa = "ESP";
        $clientes_nombrepublico = "Nuevo ".substr($email, 0, 6); 
        $clientes_activo= "TRIAL";

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

    }

    public function reservar_clase($r_clienteid, $r_diaid, $r_claseid, $r_nombrepublico, $r_pagado, $r_horadelaclase, $r_email)
    
    {
        

        $this->load->database();

        date_default_timezone_set('Europe/Berlin');         
        $autodate = date('Y-m-d H:i:s');  

        $update = "UPDATE `at_temp_listas` 
        SET 
        `listas_cont` = 0, 
        `listas_data1` = '🛳⤵',
        `listas_data2`  = '★☆☆☆☆',
        `listas_autodate` = '".$autodate."'
        WHERE `at_temp_listas`.`clientes_id` = '".$r_clienteid."' 
        AND   `at_temp_listas`.`dias_id` = '".$r_diaid."' ";

        $this->db->query($update);

        //INSERT INTO `at_temp_listas`  (NULL, '101', '40', '89', '1', '2018-06-17 02:04:00', 'SERGIO', 'OOOOX');

        $sql = "INSERT INTO `at_temp_listas`
        (`clientes_id`, `clases_id`, `dias_id`, `listas_cont`, `listas_autodate`, `listas_data4`, `listas_data1`, `listas_data3`, `listas_data2`) 
        
        VALUES 
        (
        ".$this->db->escape($r_clienteid).", 
        ".$this->db->escape($r_claseid).",
        ".$this->db->escape($r_diaid).",
        '1',
        ".$this->db->escape($autodate).",
        ".$this->db->escape($r_pagado).",
        ".$this->db->escape($r_nombrepublico).",
        ".$this->db->escape($r_horadelaclase).",
        '★★★★☆'
        )";
            
        $this->db->query($sql);

    }

    //buscar cliente 
    function stripe_customer($username){

        $this->load->database();

        $query = $this->db->query(' 
           
           SELECT * FROM at_def_clientes WHERE at_def_clientes.clientes_email = "'.$username.'"

        ');


        $row = $query->row();

        return $row;

    }

    public function main2($mi_dia){

        $r_email = $_POST['email'];

        //buscar_cliente

        $_POST['codigo'];
        $coso= $_POST['clase'];

        if (!$_POST['codigo']){$valor_codigo=0;}else{ $valor_codigo=$_POST['codigo'];}


        $datos_clase = $this->datos_clase($_POST['clase']);
         $clases_tipo = $datos_clase->clases_tipo;
        
        $datos_codigo = $this->comprobar_codigo($valor_codigo, $clases_tipo);

        if ($datos_codigo){

            "<br>El código ".$datos_codigo->codigos_codigo." es Correcto";

            $forma_de_pago ="Con código ".$datos_codigo->codigos_codigo." (".$datos_codigo->codigos_usado."+1)";
            
            $this->actualizar_codigos($datos_codigo->codigos_id,$datos_codigo->codigos_usado);
            

        }else{

            $forma_de_pago ="------<br><br><br> ".$valor_codigo." ".$clases_tipo;

        }

        $datos_cliente = $this->comprobar_email(trim($_POST['email']));

        if ($datos_cliente){
            "<br> El id del clientes es ". $datos_cliente->clientes_id;
            "<br> El nombre publico del cliente es ".$datos_cliente->clientes_nombrepublico;  

        }else{

            $this->nuevo_cliente(trim($_POST['email']));
            $datos_cliente = $this->comprobar_email(trim($_POST['email']));
            "El Id del nuevo cliente es". $datos_cliente->clientes_id;
            "<br> El nombre publico del cliente es ".$datos_cliente->clientes_nombrepublico;  
        }

        

        //email
        $r_clienteid = $datos_cliente->clientes_id;

        //dia_id
        $r_diaid = $mi_dia;

        //clase_id
        $r_claseid = $_POST['clase'];

        //OK
        $r_pagado = $forma_de_pago;

        //nombrepublico OK
        $r_nombrepublico = $datos_cliente->clientes_nombrepublico;

        //Hora de la Clase
        $r_horadelaclase = $datos_clase->clases_hora;

        //hacer la reserva
        $this->reservar_clase($r_clienteid, $r_diaid, $r_claseid, $r_nombrepublico, $r_pagado, $r_horadelaclase, $r_email); 

        //enviar un correo
        $this->enviar_correo($r_clienteid, $r_diaid, $r_claseid, $r_nombrepublico, $r_pagado, $r_horadelaclase, $_POST['email']);

        //retorno
        $this->retorno($r_claseid); 




    }

    public function obtener_fecha($id){

        //https://wendy.log99.es/index.php/A_atlo_horario/obtener_fecha
        
        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_id` = $id" ;

        $query = $this->db->query($sql);
        return $query->row();
        
       

    }


    public function enviar_correo($r_clienteid, $r_diaid, $r_claseid, $r_nombrepublico, $r_pagado, $r_horadelaclase, $correo_del_cliente){


        if ($this->stripe_customer($correo_del_cliente)){

            
            //e

            $aviso = "<br><br>Aviso: esta versión de Atlo dejará de estar disponible próximamente para los clientes con contrato. Visite https://v1.atlo.es/index.php/zonaprivada/login para acceder al sistema.";

        }

        
        $fechaA=$this->obtener_fecha($r_diaid);
        $fecha1=$fechaA->dias_date;
        
        $this->load->library('email');

        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot de Reservas)');
        $this->email->to($correo_del_cliente);
        $this->email->bcc('strongestpalma@gmail.com');

        $this->email->subject('Clase Reservada Correctamente.');


        $this->email->message('
        <html>
        <body>


            <h3>Hola '.$aviso.'</h3>
            <p>Soy Wendy, el bot de reservas de Atlo Barbell Club</p>
            <p>Te informo que ya te he apuntado para tu clase de CrossFit</p>
            <p>Esto son los datos:</p>

            <ul>
                <li><strong>Usuario ID: </strong>'.$r_clienteid.' ('.$correo_del_cliente.')</li>
                <li>Nombre: '.$r_nombrepublico.'</li>
                <li>Hora de la clase: '.$r_horadelaclase.'</li>
                <li>Día: '.$fecha1.'</li>
                <li>Lugar: Atlo Barbell Club</li>
                <li>Forma de pago: '.$r_pagado.'</li>
                
            </ul>

            <p>E-Mail para soporte técnico: sergio@mallorcainterbox.com</p>
            
            <p>Gracias, Wendy</p>

        <body>
        
        ');

        $this->email->send();



    }

    public function retorno($clase){

        $this->load->helper('url');

        $mensaje="_CLASE_RESERVADA_CORRECTAMENTE_(ID_".$clase.") VERSION ANTIGUA";

        $redirect="https://v1.atlo.es/index.php/home?MENSAJE=".$mensaje;
    

        redirect($redirect);
    }




}
?>