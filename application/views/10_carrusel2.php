<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<!--incluye carrusel y modal de telegram-->


<?php $this->load->helper('url'); ?> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<!--<script async>


  $(document).ready(function(){ 
   console.log("Enlace Ajax preparado...");
   $(".enlaceajax").click(function(evento){

       evento.preventDefault();

       $.get("https://v1.atlo.es/index.php/telegram/data", {
           
           telegraf: $(this).attr('data-url-telegraf')}, 
           
           function(respuesta){
       $("#destino").html(respuesta);
               //document.getElementById('selection'+select).disabled = true;
   })

       
   });
 })
  


  

</script>--> 


<script type="text/javascript">

$(document).ready(function(){

      var height = $(window).height();

      $('.div2').height(height);
      $('.div3').height(height/2);
      
});

</script>

<!-- fin ajax-->


<!--modal1-->
<!-- Modal Telegrah -->
<div class="modal fade" style="background-color:#770124;;" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

  <div class="modal-dialog modal-lg" style="background-color:#770124;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">atlo.es  <small><span style="color:#900c3e">|</span> NOTICIAS</small></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span> 
          </button>
      </div>
      <div class="modal-body">
        <div id="destino">Un segundo...</div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>      

<!--nueva temporada-->


<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">

<div class="text-center div2 w-100" style='
  background-image: url("https://v1.atlo.es/00_img/f1.jpeg");
  background-repeat: no-repeat;
  background-position: center center;
  background-attachment: fixed;
  background-color:black;' >

    <div class="p-3 text-center">

        <img src="https://v1.atlo.es/00_img/ATLO_ESPANYA2.svg" class="div3  img-fluid" alt="">

    </div>


    <div style=" font-family: 'Saira Stencil One', cursive;" id="contador_01" class="h2 text-center"></div>
</div>




<script>

$( document ).ready(function() {


    //Set color
    $("#fondo-color").css({"background":"linear-gradient(0.50turn, crimson, mediumvioletred)"});  
    
    // Set the date we're counting down to
    var countDownDate = new Date("Sep 23, 2019 07:00:00").getTime();

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

    // Display the result in the element with id="contador_xx"
    document.getElementById("contador_01").innerHTML = "LA <span style='color:yellow'>NUEVA TEMPORADA</span>  DEL ATLO TRAINING CLUB COMIENZA EN...<br>" + days +" días " + hours + " horas "
    + minutes + " min. " + seconds + " seg.";
    // If the count down is finished, write some text 
    // "." <--cambiar
    if (distance < 0) {
    clearInterval(x);
    document.getElementById("contador_01").innerHTML = "European Week of Sport 2019<br> EUROPE,<br> let's#BeActive!";
    }
    }, 1000);

});

</script>