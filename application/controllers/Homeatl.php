<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeAtl extends CI_Controller {

    public function index(){

        //https://v1.atlo.es/index.php/homeatl
        echo "hola mundo";

    }

    public function ver_resultados_c($cliente=NULL,$id="%%%"){
       
        $this->load->database();
        //https://v1.atlo.es/index.php/homeatl/ver_resultados_c
        
        $sql = "SELECT * FROM `at_def_records_resultados` WHERE `cliente_id` LIKE '".$cliente."' AND `records_id` LIKE '".$id."' ORDER BY `resultados_id` ASC";

        $query = $this->db->query($sql);
        echo json_encode(
            $query->result()
        );


    }

    public function guardar_ejercicios($id=NULL,$c=NULL,$c1=NULL,$c2=NULL,$re=NULL,$cliente=NULL){

        //https://v1.atlo.es/index.php/homeatl/guardar_ejercicios

       //this load database
       $this->load->database();

       //recibir por post
        $casilla1 = $this->input->get('orden_valor');
        
       //comprobar que no existe

       //guardar datos
       /*	
        resultados_id
        user_id cliente_id
        resultados_timestamp
        resultados_a
        resultados_b
        rescultados_c resultados_c
        resultados_kg
        resultados_tiempo
       */
       //$hoy = date("Y-m-d H:i:s"); 

       $data = array(
        'resultados_timestamp' => date("Y-m-d H:i:s"),
        'cliente_id' => $cliente,
        'records_id' => $re,
        'resultados_a' => urldecode ( $c),
        'resultados_b' => urldecode ( $c1),
        'resultados_c' => urldecode ( $c2),
        'resultados_kg' => $casilla1
        );

        

        $where = array(

            'cliente_id' => $cliente,
            'records_id' => $re,
            'resultados_a' => urldecode ( $c),
            'resultados_b' => urldecode ( $c1),
            'resultados_c' => urldecode ( $c2)
            
            );

    

       /*$sql="SELECT *  FROM `at_def_valor` WHERE `clientes_email` LIKE '".$usuario."' AND `dias_id` = ".$id." AND `valor_tipo` LIKE '".$accion."' LIMIT 1";

       $sql=""*/


       $query = $this->db->get_where('at_def_records_resultados', $where);

       
       
     
       $row = $query->row_array();
       $existe = $row['resultados_id'];

       

       if($existe){ 

        $this->db->update('at_def_records_resultados', $data, $where);


       }else{
        
    
        $this->db->insert('at_def_records_resultados', $data);

       }



        echo '<div class="animated fadeOut fast">';
        echo '<h6 class="text-success">OK</h6>';
        echo '<div>';

    }

    public function ver_ejercicios(){

        //https://v1.atlo.es/index.php/homeatl/ver_ejercicios

        $this->load->database();
        $query = $this->db->query('SELECT * FROM `at_def_records_lista` ORDER BY `at_def_records_lista`.`records_destacar` DESC');

        echo json_encode(
            $query->result()
        );

    }

    public function contar_barcos($usuario='catxo99@gmail.com'){

        $this->load->database();
        //https://v1.atlo.es/index.php/homeatl/contar_barcos
        $sql = "SELECT COUNT(`clientes_id`) cuenta FROM `at_def_listas` WHERE `clientes_id` LIKE 'XXX".$usuario."'";

        $query = $this->db->query($sql);
        $row = $query->row_array();
        echo $row['cuenta'];

    }



    public function reporte_guardar($usuario=NULL,$id=NULL,$accion=NULL){

       //https://v1.atlo.es/index.php/homeatl/reporte_guardar

        $usuario;
        $id;
        $accion; 

       //this load database
       $this->load->database();

       //recibir por post
        $casilla1 = $this->input->post('casilla');
        $casilla2= $this->input->post('casilla2');

       //comprobar que no existe

       //guardar datos
       //`valor_id`, `valor_timedate`, `clientes_email`, `dias_id`, `valor_tipo`, `valor_datos`, `valor_datos1`

       //$hoy = date("Y-m-d H:i:s"); 

       $data = array(
        'valor_timedate' => date("Y-m-d H:i:s"),
        'clientes_email' => $usuario,
        'dias_id' => $id,
        'valor_tipo' => $accion,
        'valor_datos' => $casilla1,
        'valor_datos1' => $casilla2
        );

        $where = array(
            
            'clientes_email' => $usuario,
            'dias_id' => $id,
            'valor_tipo' => $accion
            );

       $sql="SELECT *  FROM `at_def_valor` WHERE `clientes_email` LIKE '".$usuario."' AND `dias_id` = ".$id." AND `valor_tipo` LIKE '".$accion."' LIMIT 1";

       $query = $this->db->query($sql);
       $row = $query->row_array();
       $existe = $row['valor_id'];

       if($existe){ 

        $this->db->update('at_def_valor', $data, $where);


       }else{
        
    
        $this->db->insert('at_def_valor', $data);

       }

   
       $mensa="usuario: ".$usuario." tipo: ".$accion." mensaje: ".$casilla1."-".$casilla2; 
       $url = "https://wa.me/34645097624?text=".urlencode($mensa);

       echo "<p class='m-0 text-center text-success'><i class='fas fa-check-square'></i> OK... Ahora Wendy se encargará de hacer llegar este mensaje a tu Entrenador. Sin embargo, puedes acelerar el proceso pulsando aquí (<a href='".$url."' target='_blanck'>whatsapp</a>). </p>";

       //respuesta

    }

    public function reporte($usuario=NULL,$id=NULL){


        echo '<div class="mt-0 px-0 animated zoomin faster"><div class="m-2"></div><form id="ajaxForm___reporte'.$id.'" action="https://v1.atlo.es/index.php/homeatl/reporte_guardar/'.$usuario.'/'.$id.'/___reporte" method="post" accept-charset="UTF-8">';
        //https://v1.atlo.es/index.php/homeatl/reporte
        echo '
        <div class="input-group mb-3">
        
        <select class="form-control rounded-left" name="casilla" id="invent0">    
            <option selected disabled>Seleccionar</option>
            <option>[201] COACH: A la clase de faltaba fluidez y organización.</option>
            <option>[202] COACH: La clase me faltaba variedad y es casi siempre lo mismo respecto otros días.</option>
            <option>[203] COACH: Me hacen faltaban indicaciones especialmente cuando estoy ejecutando los momivientos.</option>
            <option disabled>---</option>
            <option>[301] BOX: La música elegida era horrible.</option>
            <option>[302] BOX: Hay falta de material o está desgastado.</option>
            <option>[303] BOX: Estaba sucio o había cosas tiradas por el suelo.</option>
            <option disabled>---</option>
            <option>[401] VESTUARIOS: Estaba sucio (duchas).</option>
            <option>[402] VESTUARIOS: Estaba sucio (wc).</option>
            <option>[401] VESTUARIOS: Cosas y mochilas impidiendo el buen uso compartido de las instalaciones.</option>
            <option disabled>---</option>
            <option>[501] OTROS SOCIOS: Impiden la fluidez de la clase, molestando o interrunpiéndola.</option>
            <option disabled>---</option>
            <option>[990] OTROS.</option>
        </select>

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-arrow-right"></i></button>
        </div>
    
        
        </div>';


        //__reporte
        echo '</form>';
        
        echo '</div><!--final del div-->';

        echo '<div id="ajaxDestino___reporte'.$id.'"></div>';

        echo '    
        <script>

        $(document).ready(function(){
        $("#ajaxForm___reporte'.$id.'").bind("submit",function(){
            // Capturamnos el boton de envío
            //var btnEnviar = $("#btnEnviar");
            swal("Espere...", {
              button: false,
              closeOnClickOutside: false,
              timer: 1500,
            });
            
            $.ajax({
                type:$(this).attr("method"),
                url: $(this).attr("action"),
                data:$(this).serialize(),
                beforeSend: function(){
                    /*
                    * Esta función se ejecuta durante el envió de la petición al
                    * servidor.
                    * */
                },
                complete:function(data){
                    /*
                    * Se ejecuta al termino de la petición
                    * */
                },
                success: function(data){
                    /*
                    * Se ejecuta cuando termina la petición y esta ha sido
                    * correcta
                    * */
                    $("#ajaxDestino___reporte'.$id.'").html(data);
                },
                error: function(data){
                    /*
                    * Se ejecuta si la peticón ha sido erronea
                    * */
                    swal("ALGO HA IDO MAL...", {
                        button: true,
                    });
                    
                }
            });
            // Nos permite cancelar el envio del formulario
            return false;
        });
            
        });
        </script>';

        //_fin de ___reporte

    }


    public function lesion($usuario=NULL,$id=NULL){

        echo '<div class="mt-0 px-0 animated zoomin faster"><div class="m-2"></div><form id="ajaxForm___lesion'.$id.'" action="https://v1.atlo.es/index.php/homeatl/reporte_guardar/'.$usuario.'/'.$id.'/___lesion" method="post" accept-charset="UTF-8">';
        
        //https://v1.atlo.es/index.php/homeatl/lesion/catxo99@gmail.com/123
        echo '
        <div class="input-group mb-3">
        <select name="casilla" class="form-control rounded-left" id="invent1">

            <option>[900] NADA.</option>

            <option disabled>---</option>

            <option>[911] Molestia Leve: Rodillas, caderas o piernas.</option>
            <option>[912] Molestia Grave: Rodillas, caderas o piernas.</option>
            <option>[913] Recuperándome: Rodillas, caderas o piernas.</option>

            <option disabled>---</option>

            <option>[921] Molestia Leve: Lumbares o espalda.</option>
            <option>[922] Molestia Grave: Lumbares o espalda.</option>
            <option>[923] Recuperándome: Lumbares o espalda.</option>

            <option disabled>---</option>

            <option>[931] Molestia Leve: Hombros/Codos/Muñecas/Cervicales.</option>
            <option>[932] Molestia Grave: Hombros/Codos/Muñecas/Cervicales.</option>
            <option>[933] Recuperándome: Hombros/Codos/Muñecas/Cervicales.</option>

            <option disabled>---</option>

            <option>[951] Falta de aire/asma/problema respiratorio.</option>

            <option disabled>---</option>

            <option>[961] Mareo/Pérdida de equilibro/malestar general.</option>

            <option disabled>---</option>

            <option>[971] Pulso extraño/molestias o pinchazos (en el corazón).</option>
            
            <option disabled>---</option>

            <option>[990] OTROS.</option>
        </select>
        
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-arrow-right"></i></button>
        </div>
    
        </div>';

        echo '</div><!--final del div-->';

        //___lesion
        echo '</form>';
        
        echo '</div><!--final del div-->';

        echo '<div id="ajaxDestino___lesion'.$id.'"></div>';

        echo '    
        <script>

        $(document).ready(function(){
        $("#ajaxForm___lesion'.$id.'").bind("submit",function(){
            // Capturamnos el boton de envío
            //var btnEnviar = $("#btnEnviar");
            swal("Espere...", {
              button: false,
              closeOnClickOutside: false,
              timer: 1500,
            });
            
            $.ajax({
                type:$(this).attr("method"),
                url: $(this).attr("action"),
                data:$(this).serialize(),
                beforeSend: function(){
                    /*
                    * Esta función se ejecuta durante el envió de la petición al
                    * servidor.
                    * */
                },
                complete:function(data){
                    /*
                    * Se ejecuta al termino de la petición
                    * */
                },
                success: function(data){
                    /*
                    * Se ejecuta cuando termina la petición y esta ha sido
                    * correcta
                    * */
                    $("#ajaxDestino___lesion'.$id.'").html(data);
                },
                error: function(data){
                    /*
                    * Se ejecuta si la peticón ha sido erronea
                    * */
                    swal("ALGO HA IDO MAL...", {
                        button: true,
                    });
                    
                }
            });
            // Nos permite cancelar el envio del formulario
            return false;
        });
            
        });
        </script>';

        //_fin de ___lesion

        

    }


    public function duda($usuario=NULL,$id=NULL){

        echo '<div class="mt-0 px-0 animated zoomin faster"><div class="m-2"></div><form id="ajaxForm___duda'.$id.'" action="https://v1.atlo.es/index.php/homeatl/reporte_guardar/'.$usuario.'/'.$id.'/___duda" method="post" accept-charset="UTF-8">';

        echo '<div class="input-group mb-3">';

        //https://v1.atlo.es/index.php/homeatl/duda
        echo '<textarea name="casilla" class="form-control form-control-sm" id="invent'.$id.'" name="invent'.$id.'" rows="3" placeholder="Hola entrenador, me gustaría pedirte/comentarte que..."></textarea>';

        echo '<div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-arrow-right"></i></button>
        </div>

        </div>';

        echo '</div><!--final del div-->';

        //___duda
        echo '</form>';
        
        echo '</div><!--final del div-->';

        echo '<div class="mb-4" id="ajaxDestino___duda'.$id.'"></div>';

        echo'<div class="mt-4" id="focus'.$id.'"></div>';

        echo '    
        <script>

        $(document).ready(function(){
        $("#ajaxForm___duda'.$id.'").bind("submit",function(){
            // Capturamnos el boton de envío
            //var btnEnviar = $("#btnEnviar");
            swal("Espere...", {
              button: false,
              closeOnClickOutside: false,
              timer: 1500,
            });
            
            $.ajax({
                type:$(this).attr("method"),
                url: $(this).attr("action"),
                data:$(this).serialize(),
                beforeSend: function(){
                    /*
                    * Esta función se ejecuta durante el envió de la petición al
                    * servidor.
                    * */
                },
                complete:function(data){
                    /*
                    * Se ejecuta al termino de la petición
                    * */
                },
                success: function(data){
                    /*
                    * Se ejecuta cuando termina la petición y esta ha sido
                    * correcta
                    * */
                    $("#ajaxDestino___duda'.$id.'").html(data);
                },
                error: function(data){
                    /*
                    * Se ejecuta si la peticón ha sido erronea
                    * */
                    swal("ALGO HA IDO MAL...", {
                        button: true,
                    });
                    
                }
            });
            // Nos permite cancelar el envio del formulario
            return false;
        });
            
        });
        </script>';

        //_fin de ___duda


        echo '<script>
        $(document).ready(function() { 
            


            setTimeout(function() {
                location.hash = "#focus'.$id.'";
              }, 1000);

              setTimeout(function() {
               $("#invent'.$id.'").focus(); 
              }, 1001);
            
            
            
            
     

        });
        </script>';



    }


    public function seguimiento($usuario=NULL,$id=NULL){

        echo '<div class="mt-0 px-0 animated zoomin faster"><div class="m-2"></div><form id="ajaxForm___seguimiento'.$id.'" action="https://v1.atlo.es/index.php/homeatl/reporte_guardar/'.$usuario.'/'.$id.'/___seguimiento" method="post" accept-charset="UTF-8">';

        //https://v1.atlo.es/index.php/seguimiento
        //echo $usuario;
        //echo $id; 
        
        echo '<div class="form-row">
        <div class="form-group col-md-6"> <label for="form19">PESO</label> <input type="text" name="casilla" class="form-control form-control-sm" id="invent10" placeholder="000"> </div>
        <div class="form-group col-md-6"> <label for="form20">GRASA</label> <input type="text" name="casilla2" class="form-control form-control-sm" id="invent11" placeholder="000"> </div>
        </div>';

        echo '<button type="submit" name="" id="" class="btn btn-primary btn-sm btn-block">Enviar</button>';

        echo '</div><!--final del div-->';

        //___seguimiento
        echo '</form>';
        
        echo '</div><!--final del div-->';

        echo '<div id="ajaxDestino___seguimiento'.$id.'"></div>';

        echo '    
        <script>

        $(document).ready(function(){
        $("#ajaxForm___seguimiento'.$id.'").bind("submit",function(){
            // Capturamnos el boton de envío
            //var btnEnviar = $("#btnEnviar");
            swal("Espere...", {
              button: false,
              closeOnClickOutside: false,
              timer: 1500,
            });
            
            $.ajax({
                type:$(this).attr("method"),
                url: $(this).attr("action"),
                data:$(this).serialize(),
                beforeSend: function(){
                    /*
                    * Esta función se ejecuta durante el envió de la petición al
                    * servidor.
                    * */
                },
                complete:function(data){
                    /*
                    * Se ejecuta al termino de la petición
                    * */
                },
                success: function(data){
                    /*
                    * Se ejecuta cuando termina la petición y esta ha sido
                    * correcta
                    * */
                    $("#ajaxDestino___seguimiento'.$id.'").html(data);
                },
                error: function(data){
                    /*
                    * Se ejecuta si la peticón ha sido erronea
                    * */
                    swal("ALGO HA IDO MAL...", {
                        button: true,
                    });
                    
                }
            });
            // Nos permite cancelar el envio del formulario
            return false;
        });
            
        });
        </script>';

        //_fin de ___seguimiento


    }




}

