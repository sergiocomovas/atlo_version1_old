<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $casilla = $_POST['casilla'];
  $telefono = $_POST['telefono'];
  $box = $_POST['box'];

  $baseFromJavascript = $casilla;

  // Nuestro base64 contiene un esquema Data URI (data:image/png;base64,)
  // que necesitamos remover para poder guardar nuestra imagen
  // Usa explode para dividir la cadena de texto en la , (coma)
  $base_to_php = explode(',', $baseFromJavascript);
  // El segundo item del array base_to_php contiene la información que necesitamos (base64 plano)
  // y usar base64_decode para obtener la información binaria de la imagen
  $data = base64_decode($base_to_php[1]);// BBBFBfj42Pj4....

  // Proporciona una locación a la nueva imagen (con el nombre y formato especifico)
  $filepath = "./firmas/".$box.$telefono.".png"; // or image.jpg

  // Finalmente guarda la imágen en el directorio especificado y con la informacion dada
  file_put_contents($filepath, $data);

  $meta_datos= array(
    "Telefono" => $telefono,
    "Box" => $box
  );

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'metadata' => $meta_datos,
      'source'  => $token,

  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'metadata' => $meta_datos,
      'description' => 'Pago SF3 anualidad (Mallorca Interbox): '.$telefono,
      'amount'   => 2500,
      'currency' => 'eur',
  ]);



echo '


<!doctype html>
<html lang="es">
  <head>
    <title>Gracias, pago completado.</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/superhero/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>

  <div class="m-4 jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-3">Gracias</h1>
      <p class="lead"><i class="fas fa-check"></i> Se ha completado el pago. </p>
      <hr class="my-2">
      <big><big><p><code>Número de Ref.: '.$charge->id.' </code></p></big></big>
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">IMPORTANTE</h4>
        <p>En un plazo de 15 días (máximo), Mallorca Interbox, se pondrá en contacto para facilitarte tu documentación como nuevo atleta de la SF3.</p>
        <p>Si pasado ese tiempo no recibe noticias nuestras, debe ponerse en contacto inmediatamente con nosotros vía correo elecrónico: <a href="mailto:sergio@mallorcainterbox.com">sergio@mallorcainterbox.com</a></p>

        <p class="mb-0">GUARDE SU NÚMERO DE REFERENCIA</p>
      </div>
      <p class="lead mb-5">
        <a name="" id="" class="btn btn-primary" href="https://www.atlo.es" role="button">Volver a Atlo Can Valero</a>
        <a name="" id="" class="btn btn-primary" href="https://www.powerprojectmallorca.com/" role="button">Volver a Power Proyect</a>
        <a name="" id=""  class="btn disabled btn-primary" href="https://hummerboxinca.es/" role="button">Volver a Hummerbox Inca</a>
      </p>
      <div class="container">
        <a href="http://www.sf3.es">WWW.SF3.ES</a>
      </div>
    </div>
  </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>'; ?>