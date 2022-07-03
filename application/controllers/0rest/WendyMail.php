<?php

//clausula de protección {{ obligatoria }} 
//no hay cierre de php
// clase 1
//http://wendy.log99.es/index.php/WendyMail

defined('BASEPATH') OR exit('No direct script access allowed');


class WendyMail extends CI_Controller {

        public function timezone()
        {
          return date_default_timezone_set('Europe/Madrid');
        }

        public function Paypal615890787($paypalmode='')

        {

                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                mysql_query("SET NAMES utf8");
                //Change these with your information

                //$conexion = mysqli_connect("localhost", "loges_root" , "Ladrillo69");
        
                $paypalmode = 'sandbox'; //Sandbox for testing or empty ''
                $dbusername = 'loges_root'; //db username
                $dbpassword = 'Ladrillo69'; //db password
                $dbhost     = 'localhost'; //db host
                $dbname     = 'loges_hu'; //db name

                if($_POST)
                {
                        if($paypalmode=='sandbox')
                        {
                        $paypalmode     =   '.sandbox';
                        }
                        $req = 'cmd=' . urlencode('_notify-validate');
                        foreach ($_POST as $key => $value) {
                        $value = urlencode(stripslashes($value));
                        $req .= "&$key=$value";
                        }
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.sandbox.paypal.com'));
                        $res = curl_exec($ch);
                        curl_close($ch);

                        if (strcmp ($res, "VERIFIED") == 0)
                        {
                        $transaction_id = $_POST['txn_id'];
                        $payerid = $_POST['payer_id'];
                        $firstname = $_POST['first_name'];
                        $lastname = $_POST['last_name'];
                        $payeremail = $_POST['payer_email'];
                        $paymentdate = $_POST['payment_date'];
                        $paymentstatus = $_POST['payment_status'];
                        $mdate= date('Y-m-d h:i:s',strtotime($paymentdate));
                                        $buyer_additional_information = $_POST['buyer_additional_information'];
                        
                                        $custom = $_POST['custom'];
                                        $item_name = $_POST['item_name'];
                                        $item_number = $_POST['item_number'];
                                        $mc_gross= $_POST['mc_gross'];
                                        $mc_currency= $_POST['mc_currency'];
                                        $memo = $_POST['memo']; 
                                        $contact_phone = $_POST['contact_phone']; 
                                        
                                        $otherstuff = json_encode($_POST);

                        $conn = mysql_connect($dbhost,$dbusername,$dbpassword);
                        if (!$conn)
                        {
                        die('Could not connect: ' . mysql_error());
                        }

                        mysql_select_db($dbname, $conn);

                        // insert in our IPN record table
                        $query = "INSERT INTO ibn_table
                        (itransaction_id,ipayerid,iname,iemail,itransaction_date, ipaymentstatus,ieverything_else)
                        VALUES
                        ('$transaction_id','$payerid','$firstname $lastname','$payeremail $custom $item_number $item_name ','$mdate', '$mc_gross $mc_currency $paymentstatus','$otherstuff')";

                        if(!mysql_query($query))
                        {
                                //mysql error..!
                                echo "eroor1";
                        }
                                        
                                        
                                        $query2 = "
                                        INSERT INTO  `loges_hu`.`sys_shop` (
                                                                `shop_id` ,
                                                                `shop_data` ,
                                                                `sys_user` ,
                                                                `sys_talla` ,
                                                                `sys_modelo` ,
                                                                `sys_modelo2` ,
                                                                `sys_estado`
                                        )
                                        VALUES (
                                        NULL , 
                                        CURRENT_TIMESTAMP ,  '$payeremail',  '',  '',  '$paymentstatus $mc_gross $mc_currency $custom $item_number $item_name', '$otherstuff'
                                        )";

                                        
                        if(!mysql_query($query2))
                        {
                                //mysql error..!
                        }
                                        
                        mysql_close($conn);

                        }ECHO "OK";


                                        #Fecha <actual:>
                                
                                        date_default_timezone_set("Europe/Madrid");
                                        $current_timestamp = date("Y-m-d H:i:s");
        
                                        #Todo: saber la próxima celda vacía que vamos a editar. 
        
        
                                        $this->load->database();
                                        $query = $this->db->query('SELECT * FROM `at_comovas` WHERE `cv_autodate` IS NULL ORDER BY `at_comovas`.`cv_id` ASC LIMIT 1');
        
                                        $row = $query->row();
        
                                        if (isset($row))
                                        {
                                                $entrada_id = $row->cv_id;
                                                $entrada_tokken1 = $row->cad1;
                                                $entrada_tokken2 = $row->cad2;
                        
                                        }
        
                                        #Todo: insertar en la tabla mágica. 
        
                                        $data = array(
              
                                        'cv_autodate' => $current_timestamp,
                                        'cv_producto' => $item_number, 
                                        'cv_detalles' => $item_name.' '.$mc_gross.' '.$mc_currency,
                                        'cv_dato1' => $option_selection1,
                                        'cv_dato2' => $option_selection2.' '.$payerid,
                                        'cv_dato3' => $option_selection3.' '.$payeremail,
                                        'cv_referencias' => $transaction_id
        
                                        );
                                        
                                        $where = "cv_id =".$entrada_id." AND cv_cad2 = ".$entrada_tokken2 ;
        
                                        $str = $this->db->update_string('at_comovas', $data, $where);
                                        $this->db->query($str);
        
                                        #ultimo paso: 
        
                                        #$query = $this->db->query("YOUR QUERY");
        
                                        #foreach ($query->result() as $row)
                                        #        {
                                        #                echo $row->title;
                                        #                echo $row->name;
                                        #                echo $row->body;
                                        #        }
        
        
        #ESCRIBIR EL CORREO
        
                        $this->timezone(); 
        
                        $imagen = file_get_contents(
                        'https://chart.googleapis.com/chart?cht=qr&chl=https://wendy.log99.es/index.php/v/'.$entrada_id.'/'.$entrada_tokken1.'/'.$entrada_tokken2.'/'.$transaction_id.'&chs=285x285&chld=L|0'
                        );
                        file_put_contents('../imagemaker/temp/entrada'.$transaction_id.'.png', $imagen);
                        echo $namehtml = urlencode($name);      
        
                        $this->load->library('email');
                                          
                        $this->email->clear();
                        $this->email->to(array($correo, 'catxo99+copia@gmail.com'));
                        $this->email->from('cbpromotions@comovas.es', 'CB Promotions', 'sergio@mallorcainterbox.com');
                        $this->email->subject('Aquí tienes tu entrada, '.$name);
                        $this->email->message('
        
                        ¡Hola '.$firstname.' '.$lastname.'!<br> <br> 
                        Soy Wendy, el bot de Casa Alto<br><br>
                            
                        ¿Cómo vas? ;)<br><br>
        
                        PayPal informa que has hecho un pedido y aquí te mando el justificante:  <br>
                        ----------V----------<br>
                        PayPal informs me you have placed an order and this is your receipt: <br> <br>
        
                        ---------------------<br>
                        Recibo núm.: '.$transaction_id.' <br>
                        Producto: '.$item_name.'<br>
                        Modalidad: '.$option_selection1.'<br>
                        Precio:  '.$mc_gross.$mc_currency.' <br>
                        Estado del pago: '.$paymentstatus.'<br>
                        ---------------------<br><br>
                                                
                        ** Importante/Important ** <br><br>
                            
                        Consulte el extracto exacto y al detalle de los productos en mismo correo electrónico adicional de PayPal. // See the detailed information in the PayPal additional email. <br> br>
                                        
                        If necessary: Para cualquier duda se tiene que poner en contacto con info@cbpromotions.net<br>
        
                        For technical support: Para soporte técnico escriba a sergio@mallorcainterbox.com<br><br>
        
                        DATOS ADICIONALES: <br>
                        ----------V----------<br>
                        MORE:<br><br>
        
                        ---------------------<br>
                        Nombre: '.$option_selection2.'<br>
                        WhatsApp: '.$option_selection3.'<br><br>
        
                        INFO: <br>
                        ----------V----------<br>
                        INFO:<br><br>
        
                        Información en Español <br>
                        ----------V----------<br>
                        Información en Inglés. <br><br>
        
                        
                        See you very soon. // Salud y fuerza. //  To your health and strength!<br><br>
                        -- ωeηdi *!<br><br>
                        ComoVas.es<br>
                        Casa Alto<br><br>
        
                        ');
                      
                        #$this->email->attach('filename.pdf', 'attachment', 'report.pdf');
                        $this->email->attach('https://wendy.comovas.es/imagemaker/imagemaker_create.php?width=642&height=642&color=FFFFFF&object[0]=image|642;642;1|FF8888;FFFFFF|center;center|0;0;0;0|0|100|ticket_general.png&object[1]=text:impact|60;321;1|;000001|left;center|10;0;40;0|0|100|BRC/ABFK%20&object[2]=text:courier|20;0;1|;000001|left;top|15;0;230;0|0|100|1000000001%0A-------%0A2%20PAX%0A%3D%3D%3D%3D%3D%3D%3D%0Ainfodsfdsf%0A@afdsfd.com&object[3]=text:futura|9;0;1|;FFFFFF|center;top|0;0;32;0|0|100|11111-11111111-111111111&object[4]=image|285;285;1|FF8888;FFFFFF|right;bottom|0;0;0;0|0|100|temp/foto3.png', 'imagen'.$name.'111111.jpg');
                        $this->email->send();
                        
        



                
        }//IF POST 
        }//FUNCION

