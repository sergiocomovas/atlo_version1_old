<div class="py-5" 
    style="
            background-image: url(&quot;https://v1.atlo.es/00_img/muay/muay.jpg&quot;);
            background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover;
            "
>

    <div class="container">
      <div class="row py-5">
        <div class="col-md-6 text-white">
            <img src="https://v1.atlo.es/00_img/muay/letras_portada1.png" class="img-fluid rounded-top" alt="">
          
          <h2 class="lead text-light p-2">Comienzamos en noviembre.</h2>
          <p class="p-2 text-light">A partir del martes 23 vuelve a visitar esta web para encontrar toda la información de este curso.</p>

          <!-- Button trigger modal -->
          <button disabled type="button" style="background-color:red;" class="m-1 btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Ya puedes solicitar tu oferta.
          </button><br><br>

          <img src="https://v1.atlo.es/00_img/spartan/spartan_5.png" class="img-fluid" alt="">

        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-5" >
                
                <h3 class="pb-3">Pide tu oferta sin compromiso:</h3>
                
                
                <form method="POST" action="https://formspree.io/catxo99@gmail.com">

                <?php

                //INICIO DEL FORMULARIO

                $rest = '0rest/WendyContacto';

                $attributes = array(
                  'method' => 'GET',
                  'class' => '', 
                  'id' => 'formulario_gloria'
                );  
                
                $hidden = array(
                  'copia_correo_1' => 'atlo@atlo.es', 
                  'copia_correo_2' => 'barbellclub@atlo.es',
                  //'retorno' => 'https://atlo.es/barbellclub/home/index.php?MENSAJE=MENSAJE_ENVIADO',
                  'guardar' => 'no' 
                );

                echo form_open($rest, $attributes, $hidden);

                ?>

                
                <?php 

                //CASILLA DE FORM GROUP - TEXT INPUT.
                echo '<div class="form-group">';
                
                $etiqueta = '¿Cuál es tu correo electrónico?',
                $name = 'tu_correo';
                $data = array(
                    'type'          => 'text',
                    'id'            => $name,
                    'value'         => '',
                    'maxlength'     => '100',
                    'required'      => 'required',
                    //'readonly'      => 'readonly',
                    //'onclick'       => '',
                    'class'         => 'form-control form-control-lg'
                );

                echo form_label($etiqueta, $name, 'class="h2"');
                echo form_input($data);
                
                echo '</div>';
                
                ?>

       
               
                

                <div class="form-group m-2">


                   <div class="form-check form-check-inline">
                     <label class="form-check-label">
                       <input class="form-check-input" required type="checkbox" id="LOPD" name="LOPD" required value="checkedValue">
                       
                       Acepto la política de privacidad.
                     
                     </label>    
                     
                     <a href="https://v1.atlo.es/00_00/Bolet%C3%ADn_18.pdf">   <i class="fas fa-2x fa-file-contract"></i></a> 
                       
                   </div>

                    <div class="form-check form-check-inline">
                     <label class="form-check-label">
                       <input class="form-check-input" type="checkbox" name="cliente" id="cliente" value="checkedValue"> Ya soy Cliente de Atlo
                     </label>
                </div>

                  
                  </div> 
                  <br>
                
                  <button type="submit" class="btn mt-2 btn-outline-light btn-block">Adelante</button>


                  
             <?= 
                //$string = '</div></div>';
                form_close();
                // Would produce:  </form> </div></div>
             ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><small><small>T3</small></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

     t4

      <hr>
      <h2 id="quesloquepiensas">¿Qué es lo que piensas?</h2>



      <p>Por favor, queremos conocer <strong>tu opinión</strong> y resolver tus dudas. Si tienes alguna cosa que comunicarnos puedes ponerte en contacto con nosotros por <a class="text-secondary" href="mailto:barbellclub@atlo.es">correo electrónico</a> o por <a class="text-secondary" href="https://api.whatsapp.com/send?phone=34615890787">whastapp</a>.</p>

      <img class="img-fluid" src="https://v1.atlo.es/00_img/spartan/sp_04.jpg">

      <p><small>*actividades del curso aún en preparación.</small></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vale</button>
       
      </div>
    </div>
  </div>
</div>
