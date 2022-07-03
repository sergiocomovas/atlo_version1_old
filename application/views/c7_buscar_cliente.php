<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<script>


  $(document).ready(function(){ 
   
    $(".enlaceajax").click(function(evento){
       
        evento.preventDefault();
        //$("#destino").load("contenido-ajax.html");
        $.get("https://v1.atlo.es/00_ajax/buscar_cliente_izquierda.php", {date_return: $(this).attr('data-id'), date_pollas: $(this).attr('data-mes')}, function(respuesta){
					   $("#destino").html(respuesta);
		})
    });
  })
 
  
</script>


<?php  if (isset ($_GET['CLIENTE']) )

    {
    
        echo "
        <script>
            window.onload = function () {
                 

                var a = document.getElementById(`search-highlight`);
                a.value = '".substr($_GET['CLIENTE'],6)."';
                
                document.getElementById(`search-highlight`).focus(); 
                
                a.value =  a.value + '-';  
             
               
            }
        </script>";
    }else{
        
        echo "
        <script>
            window.onload = function () {
                 

               
                
                document.getElementById(`search-highlight`).focus(); 
                
          
             
               
            }
        </script>";

    }
?>



<div class="container">
    
    <div class="row">

        <div class="col-md-6">
        <article>
            <label for="search-highlight">Lista de Clientes Activos</label>
            
            
            
            <input class="form-control"
            
            
             id="search-highlight" name="search-highlight" placeholder="Busca" type="text" data-list=".highlight_list" autocomplete="off">

            <hr> 
            
         
            <ul class="list-group highlight_list">


            <!--Clientes-->
            <?php $url = 'https://wendy.log99.es/index.php/A_atlo_sys/obtener_lista_de_clientes';
            $data = file_get_contents($url);
            $listado_de_clientes_activos = json_decode($data, true); ?>

                
                <?php 

                foreach($listado_de_clientes_activos as $x => $x_value){

                   echo '<li class="list-group-item list-group-item-action flex-column align-items-start">';

                   echo '<div class="d-flex w-100 justify-content-between">
                   <h5 class="mb-1"><span class="text-secondary">'.$x_value['clientes_rango'].'</span class="text-truncate">'.$x_value['clientes_nombrereal'].'</h5>
                   <small>'.$x_value['clientes_antiguedad'].'</small>
                   </div>';

                   echo '<div class="d-flex w-100 justify-content-between text-truncate mb-1"><small>+34'.$x_value['clientes_wa'].' </small><small class="text-muted"><strong>'.$x_value['clientes_email'].'  </strong></small></div>';
                   
            
                   echo '<p>';

                   $url = 'https://wendy.log99.es/index.php/A_atlo_sys/obtener_lista_de_libros/'.$x_value['stripe_customer_id'].'';
                   
                   $data = file_get_contents($url);
                   $listado_de_libros_activos = json_decode($data, true); 

                  
                   foreach($listado_de_libros_activos as $y => $y_value){
                    
                     if ($y_value['libros_precio1']=='0.00'){

                        //ETIQUETA ROJA
                        echo '<small><a href="#" class="enlaceajax badge badge-danger" data-mes="'.$y_value['libros_data'].'" data-id="'.$x_value['stripe_customer_id'].'">D'.$y_value['libros_data'].'</a></small> ';

                     }else{

                        echo '<small><a href="#" class="enlaceajax badge badge-success" data-mes="'.$y_value['libros_data'].'" data-id="'.$x_value['stripe_customer_id'].'">P'.$y_value['libros_data'].'</a></small> ';
                     }
                       
                   }

                   echo '<small><small class="text-dark float-right">'.$x_value["stripe_customer_id"].'--</small></small>';

                   echo '<small><small class="text-muted float-left">'.$x_value["clientes_id"].'</small></small>';

                   echo '</p></li>';

                
                }?>

            </ul>

          </article>
        </div>
       

        <!--columna_de_la_izquierda-->
        <div class="p-1 col-md-6">

        <br>
        
            <div id="destino">

            <?php if ( isset($_GET['MENSAJE'])) 

                {
                    echo '<br><br><br><div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>AVISO DE CAMBIOS</strong><hr><i class="fas fa-hand-point-left"></i> ';

                    echo str_replace("_"," ",$_GET['MENSAJE']);

                    echo '  <a type="button" class="close" href="https://www.atlo.es/7se/buscar_cliente.php">
                    <span aria-hidden="true">&times;</span>
                    </a>
                    </div>';

                  
                }
            ?>
  
            </div>

        </div>

    </div>

</div>


<!-- JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/javascripts/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<!-- JS-->

<script type="text/javascript" src="https://v1.atlo.es/01_js/escribe_busca/vendor/jquery.hideseek.min.js"></script>
<script type="text/javascript" src="https://v1.atlo.es/01_js/escribe_busca//vendor/rainbow-custom.min.js"></script>
<script type="text/javascript" src="https://v1.atlo.es/01_js/escribe_busca/vendor/jquery.anchor.js"></script>
<script src="https://v1.atlo.es/01_js/escribe_busca/initializers.js"></script>
 <!-- JS ends -->