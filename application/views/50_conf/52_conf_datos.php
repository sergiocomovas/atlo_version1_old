<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>


<?php

//DATOS DEL USUARIO--
//ZONA PRIVADA--

$cliente= $this->session->userdata('username');
$usuario = $this->session->userdata('username');


$usuario = str_replace("@",".aaaaaaaaaa.",$usuario);


$url =base_url().'index.php/zonaprivada/json_usuario/'.$usuario;
$data = file_get_contents($url);
$clientes = json_decode($data, false);



?>

    <h5 class="m-1">Datos de Atleta:</h5><br>

<div id="mostrar0">

<ul class="mx-2 list-group list-group-flush">

   
  <!--gupo_item-->
  <li class="list-group-item"> 
  
    <span class="float-right"> 
        <input name="" id="" disabled class="btn btn-primary btn-sm" type="button" value="Cambiar">   
    </span>
  
    <p>
        Nombre Público
    </p>

    <code>
        <?= $clientes->clientes_nombrepublico ?>
    </code>
    
  
  </li>

    <!--gupo_item-->
    <li class="list-group-item"> 
  
        <span class="float-right"> 
            <input name="" id="" disabled class="btn btn-primary btn-sm" type="button" value="Cambiar">   
        </span>

        <p>
            Comunicaciones por Correo Electrónico
        </p>

        <code>
            Todas
        </code>
    

    </li>

    <!--gupo_item-->
    <li class="list-group-item"> 
  
        <span class="float-right"> 
            <input name="" id="" disabled class="btn btn-primary btn-sm" type="button" value="Cambiar">   
        </span>

        <p>
            Resultados de WODS
        </p>

        <code>
            Público
        </code>
        

    </li>

        <!--gupo_item-->
  

        


        <li class="list-group-item bg-light" style="opacity: 0.9;"> 
  
        <p>
            <i class="fas fa-sign-out-alt"></i> LOG OUT
        </p>

        <code>
            <a href="https://v1.atlo.es/index.php/zonaprivada/logout">PULSA AQUÍ PARA CERRAR LA SESIÓN</a>
        </code>

        </li>


        <li class="list-group-item"> 
  


        <p>
            Soporte técnico rápido:
        </p>

        <code>
            <a target="_blank" href="https://api.whatsapp.com/send?phone=34615890787">Pulsa aquí</a>
        </code>
        

        </li>



<hr>

</ul>

</div>



<br><br><br>

