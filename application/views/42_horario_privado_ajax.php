<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>
 
<div class="animated fadeInUp fast" style="min-height:100%">

<!--necesario cargarlo cada vez-->
<script src="<?= base_url()?>01_js/jquery.hscroll.js"></script>

<?php 

//mira si hay valor
if(isset($_GET['EMAIL'])){

    $valor_correo = 'value="'.trim($_GET['EMAIL']).'"';

}else{

    $valor_correo = '';


}


if(isset($_GET['CODIGO'])){

    $valor_codigo = 'value="'.trim($_GET['CODIGO']).'"';

}else{

    $valor_codigo = '';


}


if(isset($_GET['MENSAJE'])){

    $msj = str_replace ('_' , ' ' , $_GET['MENSAJE']); 


    echo '<script>
    
    //https://sweetalert.js.org/


    swal("VALE", "'.$msj.'", "success", {
      buttons: false,
      timer: 2000,
    
    })

    .then(function() {
      history.pushState(null, "", "home");
    });

    
    </script>';


}


    if(isset($_GET['MENSAJE_ERROR'])){

        $msj = str_replace ('_' , ' ' , $_GET['MENSAJE_ERROR']); 
    
        echo '<script>
        
        //https://sweetalert.js.org/
 
        swal("VALE", "'.$msj.'", "error", {
          buttons: false,
          timer: 2000,
        
        })
    
        .then(function() {
          history.pushState(null, "", "home");
        });

        </script>';



    /*echo "<script>
		window.onload=function() {
            $.notify('<small><small><strong>AVISO:</strong> <br>".$msj."</small></small>',
            
            {
            type: 'dark',    
                placement: {
                from: 'top',
                align: 'center'
            },
            animate: {
                enter: 'animated zoomInDown fast',
                exit: 'animated zoomOutUp fast'
            }
        
        
        }
        );
        
      

		}
		</script>";*/

}

?>

<?php

date_default_timezone_set('Europe/Berlin');     
$fecha = date('Y-m-d');  

$fecha_b = date('d-m-y');  

?>


<?php 
//recibe los parámetros de fecha

$url = 'https://wendy.log99.es/index.php/A_atlo_horario/obtener_fecha';
$data = file_get_contents($url);
$fechas_parametros = json_decode($data, true);

$hoy=$fechas_parametros['dias_id'];
$manana=$hoy+1; 

$esta_semana=$fechas_parametros['dias_semana'];
$proxima_semana=$esta_semana+1; 


$url_y = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_proxima_max_min/'.$proxima_semana;
$data_y = file_get_contents($url_y);
$max_proxima_semana = json_decode($data_y, true);

?>

<?php

//recibe ids fechas
//https://wendy.log99.es/index.php/A_atlo_horario/semana_hoy/103
$url = 'https://wendy.log99.es/index.php/A_atlo_horario/semana_hoy/'.$hoy.'/';
$data = file_get_contents($url);
$ids_hoy = json_decode($data, true);
//print_r($ids_hoy);


//ids de lo que resta de esta semana
//https://wendy.log99.es/index.php/A_atlo_horario/esta_semana/manana/semana_actual
$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/esta_semana_mix/'.$manana.'/'.$esta_semana;
$data = file_get_contents($url);
$ids_esta_semana = json_decode($data, true);
//print_r($ids_esta_semana);

//ids de fecha de la semana que viene 
//OJOOOOOOOOOOOOOOOOOOOOOOOOO
$url = 'https://wendy.log99.es/index.php/A_atlo_horario/semana_proxima/'.$proxima_semana;


$url='https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_proxima/'.$proxima_semana.'/2019';


$data = file_get_contents($url);
$ids_semana_proxima = json_decode($data, true);
//print_r($ids_semana_proxima);

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


<!-- PREGUNTAR VOTO -->

<?php $datos_mini['clientes'] = $cliente; ?>
<?php $this->load->view('60_atl/60_atl_training_mini', $datos_mini) ?>
<!-- FIN DE PREGUNTAR VOTO -->


<script>
  $(".alert").alert();
</script>


<!--form comenzar-->

<h1 class="m-3" id="p_horario"></h1>

<!--SCROLL A-->

<div class="scrollmenu fade show ml-4 cajasombra" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 25px 0px 0px 0px; background-color:black;">


<table id="t1"><!--incio div tabla-->


<!--PRIMERA CELDA-->

<th  valign="top" style="max-min:220px;  color: #FFF; padding: 5px 5px 5px 5px; " >

