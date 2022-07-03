<?php

//clausula de protección {{ obligatoria }} 
//no hay cierre de php
// clase 1
//http://wendy.log99.es/index.php/atlo_redes/

defined('BASEPATH') OR exit('No direct script access allowed');


class Atlo extends CI_Controller {

        public function index( )
        {
                
                echo 'Hello Atlo Redes';
        }

        public function redes_datos($club, $origen='', $tipo='', $limite=3)
        {

            $this->load->model('Redes_model');
    
            $var = $this->Redes_model->get_Redes($club, $origen, $tipo, $limite);
    
            #echo json_encode ($var, JSON_UNESCAPED_UNICODE); 
            $cadena = str_replace ( '\/' , '/' , json_encode ($var, JSON_UNESCAPED_UNICODE) );
            echo $cadena;
            
        }

        public function red($club,$red,$tipo){

        # Lee el json enviado al webhook y lo guarda en la base de datos 'at_redes'. 

                # Get JSON as a string
                $json_str = file_get_contents('php://input');

                # Get as an object
                $flecha = json_decode($json_str);

                date_default_timezone_set('Europe/Berlin');         
                $fecha = date('Y-m-d H:i:s');  

                $this->load->database();
                $data = array(
                        're_id' => '',
                        're_autodate' => $fecha,
                        're_atlo' => $club,
                        're_origen' => $red,
                        're_tipo' => $tipo,
                        're_text' => $flecha->re_text,
                        're_url' => $flecha->re_url,
                        're_medio_url' => $flecha->re_medio_url,
                        're_mini_url' => $flecha->re_mini_url,
                        're_codigo' => $flecha->re_codigo,
                        're_comentarios' => $flecha->re_comentarios,
                        're_hash' => $flecha->re_hash
                );

                $this->db->insert('at_redes', $data);

        }

        

        public function tumblr_no ( $a1, $a2, $Caption, $PhotoFullUrl, $PhotoThumbUrl, $Url, $Tags, $Time  )
        {
                //re_id --> vacio
                //re_autodate --> fecha
                //re_atlo --> constante = ABC
                //re_origen --> constante = TUMBL
                //re_destino --> constante = FOTO-TUMBL
                //re_text --> caption
                //re_url -->  url
                //re_medio_url --> photofullurl
                //re_mini_url --> photo thumblr
                //re_codigo --> nada
                //re_comentarios --> time
                //re_hash --> tags


                //INSERT INTO `at_redes` (`re_id`, `re_timestamp`, `re_atlo`, `re_origen`, `re_destino`, `re_text`, `re_url`, `re_medio_url`, `re_mini_url`, `re_codigo`, `re_comentarios`, `re_hash`) VALUES (NULL, '2018-05-15 00:00:00', 'ATLO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                //{{Caption}}/ {{PhotoFullUrl}}/ {{PhotoThumbUrl}}/ {{Url}}/ {{Tags}}/ {{Time}}

                //Caption/FullUrl/PhotoTumb/Url/Tags/Time/
                
                date_default_timezone_set('Europe/Berlin');         
                $fecha = date('Y-m-d H:i:s');  
                $this->load->database();
               

                //re_id --> vacio
                //re_autodate --> fecha
                //re_atlo --> constante = ABC
                //re_origen --> constante = TUMBL
                //re_destino --> constante = FOTO-TUMBL
                //re_text --> caption
                //re_url -->  url
                //re_medio_url --> photofullurl
                //re_mini_url --> photo thumblr
                //re_codigo --> nada
                //re_comentarios --> time
                //re_hash --> tags


                $data = array(
                        're_id' => '',
                        're_autodate' => $fecha,
                        're_atlo' => 'ABC',
                        're_origen' => $a1,
                        're_tipo' => $a2,
                        're_text' => $Caption,
                        're_url' => $Url,
                        're_medio_url' => $PhotoFullUrl,
                        're_mini_url' => $PhotoThumbUrl,
                        're_codigo' => '',
                        're_comentarios' => 'Fecha: '.$Time,
                        're_hash' => $Tags

                );
                
                $this->db->insert('at_redes', $data);
                // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')

        }

