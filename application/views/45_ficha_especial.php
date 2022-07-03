
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js">
</script>

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

<script>

$(document).ready(function(){ 

    $("#enlaceajax_susc1").click(function(evento){  
    
        evento.preventDefault();
        
        
        //$("#destino").load("https://v1.atlo.es/32_pagos_sepa/s_comprobar.php");
        $.get("https://v1.atlo.es/32_pagos_sepa/s_comprobar.php", {
            
            date_invent: $(invent).val()   }, 
            
            function(respuesta){
                
                $("#resp1").html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
        })

        
    });
})


</script>


<div class="m-4">
    
    <h6>Suscripciones:</h6>


   
    <form>
    
      <input type="hidden"
        class="form-control" name="" value=" <?= $clientes->stripe_customer_id ?>" id="invent" name="invent" aria-describedby="helpId" placeholder="">

      <a name="enlaceajax_susc1" id="enlaceajax_susc1" class="btn btn-warning" role="button">Comprobar</a>


      

    </form>

    <div class="text-primary" id="resp1"></div>
  
  

</div>




