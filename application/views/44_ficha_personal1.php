<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

//DATOS DEL USUARIO--
//ZONA PRIVADA--

$cliente= $this->session->userdata('username');
$usuario = $this->session->userdata('username');


$usuario = str_replace("@",".aaaaaaaaaa.",$usuario);


$url =base_url().'index.php/zonaprivada/json_usuario/'.$usuario;
$data = file_get_contents($url);
$clientes = json_decode($data, false);



?>

    <h5>Configuraciones:</h5><br>

<div id="mostrar0">

<ul class="mx-3 list-group list-group-flush">

   
  <!--gupo_item-->
  <li class="list-group-item"> 
  
    <span class="float-right"> 
        <input name="" id="" disabled class="btn btn-primary btn-sm" type="button" value="Cambiar">   
    </span>
  
    <p>
        Nombre Público
    </p>

    <code>
        <?= $clientes->clientes_nombrepublico ?>
    </code>
    
  
  </li>

    <!--gupo_item-->
    <li class="list-group-item"> 
  
        <span class="float-right"> 
            <input name="" id="" disabled class="btn btn-primary btn-sm" type="button" value="Cambiar">   
        </span>

        <p>
            Comunicaciones por Correo Electrónico
        </p>

        <code>
            Todas
        </code>
    

    </li>

    <!--gupo_item-->
    <li class="list-group-item"> 
  
        <span class="float-right"> 
            <input name="" id="" disabled class="btn btn-primary btn-sm" type="button" value="Cambiar">   
        </span>

        <p>
            Resultados de WODS
        </p>

        <code>
            Público
        </code>
        

    </li>

        <!--gupo_item-->
  

        <li class="list-group-item"> 
  


  <p>
      Soporte técnico rápido:
  </p>

  <code>
      <a target="_blank" href="https://api.whatsapp.com/send?phone=34615890787">Pulsa aquí</a>
  </code>
  

</li><hr>

</ul>

</div>


<!---TELEPAGO-->

<a onclick="mostrar1()" href="#telepago" id="telepago">Configuración del <i class="fas fa-piggy-bank"></i> Telepago</a>

<div id="mostrar1" class="m-1" style="z-index:20; display:none;">

<div class="bg-dark shadow-sm container-fluid pb-4 pt-3 rounded">


<pre style="color:red;"><i class="fas fa-exclamation-triangle"></i><strong> Requiere Leer y Aceptar: </strong>Mediante la conformidad de esta orden de domiciliación, el deudor autoriza a ATLO BARBELL CLUB a enviar instrucciones a la entidad del deudor para adeudar su cuenta y a la entidad para efectuar los adeudos en su cuenta siguiendo las instrucciones de <?= $clientes->clientes_nombrereal?>. Como parte de sus derechos, el deudor está legitimado al reembolso por su entidad  en los términos y condiciones del contrato suscrito con la misma. La solicitud de reembolso deberá efectuarse dentro de las ocho semanas que siguen a la fecha de adeudo en cuenta.</pre>

<form accept-charset="UTF-8" id="myForm" name="myForm" action="https://v1.atlo.es/32_pagos_sepa/charge.php" method="post">

    <!---formulario--> 

    <div class="form-group">
    <label for="nombre">Nombre y Apellidos</label>
    <input type="text"
        class="form-control form-control-sm" name="nombre" id="nombre" value="<?= $clientes->clientes_nombrereal ?>"aria-describedby="H_nombre" placeholder="nombre">
    <small id="H_nombre" class="form-text text-muted">Importante: esto lo leerá tu banco. No trollees.</small>
    </div>

    <div class="form-group">
    
    <input type="hidden"
        class="form-control form-control-sm" value="<?= $clientes->clientes_email ?>" name="email" id="email" aria-describedby="H_email" placeholder="email">
   
    </div>  

    <div class="form-group">
    <label for="iban">IBAN</label>
    <input type="text"
        class="form-control form-control-sm" name="iban" id="iban" aria-describedby="H_Iban" placeholder="Ejemplo: DE89370400440532013000">
    <small id="H_Iban" class="form-text text-muted">Escribe tu número de cuenta. Necesitaremos, concretamente, el número IBAN que, en el caso de España, comienza por "ES". No uses espacios.</small>
    </div>

    <div class="form-group">
    <label for="stripe_id"><i class="fab fa-cc-stripe"></i> ID <?= $clientes->stripe_customer_id ?></label>
    <input type="hidden"
        class="form-control" name="stripe_id" id="stripe_id" aria-describedby="H_stripe_id" value="<?= $clientes->stripe_customer_id ?>" readonly placeholder="Stripe Id">
    <small id="H_stripe_id" class="form-text text-muted">Tu cuenta interna de <i class="fab fa-stripe"></i> se genera automáticamente al darte de alta en el club.</small>  <button style="background-color:red;" type="submit" class="m-4 btn btn-sm btn-primary">Aceptar y Enviar</button>
    </div>


    
</form>
    
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