<?php $this->load->view('60_atl/60_atl_menu'); ?>
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
    $url = 'https://v1.atlo.es/index.php/6atl/atletas/asistencias/'.$usuario.'/3';
    $data = file_get_contents($url);
    $asistencias = json_decode($data, false);

?>




  <!--<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js">
  </script>-->

  <script>
    
    $(document).ready(function(){ 

      $('[data-toggle="tooltip"]').tooltip();


      //NO HACER CASO
      $(".verresultados_caras").click(function(evento){ 
        evento.preventDefault();
        var  _carita = $(this).attr('data-destino');
        $('#_carita' + _carita).html("<i class='fas fa-circle-notch fa-spin'></i>");
        $('#_carita' + _carita).load("https://v1.atlo.es/index.php/6atl/valoraciones/caras_1/"+_carita+"/m");
      
      
      })
      

      //ENLACE AJAX (MULTITODO)
      $(".enlaceajax").click(function(evento){  
    
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



    <?php // PARAMETROS DATOS
    ?>

     <!-- div contenedor-->
    <div class="" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 25px 0px 0px 0px; background-color:black;">

    <div class="table-responsive scrollmenu">
    <table style="table-layout: fixed" class="table table-borderless"><tr>

        <td scope="row" class="p-1" style="min-width: 290px; width: 300px;">


        <div class="pb-1 mt-0">
        <h3>EN PRUEBAS</h3>
        <div class="card pt-0">
          <div class="card-body ">
          <h4 class="card-title">Entrenos:</h4>
          <a href="javascript:void(0)" onclick="openNav()" class="btn btn-primary btn-block">Ver Hoy/Mañana</a>
          </div>
        </div></div>




        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Realizados:</h4>
                <p class="card-text">Encuentra aquí los Entrenos que ya has hecho y que están disponibles para Añadir Resultados:    

                <span class="card-text text-muted">Se Guardarán en tus Colecciones.</span>

                </p>
                <a href="javascript:void(0)" onclick="openNav_atl()" class="btn btn-primary">Ver Últimos</a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Colecciones:</h4>
                <p class="card-text">  Visualiza, compara y comparte tus Entrenos almacenados:

                <span class="card-text text-muted">Desde aquí puedes ver los Entrenos que has guardado previamente en tus Colecciones.</span>

                </p>
                <a href="javascript:void(0)" onclick="openNav_atl2()" class="btn btn-primary"><i class="fas fa-dice-d20"></i> Acceder</a>
            </div>

           

        </div><!--fin del div del card-->
        </td>

        <?php //bucle <td></td> ?>

        
        <?php foreach ($asistencias as $x) { 

            $url = 'https://v1.atlo.es/index.php/6atl/atletas/mostrar_dias/'.$x->dias_id;
            $data = file_get_contents($url);
            $formato_fecha = json_decode($data, false);


            $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$x->dias_id;
            $data = file_get_contents($url);
            $entreno_hoy = json_decode($data, false);
          
        ?>

                    
        <td class="p-1" style="min-width: 280px; width: 290px;"> 
        <div class="card">
              
          <div class="card-body">  
             
            <h6 class="card-title">
              <span> 
                <a class="text-center text-secondary" href="javascript:void(0)" data-toggle="collapse" data-target="#collapseEntreno<?= $x->dias_id ?>" aria-expanded="false" aria-controls="collapseEntreno">
                  <i class="fas fa-caret-square-down"></i>
                </a>
              </span>

              <a class="text-center" href="javascript:void(0)" data-toggle="collapse" data-target="#collapseEntreno<?= $x->dias_id ?>" aria-expanded="false" aria-controls="collapseEntreno">
                CLASE <?= $formato_fecha ?>:
              </a>
            </h6>
            
            <p class="card-text">

              <div class="collapse" id="collapseEntreno<?= $x->dias_id ?>">
              <div class="card card-body">
              <?php if(isset($entreno_hoy[2])){  

                $tex=
                substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[0]->entowod_descripcion),0,15).             
                '... '. 
                substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[1]->entowod_descripcion),0,15).
                '... '.  
                substr(preg_replace("/[\r\n|\n|\r]+/", " ", $entreno_hoy[2]->entowod_descripcion),0,35).
                '... ';
              
              }else{ $tex = "Info. no disponible..."; } ?>

                <big><pre style="color:gold" class="p-0 m-0">Extracto: <?= $tex ?> </pre></big>
              
              </div>
              </div><!--collapse fin-->

              <strong>
                <div class="text-center">¿Qué te tal te ha ido?</div> 
              </strong>

              <div class="row">
                
                <div style="padding:3px;" class="col">

                <a class="enlaceajax" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="20"    
                  role="button"
                > 
                <img src="https://v1.atlo.es/00_img/M1.png" class="img-fluid" alt="20%">
                </a>
                </div>

                <div style="padding:3px;" class="col">
                <a class="enlaceajax" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="60"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M2.png" class="img-fluid" alt="60%">
                </a></div>

                <div style="padding:3px;" class="col">
                <a class="enlaceajax" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="85"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M3.png" class="img-fluid" alt="85%">
                </a></div>                
                
                <div style="padding:3px;" class="col">
                <a class="enlaceajax" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="99"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M4.png" class="img-fluid" alt="99%">
                </a></div>

                <div style="padding:3px;" class="col">
                <a class="enlaceajax" href="javascript:void(0)"
                  data-destino="_carita"
                  data-id="<?= $x->dias_id ?>"
                  data-select="<?= $tex ?>" 
                  data-orden="<?= $usuario?>" 
                  data-fecha="<?= $formato_fecha ?>" 
                  data-valor="00"    
                  role="button"
                > 
              
                <img src="https://v1.atlo.es/00_img/M5.png" class="img-fluid" alt="00%">
                </a></div>

              </div>

                 
              <div id="_carita<?= $x->dias_id ?>" style="min-height:49px" class="text-center"><kbd>Brutalmómetro:</kbd><code style="color:gold"> Pulsa <i class="far fa-meh-blank"></i> para votar o <a href="javascriot:void(0)" class="verresultados_caras" style="text-decoration-line: underline;" data-destino="<?= $x->dias_id ?>">MIRA EL RESULTADO</code>.
              </div></a>

            </p><!--fin del apartado 1-->
            
            <p class="card-text">
                  <strong>Algo ha ido mal</strong>
                  <div class="row">
                
              

                    <div style="padding-right:3px;" class="col pb-2">                    
                    <button class="px-0 btn btn-sm btn-block btn-secondary">
                        <span style="font-size:10px" class="badge badge-primary"><i class="fas fa-exclamation-triangle"></i></span> Reportar
                    </button>
                    </div>

                    <div style="padding-right:3px;" class="col pb-2">
                    <button class="px-0 btn btn-sm btn-block btn-secondary ">
                         <span style="font-size:10px" class="badge badge-primary"><i class="fas fa-user-injured"></i></span> Posible lesión
                    </button>
                    </div>                    
  
                  </div>
                  
                  <div style="min-height:100px" class="text-center"><pre style="color:gold">--En preparación--</pre>
                  </div>
            </p><!--fin del apartado 2-->

            <p class="card-text">
                  <strong>Contacta con tu entrenador:</strong>
                  <div class="row">
                
                    <div class="col pr-1 pb-2">                    
                    <button  style="padding-right:3px;" class="px-0 btn btn-sm btn-block btn-warning ">
                        <span style="font-size:10px" class="badge badge-primary"><i class="far fa-comments"></i></span> Dudas
                    </button>
                    </div>

                    <div class="col pr-1 pb-2">                    
                    <button  style="padding-right:3px;" data-toggle="tooltip" data-placement="top" title="Personalización de Entrenos, dietas, recuperación de lesiones, Programa de Competidores y más" class="px-0 btn btn-sm btn-block btn-secondary ">
                        <span style="font-size:10px" class="badge badge-primary"><i class="fab fa-jira"></i></span> Seguimientos
                    </button>
                    </div>
                  </div>

                  <div style="min-height:100px" class="text-center"><pre style="color:gold">--En preparación--</pre>
                  </div>
            </p><!--fin del apartado 3-->            

          </div><!--fin de la card-->
  </td><!--fin de la parte que se repite-->

        <?php } ?>
                   
                
<td style="min-width: 290px; width: 300px;"><div class="text-center">Servicio en Pruebas</div></td>
    </tr></table> 
    </div>

</div>


    
