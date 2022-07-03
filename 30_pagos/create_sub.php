<?php // Create a customer using a Stripe token

// If you're using Composer, use Composer's autoload:
//require_once('vendor/autoload.php');

// Be sure to replace this with your actual test API key
// (switch to the live key later)
// \Stripe\Stripe::setApiKey("sk_test_BKZFGTqIY9iUbkhYuri0nIqV");

require_once('./config.php');

$wp  = $_POST['whastapp'];

$user_cosa = array(
  "address" => array("line1" => $_POST['stripeBillingAddressLine1']),
  "name" => $_POST['stripeBillingName'],
  "phone" => $wp,
);

echo json_encode($user_cosa);

try
{
    
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  

  $response = \Stripe\Customer::all(["limit" => 100, "email" => $email]);

  $user_info = array(
    "First_Name" => $_POST['stripeBillingName'], 
    "Last_Name" => "pollo2", 
    "Address" => "loqesea2",
    "Telf" => $wp, 
    "Zip_Code" => "070082",
    );


    if (isset($response->data[0]->id)) {

        //existe
        $cliente = $response->data[0]->id;

        $cu = \Stripe\Customer::retrieve($cliente);
        $cu->description = "Pasa";
        $cu->source = $_POST['stripeToken'];
        $cu->metadata = $user_info; 
        echo $cu->shipping = $user_cosa; 

        $cu->save();

    }else{

        //no existe
        $customer = \Stripe\Customer::create(array(
            'email' => $_POST['stripeEmail'],
            'source'  => $_POST['stripeToken'],
          ));
        
        $cliente = $customer->id;

    }
    

  echo $subscription = \Stripe\Subscription::create(array(
    'customer' => $cliente,
    'items' => array(array('plan' => 'plan_CyHEpJ8sGd5dXY')),
    'trial_end' => 1530403200,
    //1530403200
  ));


  $charge = \Stripe\Charge::create(array(
    'customer' => $cliente,
    'amount'   => 5000,
    'currency' => 'eur',
    'description' => 'Example charge',
    'receipt_email' => $email,
));

  //header('Location: thankyou.html');
  echo "<hr>gracias";
  exit;

}

catch(Exception $e)
{

  //header('Location:oops.html');
  echo error_log("unable to sign up customer:" . $_POST['stripeEmail'].
    ", error:" . $e->getMessage());

}