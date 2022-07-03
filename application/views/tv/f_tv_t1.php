

<?php

$now = ' XX ';
$act = ' -- ';

try {


$url = 'https://opendata.aemet.es/opendata/api/observacion/convencional/datos/estacion/B278/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjYXR4bzk5QGdtYWlsLmNvbSIsImp0aSI6ImY5Y2ViOWFlLTY5YTMtNDJkNC04YjQ4LWFjOTVjZGE5NjcwNiIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNTU3NDI2MzY3LCJ1c2VySWQiOiJmOWNlYjlhZS02OWEzLTQyZDQtOGI0OC1hYzk1Y2RhOTY3MDYiLCJyb2xlIjoiIn0.AxdEkaYJwhJ-dZOCRl2bdDnMrode8rQOPUbQ_FQ_7hg';
$data = file_get_contents($url);
$eltiempo = json_decode($data);
$url=$eltiempo->datos;
$data1=file_get_contents($url,0,null,null);

$data2=$data1;



//$eltiempo_ahora = json_decode($data1, true);



$json = json_decode($data2);


$eltiempo_ahora = array_reverse($json);






if (isset($eltiempo_ahora[0]->ta)){$now = $eltiempo_ahora[0]->ta;}
if (isset($eltiempo_ahora[0]->fint)){$act = $eltiempo_ahora[0]->fint;}



}

catch(Exception $e) {
    //echo 'Error: ' .$e->getMessage();
  }





?>


<H1 class="text-center text-primary">TEMPERATURA AHORA</H1>
<H1 class="text-center text-primary"><big><big><big><big><big><?= $now?>ºC*</big></big></big></big></big></h1>


<div class="text-center">
<?php



$mensaje = "";



if ($now<20){$mensaje = "";} 
if ($now>=20){$mensaje = "<p>La temperatura es agradable. :) Hidrátate y disfruta del entreno.</p>";} 
if ($now>=25){$mensaje = "
    
    <div class='rounded p-3 m-2 bg-primary border border-warning text-light'>AVISO: LA TEMPERATURA ES CÁLIDA<br><h4> ¡Detente a beber siempre que lo necesites! </h4></div>        
    
    
    ";} 
if ($now>=30){$mensaje = "
    
    <div class='animated rounded infinite pulse slow delay-2s p-3 m-2 bg-secondary text-light'><strong class='text-warning'>ALERTA POR ALTA TEMPERATURA</strong><br><h3> POR FAVOR, HIDRÁTATE CONTINUAMENTE Y NO TE SOBRE-ESFUERCES. SI TE MAREAS DEJA DE ENTRENAR E INFORMA A TU COACH.</h3></div>    
    
    ";}
echo $mensaje; 
?> 
</div>

<p class="text-center">*Datos facilitados por el último boletín de la AEMET.</p> 
<p class="text-center"><small><small><small> <?= $act ?> </small></small></small></p>

<script>


$(document).ready(function(){

 


    $("#fondo-color").removeClass("bg-primary");
    //$("#fondo-color").css({"background-color": "#0C090A"});

    

    $("#fondo-color").css({"background-image": "url(https://v1.atlo.es/00_img/fondo_eltiempo.jpg)"});  
   

   
});

</script>