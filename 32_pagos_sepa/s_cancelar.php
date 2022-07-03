<?php 


require_once('./config.php');

echo $cancelar  = trim($_GET['cancelar']); 



//CREAR UNA SOURCE

try
{  

    $sub = \Stripe\Subscription::retrieve($cancelar);
    $sub->cancel();


    echo '<meta http-equiv="refresh" content="0; url=https://v1.atlo.es/index.php/home?MENSAJE=SUSCRIPCIÓN_CANCELADA_SIN_ERRORES" />';





}catch(Exception $e)
{
  echo "<br>Algo ha ido mal.<br>";
  print_r($e->getMessage()); 


}








?>