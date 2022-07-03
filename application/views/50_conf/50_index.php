<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session'); ?>

<?php
$pantalla_loading="<i class='p-1 m-1 fas fa-circle-notch fa-spin'></i>";
?>

<div class="mt-2 px-2 animated fadeInUp fast" style="min-height:100%">

<h1>CONFIGURACIÓN</h1>


<!-- script -->
    <script>
        $(document).ready(function(){


            $(".menuajax_conf").click(function(evento){
         
                evento.preventDefault(); 

                var datadestino = $(this).attr('data-destino');
                var vid = $(this).attr('id');

                //remover clases
                $(".menuajax_conf").removeClass("active");
                $('#'+vid).addClass("active");

                //<i class="far fa-caret-square-up"></i>
                //$(".ico_camb").removeClass("fa-caret-square-up");
                //$('.ico_camb').addClass("fa-minus-square");
                //$('#ico_'+vid).removeClass("fa-minus-square");
                //$('#ico_'+vid).addClass("fa-caret-square-up");

                $('#destino_configuracion').html(`<?php echo $pantalla_loading; ?>`);
                $("#destino_configuracion").load(datadestino);

            });
        
        })
    </script>




<div id="destino_configuracion">

    <?php $this->load->view('50_conf/52_conf_datos'); ?>
 
</div>



</div>

<script>
function mostrar1() {
  var m1 = document.getElementById("mostrar1");
  var m0 = document.getElementById("mostrar0");
  
  if (m1.style.display === "none") {
    m1.style.display = "block";
    m0.style.display = "none";
  } else {
    m1.style.display = "none";
    m0.style.display = "block";
  }
}
</script>








</div>


<div class="btn-group btn-group-toggle text-center w-100" 
        style="position: sticky;
                    margin: auto;
                    width: 80%;
                    padding: 10px;
                    bottom: 12%;
                   
                    ">
        
        <a style="width:33%; -webkit-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); -moz-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75);" class="menuajax_conf btn btn-primary active btn-sm" id="enlace1" data-destino="https://v1.atlo.es/index.php/homeconf/ficha_cliente" href="javascript:void(0)">Datos</a>

        <a style="width:33%; -webkit-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); -moz-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75);" class="menuajax_conf btn btn-warning btn-sm" id="enlace2" data-destino="https://v1.atlo.es/index.php/homeconf/alta_sus" href="javascript:void(0)">Alta Telepago</a>

        <a style="width:33%; -webkit-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); -moz-box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75); box-shadow: 8px -4px 29px -6px rgba(0,0,0,0.75);" class="menuajax_conf btn btn-warning btn-sm" id="enlace3" data-destino="https://v1.atlo.es/index.php/homeconf/baja_sus" href="javascript:void(0)"><i class="fas fa-cog"></i> Telepago</a>

</div>
