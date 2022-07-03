<?php
require_once('./stripe/init.php');

//número 32.

$stripe = [
  "secret_key"      => "sk_live_ZBQZAqvsYCWqfrzhp9x7jn9n",
  "publishable_key" => "pk_live_JT7afqco9ijWbkdzxBoTTjUE",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>