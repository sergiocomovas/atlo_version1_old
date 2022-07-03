<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>

<?php 

//DATOS DEL USUARIO--
//ZONA PRIVADA--

$cliente = $this->session->userdata('username');
$usuario = $this->session->userdata('username');

$usuario = str_replace("@",".aaaaaaaaaa.",$usuario);

$url =base_url().'index.php/zonaprivada/json_usuario/'.$usuario;
$data = file_get_contents($url);
$clientes = json_decode($data, false);

?>




<h5></h5><br>

<div class="bg-dark shadow-sm container-fluid pb-4 pt-3 rounded">

    <big><big><big><big><big><pre style="color:red;"><i class="fas fa-exclamation-triangle"></i><strong> TEXTO LEGAL QUE HAY QUE LEER Y ACEPTAR: </strong>Mediante la conformidad de esta orden de domiciliación, el deudor autoriza a ATLO BARBELL CLUB a enviar instrucciones a la entidad del deudor para adeudar su cuenta y a la entidad para efectuar los adeudos en su cuenta siguiendo las instrucciones de <?= $clientes->clientes_nombrereal?>. Como parte de sus derechos, el deudor está legitimado al reembolso por su entidad  en los términos y condiciones del contrato suscrito con la misma. La solicitud de reembolso deberá efectuarse dentro de las ocho semanas que siguen a la fecha de adeudo en cuenta.</pre></big></big></big></big></big>


    <form id="ajaxForm2" accept-charset="UTF-8" action="https://v1.atlo.es/32_pagos_sepa/charge.php" method="post">

        <!---formulario--> 

        <div class="form-group">
        <label for="nombre">Nombre y Apellidos</label>
        <input type="text"
            class="form-control form-control-sm" name="nombre" id="nombre" value="<?= $clientes->clientes_nombrereal ?>"aria-describedby="H_nombre" placeholder="nombre">
        <small id="H_nombre" class="form-text text-muted">Importante: esto lo leerá tu banco. No trollees.</small>
        </div>

        <div class="form-group">
        <input type="hidden"
            class="form-control" name="stripe_id" id="stripe_id" aria-describedby="H_stripe_id" value="<?= $clientes->stripe_customer_id ?>" readonly placeholder="Stripe Id">
            
         <small id="H_stripe_id" class="form-text">Tu cuenta interna de <i class="fab fa-stripe"></i> se genera automáticamente al darte de alta en el box.</small>  
         <label for="stripe_id"><i class="fab fa-cc-stripe"></i> ID <?= $clientes->stripe_customer_id ?></label>
       
        </div>

        <div class="form-group">
        
        <input type="hidden"
            class="form-control form-control-sm" value="<?= $clientes->clientes_email ?>" name="email" id="email" aria-describedby="H_email" placeholder="email">
    
        </div>  
        
        
        <div class="form-group">
        <label for="iban" class="m-0"><h6>ESCRIBE TU IBAN</h6></label>
       
        <div class="col" id="resp_activar"></div>

        <div class="input-group mb-3">
            <input type="text"
                class="form-control bg-warning form-control-lg" name="iban" id="iban" aria-describedby="H_Iban" placeholder="Ejemplo: DE89370400440532013000">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-light py-0 enlaceajax_activar" type="button">ENVIAR</button>
            </div>
        </div> 
        <small id="H_Iban" class="p-0 m-0 form-text">Escribe tu número de cuenta. Necesitaremos, concretamente, el número IBAN que, en el caso de España, comienza por "ES". No uses espacios. Luego pulsa en "ENVIAR".</small>
        </div>


        
    </form>


<br><br><br>


</div>


<script>

$(document).ready(function(){ 

    
    $("#ajaxForm2").bind("submit",function(){
        // Capturamnos el boton de envío
        //var btnEnviar = $("#btnEnviar");
        swal("Un momento...", {
          
          button: false,
          timer: 1000,
        });
        
        $.ajax({
            type: $(this).attr("method"),
            url:  $(this).attr("action"),
            data: $(this).serialize(),
            beforeSend: function(){
                /*
                * Esta función se ejecuta durante el envió de la petición al
                * servidor.
                * */
                // btnEnviar.text("Enviando"); Para button 
                //btnEnviar.val("Enviando"); // Para input de tipo button
                //btnEnviar.attr("disabled","disabled");
            },
            complete:function(data){
                /*
                * Se ejecuta al termino de la petición
                * */
                //btnEnviar.val("Enviar formulario");
                //btnEnviar.removeAttr("disabled");
            },
            success: function(data){
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
                $("#resp_activar").html(data);
                //var datadestino = 'https://v1.atlo.es/index.php/home2/premium_clases?MENSAJE=_ACCION_REALIZADA_CORRECTAMENTE';
                //$("#destino_principal").load(datadestino);
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                //var datadestino = 'https://v1.atlo.es/index.php/home2/premium_clases?MENSAJE_ERROR=_UPS_ALGO_HA_IDO_MAL';
                //$("#destino_principal").load(datadestino);
                $("#resp_activar").html(data);
            }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });    
    
})


</script>

