<?php $this->load->library('session'); ?>

<?php 
    //recibe los parámetros de fecha


    $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_horario/obtener_fecha';
    $data = file_get_contents($url);
    $fechas_parametros = json_decode($data, true);

    $hoy=$fechas_parametros['dias_id']+1;
    $manana=$hoy+1; 

    $esta_semana=$fechas_parametros['dias_semana'];
    $proxima_semana=$esta_semana+1; 

    ?>
    
<?php

$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_reservas/ver_entreno/'.$hoy;
$data = file_get_contents($url);
$entreno_hoy = json_decode($data, false);


?>

<h1>Entreno Mañana:</h1>
      <div class="card mt-3 tab-card">
        <div  class="card-header tab-card-header">
          <ul  class="nav nav-pills nav-fill card-header-tabs" id="EntrenoMananaTab" role="tablist">

            <?php if(!empty($entreno_hoy[0]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link active" id="one1-tab" data-toggle="tab" href="#one1" role="tab" aria-controls="one1" aria-selected="true"><?= $entreno_hoy[0]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[1]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="two1-tab" data-toggle="tab" href="#two1" role="tab" aria-controls="two1" aria-selected="false"><?= $entreno_hoy[1]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[2]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="thee1-tab" data-toggle="tab" href="#thee1" role="tab" aria-controls="thee1" aria-selected="false"><?= $entreno_hoy[2]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[3]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="four1-tab" data-toggle="tab" href="#four1" role="tab" aria-controls="four1" aria-selected="false"><?= $entreno_hoy[3]->entowod_clase ?></a>
            </li>
            <?php } ?>

            <?php if(!empty($entreno_hoy[4]->entowod_descripcion)){ ?>
            <li class="nav-item">
                <a style="padding:0;" class="nav-link" id="extra1-tab" data-toggle="tab" href="#extra1" role="tab" aria-controls="extra1" aria-selected="false"><?= $entreno_hoy[4]->entowod_clase ?></a>
            </li>
            <?php } ?>


          </ul>
        </div>

        <div class="tab-content" id="EntrenoMananaTabContent">

        <?php if(!empty($entreno_hoy[0]->entowod_descripcion)){ ?>
          <div class="tab-pane fade show active p-3" id="one1" role="tabpanel" aria-labelledby="one1-tab">
            <?php if($this->session->userdata('username') != ""){?>
            <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[0]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[0]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[0]->entowod_titulo ?></p>
            <?php }else{echo "<p>Información disponible solo para usuarios premium con una <strong>Cuenta Atlo</strong> activa</p><br> <a style='text-decoration-line: underline;' href='https://v1.atlo.es/index.php/zonaprivada/login'>ACCEDER</a>";} ?>  
          </div>
        <?php } ?>

        <?php if(!empty($entreno_hoy[1]->entowod_descripcion)){ ?>
          <div class="tab-pane fade  p-3" id="two1" role="tabpanel" aria-labelledby="two1-tab">
            <?php if($this->session->userdata('username') != ""){?>
            <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[1]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[1]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[1]->entowod_titulo ?></p>
            <?php }else{echo "<p>Información disponible solo para usuarios premium con una <strong>Cuenta Atlo</strong> activa</p><br> <a style='text-decoration-line: underline;' href='https://v1.atlo.es/index.php/zonaprivada/login'>ACCEDER</a>";} ?>  
          </div>
        <?php } ?>



        <?php if(!empty($entreno_hoy[2]->entowod_descripcion)){ ?>
          <div class="tab-pane fade p-3" id="thee1" role="tabpanel" aria-labelledby="thee1-tab">
          <?php if($this->session->userdata('username') != ""){?>
          <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[2]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[2]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[2]->entowod_titulo ?></p> 
            <?php }else{echo "<p>Información disponible solo para usuarios premium con una <strong>Cuenta Atlo</strong> activa</p><br> <a style='text-decoration-line: underline;' href='https://v1.atlo.es/index.php/zonaprivada/login'>ACCEDER</a>";} ?>         
          </div>
        <?php } ?>

        <?php if(!empty($entreno_hoy[3]->entowod_descripcion)){ ?>
          <div class="tab-pane fade p-3" id="four1" role="tabpanel" aria-labelledby="four1-tab">
          <?php if($this->session->userdata('username') != ""){?>
          <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[3]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[3]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[3]->entowod_titulo ?></p>
            <?php }else{echo "<p>Información disponible solo para usuarios premium con una <strong>Cuenta Atlo</strong> activa</p><br> <a style='text-decoration-line: underline;' href='https://v1.atlo.es/index.php/zonaprivada/login'>ACCEDER</a>";} ?>              
          </div>
        <?php } ?>

        <?php if(!empty($entreno_hoy[4]->entowod_descripcion)){ ?>
          <div class="tab-pane fade p-3" id="extra1" role="tabpanel" aria-labelledby="extra1-tab">
        
          <?php if($this->session->userdata('username') != ""){?>
          <h5 class="card-title text-uppercase">Atlo <?= $entreno_hoy[4]->entowod_clase ?></h5>
            <pre style="height:200px; overflow-y:scroll;" class="h5 ml-4 mr-1 card-text text-secondary text-monospace"><?= $entreno_hoy[4]->entowod_descripcion ?></pre>
            <p><?= $entreno_hoy[4]->entowod_titulo ?></p> 
          <?php }else{echo "<p>Información disponible solo para usuarios premium con una <strong>Cuenta Atlo</strong> activa</p><br> <a style='text-decoration-line: underline;' href='https://v1.atlo.es/index.php/zonaprivada/login'>ACCEDER</a>";} ?>         
          </div>
        <?php } ?>


        </div>
      </div>
