<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="https://www.comovas.es/ico.ico">
  <title>Tarifa Club - Atlo Barbell Club</title>
  <meta name="description" content="Contrata ahora la mejor tarifa de nuestro centro de entrenamiento en Palma de Mallorca.">
  <meta name="keywords" content="socios, crossfit, fitness, atlo, can valero, gym, tarifas, precios, descuentos, ofertas, compra ahora, gimnasio barato, crossfit barato, mejor precio.">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../webfonts/stylesheet.css">
 
  <link rel="stylesheet" href="neon.css">
  <!-- Script: Make my navbar transparent when the document is scrolled to top -->
  <script src="js/navbar-ontop.js"></script>
  <!-- Script: Animated entrance -->
  <script src="js/animate-in.js"></script>
</head>

<body>

<style>
  .feedback {
  background-color : #31B0D5;
  color: white;
  padding: 10px 20px;
  border-radius: 4px;
  border-color: #46b8da;
  
}

#mybutton {
  position: fixed;
  bottom: -4px;
  right: 10px;
  z-index: 2 !important; 
}

/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed !important; /* Stay in place */
  z-index: 10 !important; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: #5F6A6A; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #faf;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #faf;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>


  <div id="mybutton">
  <button onclick="openNav()" class="feedback">¿Cómo llegar?</button>
  </div>

<? 
    unset($_COOKIE['__cfduid']); 
?>


    <?php
    if ($_GET['MENSAJE']!==null){
  
      echo '<div class="py-5 text-center bg-secondary" >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <h1 class="text-light"><br>'.str_replace('_',' ',$_GET['MENSAJE']).'</h1>
  
                <p><a href="https://www.atlo.es/"> <i class="fas fa-redo"></i> Volver</a>
                </p>
  
                <p>
                Para incidencias ponte en contacto con el  
                <a href="mailto:sergio@mallorcainterbox.com"> equipo de soporte técnico</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>'; 
    }
  ?>

  
<div id="mySidenav" class="sidenav">

  <br>

  <div class="container">

  <br>
  <br>
  <br>
        <h3>Google Maps</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3074.3284099418142!2d2.6274003146903278!3d39.59728387946881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1297932c8b09da29%3A0x61e624f7a3417d5d!2sAtlo+Barbell+Club!5e0!3m2!1ses!2ses!4v1530132856432" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        <p>CARRER CAN VALERO 31, POLIGONO DE CAN VALERO</p>
        <p>Para no perderse: En la rotonda de la Gasolinera Repsol de Can Valero/Son Valentí, seguir la Calle Can Valero hasta el final: es una calle larga de tiene una curva y atraviesa la calle principal del polígono. Estamos al final de esa calle y delante la Sala Dante.</p>
  </div>


  <button style="color:000;"type="button" onclick="closeNav()" name="" id="" class="btn btn-primary btn-lg btn-block">ENTENDIDO</button> <br><br>