<div class="container">

    <h2 id="roast2" style="width:220px; padding: 5px;" class=""><i class="fas fa-calendar-plus"></i> Reservas</h2>

    <div class="text-uppercase alert alert-light" role="alert">
        <small><small>
            Hola, <?= $clientes->clientes_nombrereal ?>
        </small></small>
    </div>


<h6 class="text-center">CLASES DISPONIBLES HOY <?= $fecha_b ?> <i class="fas fa-arrow-right"></i></h6>

    <ul class="my-3" >
        
        <li class="my-3"><a href="#manana1">Reservas de mañana y próximos días.</a> </li>

        <li class="my-3"><a href="#clases_especiales"><h6>HAY EVENTOS ESPECIALES DISPONIBLES</h6></a></li>
    <ul>

</div>

</th>

<th id="hoy"></th>

<!--FIN PRIMERA CELDA-->

<!--CARD CENTAL-->

<?php 


//
//
//
//hoy


//recibe las clases correspondientes (hoy)
$url='http://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_clases/'.$hoy;
$data = file_get_contents($url);
$clases_hoy = json_decode($data, true); 

foreach($clases_hoy as $x => $x_value){


    
    
    echo'<th valign="top" style="padding: 5px 5px 5px 5px; background-color: black;" >';

    echo'<div style="width:240px;" class="card text-justify">';
    echo'<div class="card-block p-1">';
    echo'<div class="card-header text-white bg-secondary">'; 


    echo'<div class="media">
    <img class="mr-1 rounded-circle border-white img-fluid" width="30%" src="https://atlo.es/barbellclub/tarifaclub/assets/img/image006.png" alt="Generic placeholder image">

    
    <div class="media-body">
      <h6 class="mt-0">
      <span class="border border-white">'.
      
      substr($x_value['clases_hora'],0,5)
      
      .'</span><small><small> Hoy</small></small><br>
      '.$x_value['clases_tipo'].'
      </h6>
    </div>


    
    </div>';


    echo'<small><small><div style="color:orange;" class="form-check">
    <input disabled class="form-check-input" type="checkbox" value="" id="defaultCheck'.$x_value['clases_id'].'">
    <label class="form-check-label" for="defaultCheck'.$x_value['clases_id'].'">
      Quality First (0 plaza/s).
    </label>
    </div></small></small>';


    
    echo'</div>';

    echo'<div class="card-body bg-primary">';
    
    echo'<div class="col-xs-12" style="
    width: 115%;
    line-height: 1.2rem;
    margin-left: -1vw;
    left: 50%;
    height: 200px;
    overflow: auto;">';


    $url =base_url().'index.php/0rest/A_atlo_reservas/def_lista_lista/'.$x_value['clases_id'];
    $data = file_get_contents($url);
    $lista_clase = json_decode($data, true);
    $valor_local = 0;

   

    foreach($lista_clase as $y => $y_value){


        $valor_local = $valor_local + $y_value['listas_cont']; 
        if ($valor_local=='12'){echo "<br><code>== LÍMITE 12 PERSONAS ==</code>";}
        if ($valor_local=='16'){echo "<br><code>== LÍMITE 16 PERSONAS ==</code>";}
        if ($valor_local=='32'){echo "<br><code>== LÍMITE 32 PERSONAS ==</code>";}
        if ($valor_local=='40'){echo "<br><code>== LÍMITE 40 PERSONAS ==</code>";}


        if ($y_value['clientes_id'] == $cliente){

        echo'

        <span class="mt-1 text-warning d-inline-block text-truncate" style="max-width: 190px;">
        <code>'.$valor_local.'. </code> <i class="fas fa-star"></i>'.$y_value['listas_data1'].' <small><small>'.$y_value['listas_data4'].'</small></small>
        </span><br>
    
        ';}else{

        echo '

            <span class="mt-1 d-inline-block text-truncate" style="max-width: 170px;">
            <code>'.$valor_local.'. </code>'.$y_value['listas_data1'].' <small><small>'.$y_value['listas_data4'].'</small></small>
            
            </span><br>';



        }

    

       
    }
    
    echo '</div>';

    echo'</div>';

    echo'<div  style="padding-bottom: 0px;" class="card-body">';


    ///https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_estas/catxo99@gmail.com/611

    $url =base_url().'index.php/0rest/A_atlo_reservas/def_lista_estas/'.$cliente.'/'.$x_value['clases_id'];
    
    $datax = file_get_contents($url);
    
    //$lista_clase = json_decode($data, true);

    if ($datax=='null'){

    echo '
      
      <form target="_blanck" class="ajaxForm" action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_diario/sin_retorno" method="POST">

      <input type="hidden" class="form-control" name="listas_cont" id="" aria-describedby="helpId" value="+1">

      <input type="hidden" class="form-control" name="qf" id="" aria-describedby="helpId" value="FALSE">

      <input type="hidden" class="form-control" name="clientes_id" id="" aria-describedby="helpId" value="'.$this->session->userdata('username').'">

      <input type="hidden" class="form-control" name="clases_id" id="" aria-describedby="helpId" value="'.$x_value['clases_id'].'">

      <input type="hidden" class="form-control" name="dias_id" id="" aria-describedby="helpId" value="'.$hoy.'">

      <input type="hidden" class="form-control" name="listas_data1" id="" aria-describedby="helpId" value="'.$clientes->clientes_nombrepublico.'">

      <input type="hidden" class="form-control" name="listas_data2" id="" aria-describedby="helpId" value="'.substr($x_value['clases_hora'],0,5).' '.$x_value['clases_tipo'].', '.$clientes->clientes_nombrepublico.'">

      <input type="hidden" class="form-control" name="listas_data3" id="" aria-describedby="helpId" value="'.$fechas_parametros['dias_semana'].'">

      <input type="hidden" class="form-control" name="listas_data4" id="" aria-describedby="helpId" value="***">

      <input type="hidden" class="form-control" name="retorno" id="" aria-describedby="helpId" value="'.current_url().'">

      <button type="submit" '.$x_value['clases_disabled'].' id="b.'.$x_value['clases_id'].'" onclick="return botonFuera();" class="btn btn-secondary btn-lg btn-block">¡Asistir!</button>
      

      </form>
    ';

    }else{

        echo '
      
      <form class="ajaxForm" action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_cancelar/sin_retorno" method="POST">

      <input type="hidden" class="form-control" name="listas_cont" id="" aria-describedby="helpId" value="+1">

      <input type="hidden" class="form-control" name="qf" id="" aria-describedby="helpId" value="FALSE">

      <input type="hidden" class="form-control" name="clientes_id" id="" aria-describedby="helpId" value="'.$this->session->userdata('username').'">

      <input type="hidden" class="form-control" name="clases_id" id="" aria-describedby="helpId" value="'.$x_value['clases_id'].'">

      <input type="hidden" class="form-control" name="dias_id" id="" aria-describedby="helpId" value="'.$hoy.'">

      <input type="hidden" class="form-control" name="listas_data1" id="" aria-describedby="helpId" value="'.$clientes->clientes_nombrepublico.'">

      <input type="hidden" class="form-control" name="listas_data2" id="" aria-describedby="helpId" value="'.substr($x_value['clases_hora'],0,5).' '.$x_value['clases_tipo'].', '.$clientes->clientes_nombrepublico.'">

      <input type="hidden" class="form-control" name="listas_data3" id="" aria-describedby="helpId" value="'.$fechas_parametros['dias_semana'].'">

      <input type="hidden" class="form-control" name="listas_data4" id="" aria-describedby="helpId" value="***">

      <input type="hidden" class="form-control" name="retorno" id="" aria-describedby="helpId" value="'.current_url().'">

      <button type="submit" onclick="return botonFuera();" style="font-size: 12px;" class="btn btn-warning btn-lg btn-block">CANCELAR<br>TU RESERVA</button>
      

      </form>
    ';

    




      }


    echo'</div>';


    echo'</div>';
    echo'</div>';
    echo'</th>';


}


