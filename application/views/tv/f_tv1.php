<!-- buena-->



<!--arriba invent, ver más abajo: bueno-->



<?php 
$random = rand (0,1); 

if ($random == 1){

    $inverse = '';

}else{

    $inverse = 'order-last';
}


?> 



<div style="overflow:hidden;"  class="animated fadeOut slow delay-58s">
<div style="overflow:hidden;" class="h-100 animated fadeIn row" >

    <div id="fondo-color" id="lista_eventos" class="col-lg-7  bg-primary <?= $inverse ?>">
<!--grand-->
    <?php
    
    date_default_timezone_set('Europe/Madrid'); 
    $hora= date ("H");
    $minutos = date("i");
    $actual_hora = new DateTime(date("H:i"));

    //02-11-19
    $fecha = date ("m-d-y");

    
    ?>
 <h1 class="text-center mt-2">
    <big><big><big><big id="reloj">
   <?= $hora ?><span class="parpadeo flash">:</span><?= $minutos?>
    </big></big></big></big>
        </h1> 


    <!--carrusel-->

    <div class="container animated fadeIn slow delay-1s">
        
 
    <?php 
         $coso = mt_rand (0,20); 

        //echo "TV1= bueno.";

        switch ($coso) {
            case 0:
                //cuidar el material
                $this->load->view('tv/f_tv_o5');
                break;
            case 1:
                //cuidar el material
                $this->load->view('tv/f_tv_o5');
                break;
            case 2:
                //horario sábado
                $this->load->view('tv/f_tv_o3');
                break;
            case 3:
                //registrate sin pin
                $this->load->view('tv/f_tv_o4');
                break;
            case 4:
                //sf3
                $this->load->view('tv/f_tv_o13');
                break;
            case 5:
                //ROAST
                $this->load->view('tv/f_tv_r1');
                break;
            case 6:
                //PROPAGANDA QUEEN
                $this->load->view('tv/f_tv_a2');
                break;
            case 7:
                //PROPAGANDA QUEEN
                $this->load->view('tv/f_tv_a1');
                break;
            case 8:
                //EL TIEMPO
                $this->load->view('tv/f_tv_t2');
                break;
            case 9:
                //EL TIEMPO
                $this->load->view('tv/f_tv_t2');
                break;
            case 10:
                //ROAST
                $this->load->view('tv/f_tv_r1');
                break;
            case 11:
                //TIEMPO
                $this->load->view('tv/f_tv_t2');
                break;
            case 12:
                //ATLO CAFE
                $this->load->view('tv/f_tv_o11');
                break;
            case 13:
                //EL_TIEMPO
                $this->load->view('tv/f_tv_r1');
                break;
            case 14:
                //INSTAGRAM
                $this->load->view('tv/f_tv_o15');
                break;    
            case 15:
                //ATLO PRIMER AÑO
                $this->load->view('tv/f_tv_o16');
                break;     
            case 16:
                //EL TIEMPO
                $this->load->view('tv/f_tv_r1');
                break;   
            case 17:
                //EL TIEMPO
                $this->load->view('tv/f_tv_r1');
                break;  
            case 18:
                //ROAST
                $this->load->view('tv/f_tv_r1');
                break; 
            case 19:
                //ROAST
                $this->load->view('tv/f_tv_b1');
                break; 
            case 20:
                //ROAST
                $this->load->view('tv/f_tv_b2');
                break; 
     

            default:
                //ROAST
                $this->load->view('tv/f_tv_r1');
                break;
                        
        }

       


    ?> 

    </div>

    <!--fin carrusel-->

    </div>
    <div class="col-lg-5" id="lista_personas">
    <div class="container">


    <?php

    //buscar el id de la clase
    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_tv/clase_actual';
    $data = file_get_contents($url);
    $clase_actual = json_decode($data, false);

    if (is_null($clase_actual)){echo 'Buenos días';$next_next = TRUE;}else{
        $next_next = TRUE;
    $clase_actual_hora = new DateTime (substr($clase_actual->clases_hora,0,5));

    echo "<h1 class='mt-3'>Clase de las ".substr($clase_actual->clases_hora,0,5).".</h1>";

    $dateInterval2 = $actual_hora->diff($clase_actual_hora);
    $var1 = intval($dateInterval2->format('%H'))*60;
    $var2 = intval($dateInterval2->format('%i'));

    $burpees = ($var1+$var2)*3;

    
    if ($burpees < 50){echo "<h6 style='-webkit-animation-duration: 10s; animation-duration: 10s;' class='bg-light border border-primary blockquote text-center p-1 text-secondary parpadeo flash'>Burpeemetro = ".$burpees.".</h6>";$next_next = FALSE;}

    ?>

    

    <div id="caja">

    <?php 
    
    $url =base_url().'index.php/0rest/A_atlo_reservas/def_lista_lista/'.$clase_actual->clases_id;
    $data = file_get_contents($url);
    $lista_clase = json_decode($data, true);
    $valor_local = 0;

    foreach($lista_clase as $y => $y_value){

        $valor_local = $valor_local + $y_value['listas_cont']; 
        echo '
            <div class="media m-3">
                <img style="max-width: 80px;"; class="mr-1 border-white img-fluid align-self-start rounded" src="https://api.adorable.io/avatars/80/'.$y_value['clientes_id'].'.png" alt="Generic placeholder image">

                <div class="mt-2 media-body">
                <h3 class="text-uppercase mt-0 d-inline-block text-truncate">'.$y_value['listas_data1'].'<pre class="text-secondary">'.$y_value['listas_autodate'].'</pre></h3>
                
                </div>
            </div>

            ';
    }
}//del else
    ?>

    <hr>

    <?php 

    
    
