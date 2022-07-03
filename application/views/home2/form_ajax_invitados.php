<style>

.exito_a {
    display: none;
    background: #E1F8ED;
    padding: 20px;
    margin-top: 16px;
    margin-bottom: 16px;
        &.activar {
            display: block;
        }
}


</style>


<div class="mr-1 pt-2 ml-2" style="width:340px;">

<p class="m-0 p-0">Para ponerte en contacto con ATLO puedes usar el <a style="color:blue; text-decoration: underline;"href="mailto:atlo@alto.es">[correo_electrónico]</a> o el <a style="color: blue; text-decoration: underline;" href="https://wa.me/34615890787" target="_blank">[whatsapp]</a>.</p> 

<p class="m-0 p-0">Además, si lo deseas, te invitamos a una clase gratuita para una o dos personas (completa el formulario)</p>

<form accept-charset="UTF-8" action="https://getform.io/f/02bf94ea-b203-4d10-8e20-7ff9769aa5ca" method="POST" enctype="multipart/form-data" target="_blank" id="formulario12">

<div class="form-group mt-1">
    <select class="form-control form-control-lg" required id="selecciona" name="platform" >
        <option disabled selected>SELECCIONA DÍA PREFERIDO:</option>
        <option>LUNES</option>
        <option>MARTES</option>
        <option>MIÉRCOLES</option>
        <option>JUEVES</option>
        <option>VIERNES</option>
    </select>
  </div>
  
  
<div class="form-row">
    <div class="col">
        <label for="exampleInputEmail1" required="required">E-mail: </label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="tucorreo@correo.es" value="">
    </div>
    
    
    <div class="col">
    <label for="exampleInputnombre1">Nombre:</label>
    <input type="text" name="nombre" class="form-control" id="exampleInputnombre1" placeholder="Nombre Apellido1 Apellido2" required="required" value="">
    </div>
    </div> <br>
  <!---
  <div class="form-group">
    <label for="texto">Escribe los detalles...</label>
    <textarea class="form-control" name="texto" id="texto" rows="1"></textarea>
  </div>

  <div class="form-group mt-0">
    <label class="mr-2">o manda un archivo:</label>
    <input capture type="file" name="file">
  </div>

  <div class="form-check form-check-inline mb-1">
      <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="compartir" id="comprtir" value="Archivo adjunto disponible en https://getform.io/forms/14397"> Acepto compartir el archivo con ATLO.
      </label>
  </div>
  -->

  <div class="exito_a">Todo ha ido bien. Gracias.</div> 
<p class="m-0 p-0"><small><small> Una vez recibido el mensaje, nos pondremos en contacto tan pronto como nos sea posible </small></small></p>
  <button type="submit" class="mt-1 btn btn-sm btn-block btn-success">Enviar</button>
</form>


</div>


<script>

$(document).ready(function(){

$("#formulario12").submit(function(e){

e.preventDefault();
var action = $(this).attr("action");
$.ajax({
type: "POST",
url: action,
crossDomain: true,
data: new FormData(this),
dataType: "json",
contentType: "multipart/form-data",
processData: false,
contentType: false,
headers: {
"Accept": "application/json"
}
}).done(function() {
swal({
    icon: "success",
    text: "Se ha mandado tu mensaje correctamente",
    button: false,
});

}).fail(function() {
swal({
    icon: "error",
    text: "Algo ha ido mal. Re-carga el menú y comprueba la conexión a internet. Si has adjuntado un archivo más grande de 25MB, también dará error.",
    button: false,
});
});
});
})

</script>