echo '<th> <div style="padding-right: 5px;"> </div> </th>';


//
//
//    
//recibe las clases correspondientes (esta semana)

//
//th del loot

?>

<!-- FIN CARD LUNES -->
<!--ÚLTIMA CELDA-->
<!--ÚLTIMA CELDA-->

<!--INICIO PRÓXIMOS DIAS-->

<th valign="top" style="width: 300px; padding: 5px 5px 5px 5px; color:red; background-color:black;" >


</th>

<!--FIN ÚLTIMA CENDA-->
<!-- FIN CARD SÁBADO -->

</table></div><!--fin div tabla-->
<!--form comenzar-->


<!--SEMANA PRÓXIMA-->

<div class="scrollmenu fade show ml-4 cajasombra" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 0px 0px 0px 0px; background-color:#C2185B">

<table id="t2"><!--incio div tabla-->

<th valign="top" style="max-min:220px;  color: #FFF; padding: 5px 5px 5px 5px; " >

<div class="container" id="manana1" name="manana1">
<h2 id="roast2" style="width:220px; padding: 5px;" class=""><i class="fas fa-calendar-plus"></i> Próximos Días</h2>

<!--detalles de la primerera celda de proximos dias-->

<?php

//ids de fecha de la semana que viene 
$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_proxima_max_min/'.$esta_semana;
$data = file_get_contents($url);
$max_esta_semana = json_decode($data, true);
//print_r($ids_semana_proxima);
//date_format(date_create($x_value['dias_date']),"d/m")


