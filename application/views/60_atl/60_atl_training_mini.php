<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>

<!--DATOS-->
<!--<script src="https://v1.atlo.es/01_js/ajax-js.min.js"></script>-->


<?php
$pantalla_loading="<i class='p-1 m-1 fas fa-circle-notch fa-spin'></i>"; ?>


<?php 

    $this->load->library('session');
        if($this->session->userdata('username') == "")
        {
           $sin_login = "<h3>NO ESTÁS LOGEADO</h3>";
           $usuario = "";
        }else{
            $usuario = $this->session->userdata('username'); 
    }

    //RECUPERAR DATOS USUARIO
    //$usuario="alexisc17@hotmail.com";
    $usuario= $this->session->userdata('username'); 

    //RECIBIR DATOS
    $url = 'https://v1.atlo.es/index.php/6atl/atletas/asistencias/'.$usuario.'/1';
    $data = file_get_contents($url);
    $asistencias = json_decode($data, false);

    //conseguir el ultimo
    if ($asistencias){$voto = $asistencias[0]->dias_id;}else{$voto = "0";}

    //COMPROBAR QUE HAS VOTADO
    //SELECT * FROM `at_def_valoraciones` WHERE `dias_id` = 533 ORDER BY `val_id` DESC

    $url = 'https://v1.atlo.es/index.php/6atl/atletas/ver_voto/'.$usuario.'/'.$voto;
    $data = file_get_contents($url);
    $hay_voto = json_decode($data, false);

    if (!$hay_voto){$he_votado="NO";}else{$he_votado="SI";}



    //DALE

    foreach ($asistencias as $x) { 

        $url = 'https://v1.atlo.es/index.php/6atl/atletas/mostrar_dias/'.$x->dias_id;
        $data = file_get_contents($url);
        $formato_fecha = json_decode($data, false);


        $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$x->dias_id;
        $data = file_get_contents($url);
        $entreno_hoy = json_decode($data, false);
      

?>


  <!-- información de la ficha del cliente -->

  <?php

  //DATOS DEL USUARIO--
  //ZONA PRIVADA--

  $cliente= $this->session->userdata('username');
  $usuario_a = $this->session->userdata('username');

  $usuario_a = $this->session->userdata('username');
  $usuario = $this->session->userdata('username');


  $usuario = str_replace("@",".aaaaaaaaaa.",$usuario);


  $url =base_url().'index.php/zonaprivada/json_usuario/'.$usuario;
  $data = file_get_contents($url);
  $clientes = json_decode($data, false);



  ?>

    <?php if(isset($entreno_hoy[2])){  

    $tex=
    substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[0]->entowod_descripcion),0,20).             
    '... <br>          '. 
    substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[1]->entowod_descripcion),0,15).
    '... <br>          '.  
    substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[2]->entowod_descripcion),0,120).
    '...';

    }else{ $tex = "Info. no disponible..."; } ?>




  <!--<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js">
  </script>-->

  <script>
    
    $(document).ready(function(){ 

      

      //SOLO CARGAR
      $(".dia_cargar").click(function(evento){
         
         evento.preventDefault(); 

         var divurl = $(this).attr('data-url');
         var divdestino = $(this).attr('data-destino');
         var divid = $(this).attr('data-id');
         $("#"+divdestino+divid).html(`<?php echo $pantalla_loading; ?>`);
         $("#"+divdestino+divid).load(divurl);

      });


      //NO HACER CASO
      $(".verresultados_caras").click(function(evento){ 
        evento.preventDefault();
        var  _carita = $(this).attr('data-destino');
        $('#_carita' + _carita).html("<i class='fas fa-circle-notch fa-spin'></i>");
        $('#_carita' + _carita).load("https://v1.atlo.es/index.php/6atl/valoraciones/caras_1/"+_carita+"/m");
      
      
      })
      

      //ENLACE AJAX (MULTITODO)
      $(".enlaceajax_carita").click(function(evento){  
    
        evento.preventDefault();
        var  datadestino = $(this).attr('data-destino');
        var  datadestino_id = $(this).attr('data-id');
        $('#' + datadestino + datadestino_id).html("<i class='fas fa-circle-notch fa-spin'></i>");

        //data-destino
        //data-id
        //data-select
        //data-orden
        //data-fecha
        //data-valor  

        //PONER LOS IF
          //caritas
          if (datadestino = '_carita'){var valorvalor = $(this).attr('data-valor'); }else{var valorvalor = NULL;}    
    
        //$("#destino001").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/6atl/valoraciones/principal", {
            
            orden_destino: $(this).attr('data-destino'), 
            orden_id: $(this).attr('data-id'), 
            orden_select: $(this).attr('data-select'), 
            orden_orden: $(this).attr('data-orden'), 
            orden_valor: valorvalor,
            orden_fecha: $(this).attr('data-fecha')}, 
            
            function(respuesta){
            $('#' + datadestino + datadestino_id).html("<span class='badge badge-secondary'>¡Gracias por Votar!</span>");
            setTimeout(function() {
                $('.alert').fadeOut('slow');}, 500
            );
            //document.getElementById('selection'+select).disabled = true;
            })
      });      
    })


  </script>







<!--CONTENEDOR-->

<?php if ($he_votado=="NO"){ ?>


<div id="merror" class="m-4 alert  alert-light alert-dismissible fade show" role="alert" style="height:150px;"><div class="text-center p-0" style="width:200px; margin-left: auto;  margin-right: auto;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    <span class="sr-only">Close</span>
  </button>
  


<!--CARITAS-->
            <p class="m-0 text-center">
              <strong>
                <div class="text-center">Clase del <?= $formato_fecha ?>:</div> 
              </strong>

              <div class="row">
                
                <div style="padding:3px;" class="col">

                <a class="enlaceajax_carita" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario_a?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="20"    
                  role="button"
                > 
                <img src="https://v1.atlo.es/00_img/M1.png" class="img-fluid" alt="20%">
                </a>
                </div>

                <div style="padding:3px;" class="col">
                <a class="enlaceajax_carita" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario_a?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="60"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M2.png" class="img-fluid" alt="60%">
                </a></div>

                <div style="padding:3px;" class="col">
                <a class="enlaceajax_carita" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario_a?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="85"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M3.png" class="img-fluid" alt="85%">
                </a></div>                
                
                <div style="padding:3px;" class="col">
                <a class="enlaceajax_carita" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario_a?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="99"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M4.png" class="img-fluid" alt="99%">
                </a></div>

                <div style="padding:3px;" class="col">
                <a class="enlaceajax_carita" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario_a?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="00"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M5.png" class="img-fluid" alt="00%">
                </a></div>

              </div>

                 
              <div id="_carita<?= $x->dias_id ?>" class="m-0 text-center">¡VOTA YA! </div>

            </p><!--FIN DE LAS CARITAS-->



</div></div> <!--FIN CONTENEDOR -->


<?php } ?>


<?php } ?>