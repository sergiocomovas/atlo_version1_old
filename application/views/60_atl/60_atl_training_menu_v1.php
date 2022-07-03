<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>

<!--MENU ATLETA-->

<!--<script src="https://v1.atlo.es/01_js/ajax-js.min.js"></script>-->

<?php //$this->load->view('60_atl/60_atl_menu'); ?>


<?php
$pantalla_loading="<i class='p-1 m-1 fas fa-circle-notch fa-spin'></i>";

?>


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
    $url = 'https://v1.atlo.es/index.php/6atl/atletas/asistencias/'.$usuario.'/7';
    $data = file_get_contents($url);
    $asistencias = json_decode($data, false);

    if(empty($asistencias)){$nohaydatos="<td><h3><br><br>Aquí aparecerán las clases que ya has realizado: podrás valorarlas y consultar tus dudas con tu entrenador. Para comenzar, reserva tu primera clase.</h3></td>";}else{$nohaydatos="";}


?>


  <!-- información de la ficha del cliente -->


 

  <?php

  //DATOS DEL USUARIO--
  //ZONA PRIVADA--

  $clan['simbolo']=$this->session->userdata('simbolo');

  $cliente= $this->session->userdata('username');
  $usuario_a = $this->session->userdata('username');

  $usuario = $this->session->userdata('username');


  $usuario = str_replace("@",".aaaaaaaaaa.",$usuario);


  $url =base_url().'index.php/zonaprivada/json_usuario/'.$usuario;
  $data = file_get_contents($url);
  $clientes = json_decode($data, false);

  //SELECT COUNT(`clientes_id`) cuenta FROM `at_def_listas` WHERE `clientes_id` LIKE 'XXXcatxo99@gmail.com'

  $url = "https://v1.atlo.es/index.php/homeatl/contar_barcos/".$usuario_a;
  $barcos = file_get_contents($url);

  ?>




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
            $('#' + datadestino + datadestino_id).html(respuesta);
            //document.getElementById('selection'+select).disabled = true;
        })
      });      
    })


  </script>

    <!-- div principal -->
    <div class="mt-2 px-2 animated fadeInUp fast" style="min-height:100%; padding-right: 0px !important; ">

    <!--necesario cargarlo cada vez-->
   <script src="<?= base_url()?>01_js/jquery.hscroll.js"></script>

    <?php // PARAMETROS DATOS
    ?>

     <!-- div contenedor-->
    <div class="fade show ml-3 cajasombra" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 25px 0px 0px 0px; ">

    <div class="table-responsive scrollmenu">
    <table style="table-layout: fixed" class="table table-borderless"><tr>

        <td scope="row" class="p-2" style="min-width: 210px; width: 230px;">
          <H1>ATLETA CLUB</h1>


          Nombre: <?= $clientes->clientes_nombrereal ?>
          <br>Antigüedad: <?= $clientes->clientes_antiguedad ?>
          <p class="border-top border-bottom"><i class="em em-ship"></i><i class="em em-arrow_heading_down"></i> <code class="text-light float-right" style="text-decoration: underline wavy #46a4d9;">x<?= $barcos?> VECES...</code></p>


          <br><br>

      
         
        


          <br><br>
          <h6 class="text-center">VALORACIONES <i class="fas fa-arrow-right"></i></h6><br>
          <div class="m-2"></div>

          <a class="text-left" href="#records" data-toggle="collapse" data-target="#collapseReco" aria-expanded="false" aria-controls="collapseReco"><p class="h6 m-0"><i class="fas fa-angle-double-down"></i> REP MÁXIMA</p> </a>

          <div class="p-2 rounded collapse border border-warning" id="collapseReco">
          <button onclick="openNav_atl55()" type="button" name="" id="" class="btn btn-primary btn-sm btn-block">Actualizar Récords</button>
          <kbd  class="w-100 p-0 m-0" style="background-color: transparent !important";>


          <?php 

          $url="https://v1.atlo.es/index.php/homeatl/ver_resultados_c/". $usuario_a;
          $data = file_get_contents($url);
          $ejes = json_decode($data, false);


        

          //$this->load->library('table');
          //echo $this->table->generate($ejes);

          echo '<ul class="p-1">';
          foreach ($ejes as $yy) { 

            echo '<li class="border-bottom border-warning"><span  class="text-uppercase">'.$yy->resultados_b.'</span><br>(<small>'.$yy->resultados_c.'</small>)
            <span class="float-right text-warning pr-0">'.$yy->resultados_kg.' Kg</span></li>';



          }

          ?>


            <!--<br>TESTS 2020 (SF3)
            <li>Resistencia
            <span class="float-right text-muted pr-0">000+0</span></li>
            <li>Fuerza
            <span class="float-right text-muted pr-0">000+0</span></li>
            <li>Bodyweight
            <span class="float-right text-muted pr-0">000+0</span></li>
            <li>Habilidad
            <span class="float-right text-muted pr-0">000+0</span></li>
            <li>Mixta
            <span class="float-right text-muted pr-0">000+0</span></li>
            <li>Potencia
            <span class="float-right text-muted pr-0">000+0</span></li>-->

          </ul>
          </kbd>
        
        </div>
        <div name="records" class="m-2"></div>

        <a class="text-left" href="#brutal" data-toggle="collapse" data-target="#collapseEntrenoBrutal" 
        aria-expanded="false" 
        aria-controls="collapseEntrenoBrutal"
        
        ><p class="h6 m-0"><i class="fas fa-angle-double-down"></i> BRUTAL WOD SEP.</p> </a>


        <div  class="p-2 rounded collapse border border-warning" id="collapseEntrenoBrutal"><span  style="color:orange;">VOTA NARANJA</span> <br>
        Aquí aparecerá el wod más *Brutal* del mes pasado. Para ello necesitamos tu valoración. Los Wods con más votos naranjas será el elegido. 
        
        </div>

        <div name="brutal" class="m-2"></div>
       
        <a class="text-left" href="#competiciones" data-toggle="collapse" data-target="#collapseCompe" aria-expanded="false" aria-controls="collapseCompe"><p class="h6 m-0"><i class="fas fa-angle-double-down"></i> COMPETICIONES</p> </a>

        
        
        <div class="p-2 rounded collapse border border-warning" id="collapseCompe">

          <p>Ver:</p>
                  
          <a  href="javascript:void(0)" disabled class="disabled btn btn-warning btn-sm btn-block" disabled role="button">SF3 THORFIVE (pend.)</a> 
          
          <!-- CON ENLACE AJAX -->
          <a class="btn btn-warning ajaxtelegraf btn-sm btn-block" role="button" href="javascrit:void(0);" 
                  data-url-telegraf="https://api.telegra.ph/getPage/TAC-La-competici%C3%B3n-para-todos-09-06?return_content=true"
                  data-div-destino="ajax_modal"
                  data-toggle="modal" 
                  data-target="#modal1">The Amateur Ch.</a>
        
        </div>

        <div name="competiciones" class="m-2"></div>

        <h6 class="text-center"><br>EQUIPAMIENTO<br> TU CLAN<br><i class="fas fa-arrow-down"></i></h6>
       

        <br><br><br><br>

        </td>

        <?php //bucle <td></td> ?>

        <?= $nohaydatos ?>
        <?php foreach ($asistencias as $x) { 

            $url = 'https://v1.atlo.es/index.php/6atl/atletas/mostrar_dias/'.$x->dias_id;
            $data = file_get_contents($url);
            $formato_fecha = json_decode($data, false);


            $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$x->dias_id;
            $data = file_get_contents($url);
            $entreno_hoy = json_decode($data, false);
          
        ?>

                    
        <td class="p-1" style="min-width: 280px; width: 300px;"> 
        <div class="m-2"></div>
        <div class="card">
              
          <div class="card-body">  
             
            <h6 class="card-title">
              <span> 
                <a class="text-center text-secondary" href="javascript:void(0)" data-toggle="collapse" data-target="#collapseEntreno<?= $x->dias_id ?>"
                aria-expanded="false" 
                aria-controls="collapseEntreno<?= $x->dias_id ?>">
                  <i class="fas fa-caret-square-down"></i>
                
              </span>

              
                CLASE <?= $formato_fecha ?>:
              </a>
            </h6>
            
            <p class="card-text">

              <div class="collapse" id="collapseEntreno<?= $x->dias_id ?>">
              <div class="card card-body">
              <?php if(isset($entreno_hoy[2])){  

                $tex=
                substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[0]->entowod_descripcion),0,20).             
                '... <br>          '. 
                substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[1]->entowod_descripcion),0,15).
                '... <br>          '.  
                substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[2]->entowod_descripcion),0,120).
                '...';
              
              }else{ $tex = "Info. no disponible..."; } ?>

                <big><pre style="color:gold" class="p-0 m-0">Extracto: <?= $tex ?></pre>
                
                </big>
              
              </div>
              </div><!--collapse fin-->

              <strong>
                <div class="text-center">¿Qué tal te ha ido?</div> 
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

                 
              <div id="_carita<?= $x->dias_id ?>" style="min-height:49px" class="text-center"><code style="color:gold"> Pulsa <i class="far fa-meh-blank"></i> para votar <br>o <a href="javascriot:void(0)" class="verresultados_caras" style="text-decoration-line: underline;" data-destino="<?= $x->dias_id ?>">MIRA EL RESULTADO</code>.
              </div></a>

            </p><!--fin del apartado 1-->

            <!--apartado 2:quitado-->
            
      

            <p class="card-text">
                  <strong>Contacta con tu entrenador:</strong>

                  <div class="row p-0">

                    <div style="padding-right:3px;" class="col pb-2">                    
                    <button data-url="https://v1.atlo.es/index.php/homeatl/reporte/<?= $usuario_a?>/<?= $x->dias_id ?>" data-destino="abajo" data-id="<?= $x->dias_id ?>"class="dia_cargar px-0 btn btn-sm btn-block btn-secondary">
                        <span style="font-size:10px" class="badge badge-primary"><i class="fas fa-exclamation-triangle"></i></span> Reportar
                    </button>
                    </div>

                    <div data-url="https://v1.atlo.es/index.php/homeatl/lesion/<?= $usuario_a?>/<?= $x->dias_id ?>" data-destino="abajo" data-id="<?= $x->dias_id ?>"style="padding-right:3px;" class="dia_cargar col pb-2">
                    <button class="dia_cargar px-0 btn btn-sm btn-block btn-secondary ">
                         <span style="font-size:10px" class="badge badge-primary"><i class="fas fa-user-injured"></i></span> Posible lesión
                    </button>
                    </div>                    
  
                  </div>

                  <div class="row p-0">
                
                    <div class="col pr-1 pb-2">                    
                    <button data-url="https://v1.atlo.es/index.php/homeatl/duda/<?= $usuario_a?>/<?= $x->dias_id ?>"    data-destino="abajo" data-id="<?= $x->dias_id ?>"
                    style="padding-right:3px;" 
                    class="dia_cargar px-0 btn btn-sm btn-block btn-warning ">
                        <span style="font-size:10px" class="badge badge-primary"><i class="far fa-comments"></i></span> Dudas
                    </button>
                    </div>

                    <div class="col pr-1 pb-2">                    
                    <button data-url="https://v1.atlo.es/index.php/homeatl/seguimiento/<?= $usuario_a?>/<?= $x->dias_id ?>"            data-destino="abajo" data-id="<?= $x->dias_id ?>"
                     
                     style="padding-right:3px;" 
                     class="dia_cargar px-0 btn btn-sm btn-block btn-secondary ">
                        <span style="font-size:10px" class="badge badge-primary"><i class="fab fa-jira"></i></span> Seguimientos
                    </button>
                    </div>
                  </div>

                  <div id="abajo<?= $x->dias_id ?>" style="min-height:200px" class="text-center"><pre style="color:gold"></pre>
                  </div>
            </p><!--fin del apartado 3-->            

          </div><!--fin de la card-->
  </td><!--fin de la parte que se repite-->

        <?php } ?>
                   
                
