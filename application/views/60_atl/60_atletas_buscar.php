<a class="navbar-brand" style="position: sticky;
    z-index: 10;
    top: 0;
    text-shadow: 0 0 0.2em #000, 0 0 0.2em #000;
    
    "onclick="closeNav_alt2()" href="#colecciones"><h3><i class="p-1 fas fa-arrow-circle-left"></i>Regresar</h3></a>






<script>

  $(document).ready(function(){ 


   
    $(".enlaceajaxTUYO").click(function(evento){  
    
        evento.preventDefault();
        var datadestino = $(this).attr('data-destino');
        $('#destinoTUYO').html("<div class='text-center'><br><br>Cargando...</div>");
        
        //$("#destino").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/6atl/atletas/buscar/"+datadestino+"/<?=$this->session->userdata('username')?>", {
            
            orden_num: $(this).attr('data-orden'), 
            date_select: $(this).attr('data-select')}, 
            
            function(respuesta){
                
				$('#destinoTUYO').html(respuesta);
        
        
                //document.getElementById('selection'+select).disabled = true;
		})
    });

  })

</script>





<div class="text-center">
<pre class="text-secondary">Buscar En <strong>Tus Colecciones</strong> Por Categoría</pre>

    <div class="btn-group" role="group" aria-label="Botones Grupo">

  
    <button type="button" data-destino="BuscaFuerza" class="enlaceajaxTUYO btn border border-primary btn-secondary">Fuerza</button>

    <button type="button" data-destino="BuscaMetcon" class="enlaceajaxTUYO btn border border-primary btn-secondary">Metabólicos</button>

    <button type="button" data-destino="BuscaExtra" class="enlaceajaxTUYO btn border border-primary btn-secondary">Extras</button>

    <button type="button" data-destino="Fav" class="enlaceajaxTUYO btn border border-primary btn-secondary"><i class="far fa-star"></i></button>



    </div>
</div>




<div id="destinoTUYO"></div>

<br><br><br><br>
<br><br><br><br>

<div class="text-center"><ins><a data-destino="Basura" class="text-danger enlaceajaxTUYO"  href="#">Ver Wods en la Basura</a></ins></div>




