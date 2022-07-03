
<!-- Comprobaciones previas-->


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

?>


 <?php
    if ( isset($_GET['MENSAJE']) ){
  
      echo '
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <h1 class="text-light"><br>'.str_replace('_',' ',$_GET['MENSAJE']).'</h1>
  
                <p><a href="https://www.atlo.es/"> <i class="fas fa-redo"></i> Volver</a>
                </p>
  
                <p>
                Para incidencias ponte en contacto con el  
                <a href="mailto:sergio@mallorcainterbox.com"> equipo de soporte técnico</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    '; }
    ?>



<?php

date_default_timezone_set('Europe/Berlin');     
$fecha = date('Y-m-d');  

?>


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

<?php

//recibe ids fechas
//https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_hoy/103
$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_hoy/'.$hoy.'/';
$data = file_get_contents($url);
$ids_hoy = json_decode($data, true);
//print_r($ids_hoy);


//ids de lo que resta de esta semana
//https://v1.atlo.es/index.php/0rest/A_atlo_horario/esta_semana/manana/semana_actual
$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/esta_semana/'.$manana.'/'.$esta_semana;
$data = file_get_contents($url);
$ids_esta_semana = json_decode($data, true);
//print_r($ids_esta_semana);

//ids de fecha de la semana que viene 
 $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/semana_proxima/'.$proxima_semana;
$data = file_get_contents($url);
$ids_semana_proxima = json_decode($data, true);
//print_r($ids_semana_proxima);

?>


<!--Panel Lateral-->

<div id="mySidenav" style="overflow-y:hidden;" class="sidenav">

<a class="closebtn" href="#p_horario" onclick="closeNav()">&times;</a><br>

<div class="container" id="entreno_hoy">
    <h3>Entreno de Hoy</h3>
    <p>Información no disponible.</p>
</div>

<div class="container" id="entreno_manana">
    <h3>Entreno de Mañana</h3>
    <p>Información no disponible.</p>
</div>

<a name="" id="" onclick="closeNav()" class="btn btn-link btn-lg btn-block" href="#p_horario" role="button">Cerrar Menú</a>


</div>


<!--form comenzar-->

<a id="p_horario"></a>

<!--SCROLL A-->

<div class="scrollmenu" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 25px 0px 0px 0px; background-color:black;">


<table id="t1"><!--incio div tabla-->


<!--PRIMERA CELDA-->

<th  valign="top" style="color: #FFF; padding: 5px 5px 5px 5px; " >

<div class="container">

    <h3 id="roast2" style="padding: 5px;" class=""><i class="fas fa-ticket-alt"></i> Invitaciones</h3><br>




    <a href="https://v1.atlo.es/index.php/zonaprivada/login" class="btn btn-primary" role="button">Acceso Usuarios</a>

    


    <ul class="my-3" >
        <li class="my-3"><a href="#hoy">Hoy</a> | <a href="#entreno_hoy" onclick="openNav()"> Ver entreno</a></li>
        <li class="my-3"><a href="#manana1">Mañana</a> | <a href="#entreno_manana" onclick="openNav()"> Ver entreno</a></li>
        <li class="my-3"><a href="#semana_proxima">Siguiente semana</a></li>
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



foreach($ids_hoy as $x => $x_value) 
        
    {echo '
        <th valign="top" style="padding: 5px 5px 5px 5px; background-color: black;" >

        <div style="width:220px;" class="card text-justify">
        <div class="card-block p-1">
        <div class="card-header">Hoy 
        '.$x_value['dias_nom'].' '.date_format(date_create($x_value['dias_date']),"d/m").'
        
        </div>
        <div class="card-body">
        
        <form action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/main2/'.$x_value['dias_id'].'/" method="POST">
          
            <div class="form-group">

              <label>Escribe tu E-Mail:</label>
              <input id="email" name="email" type="email" class="form-control" placeholder="tu@correo.com" '.$valor_correo.' required="required">
              
            </div>


            <div class="form-group">
               <small><small class="text-muted form-text">¿Tienes un código? <abbr title="Los códigos de reserva o pases se usan para reservar una clase sin ser socio de Tarifa">[?]</abbr> </small></small>
              <input '.$valor_codigo.' id="codigo" name="codigo" type="number" max="999999999" min="110000" maxlength="9" class="form-control form-control-sm" placeholder="CÓDIGO">
             
            </div>

            <hr>

            <div class="form-group">
              <select name="clase" id="clase" onChange="enableSubmit(this,'.$x_value['dias_id'].')" class="custom-select">
              <option value="" selected disabled>Selecciona:</option>';

    //recibe las clases correspondientes (hoy)
    $url='https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_clases/'.$x_value['dias_id'];
    $data = file_get_contents($url);
    $clases_hoy = json_decode($data, true); 
    
    
    foreach($clases_hoy as $x => $x_value){
        echo'<option value="'.$x_value['clases_id'].'">'.$x_value['clases_hora'].' ('.$x_value['clases_tipo'].')</option>';
    }

    echo '
            </select>
            </div>
            
            
        </div>
        <div class="card-footer text-muted">
        
        <button disabled  type="submit" name="bot'.$x_value['dias_id'].'" class="btn text-uppercase btn-primary btn-sm btn-block">Reservar</button>

        </form>
        
        </div>
        </div>
        </div>

        </th>  
        ';
    }


//
//
//    
//recibe las clases correspondientes (esta semana)

echo '<th valign="top" style="border-radius: 25px 0px 0px 0px; margin:1; background-color:#C2185B;" ><br><div class="p-1

"style="width:100px;"> <i class="fa-xs fas fa-square"></i> Mañana <i class="fas fa-caret-right"></i></div></th><th style="background-color:#C2185B;" id="manana1"></th>';

foreach($ids_esta_semana as $x => $x_value) 
        
    {echo '
        <th valign="top" style="padding: 5px 5px 5px 5px; background-color: #C2185B;" >

        <div style="width:200px;" class="card text-justify">
        <div class="card-block p-1">
        <div class="card-header">
        '.$x_value['dias_nom'].' '.date_format(date_create($x_value['dias_date']),"d/m").'
        
        
        </div>
        <div class="card-body">
          
        
        <form action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/main2/'.$x_value['dias_id'].'/" method="POST">
          
            <div class="form-group">

              <label>Escribe tu E-Mail:</label>
              <input id="email" name="email" type="email" class="form-control" placeholder="tu@correo.com" '.$valor_correo.' required="required">
              
            </div>


            <div class="form-group">
               <small><small class="text-muted form-text">¿Tienes un código? <abbr title="Los códigos de reserva o pases se usan para reservar una clase sin ser socio de Tarifa">[?]</abbr> </small></small>
              <input '.$valor_codigo.' id="codigo" name="codigo" type="number" max="999999999" min="110000" maxlength="9" class="form-control form-control-sm" placeholder="CÓDIGO">
             
            </div>

            <hr>

            <div class="form-group">
              <select name="clase" id="clase" onChange="enableSubmit(this,'.$x_value['dias_id'].')" class="custom-select">
              <option value="" selected disabled>Selecciona:</option>';

    //recibe las clases correspondientes (esta semana)
    $url='https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_clases/'.$x_value['dias_id'];
    $data = file_get_contents($url);
    $clases_hoy = json_decode($data, true); 
    
    
    foreach($clases_hoy as $x => $x_value){
        echo'<option value="'.$x_value['clases_id'].'">'.$x_value['clases_hora'].' ('.$x_value['clases_tipo'].')</option>';
    }

    echo '
            </select>
            </div>
            
        </div>
        <div class="card-footer text-muted">
        
        <button disabled type="submit" name="bot'.$x_value['dias_id'].'" class="btn text-uppercase btn-primary btn-sm btn-block">Reservar</button>

        </form>
        
        </div>
        </div>
        </div>

        </th>  
        ';
    }

//
//    
//recibe la próxima semana

echo '<th style="width:150px;" id="semana_proxima" style="border-radius: 0px 0px 0px 0px; margin:1;"  valign="top"><br><i class="fas fa-ellipsis-h"></i> Próxima semana </th>';


//$ids_semana_proxima as $x => $x_value
//echo '<th ></th>';

foreach($ids_semana_proxima as $x => $x_value) 
        
{echo '
    <th valign="top" style="padding: 5px 5px 5px 5px; background-color: #880E4F;" >

    <div style="width:200px;" class="card text-justify">
    <div class="card-block p-1">
    <div class="card-header">
    '.$x_value['dias_nom'].' '.date_format(date_create($x_value['dias_date']),"d/m").'
    
    
    </div>
    <div class="card-body">
      
    
    <form action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/main2/'.$x_value['dias_id'].'/" method="POST">
      
        <div class="form-group"> 

          <!--proxima semana-->
          <label>Escribe tu E-Mail:</label>
          <input id="email" name="email" type="email" class="form-control" placeholder="tu@correo.com" '.$valor_correo.' required="required">
          
        </div>


        <div class="form-group">

           <small><small class="text-muted form-text">¿Tienes un código? <abbr title="Los códigos de reserva o pases se usan para reservar una clase sin ser socio de Tarifa">[?]</abbr> </small></small>
          <input '.$valor_codigo.' id="codigo" name="codigo" type="number" max="999999999" min="110000" maxlength="9" class="form-control form-control-sm" placeholder="CÓDIGO">
         
        </div>

        <hr>

        <div class="form-group">
          <select name="clase" id="clase" onChange="enableSubmit(this,'.$x_value['dias_id'].')" class="custom-select">
          <option value="" selected disabled>Selecciona:</option>';

//recibe las clases correspondientes (hoy)
$url='https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_clases/'.$x_value['dias_id'];
$data = file_get_contents($url);
$clases_hoy = json_decode($data, true); 


foreach($clases_hoy as $x => $x_value){
    echo'<option value="'.$x_value['clases_id'].'">'.$x_value['clases_hora'].' ('.$x_value['clases_tipo'].')</option>';
}

echo '
        </select>
        </div>
        
    </div>
    <div class="card-footer text-muted">
    
    <button disabled type="submit" name="bot'.$x_value['dias_id'].'" class="btn text-uppercase btn-primary btn-sm btn-block">Reservar</button>

    </form>
    
    </div>
    </div>
    </div>

    </th>  
    ';
}


//fin

?>

<!-- FIN CARD LUNES -->
<!--CARD LUNES-->

<th valign="top" style="width: 400px; padding: 5px 5px 5px 5px; background-color: #F41234;" >

    <div class="alert alert-primary" role="alert">
        <strong>Servicio de reservas en Pruebas</strong>
    </div>

</th>  <!--fin ROW--> 

<!-- FIN CARD LUNES -->
<!--ÚLTIMA CELDA-->

<th  valign="top" style="width: 300px; padding: 5px 5px 5px 5px; color:red; background-color:black;" >
<div class="container">


<div>  <!--importante <input type="hidden" name="charset" value="utf-8"> -->     


</th>

<!--FIN ÚLTIMA CENDA-->
<!-- FIN CARD SÁBADO -->

</table></div><!--fin div tabla-->
<!--form comenzar-->


