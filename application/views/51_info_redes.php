<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--necesario cargarlo cada vez-->
<script src="https://v1.atlo.es/01_js/jquery.hscroll.js"></script>


<!-- Article style section -->

<div class="ml-4 scrollmenu cajasombra mt-4 mb-4" id="scroll-area" style="height:555px; overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 0px 0px 0px 0px; background-color:#FFF;">


        <div class="p-0 m-0 w-100 h-100"   id="loadedContent">

          
          <div class="text-center bg-dark h-100 text-warning"> 
          
            <br>Conectando con instagram...<br><i class="fas fa-ring fa-spin"></i> <br>
          
            <a style="" href="https://www.instagram.com/atlobarbellclub/" target="_blank"><i class="fab fa-4x fa-instagram"></i><br>@atlobarbellclub</a>
          </div>


        </div>
      
      


      
</div><!--fin del todo-->



<script>


  $(document).ready(function(){

    
    $('#loadedContent').load("https://v1.atlo.es/index.php/5instagram/instagram/ultimos"); 
    $('.scrollmenu').hScroll();

            
  }); 
    
  //$(function() {
  //    console.log( "Cargando Insta..." );
  // --    
  // });

</script>

