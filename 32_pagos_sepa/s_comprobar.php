<?php
  require_once('./config.php');

  $customer_id  = trim($_GET['date_invent']);
  //$customer_id = "cus_DYZgIiSTlwMlX9";
  

  //CREAR UNA SOURCE

  try
  {  

  //COMPROMAR DATOS


  $customer = \Stripe\Customer::retrieve($customer_id);


  //print_r(json_encode($customer->subscriptions));

 

  echo '<br><br><h6>Tienes '.$customer->subscriptions->total_count.' suscripción/es activa/s:</h6>';

  if($customer->subscriptions->total_count=='0'){echo "<br>No se están cargando recibos a tu cuenta bancaría o tarjeta de crédito.";}else{
  
  echo '<br><br>Ref.:  '.$customer->subscriptions->data[0]->id. ' (Suscripción 1 de '.$customer->subscriptions->total_count.')  -- '.$customer->subscriptions->data[0]->plan->nickname;


  echo '<form action="https://v1.atlo.es/32_pagos_sepa/s_cancelar.php" method="get">';
  echo '<input name="cancelar" type="hidden" id="cancelar" value="'.$customer->subscriptions->data[0]->id.'">'; 

  echo '<br><h6>¿Deseas cancelarla?</h6><br>';
  echo '<button class="btn btn-outline-warning" type="submit">---Sí---</button>';
  
  echo '</form>';

  }//fin del else



  }catch(Exception $e)
  {
    echo "<br>Algo ha ido mal<br>";
    print_r($e->getMessage()); 
 
  
  }

  


?>