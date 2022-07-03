<!--cofiguración rápida-->


<?php 

//IMAGEN DE FONDO
$bg_fondo = "https://v1.atlo.es/00_img/muay/muay.jpg"; 

//REPETIR: no-repeat, repeat, repeat-y, repeat-x
$bg_repetir = "no-repeat"; 

?>

<?php

$tg_id="Esto-es-una-prueba-01-11-2"; 

?>


<?php 

//HTML_TEXTO
$html_texto_izquierda = '

    <span class="badge badge-pill badge-primary">dsfdf</span>

';//Fin MTML_TEXTO_IZQUIERDA


//HTML_TEXTO
$html_texto_derecha= '

    <span class="badge badge-pill badge-primary">dsfdf</span>

';//Fin HTML_TEXTO_DERECHA



?> 

<!--https://www.grabient.com/-->

<!--style=" background-color: #FFE53B;
            background-image: linear-gradient(147deg, #FFE53B 0%, #FF2525 74%);
            background-image: url(&quot;<?= $bg_fondo ?>&quot;);
            background-position: center; 
            background-repeat: <?= $bg_repetir ?>; 
            background-size: cover;
            "
-->



<?php $this->load->helper('form'); ?> 
<div class="py-5" 
    style=" background-color: #FA8BFF;
background-image: linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);


            
            background-size: cover;
            "
>

    <div class="container">
      <div class="row py-5">
        <div class="col-md-6 text-white">
         <!--contenido más información-->


        <?= $html_texto_izquierda ?>
        
        <a  class="enlaceajax btn btn-primary btn-block btn-link" 
      
            href="#" 
            data-url-telegraf="https://api.telegra.ph/getPage/<?= $tg_id ?>?return_content=true"
            data-toggle="modal" 
            data-target="#modal1"           
         >adsfdasfd</a>

         

        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body p-5" >
                
                <?= $html_texto_derecha ?>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
