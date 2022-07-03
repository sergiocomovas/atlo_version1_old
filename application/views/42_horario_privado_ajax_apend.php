
<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session'); ?>

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

//DATOS DEL USUARIO--
//ZONA PRIVADA--

$cliente= $this->session->userdata('username');
$usuario = $this->session->userdata('username');

$usuario = str_replace("@",".aaaaaaaaaa.",$usuario);

$url =base_url().'index.php/zonaprivada/json_usuario/'.$usuario;
$data = file_get_contents($url);
$clientes = json_decode($data, false);

?>


<?php


foreach($ee as $x => $x_value){

    echo '<th name="clases_especiales" id="clases_especiales" style="padding: 0px 0px 0px 0px; background-color:rgba(136,14,79,1);"></th>';

    echo'<th valign="top" style="padding: 5px 5px 5px 5px; background-color:rgba(136,14,79,1);">';
    
    echo'<div style="width:350px;" class="card text-justify">';
    echo'<div class="card-block p-1">';
    echo'<div style="background-color:#ff5733; important!" class="card-header text-white">'; 


    
    echo'<div class="media m-0">
    <img class="mr-1 rounded-circle border-white img-fluid" width="30%" src="https://atlo.es/barbellclub/tarifaclub/assets/img/aaa_temporada.png" alt="Especial">
    
    <div class="media-body">
      

        <h6 class="text-center border-bottom m-0 p-0"><small>'.$x_value['dias_nom'].
        ' <small>'.substr($x_value['dias_date'],3,2).'/'.substr($x_value['dias_date'],0,2).'/'.substr($x_value['dias_date'],6,2).'<br></small></small></h6>  
        
        <h6 class="mt-0">'.$x_value['clases_tipo'].'<br><span class="float-right border border-white">'.
            substr($x_value['clases_hora'],0,5).'
             H.</span>
        </h6>
    </div>
    </div></div>';
 
       
    
    echo'<div class="card-body bg-primary">';

    echo '<div class="m-0 p-0 row"><div class="col">Detalles:</div><div class="col">Asistentes:</div></div>';
    echo '<div class="row">';
    echo'<div class="col m-0 pr-1 " style="
    height: 165px;
    overflow: auto;"><small>'.$x_value['clases_detalles'].'</small></div>';
    echo'<div class="col m-0 pl-1" style="
    height: 165px;
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

    echo '</div>'; //DEL ROW
    
    echo'</div>';
    
    echo'<div  style="padding-bottom: 0px;" class="card-body">';
    
    
    ///https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_estas/catxo99@gmail.com/611
    
    $url =base_url().'index.php/0rest/A_atlo_reservas/def_lista_estas/'.$cliente.'/'.$x_value['clases_id'];
    
    $datax = file_get_contents($url);
    
    //$lista_clase = json_decode($data, true);
    
    if ($datax=='null'){
    
    echo '
      
      <form target="_blank" class="ajaxForm" action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_diario/sin_retorno" method="POST">
    
      <input type="hidden" class="form-control" name="listas_cont" id="" aria-describedby="helpId" value="+1">
    
      <input type="hidden" class="form-control" name="qf" id="" aria-describedby="helpId" value="FALSE">
    
      <input type="hidden" class="form-control" name="clientes_id" id="" aria-describedby="helpId" value="'.$this->session->userdata('username').'">
    
      <input type="hidden" class="form-control" name="clases_id" id="" aria-describedby="helpId" value="'.$x_value['clases_id'].'">
    
      <input type="hidden" class="form-control" name="dias_id" id="" aria-describedby="helpId" value="'.$x_value['dias_id'].'">
    
      <input type="hidden" class="form-control" name="listas_data1" id="" aria-describedby="helpId" value="'.$clientes->clientes_nombrepublico.'">
    
      <input type="hidden" class="form-control" name="listas_data2" id="" aria-describedby="helpId" value="'.substr($x_value['clases_hora'],0,5).' '.$x_value['clases_tipo'].', '.$clientes->clientes_nombrepublico.'">
    
      <input type="hidden" class="form-control" name="listas_data3" id="" aria-describedby="helpId" value="'.$fechas_parametros['dias_semana'].'">
    
      <input type="hidden" class="form-control" name="listas_data4" id="" aria-describedby="helpId" value="¤¤">
    
      <input type="hidden" class="form-control" name="retorno" id="" aria-describedby="helpId" value="'.current_url().'">
    
      <button type="submit"  id="b.'.$x_value['clases_id'].'" onclick="return botonFuera();" class="btn btn-secondary btn-lg btn-block">¡Asistir!</button>
      
    
      </form>
    ';
    
    }else{
    
        echo '
      
      <form class="ajaxForm" action="https://v1.atlo.es/index.php/0rest/A_atlo_reservas/def_lista_cancelar/sin_retorno" method="POST">
    
      <input type="hidden" class="form-control" name="listas_cont" id="" aria-describedby="helpId" value="+1">
    
      <input type="hidden" class="form-control" name="qf" id="" aria-describedby="helpId" value="FALSE">
    
      <input type="hidden" class="form-control" name="clientes_id" id="" aria-describedby="helpId" value="'.$this->session->userdata('username').'">
    
      <input type="hidden" class="form-control" name="clases_id" id="" aria-describedby="helpId" value="'.$x_value['clases_id'].'">
    
      <input type="hidden" class="form-control" name="dias_id" id="" aria-describedby="helpId" value="'.$x_value['dias_id'].'">
    
      <input type="hidden" class="form-control" name="listas_data1" id="" aria-describedby="helpId" value="'.$clientes->clientes_nombrepublico.'">
    
      <input type="hidden" class="form-control" name="listas_data2" id="" aria-describedby="helpId" value="'.substr($x_value['clases_hora'],0,5).' '.$x_value['clases_tipo'].', '.$clientes->clientes_nombrepublico.'">
    
      <input type="hidden" class="form-control" name="listas_data3" id="" aria-describedby="helpId" value="'.$fechas_parametros['dias_semana'].'">
    
      <input type="hidden" class="form-control" name="listas_data4" id="" aria-describedby="helpId" value="¤¤">
    
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

    echo '<td valign="top">';

    $datos_e['cliente'] = $cliente; 
    $datos_e['nombre'] = $clientes->clientes_nombrepublico; 
    $this->load->view('home2/form_ajax',$datos_e);
    

    echo '</td>';
    
    
    echo '<th style="padding: 0px 0px 0px 0px; background-color:rgba(136,14,79,1);"></th>';