<!doctype html>
<html lang="es">
  <head>
    <title>Pagos Sepa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    


  </head>
  <body>


    <div class="container-fluid">

    PRUEBA

    <form accept-charset="UTF-8" id="myForm" name="myForm" action="charge.php" method="post">

        <!---formulario--> 

        <div class="form-group">
        <label for="nombre">Nombre y Apellidos</label>
        <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="H_nombre" placeholder="nombre">
        <small id="H_nombre" class="form-text text-muted">Importante: esto lo leerá tu banco. No trolees.</small>
        </div>

        <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email"
            class="form-control" name="email" id="email" aria-describedby="H_email" placeholder="email">
        <small id="H_email" class="form-text text-muted">Escribe tu Correo Electrónico.</small>
        </div>  

        <div class="form-group">
        <label for="iban">IBAN</label>
        <input type="text"
            class="form-control" name="iban" id="iban" aria-describedby="H_Iban" value="DE89370400440532013000" placeholder="Ejemplo: DE89370400440532013000">
        <small id="H_Iban" class="form-text text-muted">Escribe tu número de cuenta. Necesitaremos, concretamente, el número IBAN que, en el caso de España, comienza por "ES". No uses espacios.</small>
        </div>

        <div class="form-group">
        <label for="stripe_id">Stripe ID</label>
        <input type="text"
        value = "cus_DEaU3KbKYlWzOS"
            class="form-control" name="stripe_id" id="stripe_id" aria-describedby="H_stripe_id" placeholder="Stripe Id">
        <small id="H_stripe_id" class="form-text text-muted">Escribe tu Stripe ID</small>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>

    </form>
        
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>