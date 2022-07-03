<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!--modal horario-->
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"> 
          Horario
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="float-left" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">

            
            <h3>Funcional Training<br>
            De Lunes a Viernes</h3>
            <hr>
            <code>10:00</code> Clase<br>
            <code>16:30</code> Clase<br>
            <code>18:30</code> Clase<br>
            <code>19:45</code> Clase<br>

            <pre>
            
            Y además... </pre>
            <code>Miércoles 17:30</code> Grupo Elite<br><br>

            <h3>Sábados</h3>
            <hr>
            <code>10:00</code> Haltero para todos.<br>
            <code>11:30</code> Megawod de la semana.<br><br>


            <div class="alert alert-primary" role="alert">
              <strong>El horario puede variar o estar desactualizado.</strong> Mira horario definitivo del día en el apartado "Reservas".
            </div>

            <div class="alert alert-secondary" role="alert">
              <strong>Clase de las 7:00 para atletas avanzados:</strong> Hay que confirmar con 24 horas de antelación al entrenador asignado por WhatsApp.
            </div>

            <div class="alert alert-secondary" role="alert">
              <strong>Activades ATLO PRO:</strong> Consultar directamente con tu profesional Atlo.
            </div>

            
            <div class="alert alert-secondary" role="alert">
              <strong>Escuela ATLO BALEAR:</strong> Obligatorio acceder al sistema con su número PIN y reservar clase.
            </div>
            




    
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Vale</button>
        </div>
      </div>
    </div>
  </div>
  

  <script>
    $('#exampleModal').on('show.bs.modal', event => {
      var button = $(event.relatedTarget);
      var modal = $(this);
      // Use above variables to manipulate the DOM
      
    });
  </script>