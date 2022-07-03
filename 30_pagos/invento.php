<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>


  <hr>
  <hr>
    <h1>Hello, world!</h1>
    <br>
    <?php require_once('./config.php'); ?>

    <form action="charge.php" method="post">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-description="Access for a year"
            data-amount="5000"
            data-locale="auto"></script>
    </form>

    <br><hr>

    <form action="create_sub.php" method="POST">

   
    WhatsApp: <input type="text" required name="whastapp"><br>
  

    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $stripe['publishable_key']; ?>"
        data-image="https://www.t-nation.com/system/publishing/articles/10000964/original/Beating-CrossFit-Drug-Test.jpg"
        data-name="Emma's Farm CSA"
        data-description="Subscription for 1 weekly box"
        data-panel-label = "GILIPOLLAS {{amount}}/MES",
        data-shipping-address="true",
        data-amount="2000"
        data-currency="EUR"
        data-locale="auto"
        data-label="PAGAR">
    </script>

    </form>

    <hr>

    <script src="https://checkout.stripe.com/checkout.js"></script>

    <button id="customButton">Purchase</button>

    <script>
    var handler = StripeCheckout.configure({
    key: 'pk_test_nbbBFHTwQgKjraGS8jUTwyTt',
    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
    }
    });

    document.getElementById('customButton').addEventListener('click', function(e) {
    // Open Checkout with further options:
    handler.open({
        name: 'atlo.es',
        description: '2 widgets',
        currency: 'eur',
        amount: 2000
    });
    e.preventDefault();
    });

    // Close Checkout on page navigation:
    window.addEventListener('popstate', function() {
    handler.close();
    });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>