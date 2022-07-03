<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<!--incluye carrusel y modal de telegram-->


<?php $this->load->helper('url'); ?> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<script async>


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

<!--carrusel_top-->
<div id="carouselExampleIndicators" class="carousel carousel-fade slide" data-ride="carousel" data-interval="4000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" ></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
      
    </ol>
    <div class=" carousel-inner">

        <div class="carousel-item ">
        <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/6.PNG" alt="">
        <div class="carousel-caption d-none d-md-block">
          
          <p class="text-left" style="margin: 0 0 20px 31%;" >

            <a name="" id="" class="btn btn-light" href="https://atlo.es/barbellclub/home/index.php#p_principal" role="button">Más info</a>
          
          
          </p>
        </div>
        </div>

        <div class="carousel-item active">
        <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/1.PNG" alt="">
        </div>

        <div class="carousel-item">
        <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/2.PNG" alt="">
        </div>
        
        <div class="carousel-item">
        <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/3.PNG" alt="">
        </div>

        <div class="carousel-item">
            <a  class="enlaceajax" 
            
            href="#" 
            data-url-telegraf="https://api.telegra.ph/getPage/GRUPO-ATLO-01-11?return_content=true"
            data-toggle="modal" 
            data-target="#modal1" >

            <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/5.PNG" alt="">

            </a>
        
        
        </div>

        <div class="carousel-item">
        <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/4.PNG" alt="">
        </div>

        <div class="carousel-item">

            <a  class="enlaceajax" 
        
                href="#" 
                data-url-telegraf="https://api.telegra.ph/getPage/SEGURO-FEDERATIVO-SF3-01-11?return_content=true"
                data-toggle="modal" 
                data-target="#modal1"           
            >
            <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/7.PNG" alt=""> 
        
        </a>
        
        </div>

        
        <div class="carousel-item">
        <img class="d-block w-100" src="https://v1.atlo.es/00_img/2019_carrsuel_verano_1/8.PNG" alt="">
        </div>
       

     

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Atrás</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
  </div>


