<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->helper('url');
    $this->load->library('session');
?>    

<?php

$usuario = $this->session->userdata('username'); 
$pantalla_loading="<i class='p-1 m-1 fas fa-circle-notch fa-spin'></i>";

?>

    <script>
        $(document).ready(function(){


            $(".menu_salir_1").click(function(evento){
         
                evento.preventDefault(); 

                var datadestino = $(this).attr('data-destino');
                var vid = $(this).attr('id');

                //remover clases
                //<i class="far fa-caret-square-up"></i>
       

                $('#destino_principal').html(`<?php echo $pantalla_loading; ?>`);
                $("#destino_principal").load(datadestino);

            });
        
        })
    </script>


    <script>
    $(document).ready(function(){ 


        
        $(".enviar_datos").bind("mouseup touchend",function(evento){  
            
            evento.preventDefault();

            var datadestino = $(this).attr('data-destino');
            var url = $(this).attr('data-url');
            var valor = $(this).val();
            $('#' + datadestino).html("<i class='fas fa-circle-notch fa-spin'></i>");


            //$("#destino001").load("contenido-ajax.html");
            $.get(url, {
                
                orden_valor: valor}, 
                function(respuesta){
                $('#' + datadestino).html(respuesta);
            })
        });     
    })

    </script>


<!-- REGRESAR -->
<a class="menu_salir_1 navbar-brand" style="position: sticky;
    z-index: 10;
    top: 0;
    text-shadow: 0 0 0.2em #000, 0 0 0.2em #000;"
    data-destino="<?= base_url()?>index.php/home/premium_training" id="premium_training" 
    href="javascript:void(0)"><h3><i class="p-1 fas fa-arrow-circle-left"></i>Regresar</h3></a>

<!--- PONER ARRAY --->

<?php

    $url = "https://v1.atlo.es/index.php/homeatl/ver_ejercicios";
    $data = file_get_contents($url);
    $ejercicios = json_decode($data, false);

    /*
    records_id
    records_tipo
    records_movimiento
    records_subclase
    records_destacar */

?> 


    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Ejercicio</th>
        <th scope="col">Kg</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

    <?php
    foreach ($ejercicios as $x) { ?>

    <?php if($x->records_destacar == "1"){$color_class="bg-secondary";}else{$color_class="";} ?>

    <script>

    function updateTextInput<?= $x->records_id; ?>(val) {
            document.getElementById('textInput<?= $x->records_id; ?>').value=val; 
            }

    </script>


    <tr class="<?= $color_class ?>">
      <th scope="row"> <small><small><?= $x->records_id; ?></small></small></th>
      <td><span class="text-warning"><?= $x->records_tipo; ?></span><br>
      <?= $x->records_movimiento; ?><br><?= $x->records_subclase; ?></td>
      <td style="width-min:40%;"> 


        <!--necesito:la URL (bien), los datos que envío, el destino -->

        <?php 

        $url="https://v1.atlo.es/index.php/homeatl/ver_resultados_c/". $usuario."/".$x->records_id ;    
        $data = file_get_contents($url);
        $ejercicios = json_decode($data, false);
        if(empty($ejercicios)){$valor=NULL;}else{
        $valor=$ejercicios[0]->resultados_kg;}
        
        
        
        
        ?>

        <input  class="form-control form-control-sm" type="text" readonly id="textInput<?= $x->records_id; ?>" value="<?= $valor ?>">
        
        <input data-destino="dest<?= $x->records_id; ?>" data-url="https://v1.atlo.es/index.php/homeatl/guardar_ejercicios/<?= $x->records_id; ?>/<?= $x->records_tipo; ?>/<?= $x->records_movimiento; ?>/<?=  $x->records_subclase; ?>/<?= $x->records_id; ?>/<?= $usuario ?>"  class="enviar_datos form-control form-control-sm" type="range" name="rangeInput" min="8" max="250" step="0.25" value="<?= $valor ?>" oninput="updateTextInput<?= $x->records_id; ?>(this.value);"><br>

        

      </td>

      <td><div id="dest<?= $x->records_id; ?>"></div></td>
    </tr>


<?php
}
?>

</tbody>
</table>



    <!--- range -->




  

 <?php //$this->load->view('60_atl/60_atletas_buscar'); ?>
