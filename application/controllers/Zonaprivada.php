<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 
class Zonaprivada extends CI_Controller {  

   function index()
   {
        echo "ERROR";
   }

   function login()  
    {  
        //http://localhost/tutorial/codeigniter/zonaprivada/login  
        $data['title'] = 'Usuarios Registrados';
        echo "<html>";
        $this->load->view("00_head", $data);   
        echo "<body>";
        $this->load->view("20_login");
        echo "</body>";  
        echo "</html>";
    }  

    function login_validation()  
    {  
        $this->load->library('form_validation'); 
        $this->load->helper('url');
        $this->form_validation->set_rules('username', 'Username', 'required');  
        $this->form_validation->set_rules('password', 'Password', 'required');  
        if($this->form_validation->run()){  

          //true  
          $username = strtolower(trim($this->input->post('username')));  
          $password = $this->input->post('password');  
          $simbolo = $this->input->post('symbol');  
          //model function  
          $this->load->model('zonaprivada_model'); 

          if($this->zonaprivada_model->can_login($username, $password, $simbolo)){  
              
            $session_data = array(  
                    'username' => $username,
                    'simbolo' => $simbolo,
                    'nivel' => 'Premium'  
               );  

               //$this->session->sess_expiration = '1500000';// expires in 4 hours
               $this->session->set_userdata($session_data);  
               redirect(base_url() . 'index.php/zonaprivada/socios');  
          }else{  
               $this->session->set_flashdata('error', '<i class="fas fa-tired"></i> Combinación <i>correo</i>/contraseñas incorrectas.');  
               redirect(base_url() . 'index.php/zonaprivada/login#aviso');  
          } 

        }else{ 

          //false  
          $this->login();  
        }  

    }  

    function acceder_sin()
    {

        $this->load->library('form_validation'); 
        $this->load->helper('url');
        $this->form_validation->set_rules('username_sin', 'Username', 'required');  
        if($this->form_validation->run()){  

          //true  
          $username = $this->input->post('username_sin');  
        
          //model function  
          $this->load->model('zonaprivada_model'); 

          if($this->zonaprivada_model->existe_usuario($username)){ 
              
            $this->generar_contrasena($username);

                    
            $this->session->set_flashdata('error', '<span style="color:green;"> OK <i style="color:yellow;" class="fas fa-envelope-square"></i> Mira tu correo electrónico.</span>');  

            
            redirect(base_url() . 'index.php/zonaprivada/login#aviso'); 
          
              
          }else{  
               $this->session->set_flashdata('error', '<i class="fas fa-tired"></i> ALGO HA IDO MAL. <p style="color:yellow;">Comprueba que has escrito <strong>correctamente</strong> tu correo electrónico, luego, ponte en contacto con el <i class="fas fa-heartbeat"></i> departamento de soporte.</p>');  
               redirect(base_url() . 'index.php/zonaprivada/login#aviso');  
          } 

        }else{ 

          //false  
          $this->login();  
        }  

    

    }

    function generar_contrasena($username){


        date_default_timezone_set('Europe/Berlin'); 

        //PRIMER PASO ¿EL USUARIO TIENE CONTRASEÑA?
        $this->load->model('zonaprivada_model'); 

          if($this->zonaprivada_model->existe_contrasena($username)){
            //ENVIAR EMAIL
            $this->enviar_recordatorio($username);

          }else{

            //EL USUARIO NO TIENE CONTRASEÑA

            echo $rand1 = rand(7000,13000);

            echo "<br>";

            echo $rand2 = rand(1,3); 

            echo "<br>";

            switch ($rand2) {
                case 1:
                    echo $valor="♣";
                    break;
                case 4:
                    echo $valor="♥";
                    break;
                case 2:
                    echo $valor="♦";
                    break;
                case 3:
                    echo $valor="♠";
                    break;
             }

            $datos = $this->stripe_customer($username);

            echo $datos->stripe_customer_id;
            echo $valor;  

            //INSERTAR DATOS

                
            $fecha = date('Y-m-d H:i:s');  

            $data = array(

                
                'stripe_customer_id' => $datos->stripe_customer_id, 
                'contrasena_contrasena' => ($rand1*615890787), 
                'contrasena_pin' => '', 
                'contrasena_simbolo' => $valor, 
                'contrasena_autodate' => $fecha, 
                'contrasena_comentarios' => "1" 


              
            );
        

            //
            $this->db->insert('at_def_contrasenas', $data); 
            $this->enviar_recordatorio($username);




          }

    }