$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_tv/clase_siguiente';
$data = file_get_contents($url);
$clase_siguiente = json_decode($data, false);

if (is_null($clase_siguiente)){echo "<h6>Hoy no hay más clases. <br> <small> Síguenos en instagram: <span class='text-primary'>@atlobarbellclub</span></small></h6>";}else{

    $clase_siguiente_hora = new DateTime(substr($clase_siguiente->clases_hora,0,5));

    $dateInterval = $actual_hora->diff($clase_siguiente_hora);
    if ($next_next == TRUE){echo $dateInterval->format('<p class="text-center">Siguiente clase en %H hora/s %i minuto/s.</p>');}    
    

    }



?>


    <br>
    </div>


        
</div>
</div>
</div>


<!-- ticker animated fadeInRight fast delay-2s-->


<div class="ticker-wrap ">
<div class="ticker">
  <div class="ticker__item text-primary">
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
  <strong>ATLO TRAINING PROGRAM</strong>
 
      </div>
  <div class="ticker__item text-primary"><?php 

$entreno="1";
if (isset($clase_actual->dias_id)){$entreno = $clase_actual->dias_id;}
if (isset($clase_siguiente->dias_id)){$entreno = $clase_siguiente->dias_id;}


    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_tv/extra/'.$entreno;
    $data = file_get_contents($url);
    $extra = json_decode($data, false);

    if (isset($extra->entowod_descripcion))
        { $coso1= $extra->entowod_descripcion; }else{$coso1 = "";}

    $extra = str_replace('\"','\'',$coso1);
    echo str_replace(array("\r\n","\r","\n")," -- ", $extra);

?></div>


  


  <div class="ticker__item text-secondary">WWW.ATLO.ES</div>
  <div class="ticker__item h6">@atlobarbellclub <i class="fab fa-instagram"></i> </div><!--
  <div class="ticker__item">Letterpress chambray brunch.</div>
  <div class="ticker__item">Vice mlkshk crucifix beard chillwave meditation hoodie asymmetrical Helvetica.</div>
  <div class="ticker__item">Ugh PBR&B kale chips Echo Park.</div>
  <div class="ticker__item">Gluten-free mumblecore chambray mixtape food truck. </div>
  <div class="ticker__item">Authentic bitters seitan pug single-origin coffee whatever.</div>-->
</div>
</div>

<!-- fin -->

</div>




    

<script>

$( document ).ready(function() {

    $("#crrc > div:gt(0)").hide();

    setInterval(function() {
    $('#crrc > div:first')
        .fadeOut(0000)
        .next()
        .fadeIn(2000)
        .end()
        .appendTo('#crrc');
    }, 10000);

    console.log( "CAJA" );
    var coso = ($("#caja").height());

    //$("p").css({"background-color": "yellow", "font-size": "200%"});
    $("#caja").css({"height": "78%", "overflow":"scroll", "overflow-y":"hidden", "overflow-x":"hidden"});
    
    
    $("#caja").animate({ scrollTop: coso }, 25000, function() {
    $(this).animate({ scrollTop: 0 }, 15000);
    
});


    
});


</script>


