
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>


<!--necesario cargarlo cada vez-->
<script src="https://v1.atlo.es/01_js/jquery.hscroll.js"></script>





<div class="scrollmenu ml-4 cajasombra mt-4 mb-4" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 25px 0px 0px 0px; background-color:#fff;">

<table id="t3"><!--incio div tabla-->


<!--PRIMERA CELDA-->

<th  valign="top" style="color: #FFF; padding: 0px 0px 0px 0px;" >


    <td>
    <img src="https://v1.atlo.es/00_img/2019_oferta_pre_temporada/atlo_12.png" class="div5" >
    </td>

    <td>
    <img src="https://v1.atlo.es/00_img/2019_oferta_pre_temporada/atlo_12_oferta_euro/Diapositiva1.PNG" class=" div5" >
    </td>
   
    <td>
    <img src="https://v1.atlo.es/00_img/2019_oferta_pre_temporada/atlo_12_oferta_euro/Diapositiva4.PNG" class="div5" >
    </td>
 
    <!--
    <td>
    <img src="https://v1.atlo.es/00_img/2019_oferta_pre_temporada/atlo_12_oferta_euro/Diapositiva5.PNG" class="div5" >
    </td>

    <td>
    <img src="https://v1.atlo.es/00_img/2019_oferta_pre_temporada/atlo_12_oferta_euro/Diapositiva7.PNG" class="div5" >
    </td>-->

    <td>
    <img src="https://v1.atlo.es/00_img/2019_oferta_pre_temporada/atlo_12_oferta_euro/Diapositiva8.PNG" class="div5" >
    </td>

    <td valign="bottom" class="text-secondary">

    <?php $this->load->view('home2/form_ajax_invitados'); ?>

    </td>

</th>


</table>



</div>


<script>


    $(document).ready(function(){

        $('.scrollmenu').hScroll();
        var height = $(window).height();
        $('.div5').height(height/1.5);
        $('.div5').width(height/1.5);
            
    });



</script>
