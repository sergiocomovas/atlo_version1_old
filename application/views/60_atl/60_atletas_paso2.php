<?php 


       
        $this->load->library('session');
        if($this->session->userdata('username') == "")
        {
           $sin_login = "<h3>NO ESTÁS LOGEADO</h3>";
           $usuario = "";
        }else{
            $usuario = $this->session->userdata('username'); 
        }

?>



<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js">
</script>

<?php

    //RECUPERAR DATOS USUARIO
    //$usuario="alexisc17@hotmail.com";
    $usuario= $this->input->get('orden_num', TRUE);
    $la_fecha= $this->input->get('date_fecha', TRUE);
    

    //RECIBIR WOD DEL DÍA
    $hoy = $this->input->get('date_select', TRUE);
    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$hoy;
    $data = file_get_contents($url);
    $entreno_hoy = json_decode($data, false);

?>


<script>


  $(document).ready(function(){ 
   
    $(".enlaceajaxTABA").click(function(evento){  
    
        evento.preventDefault();
        var datadestino = $(this).attr('data-destino');
        $('#' +datadestino).html("Cargando");
        
        //$("#destino").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/6atl/atletas/paso3", {
            
            orden_num: $(this).attr('data-orden'), 
            orden_lafecha: $(this).attr('data-fecha'), 
            date_select: $(this).attr('data-select')}, 
            
            function(respuesta){
                
				$('#' +datadestino).html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
		})
    });

    $(".enlaceajax1").click(function(evento){  
    
    evento.preventDefault();
    
    //$("#destino").load("contenido-ajax.html");
    $.get("https://v1.atlo.es/index.php/6atl/atletas/paso3", {
        
        orden_num: $(this).attr('data-orden'), 
        date_select: $(this).attr('data-select')}, 
        
        function(respuesta){
            $("#destino1").html(respuesta);
            //document.getElementById('selection'+select).disabled = true;
        })
    });


    $(".enlaceajax2").click(function(evento){  
    
    evento.preventDefault();
    
    //$("#destino").load("contenido-ajax.html");
    $.get("https://v1.atlo.es/index.php/6atl/atletas/paso3", {
        
        orden_num: $(this).attr('data-orden'), 
        date_select: $(this).attr('data-select')}, 
        
        function(respuesta){
            $("#destino2").html(respuesta);
            //document.getElementById('selection'+select).disabled = true;
        })
    });


    $(".enlaceajax3").click(function(evento){  
    
    evento.preventDefault();
    
    //$("#destino").load("contenido-ajax.html");
    $.get("https://v1.atlo.es/index.php/6atl/atletas/paso3", {
        
        orden_num: $(this).attr('data-orden'), 
        date_select: $(this).attr('data-select')}, 
        
        function(respuesta){
            $("#destino3").html(respuesta);
            //document.getElementById('selection'+select).disabled = true;
        })
    });

    $(".enlaceajax4").click(function(evento){  
    
    evento.preventDefault();
    
    //$("#destino").load("contenido-ajax.html");
    $.get("https://v1.atlo.es/index.php/6atl/atletas/paso3", {
        
        orden_num: $(this).attr('data-orden'), 
        date_select: $(this).attr('data-select')}, 
        
        function(respuesta){
            $("#destino4").html(respuesta);
            //document.getElementById('selection'+select).disabled = true;
        })
    });



  })
 
  
</script>



<div class="alert alert-warning alert-dismissible fade show" role="alert">

<div class="text-center" style="color:#fff3cd; position: relative;
  bottom: 50px;"> <i class="fas fa-3x fa-caret-up"></i></div>
   
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <big><big><span aria-hidden="true">&times;</span> </big></big>
  </button>

        <h5 class="card-title" style=" position: relative;
  bottom: 30px;> <i class="fas fa-level-up-alt fa-rotate-90"></i> PLAN DEL DÍA <i class="fas fa-chevron-right"></i> <?= $la_fecha ?> </h5>


        <p class="card-text">
            <?php 

                $galletas = 0;
                while ($galletas < 5){
                if(!empty($entreno_hoy[$galletas]->entowod_descripcion)){ ?>
                
                    <div class="border border-primary rounded">
                    <div class="m-2">
  

                        <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[$galletas]->entowod_clase ?></h5>
                        
                        <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[$galletas]->entowod_descripcion ?></pre>
                        
                        <a 
                        data-destino="destino<?= $entreno_hoy[$galletas]->entowod_id ?>"
                        data-select="<?= $entreno_hoy[$galletas]->entowod_id ?>" data-orden="<?= $usuario ?>"
                        data-fecha="<?= $la_fecha ?>"
                        name="" 
                        id="" 
                        class="enlaceajaxTABA rounded-0 btn btn-block btn-primary" href="javascript:void(0)" 
                        role="button">AÑADIR</a>

                        <div id="destino<?= $entreno_hoy[$galletas]->entowod_id ?>"></div>
                        
                    
                    </div>
                    </div><hr>
            <?php }  $galletas++; 
            }
            ?>
        </p>
        
        </div>
<script>
  $(".alert").alert();
</script>

  
