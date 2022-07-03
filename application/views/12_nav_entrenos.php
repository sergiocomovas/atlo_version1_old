<?php $this->load->library('session'); ?>

<?php 
    //recibe los parámetros de fecha


    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_fecha';
    $data = file_get_contents($url);
    $fechas_parametros = json_decode($data, true);

    $hoy=$fechas_parametros['dias_id'];
    $manana=$hoy+1; 

    $esta_semana=$fechas_parametros['dias_semana'];
    $proxima_semana=$esta_semana+1; 

    ?>
    
<?php

$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$hoy;
$data = file_get_contents($url);
$entreno_hoy = json_decode($data, false);


?>

<h1>Entreno Hoy:</h1>
      <div class="card mt-3 tab-card">
        <div  class="card-header tab-card-header">
          <ul  class="nav nav-pills nav-fill card-header-tabs" id="EntrenoHoyTab" role="tablist">

            <?php if(!empty($entreno_hoy[0]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true"><?= $entreno_hoy[0]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[1]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false"><?= $entreno_hoy[1]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[2]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false"><?= $entreno_hoy[2]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[3]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="false"><?= $entreno_hoy[3]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[4]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="extra-tab" data-toggle="tab" href="#extra" role="tab" aria-controls="Extra" aria-selected="false"><?= $entreno_hoy[4]->entowod_clase ?></a>
            </li>
            <?php } ?>


          </ul>
        </div>

        <div class="tab-content" id="EntrenoHoyTabContent">

        <?php if(!empty($entreno_hoy[0]->entowod_descripcion)){ ?>
          <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
            <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[0]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[0]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[0]->entowod_titulo ?></p>
          </div>
        <?php } ?>

        <?php if(!empty($entreno_hoy[1]->entowod_descripcion)){ ?>
          <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
            <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[1]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[1]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[1]->entowod_titulo ?></p>
          </div>
        <?php } ?>



        <?php if(!empty($entreno_hoy[2]->entowod_descripcion)){ ?>
          <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
          <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[2]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[2]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[2]->entowod_titulo ?></p>        
          </div>
        <?php } ?>

        <?php if(!empty($entreno_hoy[3]->entowod_descripcion)){ ?>
          <div class="tab-pane fade p-3" id="four" role="tabpanel" aria-labelledby="four-tab">
          <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[3]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[3]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[3]->entowod_titulo ?></p>            
          </div>
        <?php } ?>

        <?php if(!empty($entreno_hoy[4]->entowod_descripcion)){ ?>
          <div class="tab-pane fade p-3" id="extra" role="tabpanel" aria-labelledby="extra-tab">
        
          <?php if($this->session->userdata('username') != ""){?>
          <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[4]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[4]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[4]->entowod_titulo ?></p> 
          <?php }else{echo "<p>Información disponible solo para usuarios premium con una <strong>Cuenta Atlo</strong> activa</p><br> <a style='text-decoration-line: underline;' href='https://v1.atlo.es/index.php/zonaprivada/login'>ACCEDER</a>";} ?>         
          </div>
        <?php } ?>


        </div>
      </div>
