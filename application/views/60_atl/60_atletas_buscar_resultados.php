<script>
$(document).ready(function(){ 

  $('#search-highlight').hideseek({
    highlight: true,
    nodata: "No hay resultados.",
    ignore_accents: true,
    ignore: ".ignorar",
    min_chars:      2
	});
   
   $(".enlaceajaxFAV").click(function(evento){  

    
       evento.preventDefault();
       var datadestino = $(this).attr('data-destino');
       
       //$("#destino").load("contenido-ajax.html");
       $.get("https://v1.atlo.es/index.php/6atl/atletas/marcar_fav", {
           
           date_select: $(this).attr('data-destino') }, 
           function(respuesta){
               
               $('#destinof' +datadestino).html(respuesta);
               
               //document.getElementById('selection'+select).disabled = true;
       })
   });
})
</script>


<script>
$(document).ready(function(){ 
   
   $(".enlaceajaxVISTO").click(function(evento){  

    
       evento.preventDefault();
       var datadestino = $(this).attr('data-destino');
       
       //$("#destino").load("contenido-ajax.html");
       $.get("https://v1.atlo.es/index.php/6atl/atletas/marcar_visto", {
           
           date_select: $(this).attr('data-destino') }, 
           function(respuesta){
               
               $('#destino' +datadestino).html(respuesta);
               
               //document.getElementById('selection'+select).disabled = true;
       })
   });
})
</script>


<script>
$(document).ready(function(){ 
   
   $(".enlaceajaxBASURA").click(function(evento){  

    
       evento.preventDefault();
       var r = confirm("¿Deseas eliminar este registro?");
       var datadestino = $(this).attr('data-destino');
       if (r == true) {

       //$("#destino").load("contenido-ajax.html");
       $.get("https://v1.atlo.es/index.php/6atl/atletas/marcar_basura", {
           
           date_select: $(this).attr('data-destino') }, 
           function(respuesta){
               
               $('#destinob' +datadestino).html(respuesta);
               
               //document.getElementById('selection'+select).disabled = true;
       })
       }else{$('#destinob' +datadestino).html("Marcar como Basura (Cancelado)");}
   });
   
})
</script>


<div class="container" id="asd"> <!--container-->

<label for="search-highlight">Entrenamientos Almacenados:</label>

<input class="form-control"
 id="search-highlight" name="search-highlight" placeholder="Busca aquí..." type="text" data-list=".highlight_list<?php echo $numero=rand(0,9999); ?>" autocomplete="off"><hr>

<ol class="list-group highlight_list<?= $numero;?>" >
<?php foreach ($data as $item):?>


<li>
<?php if($item->entocust_visto == 0){?><small><span class="mb-1 badge badge-pill badge-success">Nuevo</span></small><?php } ?>


<?php echo $item->entowod_clase;?>  <?php echo $item->entocust_fecha;?> <br>

  
 
<details>


  <summary class="d-inline-block text-truncate" style="max-width: 90%;">
    <?= $item->entowod_descripcion;?>
  </summary>



  <div class="ml-1"><p class="pl-2 text-muted border-left"><!--border-->
  <?= nl2br($item->entowod_descripcion);?>
  
  
  <div class="row ignorar">
  
        <?php if($item->entocust_visto == 0){?>
        <div class="col" id="destino<?= $item->entocust_id; ?>">
        
        <a class="enlaceajaxVISTO" data-destino="<?= $item->entocust_id; ?>" class="text-white" href="#">Marcar como Visto</a> 
        
        </div>
        <?php } ?>

        <?php if($item->entocust_fav == 0){?>
        <div class="col" id="destinof<?= $item->entocust_id; ?>">
        
        <a class="enlaceajaxFAV" data-destino="<?= $item->entocust_id; ?>" class="text-white" href="#">Marcar como Favorito</a> 
        
        </div>
        <?php } ?>

        <?php if($item->entocust_basura == 0){?>
        <div class="col" id="destinob<?= $item->entocust_id; ?>">
        
        <a class="enlaceajaxBASURA" data-destino="<?= $item->entocust_id; ?>" class="text-white" href="#">Marcar como Basura</a> 
        
        </div>
        <?php } ?>

</div><!--row-->
  </div><!--boder-->
  


</details>


<small>

<ul class="m-0 list-inline ignorar">

  <?php if($item->post_rx=="disabled" || $item->post_rx==""){}else{?>
  <li class="list-inline-item"><ins><strong>Categoría Custom</strong></ins></li>
  <?php } ?>

  <?php if($item->post_secs=="disabled" || $item->post_secs=="" || $item->post_secs=="0"){}else{?>
  <li class="list-inline-item"><ins><strong>Tiempo: </strong><?php echo $item->post_secs;?> secs.</ins></li>
  <?php } ?>

  <?php if($item->post_reps=="disabled" || $item->post_reps_value=="" || $item->post_reps_value==NULL || $item->post_reps_value=="0.0000" ){}else{?>
  <li class="list-inline-item"><ins><strong>Reps: </strong><?php echo $item->post_reps_value;?> rondas.</ins></li>
  <?php } ?>

  <?php if($item->post_kg=="disabled" || $item->post_kg==""){}else{?>
  <li class="list-inline-item"><ins><strong>Peso: </strong><?php echo $item->post_kg;?> Kg(máx).</ins></li>
  <?php } ?>




</ul>
</small>

</li> 
<hr>
<?php endforeach;?>
</ul>


</div> <!--container-->






 <!--scripts-->

<script>

$("#asd").ready(function(){
     document.getElementById('search-highlight').focus();
})


</script>

        



<script type="text/javascript" src="https://v1.atlo.es/01_js/escribe_busca/vendor/jquery.hideseek.min.js"></script>
<script type="text/javascript" src="https://v1.atlo.es/01_js/escribe_busca//vendor/rainbow-custom.min.js"></script>
<script type="text/javascript" src="https://v1.atlo.es/01_js/escribe_busca/vendor/jquery.anchor.js"></script>