        public function prueba($correo='info@cbpromotions.net')
        {
                
                $this->timezone(); 
                
                $name="Persona que compra";
                $firstname = $name;
                $lastname = '1_Apellido2';


                $imagen = file_get_contents('https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fwendy.comovas.es%2Findex.php%2Floquesea%2F12321333333342432%2F12321&chs=180x180&choe=UTF-8&chld=L|2');
                file_put_contents('../imagemaker/temp/foto3.png', $imagen);
                echo $namehtml = urlencode($name);      


                $this->load->library('email');
                  
                
                $this->email->clear();
                $this->email->to(array($correo, 'catxo99+copia@gmail.com'));
                $this->email->from('cbpromotions@comovas.es', 'CB Promotions', 'sergio@mallorcainterbox.com');
                $this->email->subject('Aquí tienes tu entrada, '.$name);
                $this->email->message('

                ¡Hola '.$firstname.' '.$lastname.'!<br> <br> 
                Soy Wendy, el bot de Casa Alto<br><br>
                    
                ¿Cómo vas? ;)<br><br>

		PayPal informa que has hecho un pedido y aquí te mando el justificante:  <br>
                ----------V----------<br>
                PayPal informs me you have placed an order and this is your receipt: <br> <br>

                ---------------------<br>
		Recibo núm.: $transaction_id <br>
                Producto: $item_name<br>
                Modalidad: $option_selection1<br>
		Precio:  $mc_gross $mc_currency <br>
		Estado del pago: $paymentstatus<br>
		---------------------<br><br>
					
                ** Importante ** <br><br>
                    
                Consulte el extracto exacto y al detalle de los productos en mismo correo electrónico adicional de PayPal.<br>
					
                Para cualquier duda se tiene que poner en contacto con info@cbpromotions.net<br>

                Para soporte técnico escriba a sergio@mallorcainterbox.com<br><br>

                DATOS ADICIONALES: <br>
                ----------V----------<br>
                MORE:<br><br>

                ---------------------<br>
                Nombre: $option_selection2<br>
                WhatsApp: $option_selection3<br><br>

                INFO: <br>
                ----------V----------<br>
                INFO:<br><br>

                Información en Español <br>
                ----------V----------<br>
                Información en Inglés. <br><br>

                
                See you very soon. // Salud y fuerza. //  To your health and strength!<br><br>
                -- ωeηdi *!<br><br>
                ComoVas.es<br>
		Casa Alto<br><br>


                ');
              
                #$this->email->attach('filename.pdf', 'attachment', 'report.pdf');
                $this->email->attach('https://wendy.comovas.es/imagemaker/imagemaker_create.php?width=642&height=642&color=FFFFFF&object[0]=image|642;642;1|FF8888;FFFFFF|center;center|0;0;0;0|0|100|ticket_general.png&object[1]=text:impact|60;321;1|;000001|left;center|10;0;40;0|0|100|BRC/ABFK%20&object[2]=text:courier|20;0;1|;000001|left;top|15;0;230;0|0|100|1000000001%0A-------%0A2%20PAX%0A%3D%3D%3D%3D%3D%3D%3D%0Ainfodsfdsf%0A@afdsfd.com&object[3]=text:futura|9;0;1|;FFFFFF|center;top|0;0;32;0|0|100|11111-11111111-111111111&object[4]=image|285;285;1|FF8888;FFFFFF|right;bottom|0;0;0;0|0|100|temp/foto3.png', 'imagen'.$name.'111111.jpg');
                $this->email->send();
                
        }

}