</div>



  <!-- Navbar -->
  <nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
    <div class="m-2 container-fluid" id="p_navbar">
      <a  class="navbar-brand align-self-center p-1" href="#p_menu_1">
        <h6>
          <small>TARIFA</small> Club.</h6>
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        <ul class="navbar-nav">


          <li class="nav-item mx-2">
            <a class="nav-link" href="https://atlo.es/barbellclub/#ultimas"><i class="fas fa-level-up-alt" data-fa-transform="flip-v"></i></a>
          </li>

          <li class="nav-item mx-2">
            <a class="nav-link" href="#p_principal">Precio</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="#p_seguro">Seguro federativo</a>
          </li>
          
        </ul>
        <a href="#p_apuntate" class="btn navbar-btn btn-primary shadowed mx-2" href="#download">
          <i class="fas fa-star"></i> CONTRATAR AHORA</a>
      </div>
    </div>
  </nav>


  
  <!-- Cover -->
  <div id="p_menu_1" class="section-fade-out pt-5 bg-info w-100" style=" background-position: bottom;background-size:auto;">


    <div class="container mt-5 pt-5" id="p_home">
      <div class="row">
        <div class="col-md-6 my-4 text-lg-left text-center align-self-center">
          <h1 class="display-2">
            <small>TARIFA</small> Club.</h1>
          <p class="lead">Nuestra mejor oferta, ahora pensada para todos. ¡Únete a la experiencia Atlo!</p>
          <div class="row m-2">
            <small>
              <div class="list-group">
                <a href="#p_principal" class="list-group-item list-group-item-action"> Ver Precio y Características </a>
                <a href="#p_ofertas" class="list-group-item list-group-item-action">
                  <i class="fas fa-pulse fa-percentage"></i> Ver Ofertas
                  <br>
                  <small><spam id="demo"></spam></small>
                </a>
                <a href="#p_euroteams" class="list-group-item list-group-item-action">¡Ventajas por apuntarse!</a>
                <a href="#p_plus" class="list-group-item list-group-item-action">Otras Opciones de Contratación</a>
                <a href="#p_apuntate" style="color:yellow;" class="list-group-item list-group-item-action">
                  <i class="fas fa-star"></i> CONTRATAR AHORA</a>
              </div>
            </small>
          </div>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid my-2 d-block mx-auto" src="assets/img/tarifa_club_caratula.png" width="400"> </div>
      </div>
    </div>
  </div>


  <!--fotos-->
  <div class="py-5 bg-secondary">
    <div class="container-fluid" >
      <div class="row">

        <div class="p-0 col-md-2 col-6">
          <a href="#p_ofertas">
            <img src="./assets/img/foto_1.jpg" class="img-fluid"> </a>
        </div>
        <div class="p-0 col-md-2 col-6">
          <a href="#p_ofertas">
            <img src="./assets/img/foto_3.jpg" class="img-fluid"> </a>
        </div>
        <div class="p-0 col-md-2 col-6">
          <a href="#p_ofertas">
            <img src="./assets/img/foto_2.jpg" class="img-fluid"> </a>
        </div>
        <div class="p-0 col-md-2 col-6">
          <a href="#p_ofertas">
            <img src="./assets/img/foto_6.jpg" class="img-fluid"> </a>
        </div>
        <div class="p-0 col-md-2 col-6">
          <a href="#p_ofertas">
            <img src="./assets/img/foto_4.jpg" class="img-fluid"> </a>
        </div>
        <div class="p-0 col-md-2 col-6">
          <a href="#p_ofertas">
            <img src="./assets/img/foto_5.jpg" class="img-fluid"> </a>
        </div>
      
      
      </div>
    </div>
  </div>

 <?php include 'tarifa_club.php';?>
  
  <div class="py-5 bg-dark w-100">
    <div class="container">
      <div class="row">
        <div class="col-12 my-3 text-center">
          <p class="text-muted">ALTO BARBELL CLUB<br><a href="https://atlo.es/barbellclub/#ultimas">VOLVER A LA PÁGINA PRINCIPAL</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- JavaScript dependencies -->
  <script>
    function mostrarDiv(capa) {
        
        var x = document.getElementById(capa);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Script: Smooth scrolling between anchors in the same page -->
  <script src="js/smooth-scroll.js"></script>
  <script>
      // Set the date we're counting down to
      var countDownDate = new Date("July 10, 2018 01:00:00").getTime();
      
      // Update the count down every 1 second
      var x = setInterval(function() {
      
        // Get todays date and time
        var now = new Date().getTime();
      
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
      
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = "¡El tiempo se acaba en " + days + "d " + hours + "h "
        + minutes + "m " + seconds + "s!";
      
        // If the count down is finished, write some text 
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("demo").innerHTML = "!!! !!! !!! !!! !!!";
        }
      }, 1000);
  </script>

  <script>

    /* Set the width of the side navigation to 250px */
    function openNav() {
      document.getElementById("mySidenav").style.width = "100%";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

  </script>
  

</body>

</html>