        public function registro_provisional ( )

        {

                //echo trim($a1);

                $a1 = trim($_POST["email"]);

                $rand = rand(1111111111111,
                          9999999999999);

                date_default_timezone_set('Europe/Berlin');         
                $fecha = date('Y-m-d H:i:s');  
                
                $this->load->database();

                $data = array(
                        'rp_email' => $a1,
                        'rp_rand' => $rand,
                        'rp_autodate' => $fecha
                );
                
                $this->db->insert('at_rprovisional', $data);  // Produces: INSERT INTO mytable (title, name, date) VALUES ('{$title}', '{$name}', '{$date}')

                $this->load->library('email');

                $this->email->from('wendy@comovas.es', 'Wendy (Atlo)');
                $this->email->to($a1);
                $this->email->bcc('barbellclub@atlo.es');
                

                $this->email->subject('CONFIRMA TU DIRECCIÓN DE CORREO');

                $texto = "

                        Hola, <br><br>

                        Soy Wendy, el bot de la Casa Atlo, y necesito saber si esta dirección de correo es válida.<br><br>

                        AHORA...<br>
                        Pulsa sobre este enlace para confirmar:<br><br><a href='https://wendy.log99.es/index.php/Atlo/registro_confirmados/".$rand."'>https://wendy.log99.es/index.php/Atlo/registro_confirmados/".$rand."</a>
                        <br>-------------------------------------

                        <br><br>Ten en cuenta lo siguiente:

                        <br>- Recibirás, dentro de unos días, una invitación para el evento de inaguración del club con el código para participar en el Sorteo Picsil.

                        <br>- Tu correo electrónico será añadido en la agenda de contactos de la Casa Atlo.   
                        
                        <br>- Nuestro Staff se podrá poner en contacto contigo para informarte de ofertas, promociones y eventos del Atlo Barbell Club.

                        <br>- Puedes pasar de nosotros en cualquier momento <a href='mailto:info@mallorcainterbox.com?subject=CANCELAR_EMAIL'> pulsando aquí</a>

                        <br>Y eso es todo.<br><br>

                        See you very soon. // Salud y fuerza. //  To your health and strength!<br><br>
                        -- ωeηdi *!<br><br>
                        Atlo Barbell Club | Mallorca Interbox | Comovas.es
                        <br>Casa Alto<br><br>
                        ";


                $this->email->message($texto);

                $this->email->send();


                $this->load->helper('url');
                $redirect = 'http://www.atlo.es/barbellclub/tarifaclub/sitio_seguro.php?MENSAJE=CONFIRMA_TU_DIRECCI%C3%93N_DE_EMAIL_'.$a1; 
                redirect($redirect);

        }     

        public function registro_confirmados ( $rand )

        {

                //1382871286736
                //https://wendy.log99.es/index.php/Atlo/registro_confirmados/1382871286736

                $this->load->database();

                $query = $this->db->query("
                
                SELECT * FROM `at_rprovisional` WHERE `rp_rand` LIKE '".$rand."'
                
                ");

                $row = $query->row();

                echo $a1 = $row->rp_email;

                date_default_timezone_set('Europe/Berlin');         
                $fecha = date('Y-m-d H:i:s');  

                $data = array(
                        'rc_email' => $a1,
                        'rc_rand' => $rand,
                        'rc_autodate' => $fecha,
                        'rc_extra1'=> 'ABC_INV',
                        'rc_extra2' => 'NO'
                );
                
                $this->db->insert('at_rconfirmados', $data);  // Produces: INSERT INTO mytable (title, name, date) VALUES ('{$title}', '{$name}', '{$date}')

                $this->load->helper('url');
                $redirect = 'http://www.atlo.es/barbellclub/tarifaclub/sitio_seguro.php?MENSAJE=TU_DIRECCI%C3%93N_YA_HA_SIDO_CONFIRMADA_'.$a1; 
                redirect($redirect);
                        


        }



}