    function entrar_email($email,$numero,$simbolo,$otros){

        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d H:i:s');  
        $semana = date('W');
        $this->load->helper('url');


        if($simbolo=="2030"){$nuevo_simbolo="♠";}
        if($simbolo=="2040"){$nuevo_simbolo="♦";}
        if($simbolo=="2050"){$nuevo_simbolo="♣";}
    
        $numero = ($numero/$semana);
        $numero = ($numero/615890787);
        $numero = ($numero/615890787);
       


        $email2 = str_replace(".aaaaaaaaaa.", "@",$email);
          


        $this->load->model('zonaprivada_model'); 
        
        if($this->zonaprivada_model->can_login($email2, $numero, $nuevo_simbolo)){  
              
            $session_data = array(  
                'username' => $email2,
                'simbolo' => $nuevo_simbolo,
                'nivel' => 'Premium'  
               );  

               $this->session->set_userdata($session_data);  
               //redirect(base_url() . 'index.php/zonaprivada/socios');  
               redirect('https://v1.atlo.es/index.php');
            
            }else{

                redirect(base_url() . 'index.php/zonaprivada/login?MENSAJE=POR_FAVOR_VUELVE_A_SOLICITAR_TU_LINK_DE_ACCESO_ _ESCRIBIENDO_TU_CORREO_Y_PULSANDO-_LUEGO_PULSA-_EN_Acceder_sin_PIN___-LOS_ENLACES_CADUCAN_CADA_LUNES_');  
                
            }
   

    }

