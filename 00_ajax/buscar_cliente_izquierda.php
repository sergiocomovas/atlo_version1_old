

    <!-- parámetros de ajax-->
    <div class="container">
    <div class="row">
    <div class="col-md-10">

    <!--select to pollas-->

    <?php

    $url = 'https://wendy.log99.es/index.php/A_atlo_sys/obtener_libros_modena_cliente_por_mes/'.$_GET['date_return'].'/'.$_GET['date_pollas'];
                   
    $data = file_get_contents($url);
    $listado_moneda = json_decode($data, true); 
    ?>
    
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">MES 
                <?php echo $_GET['date_pollas']; ?>
                </h4>
                <h6 class="card-subtitle text-muted"><?php echo $_GET['date_return']; ?></h6>
              </div>
              

    <?php  
    
    
    foreach($listado_moneda as $y => $y_value){

        
    $num = $y_value['libros_precio1'];
    $a = $y_value['libros_id'];

    $euros= substr($num,0,-3);
    $decimales= substr($num,-2);
        
    
    

              
    echo '<div class="card-body bg-secondary">
    
                <form id="formulario'.$y_value['libros_id'].'">
                <h4 id="'.$y_value['libros_tipo'].'" class="bg-dark">'.$y_value['libros_tipo'].'</h4>
                <hr>

                <input type="hidden" name="cliente" value="'.$_GET['date_return'].'">

                <input type="hidden" name="fecha" value="'.$_GET['date_pollas'].'">


                

                <div class="form-group">
                  <label for="">Referencia</label>
                  <input type="text" value="'.$y_value['libros_id'].'" readonly name="libros_id" class="form-control form-control-sm" placeholder="">
                </div>
                <div class="form-group mt-1">
                  <label for="">Euros, céntimos</label>

                  <div class="row">
                  
                  <div class="col-6"><input required maxlength="4" type="text" name="euros" value="'.$euros.'"  class="form-control form-control-lg" placeholder="" aria-describedby="helpId"></div>
                  <div class="col-1"><big><big><big>,</big></big></big></div>
                  <div class="col-4"> <input required maxlength="2"  type="text" name="centimos" value="'.$decimales.'" class="form-control form-control-lg" placeholder="" aria-describedby="helpId"></div>
                  

                  </div><small id="helpId" class="text-primary"><i class="fas fa-info-circle"></i> Para indicar decimales usa la 2ª casilla.</small>

                </div>
                <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control form-control-sm" name="concepto" rows="2">'.$y_value['libros_concepto'].'</textarea>
                </div>
                <div class="form-group">
                  <label for=""></label>
                  <input type="range" min="1" max="5" name="veces"  class="form-control" value="'.$y_value["libros_veces"].'" placeholder="" id="myRange'.$a.'" aria-describedby="helpId">
                  <small id="helpId" class="text-light">Veces a la semana: <span class="text-warning" id="demo'.$a.'"></span></small>
                </div>
                
                <script>
                var slider'.$a.' 
                = document.getElementById("myRange'.$a.'");
                

                var output'.$a.' 
                = document.getElementById("demo'.$a.'");


                output'.$a.'.innerHTML 
                = slider'.$a.'.value; 

                  
                slider'.$a.'.oninput = function() {
                    output'.$a.'.innerHTML = this.value;
                   

                }
                </script>

                

                <button onClick="envia'.$a.'(`imp.php?id1='.$a.'`)" type="submit" disabled class="mt-2 btn-lg btn-block btn btn-primary">Solo Guardar</button>

                <button onClick="envia'.$y_value['libros_id'].'(`https://wendy.log99.es/index.php/A_atlo_sys/modificar_datos_libros_email`)" type="submit" class="mt-2 btn-lg btn-block btn btn-primary">Guardar y Enviar Email</button>

                <button onClick="envia'.$y_value['libros_id'].'(`imp.php?id3='.$y_value['libros_id'].'`)" type="submit" disabled class="mt-2 btn-lg btn-block btn btn-primary">Pagar con Stripe</button>

                <script>
                    function envia'.$y_value['libros_id'].'(pag){ 
                        var form = document.getElementById(`formulario'.$y_value['libros_id'].'`);
                        form.action= pag;
                        form.submit();
                    } 
                </script>

                </form>
              </div>
            
            
            
            
              ';
              
            }
        ?>

    
    
    </div>
    </div>

    <div class="col-md-2">
    
    Moneda
    <ul>
        <li><a href="#tarifa_moneda">Tarifa</a></li>
        <li><a href="#productos_moneda">Productos</a></li>
        <li><a href="#otros_moneda">Otros</a></li>
    </ul>
    </div>

    </div>
</div>

