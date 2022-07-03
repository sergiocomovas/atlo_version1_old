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

    //RECIBIR DATOS
    $url = 'https://v1.atlo.es/index.php/6atl/atletas/asistencias/'.$usuario;
    $data = file_get_contents($url);
    $asistencias = json_decode($data, false);


?>

<a class="navbar-brand" style="position: sticky;
    z-index: 10;
    top: 0;
    text-shadow: 0 0 0.2em #000, 0 0 0.2em #000;
    
    " onclick="closeNav_alt()" href="#colecciones"><h3><i class="p-1 fas fa-arrow-circle-left"></i>Regresar</h3></a>

<script>


  $(document).ready(function(){ 
   
    $(".enlaceajax").click(function(evento){  
    
        evento.preventDefault();
        var datadestino = $(this).attr('data-destino');
        $('#' +datadestino).html("<i class='fas fa-circle-notch fa-spin'></i>");
        
        //$("#destino001").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/6atl/atletas/paso2", {
            
            orden_num: $(this).attr('data-orden'), 
            date_fecha: $(this).attr('data-fecha'), 
            date_select: $(this).attr('data-select')}, 
            
            function(respuesta){
				$('#' +datadestino).html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
		})

        
    });
  })
 
  
</script>




<div>

    <div class="card p-1">
 
    <div class="card-body border border-dark bg-dark">



        <div id="destino001">

        <h5 class="card-title">AÑADIR WODS A TUS COLECCIONES. <small><br>Selecciona la fecha:</small></h5>

        <p class="card-text">
            <?php 
            
            foreach ($asistencias as $x)
                {

                    $url = 'https://v1.atlo.es/index.php/6atl/atletas/mostrar_dias/'.$x->dias_id;
                    $data = file_get_contents($url);
                    $formato_fecha = json_decode($data, false);
                     
                    
                    echo "<div class='text-center'><a 
                    
                    data-destino=destino".$x->dias_id."
                    data-select=".$x->dias_id." data-orden=".$usuario." role='button' data-fecha=".$formato_fecha." id=".$x->dias_id." class='enlaceajax'  href='#".$x->dias_id."'> <ins>".$formato_fecha."</ins> </a>
 
                    "; 

                    if(empty($formato_fecha)){echo "Sábado";}

                    

                    echo "</div><br><div id=destino".$x->dias_id."></div><br>";
                    
            
                }

            echo "<p class='text-center'>Añade los entrenos a tu colección antes que desaparezcan. Añade o Edita tus resultados obtenidos. Luego los podrás consultar en <strong>Entrenos Guardados</strong></p>";    
            
                            
            
            ?>
        </p>
        

                
        </div>
    </div>
    </div>
</div>