    function stripe_customer($username){

        $this->load->database();

        $query = $this->db->query(' 
           
           SELECT * FROM at_def_clientes WHERE at_def_clientes.clientes_email = "'.$username.'"

        ');


        $row = $query->row();

        return $row;

    }

    function json_usuario($usuario){


        //        https://v1.atlo.es/index.php/zonaprivada/json_usuario/catxo99.aaaaaaaaaa.agmail.com


        $usuario = str_replace(".aaaaaaaaaa.","@",$usuario);

        $this->load->database();

        $query = $this->db->query(' 
           
           SELECT * FROM at_def_clientes WHERE  at_def_clientes.clientes_email = "'.$usuario.'"

        ');


        $row = $query->row();

        echo json_encode($row);

        //return $row;



    }

    function datos_usuario($username){

        $this->load->database();

        $username = trim($username);
        $username = strtolower($username);

        $query = $this->db->query(' 
           
           SELECT * FROM at_def_contrasenas, at_def_clientes WHERE at_def_contrasenas.stripe_customer_id = at_def_clientes.stripe_customer_id AND at_def_clientes.clientes_email = "'.$username.'"

        ');


        $row = $query->row();

        return $row;

    }


    function enviar_recordatorio($username){

        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d H:i:s');  
        $semana = date('W');

        $datos = $this->datos_usuario($username);


        if($datos->contrasena_simbolo=="♠"){$simbolo="2030";} 
        if($datos->contrasena_simbolo=="♦"){$simbolo="2040";}
        if($datos->contrasena_simbolo=="♣"){$simbolo="2050";} 


        $this->load->library('email');
        $this->load->helper('url');


        $this->email->from('wendy@comovas.es', 'Wendy Atlo (Bot de Reservas)');
        $this->email->to($username);
        $this->email->bcc('strongestpalma+pv@gmail.com');

        $this->email->subject('Zona Privada');

        $this->email->message('
        <html>
        <body>
            <h3>Hola</h3>
            <p>Soy Wendy, el bot de la Casa Atlo.</p>

            <p>Te recuerdo tus datos como cliente</p>

            <ul>
            
            <li>Nombre de usuario: '.$datos->clientes_email.'</li>
            <li>PIN: '.($datos->contrasena_contrasena/615890787).'</li>
            <li>Símbolo: '.$datos->contrasena_simbolo.'</li>

            </ul>

            <p>Si lo prefieres, puedes pulsar sobre el enlace siguiente donde generarás, directamente, una cookie con tus credenciales de acceso. (El enlace caduca cada lunes). 
            

            <h3>
            
               

            <a href="'.base_url().'index.php/zonaprivada/entrar_email/'.str_replace("@",".aaaaaaaaaa.",$datos->clientes_email).'/'.number_format((($datos->contrasena_contrasena*615890787)*$semana),0,'','').'/'.$simbolo.'/89736186182083764692293">
                '.base_url().'index.php/zonaprivada/entrar_email/'.str_replace("@",".aaaaaaaaaa.",$datos->clientes_email).'/'.number_format((($datos->contrasena_contrasena*615890787)*$semana),0,'','').'/'.$simbolo.'/89736186182083764692293/
            </a>
            
            
            </h3>

            <p>E-Mail para soporte técnico: sergio@mallorcainterbox.com</p>
            
            <p>Gracias, Wendy</p>

        </body>
        </html>
        
        ');

        $this->email->send();


         

    }

    function socios()
    {  
        if($this->session->userdata('username') != ''){

            echo "<html>";
            $data['title'] = 'Atlo Box Can Valero ——— @atlobarbellclub ——— El teu nou Gym a Palma de Mallorca';
            $this->load->view('00_head', $data);
            echo "<body class='p-5'>";
            echo '<div class="mx-1 float-right"><big><a href="https://v1.atlo.es/">atlo.es</a></big></div>';
            //echo '<h2>Hola - '.$this->session->userdata('username').'</h2>'; 
            echo'<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

            $this->load->helper('url');
            //https://v1.atlo.es/index.php/home?MENSAJE=_CLASE_RESERVADA_CORRECTAMENTE_(ID_627)#hoy
            redirect(base_url() . 'index.php/home?MENSAJE=Bienvenido_'.$this->session->userdata('username').'#hoy');  


            //echo '<pre>'.print_r($this->session->userdata()).'</pre>';

            /*
            echo '
            <div class="card-group">
                <div class="card p-2">
                    <img class="card-img-top" src="https://media.giphy.com/media/ywl1kzGUj1dueNmslx/giphy.gif" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card p-2">
                    <img class="card-img-top" src="https://media.giphy.com/media/ywl1kzGUj1dueNmslx/giphy.gif" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card p-2">
                    <img class="card-img-top" src="https://media.giphy.com/media/ywl1kzGUj1dueNmslx/giphy.gif" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            ';
            */

            echo '<label><a href="'.base_url().'index.php/zonaprivada/logout"><i class="fas fa-sign-out-alt"></i> Salir y cerrar sesión</a></label>';
            
            echo "<a class='float-right' href='".base_url()."'><i class='fas fa-home'></i> Portada</a>";
            echo "</body>";

            $this->load->helper('url');
            redirect(base_url() . 'index.php/zonaprivada/login#aviso');  

        }else{

            $this->load->helper('url');
            redirect(base_url() . 'index.php/zonaprivada/login#aviso');  
        }  
    }  


    function logout()  
      {  
          $this->load->helper('url');
          $this->session->unset_userdata('username');  
          $this->session->unset_userdata('simbolo'); 
          $this->session->unset_userdata('nivel'); 
           redirect(base_url() . 'index.php');  
      }  

}  