<?php
require_once('./stripe/init.php');

$stripe = [
  "secret_key"      => "sk_live_P1BM1PhPZIyO0eF5YvuuC1Yj",
  "publishable_key" => "pk_live_Xhh4PRFlxbTMvzl8H7gZlRq3",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>