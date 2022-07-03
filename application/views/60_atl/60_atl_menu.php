

<?php
$this->load->library('session');


if($this->session->userdata('username') != ""){?>
    

<!--
<div id="colecciones" class="row" style="position: relative;
  bottom: 150px; margin-left: 20px;
  margin-right: 20px;">
  

<div class="col-sm-1"></div>
  <div class="col-sm-5 m-1 p-0">
    <div class="card mt-1">
      <div class="card-body">
        <h5 class="card-title">Entrenos disponibles</h5>
        <p class="card-text">Guarda en Colecciones los entrenos que ya has hecho. Añade o edita Resultados.</p>
        <a href="javascript:void(0);" onclick="openNav_atl()" class="btn btn-primary">Añadir Colecciones</a>
      </div>
    </div>
  </div>

  <div class="col-sm-5 m-1 p-0">
    <div class="card mt-1">
      <div class="card-body">
        <h5 class="card-title">Elementos Guardados</h5>
        <p class="card-text">Busca y examina los entrenos almacenados en tus colecciones. Comparte con tus amigos.</p>
        <a href="javascript:void(0);" onclick="openNav_atl2()" class="btn btn-primary">Ver Colecciones</a>
      </div>
    </div>
  </div>

  <div class="col-sm-1"></div>
  
</div>
-->

<div id="mySidenav_atl" class="sidenav-atl">

 <?php $this->load->view('60_atl/60_atletas_paso1'); ?>

</div>


<div id="mySidenav_atl2" class="sidenav-atl">

 <?php $this->load->view('60_atl/60_atletas_buscar'); ?>

</div>



<script>
/* Set the width of the side navigation to 250px */
function openNav_atl() {
  document.getElementById("mySidenav_atl").style.width = "100%";
  document.getElementById("mySidenav_atl").style.padding = "0px";
}

/* Set the width of the side navigation to 0 */
function closeNav_alt() {
  document.getElementById("mySidenav_atl").style.width = "0";
}
</script>


<script>
/* Set the width of the side navigation to 250px */
function openNav_atl2() {
  document.getElementById("mySidenav_atl2").style.width = "100%";
  document.getElementById("mySidenav_atl2").style.padding = "0px";
}

/* Set the width of the side navigation to 0 */
function closeNav_alt2() {
  document.getElementById("mySidenav_atl2").style.width = "0";
}
</script>


<? } ?>