<td style="min-width: 290px; width: 300px;"><div class="text-center"></div></td>
    </tr></table> 
    </div>

</div>

<!-- extensión -->
<?php $this->load->view('60_atl/60_atl_training_menu_v1_gear.php'); ?>
<?php $this->load->view('60_atl/60_atl_training_menu_v1_clan.php',$clan); ?>

<div class="m-4"></div>
<div class="m-4"></div>

<br><br><br>



</div> <!--fin del div final principal-->

<script>

$(document).ready(function(){


  $('.scrollmenu').hScroll(); // You can pass (optionally) scrolling amount

})

</script>

<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->


<!--MENU ATLETA RÉCORDS-->
<div id="mySidenav_atl55" class="sidenav-atl">

  <?php $this->load->view('60_atl/60_atl_training_menu_v1_records'); ?>

</div>

<!-- MODAL TELEGRAF -->
<script src="https://v1.atlo.es/01_js/telegraf.js"></script>
<!-- Modal Telegrah -->
<div class="modal fade" style="background-color:#770124;;" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

  <div class="modal-dialog modal-lg" style="background-color:#770124;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">atlo.es  <small><span style="color:#900c3e">|</span> NOTICIAS</small></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span> 
          </button>
      </div>
      <div class="modal-body">
        <div id="ajax_modal">Un segundo...</div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>   
<!--FIN MODAL TELEGRAF-->

<script> 

/* Set the width of the side navigation to 250px */
function openNav_atl55() {
  document.getElementById("mySidenav_atl55").style.width = "100%";
  document.getElementById("mySidenav_atl55").style.padding = "0px";
}

function closeNav_alt2() {
  document.getElementById("mySidenav_atl55").style.width = "0";
}
</script>



