<p class="text-center text-primary"> <BIG><BIG> ATLO AÑO 2 </BIG></BIG> </p>

<h2 class="text-center"><hr></h2> 

<div id="contador_01" class="h2 text-center"></div>

<p class="text-center"> </p>




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
    document.getElementById("contador_01").innerHTML = "LA <strong style='color:yellow'>NUEVA TEMPORADA</strong>  DEL ATLO TRAINING CLUB COMIENZA EN...<br><br>" + days +" días<br> " + hours + " horas<br> "
    + minutes + " min.<br> " + seconds + " seg.<br>";
    // If the count down is finished, write some text 
    // "." <--cambiar
    if (distance < 0) {
    clearInterval(x);
    document.getElementById("contador_01").innerHTML = "European Week of Sport 2019<br> EUROPE,<br> let's#BeActive!";
    }
    }, 1000);

});

</script>