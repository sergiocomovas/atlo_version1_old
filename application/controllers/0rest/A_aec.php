<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class A_aec extends CI_Controller {

    public function index( )
    {
        
        echo 'Hola Mundo';

    }


    public function confirmar($id=1)
    {


        //https://wendy.log99.es/index.php/A_aec/confirmar/1
        
        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_def_aec` WHERE `aec_id` = $id" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        echo json_encode($row);
    

    }

    public function loquesea()
    {
        $this->load->helper('form');
        $attributes = "";
        form_input('name', 'value', $attributes);
        

    }

    public function modificar_datos()
    {

        //https://wendy.log99.es/index.php/A_aec/modificar_datos

        $this->load->database();
    
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        //recibir datos
        $id = $_POST['aec_id'];	
        $tokken = $_POST['aec_tokken'];
        $enviado = $_POST['aec_enviado'];
        //$autodate = $_POST['aec_autodate'];	
        $nombre = $_POST['aec_nombre'];	
        $club = $_POST['aec_club'];	
        $nif = $_POST['aec_nif'];	
        $direccion = $_POST['aec_direccion'];	
        $cp = $_POST['aec_cp'];
        $ciudad = $_POST['aec_ciudad'];
        $provincia = $_POST['aec_provinci'];	
        $tecf = $_POST['aec_tecf'];
        $email = $_POST['aec_email'];	
        $deporte = $_POST['aec_deporte'];	
        $tipo = $_POST['aec_tipo'];
        $seguro = $_POST['aec_seguro'];
        $pago = $_POST['aec_pago'];
        $detalles = $_POST['aec_detalles'];	
        //$fecha = $_POST['aec_fecha'];
        $firma = $_POST['casilla'];

        //update

        $data = array(
                'aec_id' => $id,
                'aec_autodate' => $fecha,	
                'aec_nombre' => $nombre,	
                'aec_club' => $club,	
                'aec_nif' => $nif,	
                'aec_direccion' => $direccion,	
                'aec_cp' => $cp,	
                'aec_ciudad' => $ciudad,	
                'aec_provinci' => $provincia,	
                'aec_tecf' => $tecf,	
                'aec_email' => $email,	
                'aec_deporte' => $deporte,	
                'aec_tipo' => $tipo,	
                'aec_seguro' => $seguro,	
                'aec_pago' => $pago,	
                'aec_detalles' => $detalles,	
                'aec_fecha' => $fecha,	
                'aec_firma' => $firma,
                'aec_tokken' => $tokken,
                'aec_enviado' => 'SI'
                
            );
            
            $this->db->where('aec_id', $id);
            $this->db->update('at_def_aec', $data);


        $this->generar_documento($data);

        $this->enviar_email($data);


    }

    public function generar_documento($data)
    {

        $valor='

        <!doctype html>
        <html lang="es">
          <head>
            <title>AEC</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
          </head>
          <body>
        
          <div class="container-fluid">
              <h4 class="text-right">Ficha Federativa N:___________________</h4>
        
              <p class="text-center">
                <img src="data:image/png;base64,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" class="img-fluid" alt="">
              </p>
        
              <h4 class="text-center">ISLAS BALEARES - ILLES BALEARES</h4>
        
              <hr>
        
              <div class="row">
                  
                <div class="col">
        
                       <h4>
                            Nombre:
                            <pre>'.$data['aec_nombre'].'</pre>
                        </h4>
            
                </div>
        
                <div class="col">
        
                        <h4>
                             DNI/NIE:
                             <pre>'.$data['aec_nif'].'</pre>
                         </h4>
             
                 </div>
         
        
                <div class="col">
        
                        <h4>
                                Club:
                                <pre>'.$data['aec_club'].'</pre>
                        </h4>
                    
                </div>
        
        
              </div><!--row-->
        
              <hr>
        
              <div class="row">
                  
                <div class="col">
        
                       <h4>
                            Telefono:
                            <pre>'.$data['aec_tecf'].'</pre>
                        </h4>
            
                        <h4>
                             Correo Electrónico:
                             <pre>'.$data['aec_email'].'
                             </pre>
                         </h4>
             
                 </div>
         
        
                <div class="col">
        
                        <h4>
                                Dirección
                                <pre>'.$data['aec_direccion'].'</pre>
                                <pre>'.$data['aec_cp'].' '.$data['aec_ciudad'].'</pre>
                                <pre>'.$data['aec_provinci'].'</pre>
        
                        </h4>
                    
                </div>
        
        
              </div><!--row-->
              <hr>
        
              <h3>
                Deporte:
                <pre class="text-center">'.$data['aec_deporte'].'</pre>
              </h3>
        
              <hr>
        
              <div class="row">
                  
                <div class="col">
        
                       <h4>
                            Tipo de prestación:
                            <pre>'.$data['aec_seguro'].'</pre>
                        </h4>
            
                </div>
        
                <div class="col">
        
                        <h4>
                            Categoría:
                             <pre>SEGURO '.$data['aec_tipo'].'</pre>
                         </h4>
             
                 </div>
         
        
                <div class="col">
        
                        <h4>
                                Pago:
                                <pre>'.$data['aec_pago'].' -<br>- '
                                .$data['aec_detalles'].'</pre>
                        </h4>
                    
                </div>
        
        
              </div><!--row-->
        
        
              <hr>
              PALMA DE MALLORCA A '.$data['aec_fecha'].', <br>
              Firma del autorizada: <br>
        
              <img src="'.$data['aec_firma'].'" class="img-fluid" alt="">
        
        
        
        
          </div>
              
         
          </body>
        </html>

        
        ';

        $this->load->helper('file');
        write_file('contratos_aec/con_'.$data['aec_id'].'.html', $valor);

    } 

    public function enviar_email($array)
    {
        

        $email1=$array['aec_email'];

        $this->load->library('email');

        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot)');
        $this->email->to($email1);
        $this->email->cc('afiliacion@aecfit.es');
        $this->email->bcc('strongestpalma@gmail.com');

        $this->email->subject('Datos enviados a la AEC.');

        $this->email->message('
        <html>
        <body>
            <h3>Hola</h3>
            

            <p>Soy Wendy, el bot de servicio del grupo Atlo.</p>
            <p>Te informo que acabo de enviar tu ficha de federado a la AEC.</p>
            <p>En pocos días la AEC se pondrá en contacto (vía e-mail a '.$email1.') para informarte del estado del proceso.</p>


            Nombre del solicitante: '.$array['aec_nombre'].' <br>
            en fecha: '.$array['aec_fecha'].'<br>

            <h4>ADJUNTAMOS SU SOLICITUD EN LOS ARCHIVOS ADJUNTOS</h4>

            <pre>Prestador del servicio:

            ASOCIACIÓN ESPAÑOLA DE CROSS FUNCTIONAL TRAINING. Su CIF es: G19559004. Su domicilio social está en: PLAZA LOS PRADOS Nª10 AT 4º 18100 Armilla. Para comunicarse con nosotros, ponemos a su disposición diferentes medios de contacto que detallamos a continuación. 
      
            Teléfno: 676056110 
            Email: info@aecfit.es 
      
            SEGURO AEC.
      
            No esta solo pensado para competidores, todos asumimos riesgos cuando entrenamos, y estar cubiertos antes ante adversidades, lesiones y/o accidentes que puedan surgir durante los entrenamientos nos porta una seguridad extra para la asistencia que necesitemos.
      
            Atleta Afiliado a la AEC: 80€/año. Incluye:

            Seguro deportivo con cobertura medica “ilimitada” (las exigidas legalmente para toda federación deportiva) *(más información)

            Descuentos en la inscripción de competiciones individuales organizadas por la AEC.

            Descuentos en cursos y talleres organizados por la AEC. Las condicione mejorarán a medida que se unan colaboradores a la AEC
      
            *PRESTACIONES Y SERVICIOS ASISTENCIALES OFERTADOS:
            
            1. Asistencia Médico Quirúrgica y Sanatorial en accidentes, ilimitada, y con un límite temporal de hasta dieciocho meses desde la fecha del accidente. Las pruebas de diagnóstico y contraste, TACs, Resonancias Magnéticas, …, se realizarán siempre a criterio médico, y tras autorización de la Entidad Aseguradora, salvo en casos de extrema urgencia.

            2. Asistencia farmacéutica en régimen hospitalario, sin límite de gastos, y con un límite temporal de hasta dieciocho meses desde la fecha del accidente.

            3. Asistencia en régimen hospitalario de los gastos de prótesis y material de osteosíntesis, en su totalidad, y con un límite temporal de dieciocho meses desde la fecha del accidente.

            4. Los gastos originados por rehabilitación durante el período de dieciocho meses desde la fecha del accidente, excepto el transporte para la misma.

            5. Asistencia médico quirúrgica y sanitaria en accidentes ocurridos en el extranjero, hasta un límite por todos los conceptos de 6.010,12 € y con un límite temporal de hasta 18 meses desde la fecha del accidente. Esta prestación es compatible con las indemnizaciones por pérdidas anatómicas o funcionales, motivadas por accidente deportivo, que se concedan al finalizar el tratamiento.

            6. Indemnizaciones por pérdidas anatómicas o funcionales motivadas por accidente deportivo según baremo ANEXO, siendo el importe máximo a pagar para los grandes inválidos de 12.020,24 €.

            7. Capital de fallecimiento, cuando éste se produzca como consecuencia de accidente en la práctica deportiva, por un importe de 6.010,12 €.

            8. Capital de fallecimiento, cuando éste se produzca en la práctica deportiva, pero sin causa directa del mismo, por un importe de 1.803,04 €.

            9. Gastos originados por la compra de material ortopédico para la curación de un accidente deportivo, por un importe del 70 % del precio de venta al público del mencionado material ortopédico. La compañía facilitará al afectado una certificación, indicando en ella el nombre de la ortopedia correspondiente, para que sólo deba de efectuar el desembolso del 30 % no cubierto, siendo el 70 % restante facturado directamente a La compañía.

            10. Gastos originados en odonto-estomatología, por lesiones en la boca motivadas por accidente deportivo. Estos gastos serán cubiertos de forma ilimitada durante 18 meses desde la fecha del accidente cuando se correspondan a honorarios médicos, y hasta 240,40 € en concepto de material, prótesis, ….

            11. Gastos originados por traslado o evacuación del lesionado desde el lugar del accidente hasta su ingreso definitivo en los hospitales concertados por la póliza del seguro.

            12. Asistencia médica en los centros o facultativos concertados, establecidos en el cuadro asistencial antes señalado.
            
            13. Las lesiones o dolencias deportivas, no derivadas de accidente, no quedarán cubiertas por el presente seguro. No obstante, los servicios médico asistenciales procederán a una primera visita de urgencia del afectado para efectuar un primer diagnóstico para el posterior control y seguimiento por parte del propio afectado.

            14. El ámbito de protección de los riesgos cubiertos se corresponderá con los derivados de la práctica deportiva asegurada.
            
            15. En ningún caso quedarán cubiertas por el presente seguro las secuelas o recidivas de lesiones y dolencias, agudas o por sobrecarga, con origen anterior a la fecha de alta del asegurado en la póliza, siendo todos los gastos derivados de la misma a cargo del asegurado.
            
            16. Incluimos LANT( cubre accidentes y lesiones deportivas) PROCEDIMIENTO ASISTENCIAL Una vez que el accidentado sea atendido en alguno de los Centros Asistenciales establecidos en el cuadro médico, previa presentación del Volante de Asistencia correspondiente, el médico actuante lo remitirá a un especialista en el caso de que las características de las lesiones hagan necesaria su participación (oftalmología, neurología, odontología, ….).

            Consulte en la web de la Federeación todos los detalles, actualizaciones y los cuadros médicos actualizados.

            CUADRO MÉDICO BALEARES:
            https://aecfit.es/wp-content/uploads/2018/03/10-Cuadro_Baleares_1708.pdf
            </pre>


            <p>E-Mail para soporte técnico humano: sergio@mallorcainterbox.com</p>
            
            <p>Gracias, Wendy</p>

        <body>
        
        ');

            

        $this->email->attach('https://wendy.log99.es/contratos_aec/con_'.$array['aec_id'].'.html');
        $this->email->attach('http://aecfit.es/wp-content/uploads/2018/03/10-Cuadro_Baleares_1708.pdf');


        $this->email->send();
        
        
        
     


    }




}
?>