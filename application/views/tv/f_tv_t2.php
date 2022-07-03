
<?php

$now= ' XX ';
$desc = ' -- ';
$icono = ' XX ';
$ciudad = ' -- ';
$dt = ' -- ';

try {


$url = 'http://api.openweathermap.org/data/2.5/weather?q=Palma,es&APPID=69c5141128b64223faa1df3e74a6792b&units=metric&lang=es';
$data = file_get_contents($url);


$eltiempo = json_decode($data);


//print_r($eltiempo);

//$eltiempo_ahora = json_decode($data1, true);



if (isset($eltiempo->main->temp ))
    {$now = $eltiempo->main->temp ;}

if (isset($eltiempo->weather[0]->description ))
    {$desc = $eltiempo->weather[0]->description;}

if (isset($eltiempo->weather[0]->icon ))
    {$icono = $eltiempo->weather[0]->icon;}

if (isset($eltiempo->name ))
    {$ciudad = $eltiempo->name;}

if (isset($eltiempo->dt ))
    {$dt = $eltiempo->dt ;}

    
if (isset($eltiempo->main->humidity ))
{$humidity = $eltiempo->main->humidity ;}




}

catch(Exception $e) {
    //echo 'Error: ' .$e->getMessage();
  }





?>


<H1 class="text-center text-primary text-uppercase"><?= $ciudad ?> ahora</H1>
<H1 class="text-center text-primary"><big><big><big><big><big><?= $now?>ºC</big></big></big></big></big></h1>


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

<p class="text-center text-uppercase"><?= $desc ?> <img src="https://openweathermap.org/img/w/<?= $icono?>.png"> - Humedad: <?= $humidity ?>%</p> 
<p class="text-center"><small><small><small> <?= $dt ?> - Datos proporcionados por OpenWeather. </small></small></small></p>

<script>


$(document).ready(function(){

 


    $("#fondo-color").removeClass("bg-primary");
    //$("#fondo-color").css({"background-color": "#0C090A"});

    

    $("#fondo-color").css({"background-image": "url(https://v1.atlo.es/00_img/fondo_prueba.jpg)"
    
        , "background-size": "1400px"
    
    });  
   

   
});

</script>