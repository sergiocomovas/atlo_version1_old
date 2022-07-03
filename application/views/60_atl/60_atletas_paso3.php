
<?php //echo $clientes_email; ?>
<?php //echo $entocust_id; ?>
<?php //echo $entowod_id; ?>
<?php //echo $clientes_email; ?>
<?php //echo $entowod_timestamp; ?>
<?php //echo $entowod_titulo; ?>
<?php //echo $entowod_hero; ?>
<?php //echo $entowod_post; ?>
<?php //echo $post_rx; ?>
<?php //echo $post_kg; ?>
<?php //echo $post_secs; ?>
<?php //echo $post_reps; ?>
<?php  //echo $entocust_fecha; ?>



<script>
  $(document).ready(function(){ 
   
    $(".enlaceajax<?= $entowod_id ?>").click(function(evento){  
    

      
        evento.preventDefault();
        var wod = '#wod<?= $entowod_id ?>';
        var categoria = '#categoria<?= $entowod_id ?>';
        var minutos = '#minutos<?= $entowod_id ?>';
        var segundos = '#segundos<?= $entowod_id ?>';
        var rondas = '#rondas<?= $entowod_id ?>';
        var reps = '#reps<?= $entowod_id ?>' ;
        var kg = '#kg<?= $entowod_id ?>' ;
        $("#destinoPOP<?= $entowod_id ?>").html("<i class='text-center fas fa-circle-notch fa-spin'></i>");

        
        //$("#destino").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/6atl/atletas/paso4", {
            
            date_invent1: $(wod).val(),
            date_invent2: $(categoria).val(),
            date_invent3: $(minutos).val(),
            date_invent4: $(segundos).val(),
            date_invent5: $(rondas).val(),
            date_invent6: $(reps).val(),
            date_invent9: $(kg).val(),       
            date_invent0: '<?= $entocust_id ?>',  
            date_invent10: '<?= $entocust_fecha ?>',     
            date_invent7: $(this).attr('data-orden<?= $entowod_id ?>'), 
            date_invent8: $(this).attr('data-select<?= $entowod_id ?>')
            
            }, 
            
            function(respuesta){
				$("#destinoPOP<?= $entowod_id ?>").html(respuesta);
        //document.getElementById('selection'+select).disabled = true;
		})

        
    });
  
  })
 
  
</script>





<form id="form<?= $entowod_id ?>"  name="form<?= $entowod_id ?>">							
					

<div class="row">
    <div class="col-md-7">
        <div class="form-group">
          <label for="wod"><strong class="text-danger">Entrenamiento tipo <?php echo $entowod_clase; ?></strong></label>
          <textarea class="form-control border border-warning form-control-lg bg-warning" name="wod<?= $entowod_id ?>" id="wod<?= $entowod_id ?>" rows="9"><?php echo $entowod_descripcion; ?>
          

