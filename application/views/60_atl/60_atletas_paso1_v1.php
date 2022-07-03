<div class="animated fadeInUp fast" style="min-height:100%">

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


<script>


  $(document).ready(function(){    //$(".historicoajax").click(
    $('#historicoselect').on('change', function(evento){  
        
        evento.preventDefault();
        
       
        
        $('#historicodestino').html("<i class='fas fa-circle-notch fa-spin'></i>");
        
        //$("#destino001").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/index.php/6atl/atletas/paso2", {
            
            orden_num: $('option:selected', this).attr('data-orden'), 
            date_fecha: $('option:selected', this).attr('data-fecha'), 
            date_select: $('option:selected', this).attr('data-select')}, 
            
            function(respuesta){
				$('#historicodestino').html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
		})

        
    });
  })
 
  
</script>




    <div class="mx-2 mt-3">
 
    <div>



        <div id="destino001">

        <h5 class="card-title mb-0 pb-0">Guardar Resultados: <small><small>(Añadir Wod a tu Colección)</small></small></h5>

        <p class="card-text">


            <div class="form-group m-0 p-0">
            <label for=""></label>
            <select style="background-color:#ffeeba;" id="historicoselect" class="form-control form-control-lg" name="" ><option disabled="disabled" selected>ÚLTIMOS ENTRENOS REALIZADOS...</option>
                
           

            <?php 
            
            foreach ($asistencias as $x)
                {

                    $url = 'https://v1.atlo.es/index.php/6atl/atletas/mostrar_dias/'.$x->dias_id;
                    $data = file_get_contents($url);
                    $formato_fecha = json_decode($data, false);

                    echo "<option data-destino=destino".$x->dias_id."
                    data-select=".$x->dias_id." data-orden=".$usuario." role='button' data-fecha=".$formato_fecha." id=".$x->dias_id." class='historicoajax'  href='#".$x->dias_id."'>".$formato_fecha."</option>";
                     
                    
                    /*echo "<div class='text-center'><a 
                    
                    data-destino=destino".$x->dias_id."
                    data-select=".$x->dias_id." data-orden=".$usuario." role='button' data-fecha=".$formato_fecha." id=".$x->dias_id." class='historicoajax'  href='#".$x->dias_id."'> <ins>".$formato_fecha."</ins> </a>
 
                    ";*/

                    if(empty($formato_fecha)){echo "Sábado";}

                    

                    /*echo "</div><br><div id=destino".$x->dias_id."></div><br>";*/
                    
            
                }

            echo " </select>
            </div>";

            echo "</div><br><div id='historicodestino'></div><br>";            
            ?>
        </p>
        

                
        </div>  
        
        <?php $this->load->view('12_nav_entrenos'); ?>
        <div class="pb-4"></div> 
        <?php $this->load->view('12_nav_entrenos_2'); ?>

        <div style="position: sticky;
                    margin: auto;
                    width: 80%;
                    padding: 10px;
                    bottom: 12%;">
        <a href="javascript:void(0)" onclick="openNav_atl2()" class="btn btn-secondary btn-sm mt-5 btn-block" style="-webkit-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); -moz-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75);"><i class="fas fa-dice-d20"></i> Ver Colección</a>
        </div>



       
    </div>
      
    </div>
    
  
</div>

<div id="mySidenav_atl2" class="sidenav-atl">

 <?php $this->load->view('60_atl/60_atletas_buscar'); ?>

</div>

<script>

/* Set the width of the side navigation to 250px */
function openNav_atl2() {
  document.getElementById("mySidenav_atl2").style.width = "100%";
  document.getElementById("mySidenav_atl2").style.padding = "0px";
}

function closeNav_alt2() {
  document.getElementById("mySidenav_atl2").style.width = "0";
}
</script>

</div>