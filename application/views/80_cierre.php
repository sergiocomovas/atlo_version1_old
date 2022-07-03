<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Script: Animated entrance -->
<script src="<?= base_url()?>/01_js/animate-in.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>-->
<script src="<?= base_url()?>01_js/jquery.hscroll.js"></script>
<!--<script src="<?= base_url()?>01_js/contador_01.js"></script>-->
<!--jquery.mousewheel.js -->
<!--<script src="https://www.atlo.es/css/jquery.mousewheel.js"></script>-->
<!--https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js -->
<script src="<?= base_url()?>01_js/popper.min.js" ></script>
<!--mensajes pop-->
<script src="<?= base_url()?>01_js/bootstrap-notify.js" ></script>
<script src="<?= base_url()?>01_js/bootstrap-notify.min.js" ></script>


<!--script para activar el botón-->

<script>
  function enableSubmit(e,n)
  { 
    
    document.getElementsByName("bot"+n)[0].disabled=e.selectedIndex==0;
  
  }
</script>



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




  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Script: Smooth scrolling between anchors in the same page 
  <script src="https://www.comovas.es/powerg/js/smooth-scroll.js"></script>-->

  <!--<script>
  $(document).ready(function(){
    
    $('.scrollmenu').hScroll(100); // You can pass (optionally) scrolling amount
    });
  
  </script>-->
  
  <!--contador-->
  <!--<script src="<?= base_url()?>01_js/contador_01.js" ></script> -->
  <!--<div id="contador_01"></div>-->

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


 <!--<script>
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("navbar-fija");
    var sticky = navbar.offsetTop;

    function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
    }
  </script>-->

  <script src="https://v1.atlo.es/pwabuilder-sw-register.js"></script>


  <div id="cookie-banner" style="text-align: right;" class="cookie animated slideInDown slower">
    Cookies obligatorias
    <span class="button-info"><a href="https://v1.atlo.es/00_00/Bolet%C3%ADn_18.pdf" target="_blank">+info</a></span>
    <span id="cookie-button" class="button-ok"><a href="#">Aceptar</a></span>
</div>



  <script>
  
    function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";}

    function createAcceptCookie() {
    var cookieBanner = document.getElementById("cookie-banner");
    document.cookie = "accepted_cookie_policy=yes; expires=" + setExpiryDate() + ";";
    cookieBanner.classList.add("accepted-cookie-policy");
    }

    function setExpiryDate() {
    var d = new Date();
    d.setFullYear(d.getFullYear() + 1);
    return d.toUTCString();
    }

    var isCookieSet = getCookie("accepted_cookie_policy");
    if (isCookieSet === "") {
    document.getElementById("cookie-button").addEventListener("click", createAcceptCookie);
    } else {
    document.getElementById("cookie-banner").classList.add("accepted-cookie-policy");
    }

</script>


<!--instalar app-->


<script>
    let deferredPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent Chrome 67 and earlier from automatically showing the prompt
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
});

async function install() {
  if (deferredPrompt) {
    deferredPrompt.prompt();
    console.log(deferredPrompt)
    deferredPrompt.userChoice.then(function(choiceResult){

      if (choiceResult.outcome === 'accepted') {
      console.log('Your PWA has been installed');
    } else {
      console.log('User chose to not install your PWA');
    }

    deferredPrompt = null;

    });


  }
}</script>






  <!--
  <script>
  
  var button = document.getElementById('slide');

  button.onclick = function () {
      var container = document.getElementById('scroll-area');
      sideScroll(container,'right',20,500,100);
  };

  var back = document.getElementById('slideBack');
  back.onclick = function () {
      var container = document.getElementById('scroll-area');
      sideScroll(container,'left',20,500,100);
  };

  function sideScroll(element,direction,speed,distance,step){
      scrollAmount = 0;
      var slideTimer = setInterval(function(){
          if(direction == 'left'){
              element.scrollLeft -= step;
          } else {
              element.scrollLeft += step;
          }
          scrollAmount += step;
          if(scrollAmount >= distance){
              window.clearInterval(slideTimer);
          }
      }, speed);
  }
  </script>
  -->   

