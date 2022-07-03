<?php
//require_once('vendor/autoload.php');
require_once('./stripe/init.php');

$stripe = array(
    "secret_key"      => "sk_test_BKZFGTqIY9iUbkhYuri0nIqV",
    "publishable_key" => "pk_test_nbbBFHTwQgKjraGS8jUTwyTt"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>

