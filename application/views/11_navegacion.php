<div class="navegacion animated slideinup slow">



  <!--<a  class="enlaceajax disabled" 
      
      href="#" 
      data-url-telegraf="https://api.telegra.ph/getPage/BEACH-WOD-2019-04-21?return_content=true"
      data-toggle="modal" 
      data-target="#modal1"           
  >
  
  <div class="shine">
  
  <i class="fas fa-umbrella-beach"></i><br><small><small> Playa Wod 2019 </small></small>
  
  </div>
  
  
  </a>-->


  <div id="entr"> <a  class="enlaceajax disabled"  href="#entr" onclick="openNav()"><i class="far fa-minus-square"></i><br> <small><small>Hoy Entreno</small></small></a> </div>




  <!--<a class="color" href="#home">seccion 1</a>
  <a class="Color" href="#news">seccion 2</a>-->


  <!--estas registrado?-->
<?php 
    $this->load->library('session');

    //$this->session->userdata('nivel');

    if($this->session->userdata('username') != ""){

      echo '
      <a href="'.base_url().'index.php/zonaprivada/logout" class="active"><i class="fas fa-sign-out-alt"></i><br><small><small> Logout</small></small></a>
      ';

        
    }else{

      echo '
      <a href="https://v1.atlo.es/index.php/zonaprivada/login" class="active"><i class="fas fa-sign-in-alt"></i><br><small><small>Acceso</small></small></a>
      ';

    }
?>

  
 



</div>



     

<!--Panel Lateral-->

<div id="mySidenav" style="overflow-y:scroll; padding-top:0px;" class="sidenav">


<a class="navbar-brand" style="position: sticky;
    z-index: 10;
    top: 0px;
    padding-left:0px;
    text-shadow: 0 0 0.2em #000, 0 0 0.2em #000;
    
    " onclick="closeNav()" href="#p_horario"><h3><i class="p-1 fas fa-arrow-circle-left"></i>Regresar</h3></a>



<div class="container" id="entreno_hoy">

    <?php 
    //recibe los parámetros de fecha


    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_fecha';
    $data = file_get_contents($url);
    $fechas_parametros = json_decode($data, true);

    $hoy=$fechas_parametros['dias_id'];
    $manana=$hoy+1; 

    $esta_semana=$fechas_parametros['dias_semana'];
    $proxima_semana=$esta_semana+1; 

    ?>

    <? $this->load->view('12_nav_entrenos.php'); ?>
<br>
    <? $this->load->view('12_nav_entrenos_2.php'); ?>

</div>

<div class="container" id="entreno_manana">
    <!-- <h3>Entreno de Mañana</h3> -->
    <?php
/*
    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$manana;
    $data = file_get_contents($url);
    $entreno_manana = json_decode($data, true);

    echo '<pre class="text-warning">';
    print_r($entreno_manana);
    echo '</pre>';

*/
    ?>
   

</div>

<a name="" id="" onclick="closeNav()" class="btn btn-link btn-lg btn-block" href="#p_horario" role="button">Cerrar Menú</a>


</div>
