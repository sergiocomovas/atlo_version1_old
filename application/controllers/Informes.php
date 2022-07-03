<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informes extends CI_Controller {


    public function index(){
        
    }

    public function recibir_informe(){

//https://v1.atlo.es/index.php/informes/recibir_informe
    echo "<code>Enviando...</code>";

    $u1 =  "Usuario: ".$this->input->get('date_invent1' ).
    " (DIA-".$this->input->get('date_invent2' ).')<hr>'.
    "Fecha (mm-dd-yy): ".$this->input->get('date_invent3' ).'<hr>'.
    "Id. de la Clase: ".$this->input->get('date_invent4' ).'<hr>'.
    "- Sensación subjetiva: ".$this->input->get('date_invent5' ).'<hr>'.
    "- Mejoras Propuestas: ".$this->input->get('date_invent7' ).'<hr>'.
    "- Posibles Lesiones: ".$this->input->get('date_invent8' ).'<hr>'.
    "COMENTARIOS:<br>".$this->input->get('date_invent9' ).'<hr>'.
    "LISTA DE SEGUIMIENTO 1:<br>".$this->input->get('date_invent10').'<hr>'.
    "LISTA DE SEGUIMIENTO 2:<br>".$this->input->get('date_invent11').'<hr>';

    echo $coso = $this->enviar_email_al_entrenador($this->input->get('date_invent1'),$u1);



    }


    public function enviar_email_al_entrenador($email,$mensaje){


        $this->load->library('email');
        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot)');
        $this->email->bcc($email);
        $this->email->bcc('strongestpalma@gmail.com');
        $this->email->to('jdds1985@gmail.com');
        $this->email->reply_to($email);

        $this->email->subject('Infome '.date('d/m'));
        $this->email->message('
            
            <html>
            <body>
                <h3>Hola</h3>
                <p>Soy Wendy, el bot de la casa Atlo.</p>
    
                <p>En esta ocasión me pongo en contacto para hacerte llegar el feedback de un Cliente Premium a través de su Cuenta Atlo</p>

                <p>Me he tomado la libertad de codificar este mensaje para que, al responderlo, lo hagas directamente a la persona interesada.</p>'.
    
                
            
            $mensaje.'                <p>E-Mail para soporte técnico: sergio@mallorcainterbox.com</p>
                
            <p>Gracias, Wendy</p>

        </body>
        </html>'       
        
        );
        $this->email->send();


        return $coso = '<h1 class="animated infinite bounce delay-2s">OK</h1>';



    }








    public function obtener_fecha(){
        
        $this->load->database();
        
        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  

        $sql = 
        "SELECT * FROM `at_temp_dias` WHERE `dias_date` LIKE '$fecha'" ;

        $query = $this->db->query($sql);
        $row = $query->row();
        return $row;
       

    }

    public function enviar_correo(){

        //quiero saber el id de la fecha de hoy
        //https://v1.atlo.es/index.php/informes/enviar_correo
        $dia_id = $this->obtener_fecha()->dias_id;


       //obtener una lista de toda la gente que ha entrenado hoy.
       $this->load->database();
        $sql= "SELECT * FROM `at_def_listas` WHERE `dias_id` = ".$dia_id." AND `listas_cont` = 1 "  ;
        $query = $this->db->query($sql);

        foreach ($query->result() as $row)
        {
                
            
            $this->dar_de_alta($row);
            $this->generar_correo($row);
                
                
        }
    
    }

    public function dar_de_alta($row){

        $this->load->database();
        $sql = "SELECT * FROM `at_def_notas` WHERE `clientes_email` LIKE '".$row->clientes_id."'
                AND `clases_id` = '".$row->clases_id."'";

        $query = $this->db->query($sql);
        
        $row2 = $query->row();


        if (isset($row2->clientes_email)){

            
           $existe = "no hacer nada";

        
        }else{

           $sql = 
           
           "INSERT INTO `at_def_notas` (`notas_id`, `clientes_email`, `dias_id`, `dias_date`, `notas_timestamp`, `clases_id`, `notas_nota`) VALUES (NULL, '".$row->clientes_id."', '".$row->dias_id."', '".date('m-d-Y')."', '".date('Y-m-d h:m')."', '".$row->clases_id."', NULL)"; 

           $this->db->query($sql);
        }

        $existe = $sql;
        //return $existe; 

    }

    public function obtener_info_clase($clases_id){

        $this->load->database();
        $sql = "SELECT * FROM `at_def_clases` WHERE `clases_id` =".$clases_id; 
        $query = $this->db->query($sql);
        return $info_clases = $query->row();
    }

    public function generar_correo($row){

        /* [listas_id] => 946 [clientes_id] => XXXjohn.faberhill@gmail.com [clases_id] => 20604 [dias_id] => 410 [listas_cont] => 0 [listas_autodate] => 2019-05-03 22:36:58 [listas_data1] => ⤵ [listas_data2] => [listas_data3] => 18 [listas_data4] => 2019-05-04 11:09:18 ) */


        $fecha = date('m-d-Y'); 

    
         $coso = "https://v1.atlo.es/index.php/informes/diario/".$row->clientes_id."/".$row->dias_id."/".$fecha."/".$row->clases_id;

         

         $info_clase=$this->obtener_info_clase($row->clases_id);
         
         
         $asunto = "Tu Atlo ".$info_clase->clases_tipo." del ".date('d/m/Y');
         

         echo $mensaje = '<!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
                <title>Tu Atlo</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

                <!-- Web Font / @font-face : BEGIN -->
                <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

                <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
                <!--[if mso]>
                    <style>
                        * {
                            font-family: sans-serif !important;
                        }
                    </style>
                <![endif]-->

                <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
                <!--[if !mso]><!-->
                <!-- insert web font reference, eg: <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css"> -->
                <!--<![endif]-->

                <!-- Web Font / @font-face : END -->

                <!-- CSS Reset : BEGIN -->
                <style>

                    /* What it does: Remove spaces around the email design added by some email clients. */
                    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                    html,
                    body {
                        margin: 0 auto !important;
                        padding: 0 !important;
                        height: 100% !important;
                        width: 100% !important;
                    }

                    /* What it does: Stops email clients resizing small text. */
                    * {
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                    }

                    /* What it does: Centers email on Android 4.4 */
                    div[style*="margin: 16px 0"] {
                        margin: 0 !important;
                    }

                    /* What it does: Stops Outlook from adding extra spacing to tables. */
                    table,
                    td {
                        mso-table-lspace: 0pt !important;
                        mso-table-rspace: 0pt !important;
                    }

                    /* What it does: Fixes webkit padding issue. */
                    table {
                        border-spacing: 0 !important;
                        border-collapse: collapse !important;
                        table-layout: fixed !important;
                        margin: 0 auto !important;
                    }

                    /* What it does: Uses a better rendering method when resizing images in IE. */
                    img {
                        -ms-interpolation-mode:bicubic;
                    }

                    /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
                    a {
                        text-decoration: none;
                    }

                    /* What it does: A work-around for email clients meddling in triggered links. */
                    a[x-apple-data-detectors],  /* iOS */
                    .unstyle-auto-detected-links a,
                    .aBn {
                        border-bottom: 0 !important;
                        cursor: default !important;
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }

                    /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
                    .a6S {
                        display: none !important;
                        opacity: 0.01 !important;
                    }

                    /* What it does: Prevents Gmail from changing the text color in conversation threads. */
                    .im {
                        color: inherit !important;
                    }

                    /* If the above doesnt work, add a .g-img class to any image in question. */
                    img.g-img + div {
                        display: none !important;
                    }

                    /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
                    /* Create one of these media queries for each additional viewport size youd like to fix */

                    /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
                    @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                        u ~ div .email-container {
                            min-width: 320px !important;
                        }
                    }
                    /* iPhone 6, 6S, 7, 8, and X */
                    @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                        u ~ div .email-container {
                            min-width: 375px !important;
                        }
                    }
                    /* iPhone 6+, 7+, and 8+ */
                    @media only screen and (min-device-width: 414px) {
                        u ~ div .email-container {
                            min-width: 414px !important;
                        }
                    }

                </style>

                <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
                <!--[if gte mso 9]>
                <xml>
                    <o:OfficeDocumentSettings>
                        <o:AllowPNG/>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                <![endif]-->

                <!-- CSS Reset : END -->

                <!-- Progressive Enhancements : BEGIN -->
                <style>

                    /* What it does: Hover styles for buttons */
                    .button-td,
                    .button-a {
                        transition: all 100ms ease-in;
                    }
                    .button-td-primary:hover,
                    .button-a-primary:hover {
                        background: #555555 !important;
                        border-color: #555555 !important;
                    }

                    /* Media Queries */
                    @media screen and (max-width: 600px) {

                        /* What it does: Adjust typography on small screens to improve readability */
                        .email-container p {
                            font-size: 17px !important;
                        }

                    }

                </style>
                <!-- Progressive Enhancements : END -->

            </head>
            <!--
                The email background color (#222222) is defined in three places:
                1. body tag: for most email clients
                2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
                3. mso conditional: For Windows 10 Mail
            -->
            <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
                <center style="width: 100%; background-color: #222222;">
                <!--[if mso | IE]>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #222222;">
                <tr>
                <td>
                <![endif]-->

                    <!-- Visually Hidden Preheader Text : BEGIN -->
                    <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                        Hola. Este tu informe diario de Atlo. 
                    </div>
                    <!-- Visually Hidden Preheader Text : END -->

                    <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
                    <!-- Preview Text Spacing Hack : BEGIN -->
                    <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                    </div>
                    <!-- Preview Text Spacing Hack : END -->

                    <!--
                        Set the email width. Defined in two places:
                        1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
                        2. MSO tags for Desktop Windows Outlook enforce a 600px width.
                    -->
                    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                        <!--[if mso]>
                        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
                        <tr>
                        <td>
                        <![endif]-->

                        <!-- Email Body : BEGIN -->
                        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                            <!-- Email Header : BEGIN -->
                            <tr>
                                <td style="padding: 20px 0; text-align: center; background-color: #222222;">
                                    <img src="https://v1.atlo.es/00_img/2019_wendy_mail/arrriba.png" width="200" height="50" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px;">
                                </td>
                            </tr>
                            <!-- Email Header : END -->

                            <!-- Hero Image, Flush : BEGIN -->
                            <tr>
                                <td style="background-color: #ffffff;">
                                    <img src="https://v1.atlo.es/00_img/2019_wendy_mail/portada.png" width="600" height="" alt="alt_text" border="0" style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img">
                                </td>
                            </tr>
                            <!-- Hero Image, Flush : END -->

                            <!-- 1 Column Text + Button : BEGIN -->
                            <tr>
                            <td style="padding: 0 10px 40px 10px; background-color: #ffffff;">
                            <table>
                                        <tr>
                                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                                <h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 18px; line-height: 22px; color: #333333; font-weight: bold;">Amigo/a <strong>'.$row->listas_data1.'</strong>:</h2>

                                                <p style="margin: 0;">Gracias por participar en el <strong>entrenamiento de las '.substr ($info_clase->clases_hora,0,5).' del '.date('d/m').'</strong>. Como eres cliente premium, te invitamos a que guardes este y todos los <strong>WOD </strong> que hagas en tu <strong style="color:green;">Cuenta Atlo™</strong>.<br><br>Para ello,  </p>
                                                <ul style="padding: 0; margin: 0 0 10px 0; list-style-type: disc;">
                                                    <li style="margin:0 0 10px 30px;" class="list-item-first">Valora el entreno del día de hoy según tu <strong style="color:red;">SENSACIÓN PERSONAL</strong>, pulsando sobre el enlace que más se le aproxime: hay cinco estados distintos disponiobles.</li>
                                                    
                                                    <li style="margin: 0 0 0 30px;" class="list-item-last">Una vez mandes esta valoración, podrás guardar <strong style="color:OLIVE">TU RESULTADO</strong> y otras marcas personales. También podrás mandar un feedback a tu entrenador si así lo deseas.</li>
                                                </ul>
                                                Y eso es todo: ¡Estamos esperado volverte a ver muy pronto! <br>Un saludo,
            <pre>~~Wendy ❤
Bot de Atlo</pre>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- 1 Column Text + Button : END -->

                        


                            <!-- 5 Even Columns : BEGIN -->
                            <tr>
                                <td style="padding: 0 10px 40px 10px; background-color: #ffffff;"> 
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td valign="top" width="20%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0 10px;">
                                                            <img src="https://v1.atlo.es/00_img/M1.png" alt="20% :|" border="0" style="width: 100%; max-width: 200px;  font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                        |<a href="'.$coso.'/20"><p style="margin: 0;">Bah.</p></a>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>


                                        <td valign="top" width="20%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0 10px;">
                                                            <img src="https://v1.atlo.es/00_img/M2.png" alt="60% :)" border="0" style="width: 100%; max-width: 200px;  font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                            |<a href="'.$coso.'/60"><p style="margin: 0;">Bien.</p></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>


                                            <td valign="top" width="20%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0 10px;">
                                                            <img  src="https://v1.atlo.es/00_img/M3.png"   alt="85% :)" border="0" style="width: 100%; max-width: 200px;  font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                        |<a href="'.$coso.'/85"><p style="margin: 0;">Genial.</p></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>


                                        <td valign="top" width="20%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0 10px;">
                                                            <img src="https://v1.atlo.es/00_img/M4.png"   alt="99% :)" border="0" style="width: 100%; max-width: 200px;  font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                            |<a href="'.$coso.'/99"><p style="margin: 0;">Brutal.</p></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>


                                            <td valign="top" width="20%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0 10px;">
                                                            <img src="https://v1.atlo.es/00_img/M5.png" alt="0% :,(" border="0" style="width: 100%; max-width: 200px;  font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                                        |<a href="'.$coso.'/0"><p style="margin: 0;">PEPTO.</p>
                                                        </td></a>
                                                    </tr>
                                                </table>
                                            </td>
                                        
                                        
                                        
                                        
                                        


                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Five Even Columns : END -->

                    

                            <!-- 1 Column Text : BEGIN -->
                            <tr>
                                <td style="background-color: #ffffff;">
                                    <table style="background-color: #ff0;" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">


                                    <tr>
                                        <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                            <h2 style="margin: 0; color:#c70039;">ENTRENAMIENTO DEL '.date('d/m/y').'
                                            </h2>
                                        </td>
                                    </tr>


                                        <tr>
                                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                                <h3 style="margin: 0; color: #000;">A. FUERZA</h3>
                                                <code>
                                                SQUAT CLEAN
                                                5-5-5-5-5
                                                </code>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                                <h3 style="margin: 0;">B. FUERZA</h3>
                                                <code>
                                                SQUAT CLEAN
                                                5-5-5-5-5
                                                </code>
                                            </td>
                                        </tr>




                                    </table>
                                </td>
                            </tr>
                            <!-- 1 Column Text : END -->

                        </table>
                        <!-- Email Body : END -->

                        <!-- Clear Spacer : BEGIN -->
                        <tr>
                            <td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;">
                                &nbsp;
                            </td>
                        </tr>
                        <!-- Clear Spacer : END -->

                        <!-- Email Footer : BEGIN -->
                        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                            <tr>
                                <td style="padding: 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
                                    <webversion style="color: #cccccc; text-decoration: underline; font-weight: bold;">Ver como página web</webversion>
                                    <br><br>ATLO MALLORCA INTERBOX®<br>
                                    ACTIVIDADES INFORMÁTICAS<br><span class="unstyle-auto-detected-links">CARRER CAN VALERO 31<br>wa.me/34615890787</span>
                                    <br><br>
                                    <!--<unsubscribe style="color: #888888; text-decoration: underline;">unsubscribe</unsubscribe>-->
                                </td>
                            </tr>
                        </table>
                        <!-- Email Footer : END -->

                        <!--[if mso]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </div>

                    <!-- Full Bleed Background Section : BEGIN -->
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: yellow;">
                        <tr>
                            <td>
                                <div align="center" style="max-width: 600px; margin: auto;" class="email-container">
                                    <!--[if mso]>
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                                    <tr>
                                    <td>
                                    <![endif]-->
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #000;">
                                                <p style="margin: 0;"><strong>Este servicio está actualmente en pruebas.</strong> Por favor, si tienes cualquier comentario rogamos que nos lo haga llegar: <a href="sergio@mallorcainterbox.com">sergio@mallorcainterbox.com</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--[if mso]>
                                    </td>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </div>
                            </td>
                        </tr>
                    </table>
                    <!-- Full Bleed Background Section : END -->

                <!--[if mso | IE]>
                </td>
                </tr>
                </table>
                <![endif]-->
                </center>
            </body>
            </html>
        ';

        

        $this->load->library('email');
        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot)');
        $this->email->to($row->clientes_id);
        //$this->email->cc('another@another-example.com');
        $this->email->bcc('catxo99+vis1@gmail.com');

        $this->email->subject($asunto);
        $this->email->message($mensaje);

        //$this->email->send();


}


    public function diario($user_id=null,$day_id=null,$dias_date=null,$clase_id=null,$N=4){


        //FUNCION PRINCIPAL
        //OJO

        //https://v1.atlo.es/index.php/informes/diario/1/2/3/4
        echo "<kbd><img width='150' src='https://v1.atlo.es/00_img/2019_wendy_mail/arrriba.png'>VERSIÓN PRE-ALPHA.</kbd>";
        

        $this->load->view('!_html');
        $this->load->helper('url');  
        $fecha = date('Y-m-d');  

        $data = new stdClass();
        $data->title = 'Atlo Informe Diario ——— @atlobarbellclub';

        $pr = new stdClass();
        $pr->user_id = $user_id;
        $pr->day_id = $day_id;
        $pr->clase_id = $clase_id; 
        $pr->dias_date = $dias_date; 

        $pr->frase = $this->almacenar($N,$pr);

        $this->load->view('00_head', $data);
        $this->load->view('w_info_1', $pr);
        $this->load->view('w_info_2', $pr);
        $this->load->view('w_info_3', $pr);

        
        $this->load->view('80_cierre');
        $this->load->view('!_body');
        $this->load->view('!_body_fin');
        $this->load->view('!_html_fin');

    }


    public function almacenar($nota,$pr){


        //CREAR LA BASE DE DATOS
        
        /* notas_id
        clientes_email
        dias_id
        dias_date
        notas_timestamp
        clases_id
        notas_nota

        1
        410
        05-04-2019
        2018-08-26 16:57
        20612
        NULL
        */

        //COMPROBAR QUE NO EXISTEN RESULTADOS

        $this->load->database();
        $sql = "SELECT * FROM `at_def_notas` WHERE `clientes_email` LIKE '".$pr->user_id."'
                AND `clases_id` = '".$pr->clase_id."'";

        $query = $this->db->query($sql);
        
        $row = $query->row();

        if (isset($row->clientes_email)){

            
            $sql = "UPDATE `at_def_notas` SET `notas_nota` = '".$nota."' 
            WHERE `at_def_notas`.`clientes_email` LIKE '".$pr->user_id."'
            AND `at_def_notas`.`clases_id` = ".$pr->clase_id;

            $this->db->query($sql);
            
            $existe = "Gracias. Hoy has valorado tu visita en el Atlo con un ".$nota.".<hr>";

        
        }else{

            $existe = "algo ha ido mal-";
        }
        

        //GRABAR RESULTADOS

        return $existe; 


    }






}