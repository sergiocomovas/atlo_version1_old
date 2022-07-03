<?php
  require_once('./config.php');

  $email  = $_POST['email'];
  $nombre  = $_POST['nombre'];
  $iban  = trim($_POST['iban']);
  $stripe_id  = $_POST['stripe_id'];


  //CREAR UNA SOURCE

  try
  {  

  $source = \Stripe\Source::create([
    "type" => "sepa_debit",
    "sepa_debit" => ["iban" => $iban],
    "currency" => "eur",
    "mandate" =>[
      // Automatically send a mandate notification email to your customer
      // once the source is charged.
      "notification_method" => "email"]
    ,
    "owner" => [
      "name" => $nombre,
      "email" => $email,
    ],
  ]);

  //ACTUALIZAR CLIENTE
  $actualizar_cliente = \Stripe\Customer::update(
    $stripe_id,
    [
      'source' => $source->id,
      'default_source' => $source->id,
    ]
  );

  //echo '<meta http-equiv="refresh" content="0; url=https://v1.atlo.es/index.php/home?MENSAJE=CAMBIO_REALIZADO_SIN_ERRORES" />';

  echo '

   <div class="animated fadeInUp fast alert alert-success alert-dismissible fade show" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     <strong>¡Cambios Guardados Correctamente!</strong> 
     <hr>
     <iframe class="w-100" src="https://v1.atlo.es/index.php/homeconf/oferta_sus"></iframe>
   </div>
   
   <script>
     $(".alert").alert();
   </script>';



  }catch(Exception $e)
  {
  

    echo '

    <div class="animated fadeInUp fast alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Algo ha ido mal.</strong><br><pre>'.$e->getMessage().'</pre><br>
      ¡Por favor, revisa los datos introducidos y vuelve a intentarlo! 
    </div>
    
    <script>
      $(".alert").alert();
    </script>';

    

   
  
  }

  


?>