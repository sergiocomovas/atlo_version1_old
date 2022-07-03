<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>

<!--necesario cargarlo cada vez-->
<script src="<?= base_url()?>01_js/jquery.hscroll.js"></script>


<?php if($simbolo=="♠"){$color="#2A5FFB";} ?>
<?php if($simbolo=="♦"){$color="#E641EB";} ?>
<?php if($simbolo=="♣"){$color="#4DCA00";} ?>



<div class="fade show ml-3 cajasombra" id="scroll-area" style="overflow-y:hidden; padding: 0px 0px 0px 0px; border-radius: 0px 0px 0px 25px; background-color:<?= $color?> ">

    <div class="table-responsive scrollmenu m-4" style="overflow: hidden;">

        <h1>TU CLAN<br>
        <h5>Te asignamos automáticamente un Clan al darte de alta en un BOX ATLO.<br> 
        Actualmente hay tres clanes, aún sin nombre, representados por un símbolo de la baraja francesa.<br> 
        A lo largo de este segundo año esperamos trabajar en el desarrollo del concepto.<br>
        TU CLAN ACTUAL ES <big><big><?= $simbolo ?></big></big></strong></h5></h1>

    </div>

</div>