echo '<i class="fa-xs fas fa-square"></i> Desde mañana hasta el domingo '.date_format(date_create($max_proxima_semana[0]['max']),"d/m");

echo '
<br><div style="width: 15rem;" class="mb-2 border border-primary text-center">Semana '.$esta_semana.' y '.$proxima_semana.'</div>';

?>

<video width="240px" class="mb-2" autoplay muted loop>
<source 
src="https://v1.atlo.es/00_img/federate.mp4"  type="video/mp4">

</video><br>

</div><!--fin del conteiner de proximos días-->

</th>

<!--PROXIMOS DÍA COPYPASTE-->


<?php
//th del "ESTA SEMANA"


foreach($ids_esta_semana as $x => $x_value) 
        
    {echo '
       
       
        <th class="p-1" style="vertical-align:bottom; background-color: #C2185B;" >';

        echo '<div id="manana'.$x_value['dias_id'].'"></div>

        <div style="width:210px;" class="mb-1 card text-justify">
        <div class="card-block p-1">

        <div class="card-header" style="height: 90px;"><h6>
        '.$x_value['dias_nom'].'<br>'.date_format(date_create($x_value['dias_date']),"d/m").'</h6>';


        //hacer una comprobación

        //https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_dias_estas/catxo99@gmail.com/192

        
         $url =base_url().'index.php/0rest/A_atlo_reservas/def_lista_dias_estas/'.$cliente.'/'.$x_value['dias_id'];
    
        $datax = file_get_contents($url);

        $lista_datax = json_decode($datax, false);
        
        $existe = isset($lista_datax->clases_hora);

        if ($existe==1){

            $boton_etiqueta = "Cambiar";

            echo '<p style="width: 115%; margin-left: -1vw; left: 50%; line-height: 0.4; color: #900c3e" class="bg-warning">
            
            <span data-id="'.$x_value['dias_id'].'" data-email="'.$cliente.'" class="basuraajax mx-1 badge badge-dark float-right mt-2"><a href="javascript:void(0)"><i class="fas fa-lg fa-trash-alt"></i></a></span>
            
            <p> 
            <small><small><small><i class="fas fa-star"></i>Reserva activa:<big><br><strong>'.substr($lista_datax->clases_hora,0,5).'  ('.$lista_datax->clases_tipo.')</strong></big></small></small></small>
            
            
            </p>';

            }else{

            $boton_etiqueta = "Asistir";


            echo '
            <p class="bg-secondary text-center"><small><small><i class="far fa-star"></i> Sin resevas<BR>en este día.</small></small></p>';

            }

        //$c_hora = $lista_datax->clases_hora;

       echo '</div> <!--cardheader-->';

        echo'
        
        
        <div class="card-body p-1 text-ligth" style="min-height:220px;">
          
        <p class="pt-1">Cliente Premium<br>
        <small><small>Reserva ahora tu clase:</small></small></p>
         

        <form class="ajaxForm" id="form'.$x_value['dias_id'].'" class="ajaxForm" action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_diario/sin_retorno/borrado" method="POST">

        <input type="hidden" form-control" name="listas_cont" id="" aria-describedby="helpId" value="+1">

        <input type="hidden" class="form-control" name="qf" id="" aria-describedby="helpId" value="FALSE">
      
        <input type="hidden" class="form-control" name="clientes_id" id="" aria-describedby="helpId" value="'.$this->session->userdata('username').'">
      
        <input type="hidden" class="form-control" name="listas_data1" id="" aria-describedby="helpId" value="'.$clientes->clientes_nombrepublico.'">
      
        <input type="hidden" class="form-control" name="listas_data3" id="" aria-describedby="helpId" value="'.$x_value['dias_semana'].'">

        <input type="hidden" class="form-control" name="dias_id" id="" aria-describedby="helpId" value="'.$x_value['dias_id'].'">
      
        <input type="hidden" class="form-control" name="listas_data4" id="" aria-describedby="helpId" value="***">
      
        <input type="hidden" class="form-control" name="retorno" id="" aria-describedby="helpId" value="'.current_url().'">

        <div class="form-group">
              <select name="clases_id" id="clase" onChange="enableSubmit(this,'.$x_value['dias_id'].')" class="custom-select">
              <option value="" selected disabled>Selecciona:</option>';

        //recibe las clases correspondientes (esta semana)
        $url='https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_clases_semanales/'.$x_value['dias_id'];
        $data = file_get_contents($url);
        $clases_hoy = json_decode($data, true); 
    
        
        foreach($clases_hoy as $x => $x_value){
            echo'<option '.$x_value['clases_disabled'].' value="'.$x_value['clases_id'].'">'.substr($x_value['clases_hora'],0,5).' ('.$x_value['clases_tipo'].')</option>';
        }

        echo '
            </select>
            
           
            </div><button style="margin-top: 120px; type="submit" onclick="boton('.$x_value['dias_id'].');" disabled  name="bot'.$x_value['dias_id'].'" 
            class="btn btn-secondary btn-lg btn-block">'.$boton_etiqueta.'</button>
            </form>
            </div>
            
            
             
            </div></div><!--card bock-->
            

            </th>  
            ';
        }

