<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_atlo_sys extends CI_Controller {


    public function obtener_lista_de_clientes($a='CAN VALER') {

        //https://wendy.log99.es/index.php/A_atlo_sys/obtener_lista_de_clientes
        
        $this->load->database();
    
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_clientes` WHERE `clientes_club` LIKE '%".$a."%'
        AND
        `clientes_activo` LIKE '%ACTIV%'
        ORDER BY `clientes_autodate` DESC" ;
    
        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );



    }


    public function obtener_lista_de_libros($customer){

        $this->load->database();
    
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        //https://wendy.log99.es/index.php/A_atlo_sys/obtener_lista_de_libros/cus_DBCkjjLzQRAVUB/

        //https://wendy.log99.es/index.php/A_atlo_sys/obtener_lista_de_libros/cus_DBCmPFRR95rFb6/





        //CAMBIAR PARA EL AUTOPAGO
        $query = $this->db->query("
        SELECT libros_tipo, libros_id, libros_data, libros_precio1 FROM `at_def_libros` WHERE `libros_tipo` LIKE '%ARIFA_M%' AND `stripe_customer_id` = '$customer' AND `libros_cerrado` = 'NO' ORDER BY `libros_id` ASC;");

        echo json_encode(
            $query->result()
        );



    }


    public function modificar_datos_libros_email(){


        //https://wendy.log99.es/index.php/A_atlo_sys/modificar_datos_libros_email;
        echo "Espere...";


        //cliente=cus_DEDDMVNGQv5ZSq&libros_id=6&euros=12&centimos=2&libros=4

        $this->load->database();
    
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $euros = $_GET['euros'];
        $id =  $_GET['libros_id'];
        $centimos = $_GET['centimos'];
        $veces =  $_GET['veces'];
        $retorno = $_GET['cliente'];
        $fecha = $_GET['fecha'];
        $concepto = $_GET['concepto'];


        $data = array(
            'libros_precio1' => $euros.'.'.$centimos,
            'libros_veces' => $veces,
            'libros_concepto' => $concepto
        );
        
        $this->db->where('libros_id', $id);
        $this->db->update('at_def_libros', $data);
        // Produces:
        //
   
        //UPDATE `at_def_libros` SET `libros_precio1` = '20.01' WHERE `at_def_libros`.`libros_id` = 8;

        $usuario1 = $retorno;
        $this -> actualizar_usuario($usuario1);

        $this->load->helper('url');

        $url = "http://atlo.es/7se/buscar_cliente.php?CLIENTE=".$retorno."&MENSAJE=POR_IMPORTE_DE_EUR_".$euros.",".$centimos."_MODIFICADO_CORRECTAMENTE_EL_REGISTRO_".$id."_DE_".$fecha;

        //ENVIAR  

        $this->enviar_ticket($id, $concepto, $euros, $centimos, $retorno, $fecha);
        
        redirect($url);


    }

    public function enviar_ticket($id, $concepto, $euros, $centimos, $cliente, $fecha){

      $datos_clientes = $this->obtener_cliente($cliente);
      

       $this->load->library('email');

       $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot)');
       $this->email->to($datos_clientes->clientes_email);
       $this->email->bcc('strongestpalma@gmail.com');

       $this->email->subject('Nuevo contrato Cliente');


       $this->email->message('
       <html>
       <body>
           <h3>Hola</h3>
           <p>Soy Wendy, el bot de Atlo.</p>
           <p>Hemos actualizado el sistema con el siguiente registro:</p>
           
           <ul>

           <li>Cliente: '.$datos_clientes->clientes_nombrereal.'</li>
           <li>Referencia: '.$id.' (Ticket del '.$fecha.')</li>
           <li>Tipo: '.$concepto.'</li>
           <li>Euros: '.$euros.','.$centimos.'</li>
           <li>Pago: MONEDA.</li>
           
           <ul>
           
           <br>
           <p>Saludos, ~Wendy.</p>

       <body>
       </html>       
       ');

       $this->email->send();

      

    }

    public function obtener_libros_modena_cliente_por_mes($customer, $mes, $ano)
    {
        //https://wendy.log99.es/index.php/A_atlo_sys/obtener_libros_modena_cliente_por_mes/cus_DEDDMVNGQv5ZSq/09

        //

        $this->load->database();
    
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_libros` WHERE `libros_data` LIKE '$mes/$ano' AND `stripe_customer_id` LIKE '$customer' AND `libros_tipo` LIKE '%MONED%' AND `libros_cerrado` LIKE 'NO' ORDER BY `libros_id` ASC";
    
        $query = $this->db->query($sql);

        echo json_encode(
            $query->result()
        );

    

    }

    public function obtener_cliente($a) {

        //https://wendy.log99.es/index.php/A_atlo_sys/obtener_cliente
                
        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_clientes` WHERE `stripe_customer_id` LIKE '$a' ORDER BY `clientes_orden` ASC" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        return $row;

    }

    public function renovacion_12($mes)
    {

        //SELECT * FROM `at_xx_meses` WHERE `meses_mes` LIKE '07/2018'

        //https://wendy.log99.es/index.php/A_atlo_sys/renovacion_12/07/2018
                
        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_xx_meses` WHERE `meses_mes` LIKE '$mes'" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        $mes_inicial = $row->meses_id;
        $mes_final = $mes_inicial+11;  
        
        $sql = 
        "SELECT * FROM `at_xx_meses` WHERE `meses_id` BETWEEN $mes_inicial AND $mes_final";

        $query = $this->db->query($sql);

        return $query->result();

        //echo json_encode(
        //    $query->result()
        //);

    }

    public function imprimir_cliente($a)
    {

        //https://wendy.log99.es/index.php/A_atlo_sys/imprimir_cliente/cus_DBCkjjLzQRAVUB
        $datos_clientes = $this->obtener_cliente($a);

        //INDICAR DUPLICADOS
        //UPDATE `at_def_libros` SET `libros_cerrado` = 'SI' WHERE`at_def_libros`.`stripe_customer_id` =$datos_clientes->stripe_customer_id;

        $data = array(
            'libros_cerrado' => 'SÍ'
        );
        
        $this->db->where('stripe_customer_id', $datos_clientes->stripe_customer_id);
        $this->db->update('at_def_libros', $data );
        // Produces:
        //
        //      UPDATE mytable
        //      SET title = '{$title}', name = '{$name}', date = '{$date}'
        //      WHERE id = $id


        $renovacion_12 = $this->renovacion_12($datos_clientes->clientes_antiguedad);


        foreach($renovacion_12 as $x => $x_value) 
        
        {
            $datos_clientes->clientes_id; 
            $datos_clientes->stripe_customer_id; 
            $meses=$x_value->meses_mes;
            $arreglo_meses[] = $meses;


            //INSERT INTO `at_def_libros` (`libros_id`, `libros_data`, `clinetes_id`, `stripe_customer_id`, `libros_tipo`, `libros_concepto`, `libros_precio1`, `libros_precio2`, `libros_precio3`, `libros_codigo1`, `libros_codigo2`, `libros_codigo3`) VALUES (NULL, '08/2018', '9223372036854775807', 'cus_DBCkjjLzQRAVUB', 'tarifa_moneda', NULL, '0.00', '0.00', '0.00', NULL, NULL, NULL);

            $data = array(
                'libros_data' => $meses=$x_value->meses_mes,
                'clientes_id' => $datos_clientes->clientes_id,
                'stripe_customer_id' => $datos_clientes->stripe_customer_id,
                'libros_tipo' => 'tarifa_moneda',
                'libros_precio1' => 0.00,
                'libros_precio2' => 0.00,
                'libros_precio3' => 0.00
            );
        
            $this->db->insert('at_def_libros', $data);  

            $data = array(
                'libros_data' => $meses=$x_value->meses_mes,
                'clientes_id' => $datos_clientes->clientes_id,
                'stripe_customer_id' => $datos_clientes->stripe_customer_id,
                'libros_tipo' => 'tarifa_stripe',
                'libros_precio1' => 0.00,
                'libros_precio2' => 0.00,
                'libros_precio3' => 0.00
            );
        
            $this->db->insert('at_def_libros', $data);  

            $data = array(
                'libros_data' => $meses=$x_value->meses_mes,
                'clientes_id' => $datos_clientes->clientes_id,
                'stripe_customer_id' => $datos_clientes->stripe_customer_id,
                'libros_tipo' => 'productos_moneda',
                'libros_precio1' => 0.00,
                'libros_precio2' => 0.00,
                'libros_precio3' => 0.00
            );
        
            $this->db->insert('at_def_libros', $data);  

            $data = array(
                'libros_data' => $meses=$x_value->meses_mes,
                'clientes_id' => $datos_clientes->clientes_id,
                'stripe_customer_id' => $datos_clientes->stripe_customer_id,
                'libros_tipo' => 'otros_moneda',
                'libros_precio1' => 0.00,
                'libros_precio2' => 0.00,
                'libros_precio3' => 0.00
            );
        
            $this->db->insert('at_def_libros', $data);  

            $data = array(
                'libros_data' => $meses=$x_value->meses_mes,
                'clientes_id' => $datos_clientes->clientes_id,
                'stripe_customer_id' => $datos_clientes->stripe_customer_id,
                'libros_tipo' => 'otros_stripe',
                'libros_precio1' => 0.00,
                'libros_precio2' => 0.00,
                'libros_precio3' => 0.00
            );
        
            $this->db->insert('at_def_libros', $data);  

            //print_r($arreglo_meses);

        }//fin del foreach

        //email al cliente
        
        $this->generar_documentos($arreglo_meses,$datos_clientes);
        
        
        $this->email_clientes($datos_clientes->clientes_email,$datos_clientes->stripe_customer_id);

        //imprimir documentos
        //https://wendy.log99.es/index.php/A_atlo_sys/imprimir_cliente/cus_DBCkjjLzQRAVUB
        
        
        $this->load->helper('url');

        $url = "https://wendy.log99.es/contratos/con_".$datos_clientes->stripe_customer_id.".html";
        
        redirect($url);

    }


    public function generar_documentos($arreglo_meses, $datos_clientes)
    {
        
        
        $valor = '<!doctype html>
        <html lang="es">
          <head>
            <title>CONTRATO DE PRESTACIÓN DE SERVICIOS (ATLO)</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <style>
            @media print {
                footer {page-break-after: always;}
            }
            </style>
          </head>
          <body onload="nobackbutton()">

          <script>

          function nobackbutton(){
            	
               window.location.hash="no-back-button";	
               window.location.hash="Again-No-back-button" //chrome
               window.onhashchange=function(){window.location.hash="no-back-button";}

               window.print();
            	
            }


          </script>


          

            
            <small>
            <div class="row">
                <div class="col-md-4">
                <a href="https://www.atlo.es/">
                <img src="https://www.atlo.es/L1.PNG">
                </a>
                <h1 class="">
                    <b>CONTRATO</b>
                </h1>
                <p class="">CAN VALERO ATLO BARBELL CLUB
                    <br>ATLO MALLORCA INTERBOX&nbsp;
                    <br>CARRER CAN VALERO 31, NAVE 8
                    <br>B57226433
                    <br>
                    <b>clientes@atlo.es</b>
                </p>
                </div>
                <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"> PROMOCIÓN APLICADA:&nbsp; </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <b>(EUR.-) MATRICULA: </b>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <b>(EUR.-)&nbsp;
                        PRIMERA CUOTA
                    </b>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                    <p class="p-1">Los pagos son mensuales. Las promociones tienen un carácter de 12 meses desde la fecha de firma de este documento. Las cuotas serán auto-renovable mes a mes, por dicho importe y siempre que el cliente no se haya saltado ninguna mensualidad, no haya cambiado de cuota o se haya acogido a otra promoción que no son acumulables en ningún caso.</p>
                    </div>
                </div>
                </div>
            </div>
    


            <div class="row">
                <div class="col-md-3">
                <h2 class="">CLIENTE '.$datos_clientes->clientes_antiguedad.'</h2>
                </div>
                <div class="col-md-9">
                <p class="lead">
                    <b>Nombre y Apellidos: </b>
                </p>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"> 
                    '.$datos_clientes->clientes_nombrereal.'
                    </li>
                </ul>
                </div>
            </div>

            <div class="row">
            <div class="col-md-12 py-2">
            <p class="lead">
                </p>
                <p class="">☑ Permito las comunicaciones y facturas a través de e-mail y acepto la creación y mantenimiento de una cuenta de Usuario en nuestro sistema de autogestión de reservas y de Servicios de Internet del Grupo Atlo.</p>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">CORREO ELECTRÓNICO:&nbsp;'.$datos_clientes->clientes_email.' </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">TOKEN DEL SISTEMA: '.$datos_clientes->clientes_id.' </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"> TOKEN STRIPE: '.$datos_clientes->stripe_customer_id.' </li>
                </ul>
                
            </div>
            </div>


            <div class="row">
                <div class="col-md-6 py-2">
                <p class="">☑ Acepto que mis datos personales se incorporen a los ficheros del grupo Atlo. Podrás verlos, modificados y borrarlos. Puedes ejercitar tus Derechos LOPD ante ATLO MALLORCA INTERBOX en CARRER CAN VALERO 31 o enviando un correo a clientes@atlo.es&nbsp;
                ⬛ Usamos tus datos para realizar las tareas administrativas y del día a día por lo que estos pueden ser compartidos en el caso que tengamos que externalizar dichas tareas ⬛ Serán de carácter público los Resultados que anotes en cualquier apartado del sistema informático y en la Lista de Reservas. ⬛ Si se da el caso, compartiremos tus datos con las fuerzas de seguridad del estado.&nbsp;⬛ POR FAVOR: No reveles tus token, contraseñas o datos que te comprometan a ti o al resto de clientes y personal del grupo Atlo como medida de seguridad.</p>
                <div class="alert alert-primary" role="alert">
                    <p class="mb-0">TODA ACTIVIDAD SE TIENE QUE REALIZAR EN LAS INSTALACIONES DEL GIMNASIO.&nbsp;NO NOS PODEMOS HACEMOS CARGO DE LAS LESIONES Y DAÑOS QUE PUEDAS TENER DURANTE TUS SESIONES DEPORTIVAS POR NO SEGUIR LAS PAUTAS O CONSEJOS DE TU ENTRENADOR. TE RECOMENDAMOS
                    CONTRATAR EL SEGURO FEDERATIVO DE LA AEC.</p>
                </div>
                </div>
                <div class="col-md-6">
                <p class="py-2">☑ Teléfono habilitado para grupos de mensajería, avisos y comunicaciones personales con el cliente:.&nbsp;</p>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"><span class="badge badge-pill badge-primary">+'.$datos_clientes->clientes_pre_wa.'</span>'.$datos_clientes->clientes_wa.'
                    
                    </li>
                </ul>
                <p class="">
                    <br>EN CASO DE EMERGENCIA AVISAR A:</p>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"> '.$datos_clientes->clientes_aa_nombre.' 📞 '.$datos_clientes->clientes_aa_telf.' </li>
                  
                </ul>
                <p class="">&nbsp;<small>
                    <br>Nuestros servicios Web usan cookies o similares que nos permiten tu identificación según los límites que marca la ley. NOS
                    RESERVAMOS EL DERECHO A CANCELAR DICHOS SERVICIOS EN CUALQUIER MOMENTO.</p></small>
                </div>
            </div>
            <div class="row">
          
                <div class="col-md-12"><hr>
                <p class="lead text-left">
                
                    <u>CUESTIONARIO MÉDICO:</u>
                    <i>Marca con una X para contestar afirmativamente.</i>
                </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                <p class="">Con FRECUENCIA consumo:
                    <br>
                </p>
                <div class="btn-group btn-group-vertical">
                    <a href="#" class="btn btn-outline-primary btn-block">Alcohol</a>
                    <a href="#" class="btn btn-outline-primary">Tabaco</a>
                    <a href="#" class="btn btn-outline-primary">Medicamentos incompatibles
                    <br>&nbsp;con la práctica deportiva.</a>
                </div>
                </div>
                <div class="col-md-3">
                <p class="">Padezco DOLOR estando en reposo o practicando una actividad física en…</p>
                <div class="btn-group btn-group-vertical">
                    <a href="#" class="btn btn-outline-primary">Hombros/Espalda</a>
                    <a href="#" class="btn btn-outline-primary">Rodillas/Tobillos/Cadera</a>
                    <a href="#" class="btn btn-outline-primary">Codos/Muñecas/Otros</a>
                </div>
                </div>
                <div class="col-md-3">
                <p>Tengo la tensión alta, asma, diabetes, problemas cariacos conocidos u otros factores de riesgo que pueda suponer un peligro para mi salud.</p>
                <div class="btn-group">
                    <a href="#" class="btn btn-outline-primary">Sí</a>
                    <a href="#" class="btn btn-outline-primary">No</a>
                    <a href="#" class="btn btn-outline-secondary text-secondary">&nbsp; ¿CIRUGÍA? S/N</a>
                </div>
                <p class="text-center">Indicar dónde:</p>
                </div>
                <div class="col-md-3">

                <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">¿Qué otros deportes practicas o has practicado?&nbsp; <br><br><br>¿Con qué frecuencia? <br><br> </li>
                </ul>




                </div>
            
            </div>
            <div class="row">
                <div class="col-md-7">
                <p class="">Fenómenos poco frecuentes como la rabdomiólisis están asociados a ejercicios intensos y de carácter muscular. Sus síntomas son dolor agudo, agujetas, inflamación y/o debilidad de extremidades y cambios en el color de la orina. Para prevenir
                    estas u otras complicaciones debes beber líquidos (que no sean alcohólicos o diuréticos) antes, durante y después del entrenamiento. Debes comunicar a tu entrenador y finalizar el ejercicio si sientes angustia, mareos, malestar, nauseas o
                    estás enfermo/con fiebre. Debes dejar pasar 24 horas antes de realizar otra sesión de ejercicio y dedicar 20 minutos a estirar adecuadamente.</p>
                </div>
                <div class="col-md-5">
                <p class="">✔Autorizo expresamente que Mi Imagen -que surge cuando ATLO MALLORCA INTERBOX te hace una foto, retrato o video- sean utilizados como publicación en redes sociales y/o en nuestra página web. Para ello, cuando es posible, se usa una licencia
                    CREATIVE COMMONS para su difusión que impide el lucro. Puedes solicitar por e-mail que se eliminen dichas imágenes si así lo consideras.</p>
                <img src="https://www.atlo.es/L2.PNG">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <small><p class="text-right">PALMA DE MALLORCA A FECHA '.date('Y-m-d H:i:s').'</p></small>
                <p class="lead">HE LEIDO EL CONTATO Y LO ACEPTO, CONFORME:
                <br>Fima del Cliente:  
                </p>
                
                </div>
            </div>

        </small><footer></footer>
        
        <p>Control manual de pagos</p>
        <p>Cliente: <strong>'.$datos_clientes->clientes_nombrereal.'</strong><p>';

        

        foreach($arreglo_meses as $x => $x_value){
            $valor = $valor. "<hr>";
            $valor = $valor. "<div class='row'>"; 
            $valor = $valor. '<div class="col-md-1">';
            $valor = $valor. "<h5>Mes: ".$x_value."</h5>";
            $valor = $valor. "</div>";

            //$cosa = $this->desglose_libro($x_value, $datos_clientes->stripe_customer_id);

            $query = $this->db->query("
            SELECT libros_id, libros_tipo FROM `at_def_libros` WHERE libros_tipo LIKE '%MONED%' AND `stripe_customer_id` = '$datos_clientes->stripe_customer_id' AND `libros_data` = '$x_value' AND `libros_cerrado` = 'NO';");

        

                foreach ($query->result() as $row)
                {
                    $valor = $valor. '
                        
                        <div class="col-md-3"><small>
                        <div class="list-group">
                            
                            <a  class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100">
                                <small>Apunte:&nbsp;'.$row->libros_id.' (<small>'.$row->libros_tipo.'</small>)
                            </small></div>
                            <div class="d-flex w-100 justify-content-between">
                            </div>
                            EUROS PAGADOS:<br><br>
                            </a>
                        </div></small>
                        </div>
                        
                        ';
                }

            //$valor = $valor.$cosa; 

            $valor = $valor. '<div class="col-md-2">TOTAL</div>';
            $valor = $valor. "<br>";
            $valor = $valor. "</div>";

        }
           
        $valor = $valor.  '</body>
        </html>' ; 

        //echo $valor; 

        $this->load->helper('file');
        write_file('contratos/con_'.$datos_clientes->stripe_customer_id.'.html', $valor);

        $usuario1 = $datos_clientes->stripe_customer_id;
        $this -> actualizar_usuario($usuario1);

        //print_r($datos_clientes);
        //print_r($arreglo_meses);

    }


    public function actualizar_usuario($usuario){

        //UPDATE `at_def_clientes` SET `clientes_autodate` = '2018-07-15' WHERE `at_def_clientes`.`clientes_orden` = 1;


        $this->load->database();
    
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d H:i:s');  


        $data = array(
            'clientes_autodate' => $fecha
        );
        
        $this->db->where('stripe_customer_id', $usuario);
        $this->db->update('at_def_clientes', $data);


    }

    public function desglose_libro($mes, $customer)
    {

        //SELECT libros_id, libros_tipo FROM `at_def_libros` WHERE libros_tipo LIKE '%MONEDA%' AND `stripe_customer_id` = '' AND `libros_data` = '';


        $query = $this->db->query("
        SELECT libros_id, libros_tipo FROM `at_def_libros` WHERE libros_tipo LIKE '%MONED%' AND `stripe_customer_id` = '$customer' AND `libros_data` = '$mes' AND `libros_cerrado` = 'NO';
        
        
        ");

        

        foreach ($query->result() as $row)
        {
            echo '
                
                <div class="col-md-3"><small>
                  <div class="list-group">
                    
                    <a  class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100">
                        <small>Apunte:&nbsp;'.$row->libros_id.' (<small>'.$row->libros_tipo.'</small>)
                      </small></div>
                      <div class="d-flex w-100 justify-content-between">
                      </div>
                      EUROS PAGADOS:<br><br>
                    </a>
                  </div></small>
                </div>
                
                ';
          
                
              
        }

      

     

    }

    public function email_clientes($email, $cliente)
    
    {


        //echo 

        $this->load->library('email');

        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot)');
        $this->email->to($email);
        $this->email->bcc('strongestpalma@gmail.com');

        $this->email->subject('Nuevo contrato Cliente');


        $this->email->message('
        <html>
        <body>
            <h3>Hola</h3>
            <p>Soy Wendy, el bot de contratación de Atlo.</p>
            <p>En los archivos adjuntos encontrarás los datos de tu nuevo contrato.</p>
            <br>
            <p>Saludos, ~Wendy.</p>

        <body>
        </html>       
        ');

        $this->email->attach('https://wendy.log99.es/contratos/con_'.$cliente.'.html');
        $this->email->attach('https://wendy.log99.es/contratos/info.pdf');

        $this->email->send();




    }





}