<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<?php if ($this->input->get('launcher')=='true'){

  if($this->session->userdata('username') != ""){  
    
  }else{ redirect('https://v1.atlo.es/index.php/zonaprivada/login');
  
  echo "Espere...";}

} ?>

<div style="margin-right: 0px; padding-right: 0px;" class=" container-fluid mt-1 pt-1 " id="p_horario">

<ul class="nav nav-pills flex-column flex-sm-row pb-3 mt-2 p-1" id="pills-tab" role="tablist">

<!--LISTA DE TABS-->

  <!--<li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> Reservas</a>
  </li>-->

  <?php if($this->session->userdata('username') != ""){?>

      <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> Reservas</a>
      </li>

      <li class="nav-item">
      <a class="nav-link" id="pills-entreno-tab" data-toggle="pill" href="#pills-entreno" role="tab" aria-controls="pills-entreno" aria-selected="true"> <i class="fas fa-dice-d20"></i> Training</a>
      </li>
   
    <?php }else{ ?>

      <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> Nuevos Clientes <span class="badge badge-primary"> Ofertas</span></a>
      </li>

      

    <?php }?>

  <!--<li class="nav-item">
    <a class="nav-link" id="pills-noticias-tab" data-toggle="pill" href="#pills-noticias" role="tab" aria-controls="pills-noticias" aria-selected="false"><i class="fab fa-instagram"></i> Noticias</a>
  </li>-->

  <?php if($this->session->userdata('username') != ""){?>

  <!--<li class="nav-item">
    <a class="nav-link" id="pills-config-tab" data-toggle="pill" href="#pills-config" role="tab" aria-controls="pills-config" aria-selected="false"> <i class="fas fa-cog"></i> Conf.</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="pills-pagos-tab" data-toggle="pill" href="#pills-pagos" role="tab" aria-controls="pills-pagos" aria-selected="false"><i class="fab fa-stripe-s"></i> Pagos</a>
  </li>-->

  <?php }else{ ?>
  
  <li class="nav-item">
    <a class="nav-link" id="pills-ofertas-tab" data-toggle="pill" href="#pills-ofertas" role="tab" aria-controls="pills-ofertas" aria-selected="false">Invitaciones</span></a>
  </li>

  <li class="nav-item">
  
  <a class="nav-link enlaceajax" href="#" 
                data-url-telegraf="https://api.telegra.ph/getPage/EMPLEO-01-11?return_content=true"
                data-toggle="modal" 
                data-target="#modal1"> <i class="fas fa-object-group"></i>Empleo</a>
  </li>

  <?php }?>


  <?php if($this->session->userdata('username') != "")
        { ?>



            
  <?php }else{ ?> 
  
  
  <li class="nav-item">
    <a name="" id="" style="color:#C2185B; text-decoration: underline; " class="btn btn-link pull-right" href="#p_redes" role="button"> <i class="fab fa-instagram"></i> Redes</a>
  </li>
  <?php } ?>
        






  
  <li class="nav-item">
    <a name="" id="" style="color:#C2185B; text-decoration: underline; " class="btn btn-link pull-right" href="#p_principal" role="button"> <i class="fas fa-info-circle"></i> Más</a>
  </li>


</ul>

<!--<br>-->

<div style="width:100%; height:850px;" class="tab-content" id="pills-tabContent">
  
  <div style="y-overflow:hidden; height:100%"  class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


    <!--estas registrado?-->
    <?php 
    

    //$this->session->userdata('nivel');

    if($this->session->userdata('username') != ""){

      //echo "hola ";
      //echo $this->session->userdata('username');
      //echo "<br>";
      $this->load->view('42_horario_privado2.php');
        
    }else{

      $this->load->view('39_ofertas.php');
      //echo "Horario de mañana 07 de enero: <br> Clase de las 10 am. clase de las 16.30, 18.30 y 19.45. Clase de las 07: avisar al entrenador.";

       
    }
  ?>
  <!--fin estas registado-->

  
    <!--- RESERVAS DE HORARIO-->
    <!--<button id="slideBack" type="button">AT</button>
    <button id="slide" type="button">AD</button>-->
    
    
  </div>
  
  <!--<div  class="tab-pane fade" id="pills-noticias" role="tabpanel" aria-labelledby="pills-noticias-tab">
    
    <h5>Instagram:</h5><br>
    <iframe src="https://www.instagram.com/p/Bk0oOiNgXxL/embed" width="320" height="600" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
    
  </div>-->
  
  
  <div  class="tab-pane fade" id="pills-ofertas" role="tabpanel" aria-labelledby="pills-ofertas-tab">
    
    
    <?php $this->load->view('41_horario_general.php');?> 
  
  </div>

  <div  class="tab-pane fade" id="pills-entreno" role="tabpanel" aria-labelledby="pills-entreno-tab">
    
    
    <?php $this->load->view('60_atl/60_atl_menu2.php');?> 
  
  </div>

  <div  class="tab-pane fade" id="pills-config" role="tabpanel" aria-labelledby="pills-config-tab">
    
  <?php $this->load->view('44_ficha_personal1.php');?>
    
  
  </div>

  <?php if($this->session->userdata('username') != ""){?>

  <div  class="tab-pane fade" id="pills-pagos" role="tabpanel" aria-labelledby="pills-pagos-tab">

  
  <?php $this->load->view('45_ficha_especial');?>

  <?php } ?> 


  </div>

 

</div>

<!--estas registrado?-->
<?php 
    $this->load->library('session');

    //$this->session->userdata('nivel');

    if($this->session->userdata('username') != ""){

      


      //$this->load->view('60_atl/60_atl_menu2.php');
      echo "<br>";
      echo "<small>Usuario:  ";
      echo $this->session->userdata('username');
      echo "</small><br>";
      echo '<label class="pl-2">  Cuenta Atlo: [ <a href="'.base_url().'index.php/zonaprivada/logout">SALIR Y CERRAR SESIÓN</a> ]</label>';
        
    }else{

      
      
      echo "<label class='pl-2'> Cuenta Atlo: [ <a href='https://v1.atlo.es/index.php/zonaprivada/login'> <i class='fas fa-exclamation-triangle'></i> ACCEDER AHORA</a> ]</label>";
      
    }
?>



<label class="pl-2" ><code>-</code> Contacto: <a href="mailto:atlo@atlo.es">atlo@atlo.es</a></label>

</div> 