~~Mis~Pesos~(Kg):
...~~
          </textarea>
        </div>
    </div>

    <div class="col-md-5">
        <strong class="text-danger">TU RESULTADO</strong><br>

        <?php 
        
        if ($post_rx=="disabled"){echo "<i class='text-danger fas fa-times'></i> Sin Categoría<br>";}else{ ?>

            <div class="form-group">
              <label for="categoria">Categoría Custom:</label>
              <input type="text"
                class="form-control" value="0" readonly name="categoria<?= $entowod_id ?>" id="categoria<?= $entowod_id ?>" placeholder="RX">
              
            </div>
       
       
       <?php } ?>

       <?php 
        
        if ($post_secs=="disabled"){echo "<i class='text-danger fas fa-times'></i> Sin Tiempo<br>"; $dd=""; $ee="Introduce Reps:";}else{ ?>



        <?php 

        $dd="readonly='readonly' ";
        $ee="<small><a  href='javascript:void(0)' onclick='timecap(`form".$entowod_id."`)'>[ <ins>Pulsa para Time Cap</ins> ] - Introducir Reps</a></small>"; 
        
        if ( empty($post_sec) ){$init=0;}else{$init = $post_secs;}
        
        
        $hours = floor($init / 3600);
        $hm= $hours*60;
        $minutes = floor(($init / 60) % 60);
        $minutes = $minutes+$hm;
        $seconds = $init % 60;



        ?>

            <div class="form-group">
              <label for="tiempo" id="tiempo">Introduce Tiempo:</label>
              
              <div class="row pr-3">
              
              <div class="col-md-6">
              <span class="text-warning">Minutos</span>
                <input type="number"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                class="form-control border border-warning"  id="minutos<?= $entowod_id ?>" value="<?php echo $minutes; ?>" min="0" name="minutos" placeholder="999">
              </div>

              
              <div class="col-md-6">
              Segundos
                <input type="number"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                class="form-control" min="0" max="59" id="segundos<?= $entowod_id ?>" value="<?php echo $seconds; ?>" name="segundos<?= $entowod_id ?>"  placeholder="59">
              </div>
              </div>


              
            </div>
       
       
       <?php } ?>

       <?php 
        
        if ($post_reps=="disabled"){echo "<i class='text-danger fas fa-times'></i> Sin Reps<br>";}else{ ?>

            <div class="form-group">
              <label for="rondas"><?= $ee ?></label>

              <div class="row pr-3">

              <?php 

              $reps=substr($post_reps_value,-4);
              $rondas=substr($post_reps_value,0,-5);

              ?>
              
              <div class="col-md-6">
              <span class="text-warning">Rondas:</span>
                <input <?= $dd ?> type="number" min="0" max="9999"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                class="form-control border border-warning" onfocusout="editar('form<?= $entowod_id ?>','rondas<?= $entowod_id ?>')" id="rondas<?= $entowod_id ?>" value="<?php echo $rondas; ?>" name="rondas<?= $entowod_id ?>" >
              </div>

              
              <div class="col-md-6">
              Reps:
                <input <?= $dd ?> type="number" min="0" max="9999"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                class="form-control" onfocusout="editar('form<?= $entowod_id ?>','reps<?= $entowod_id ?>')"  value="<?php echo $reps; ?>" name="reps<?= $entowod_id ?>" id="reps<?= $entowod_id ?>" >
              </div>
              </div>
              
              
  
              
            </div>
       
       
       <?php } ?>

       <?php 
        
        if ($post_kg=="disabled"){echo "<br>";}else{ ?>

            <div class="form-group">
              <label for="kg">Introduce Kg <small>(Máx.)</small>:</label>
              <input type="number" 
              
              onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                


               min="0" max="999" step="1" 
                class="form-control" value="<?php echo $post_kg; ?>" name="kg<?= $entowod_id ?>" id="kg<?= $entowod_id ?>" placeholder="000">
              
            </div>
       
       
       <?php } ?>

       

    </div>


</div>


    <a 
      data-select<?= $entowod_id ?>="<?= $clientes_email ?>" 
      data-orden<?= $entowod_id ?>="<?= $entowod_id ?>"
      name="" 
      id="" 
      class="enlaceajax<?= $entowod_id ?> rounded-0 btn btn-block btn-warning" 
      href="#destinoPOP<?= $entowod_id ?>" 
      role="button">GUARDAR/<small>MODIFICAR RESULTADO</small></a>

</form>
<div id="destinoPOP<?= $entowod_id ?>"></div>

<script>
function editar(fff,nombre) {

  var oForm = document.forms[fff];

  var x = oForm.elements.namedItem(nombre);
 
  x.value = ('000' + x.value).slice(-4);

}

function timecap(fff){
 
  
  var oForm = document.forms[fff];
 
  oForm.elements.namedItem("segundos<?= $entowod_id ?>").value = 59;
  oForm.elements.namedItem("minutos<?= $entowod_id ?>").value = 9999;


  oForm.elements.namedItem("segundos<?= $entowod_id ?>").classList.add("bg-dark");
  oForm.elements.namedItem("minutos<?= $entowod_id ?>").classList.add("bg-dark");




  oForm.elements.namedItem("rondas<?= $entowod_id ?>").classList.add("bg-success");
  oForm.elements.namedItem("reps<?= $entowod_id ?>").classList.add("bg-success");


  oForm.elements.namedItem("rondas<?= $entowod_id ?>").placeholder = "0000";
  oForm.elements.namedItem("reps<?= $entowod_id ?>").placeholder = "0000";


  oForm.elements.namedItem("rondas<?= $entowod_id ?>").removeAttribute("readonly");
  oForm.elements.namedItem("reps<?= $entowod_id ?>").removeAttribute("readonly");

  


}
</script>