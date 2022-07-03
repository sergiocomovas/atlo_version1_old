<?php $this->load->helper('date'); ?>

<h5 class="mx-2">
<p>Ofertas Nuevos Clientes (Solo Mes de <?php $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
             echo $meses[date('n')-1];?>).<br>

<small><small><small><small>OFERTAS PARA LO QUE RESTA DE ESTE MES: DEL <?= date('d')?>/<?= date('m')?> AL <?php echo days_in_month(date('n'), date('y')); ?>/<?= date('m')?>. FINALIZAN: <?php echo days_in_month(date('n'), date('y')); ?>/<?= date('m')?>.</small></small></small></small></p>


</h5>


<table class="table table-sm table-responsive scrollmenu">


    <script src="https://js.stripe.com/v3"></script>
  
    <tbody>
        <tr>

        <td style="min-width: 250px; border-top:0px none;" scope="row">
            
            <video width="240px" autoplay muted loop>
                <source 
                src="https://v1.atlo.es/00_img/2019_ofertas_enero/p11.mp4"  type="video/mp4">
            
            </video>

            <small>
            <p>Las promociones finalizan el último día de este mes. <strong>Hable con su entrenador sobre los descuentos para familias, amigos y federados (hasta -20€ de ahorro sobre la tarifa normal).</strong></p></small>
        
            <h5>Novedad: <a href="#oferta16">Compre ahora su primer entreno personal al 50%</h5>
            

        </td>

        <!--OFERTAS-->

        <?php 
        //recibe los parámetros de fecha

        
        $dia_hoy = date('j');

         $url = 'https://v1.atlo.es/index.php/0rest/A_ofertas/semanal/'.$dia_hoy;
        $data = file_get_contents($url);
        $ofertas_datos = json_decode($data, true);

        ?>

        <?php

        $texto_c=" ❤ Una vez confirmemos el pago, recibirás un correo electrónico explicándote los pasos a seguir. Además te proporcionaremos un número de WhatsApp en donde te atenderemos personalmente y resolveremos todas tus dudas. El correo electrónico de soporte técnico es sergio@mallorcainterbox.com";
        
        foreach ($ofertas_datos as $row)
        {
                echo '<td id="oferta'.$row['of_id'].'">';


                echo '<div class="card" style="width: 14rem;">
                <img class="card-img-top" src="https://v1.atlo.es/00_img/2019_ofertas_enero_2/'.$row['of_id'].'.PNG" alt="Card image cap">
                <div class="card-body">
                <small><span class="badge badge-secondary text-trucate">'.$row['of_producto'].'</span></small>
                  <h4 style="border-bottom: 3px solid #fff"><small><small><small>PRECIO:</small></small></small> €'.$row['of_promo'].'.-<br> <small><small><code style="color:#fff";>PVP Normal: €'.$row['of_precionormal'].'.-</code></small></small></h4>


                  <div class="form-group">
                    <label for="">Condiciones:</label>
                    <textarea readonly style="border-radius: 1px;" class="form-control" name="" id="" rows="3">'.$row['of_advertencias'].'</textarea>
                  </div>

                  <div class="form-group">
                    <label for="">Advertencias:</label>
                    <textarea readonly style="border-radius: 1px;"  class=" form-control" name="" id="" rows="3">'.$row['of_otros'].''.$texto_c.'</textarea>
                  </div>

                  <a href="#" id="checkout-button-'.$row['of_id'].'" class="btn btn-block btn-sm btn-secondary"><i class="fab fa-cc-stripe"></i> Pagar '.$row['of_clase'].'</a>
                </div>
              </div>';


              
              echo '</td>';

              echo "
              <script>
                var stripe = Stripe('pk_live_Xhh4PRFlxbTMvzl8H7gZlRq3', {
                  betas: ['checkout_beta_4']
                });
              
                var checkoutButton = document.getElementById('checkout-button-".$row['of_id']."');
                checkoutButton.addEventListener('click', function () {
                  // When the customer clicks on the button, redirect
                  // them to Checkout.
                  stripe.redirectToCheckout({
                    items: [{".$row['of_tpo'].": '".$row['of_ref']."', quantity: 1}],
              
                    // Note that it is not guaranteed your customers will be redirected to this
                    // URL *100%* of the time, it's possible that they could e.g. close the
                    // tab between form submission and the redirect.
                    successUrl: window.location.protocol + '//v1.atlo.es/index.php/home?MENSAJE=PAGO_REALIZADO_CORRECTAMENTE!!!!.#pills-home',
                    cancelUrl: window.location.protocol + '//v1.atlo.es/index.php/home?MENSAJE=PAGO_CANCELADO._POR_FAVOR_VUELVE_A_INTENTARLO.#pills-home',
                  })
                  .then(function (result) {
                    if (result.error) {
                      // If `redirectToCheckout` fails due to a browser or network
                      // error, display the localized error message to your customer.
                      var displayError = document.getElementById('error-message');
                      displayError.textContent = result.error.message;
                    }
                  });
                });
              </script>
              
              ";
        }

        ?>

   
       
        </tr>
      
    </tbody>
</table>