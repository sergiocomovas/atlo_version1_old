<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>



<?php if(isset($_GET['MENSAJE'])){

$msj = str_replace ('_' , ' ' , $_GET['MENSAJE']); 


echo '<script>

//https://sweetalert.js.org/


swal("VALE", "'.$msj.'", "success", {
  buttons: false,
  timer: 2000,

})

.then(function() {
  history.pushState(null, "", "home");
});


</script>';


} ?>




<script>
  $(".alert").alert();
</script>





<div class="navegacion animated slideinup slow"><div id="entr" class="shine">


        
    <a style="width: 25%;" class="menuajax" data-destino="<?= base_url()?>index.php/home/premium_clases"  id="premium_clases" href="javascript:void(0)" >
            <i id="ico_premium_clases" class="ico_camb far fa-minus-square"></i><br>
            <small><small>CLASES</small></small>
    </a>
    
    
    <a style="width: 25%; background-color:transparent;" class="menuajax" data-destino="<?= base_url()?>index.php/home/premium_wod" id="premium_wod" href="javascript:void(0)" >
            <i id="ico_premium_wod" class="ico_camb far fa-minus-square"></i><br>
            <small><small>WOD</small></small>
    </a> 

    
    <a style="width: 25%;" class="menuajax" data-destino="<?= base_url()?>index.php/home/premium_training" id="premium_training" href="javascript:void(0)" >
            <i id="ico_premium_training" class="ico_camb far fa-minus-square"></i><br>
            <small><small>ATLETA</small></small>
    </a> 

    <a style="width: 25%;" class="menuajax" data-destino="<?= base_url()?>index.php/home/premium_config" id="premium_config" href="javascript:void(0)" >
            <i id="ico_premium_config" class="ico_camb far fa-minus-square"></i><br>
            <small><small>CONFIG.</small></small>
    </a> 

</div></div>


<?php $this->load->view('home2/8footer.php'); ?>