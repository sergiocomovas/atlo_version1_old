<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>




<div class="navegacion animated slideinup slow"><div id="entr"> 



<!--<a style="width: 25%;" class="menuajax" data-destino="<?= base_url()?>index.php/home/premium_clases"  id="premium_clases" href="javascript:void(0)" >
            <i id="ico_premium_clases" class="ico_camb far fa-minus-square"></i><br>
            <small><small>CLASES</small></small>
</a>-->


<a style="width: 100%;"  href="https://v1.atlo.es/index.php/zonaprivada/login" >
            <i id="ico_premium_clases" class="ico_camb far fa-minus-square"></i><br>
            <small><small>ACCESO CLIENTES</small></small>
</a>

    
    
</div></div>

<?php $this->load->view('home2/8footer.php'); ?>