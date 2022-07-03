<!--ajax-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<script>


  $(document).ready(function(){ 
   
    $(".enlaceajax").click(function(evento){  
    
        evento.preventDefault();
        var select = $(this).attr('data-select');
        var invent = '#selection'+select;
        var invent2 = '#select'+select; 
        var invent4 = '#entonum'+select;

        document.getElementById('boton'+select).classList.add('disabled');
        
        //$("#destino").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/0rest/A_atlo_guardar_wod_izquierda", {
            
            date_invent: $(invent).val(),
            date_invent2: $(invent2).val(),
            date_invent3: $(invent4).val(),
            dia_id: $(this).attr('data-dia-id'), 
            orden_num: $(this).attr('data-orden'), 
            date_select: $(this).attr('data-select')}, 
            
            function(respuesta){
				$("#destino").html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
		})

        
    });
  })
 
  
</script>

<!-- fin ajax-->

<?php 

  //recibe los parámetros de fecha
  $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_fecha';
  $data = file_get_contents($url);
  $fechas_parametros = json_decode($data, false);

  $semana=$fechas_parametros->dias_semana;

  $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/semanas/'.$semana;
  $data = file_get_contents($url);
  $datos_semana = json_decode($data, false);

  $url = 'https://v1.atlo.es/index.php/0rest/A_ento/historial_completo/';
  $data = file_get_contents($url);
  $datos_historico= json_decode($data, false);


?>

   <!--<textarea name="hide" style="display:none;">-->
        <?php 

        $resultado = ""; 

        /*
        foreach ($datos_historico as $index => $valor) {
      
            
            $resultado = $resultado.'
'.$valor->entowod_descripcion.'


';
          
        }*/
        ?>


<div class="" style="width:99%;" >

    <div class="container-fluid m-1" >
      <div class="row" style="height:85%;">

        <div class="col-md-1" >
        
        <button type="button" name="" id="" class="btn btn-primary btn-sm btn-block">F1</button>
        <button type="button" name="" id="" class="btn btn-primary btn-sm btn-block">F2</button>
        <button type="button" name="" id="" class="btn btn-primary btn-sm btn-block">F3</button>

        <a name="" id="" class="btn btn-link btn-sm btn-block" href="https://v1.atlo.es/index.php/texto/tabla_entrenos/202/203/204/205/206" role="button">F4</a>

        </div>


        <div class="col-md-4">

            <div class="input-group">

              
              <textarea type="text" class="form-control form-control-lg" rows="10" cols="80" id="input"><?= $resultado ?></textarea>

              
            </div>

        
        <BR>COPIAR HISTORICO
        
        </div>

        <div class="col-md-1" style="height:100%; overflow:auto;">

            <p style="font-size: small;" >

                <?php foreach ($datos_semana as $index => $valor) {

                    

                    if ($valor->dias_id==$fechas_parametros->dias_id){echo "<i class='fas fa-arrow-circle-down'></i> HOY ";}
                    
                    echo "<a href='#".$valor->dias_id."'>";

                    echo mb_substr($valor->dias_nom,0,2,'UTF-8')."-".date_format(date_create($valor->dias_date),"d")."<small><br><br></small>";

                    echo "</a>";
                }?>
                
              

            </p>

        </div>

        <div class="col-md-4" style="height:100%; overflow:auto !important;">


            <?php foreach ($datos_semana as $indice => $valor) { ?>

            <br>
            <br>
            <div id="<?= $valor->dias_id ?>"> </div>

            <h3 class="py-3"><?= $valor->dias_date ?>, <?= $valor->dias_nom ?><hr></h3>

            <?php $sum = 0;
            for($i = 1; $i<=5; $i++){ 
            
                if ($i == 5){ $color_casilla = 'style="background-color:#FDEBD0;"';}else{$color_casilla="";}

            //{$sum = $sum + $i;}?>

             <button class="btn btn-link btn-sm" onclick="copySelected('selection<?= $valor->dias_id ?><?= $i?>')"><i class="far fa-copy"></i> Copiar <?= mb_substr($valor->dias_nom,0,2,'UTF-8') ?> <?=date_format(date_create($valor->dias_date),"d/m")?> </button> <kbd>en <?= $i?> /5</kbd>
            <p class="float-right m-1">

            <?php
            
            $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_guardar_wod_izquierda/ento/'.$valor->dias_id.'/'.$i;
            
            $data = file_get_contents($url);
            
            $datos_entreno= json_decode($data, false);

            $frase='';

            if ( isset($datos_entreno->entowod_descripcion) ){  $entreno_desc= $datos_entreno->entowod_descripcion; $frase='<option value="x">'.$datos_entreno->entowod_clase.'</option>'; }else{ $entreno_desc=''; }

            if ( isset($datos_entreno->entowod_id) ){  $entreno_id= $datos_entreno->entowod_id; }else{ $entreno_id=''; }
            
            ?>

                <select style="width: 100px" id="select<?= $valor->dias_id ?><?= $i?>" name="carlist" form="carform">


                    <?php echo $frase;?>

                    <option value="a">Sin valorar</option>
                    <option value="b">Foco: +Fuerza (kg)</option>
                    <option value="c">Foco: +Rondas (rx, reps)</option>
                    <option value="d">Foco: +Corto (rx, segundos, reps)</option>
                    <option value="e">General: (rx, kg, segundos, reps)</option>
                    <option value="f">eXtra</option>
               
                </select>

            </p>

            

            <div class="input-group">
               
                <textarea <?= $color_casilla ?> class="form-control form-control-xs" rows="5" cols="10" id="selection<?= $valor->dias_id ?><?= $i?>"><?= $entreno_desc ?></textarea>
                
                 
                <div class="input-group-append">

                    <a  class="enlaceajax btn btn-primary" 
                        href="#" 
                        role="button"
                        id="boton<?= $valor->dias_id ?><?= $i?>" 
                        data-dia-id="<?= $valor->dias_id ?>" 
                        data-orden="<?= $i?>"  
                        data-select="<?= $valor->dias_id ?><?= $i?>"                    
                        >

                        <i class="py-1 far fa-save"></i>


                    </a>

                </div>

                
            </div>

            

            <input type="text" readonly style="background-color: #111111; border: none;"
                class="form-control form-control-sm" value="<?= $entreno_id ?>" id="entonum<?= $valor->dias_id ?><?= $i?>">
            
            
            <br>

             <?php }}?>
             

            <input type="button" class="btn m-1" onclick="copySelected('selection2')" value="copy in 1">

            <textarea class="form-control form-control-xs" rows="5" cols="80" id="selection2"></textarea><br>  

            <input type="button" onclick="copySelected('selection3')" value="copy in 1">

            <textarea  class="form-control form-control-lg" rows="5" cols="80" id="selection3"></textarea><br>  



        </div>



        
        
        <div style="color:green;" class="col-md-2">
            <i class="fas fa-terminal"></i>
            
            
            <div id="destino"> </div>

      </div>
    </div>

</div>


<script>


//document.getElementById("demo").innerHTML = "Hello JavaScript!";

function getSelectedText(el) {
    if (typeof el.selectionStart == "number") {
        return el.value.slice(el.selectionStart, el.selectionEnd);
    } else if (typeof document.selection != "undefined") {
        var range = document.selection.createRange();
        if (range.parentElement() == el) {
            return range.text;
        }
    }
    return "";
}

function copySelected(pollas) {
    var srcTextarea = document.getElementById("input");
    var destTextarea = document.getElementById(pollas);
    destTextarea.value = getSelectedText(srcTextarea);
}

</script>