////FIN ESTA SEMANA

?>


</table>

</div>


<!--OTRA TRABLA-->

<div class="scrollmenu fade show ml-4 cajasombra" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 0px 0px 0px 25px; background-color:rgba(136,14,79,1)">


<table id="t3"><!--incio div tabla-->


<th valign="top" style="max-min:220px;  color: #FFF; padding: 5px 5px 5px 5px; " >

<div class="container">
<h2 id="roast2" style="width:220px; padding: 5px;" class=""><i class="fas fa-calendar-plus"></i> Eventos Especiales</h2>
</div>

</th>

<!--clases especiales-->


<!--primer paso: recibir los datos-->
<?php 
$url='http://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_clases_especiales/'.$hoy;
$data = file_get_contents($url);
$clases_especiales['clientes'] = $cliente;
$clases_especiales['ee'] = json_decode($data, true); ?>


<!--segundo paso: repetir el tr-->

<?php $this->load->view('42_horario_privado_ajax_apend',$clases_especiales) ?>
<!-- fin clases especiales-->



</table>
</div>


<br><br><br><br><br>


<script>

    function boton(numero){

    //var formulario = "form"+numero;
    //alert(formulario);

    //document.getElementById(formulario).submit();
        return botonFuera(); 
    }


    var enviando = false; //Obligaremos a entrar el if en el primer submit
    
    function botonFuera() {
        
        if (!enviando) {
    		enviando= true;
    		return true;
        } else {
            //Si llega hasta aca significa que pulsaron 2 veces el boton submit
            //alert("Espera... espera...");

            swal({
              title: "Un momento...",
              text: "Aún estamos realizando la reserva.",
              icon: "info",
              button: "VALE",
            });
            return false;
        }
    }

</script>

<div id="eject"></div>
<script>





  $(document).ready(function(){

    $('.scrollmenu').hScroll(); // You can pass (optionally) scrolling amount

/*.swal-overlay {
  background-color: rgba(43, 165, 137, 0.45);
}*/
  
   $(".basuraajax").click(function(evento){
      evento.preventDefault();
      swal("Un momento...", {
        
        button: false,
      });
      var u_id = $(this).attr('data-id');
      var u_email = $(this).attr('data-email');
      $("#eject").load('https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_delete_rapido/'+u_email+'/'+u_id)+'/no_retorno';
      var datadestino = 'https://v1.atlo.es/index.php/home/premium_clases?MENSAJE=_ACCION_REALIZADA_CORRECTAMENTE';
      $("#destino_principal").load(datadestino);
      
   });

 
    $(".ajaxForm").bind("submit",function(){
        // Capturamnos el boton de envío
        //var btnEnviar = $("#btnEnviar");
        swal("Un momento...", {
          
          button: false,
        });
        
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data:$(this).serialize(),
            beforeSend: function(){
                /*
                * Esta función se ejecuta durante el envió de la petición al
                * servidor.
                * */
                // btnEnviar.text("Enviando"); Para button 
                //btnEnviar.val("Enviando"); // Para input de tipo button
                //btnEnviar.attr("disabled","disabled");
            },
            complete:function(data){
                /*
                * Se ejecuta al termino de la petición
                * */
                //btnEnviar.val("Enviar formulario");
                //btnEnviar.removeAttr("disabled");
            },
            success: function(data){
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
                //$(".respuesta").html(data);
                var datadestino = 'https://v1.atlo.es/index.php/home/premium_clases?MENSAJE=_ACCION_REALIZADA_CORRECTAMENTE';
                $("#destino_principal").load(datadestino);
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                var datadestino = 'https://v1.atlo.es/index.php/home/premium_clases?MENSAJE_ERROR=_UPS_ALGO_HA_IDO_MAL';
                $("#destino_principal").load(datadestino);
            }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });
            


 });
  
</script>

</div>