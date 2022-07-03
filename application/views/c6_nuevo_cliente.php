
 <div class="py-5" >
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-1">Nuevo Cliente</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

          <form class="form" method="post" action="./procesos/nuevo_cliente_guardar.php">

            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">Nombre Real</label>
              <div class="col-sm-8">

                <!--nombre_real-->
                <input type="text" name="nombre_real" class="form-control form-control-lg" required="required">
              </div>
            </div>
            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">Nombre Público</label>
              <div class="col-sm-8">
                <!--nombre_real-->
                <input type="text" name="nombre_publico" class="form-control form-control-lg" required="required">
              </div>
            </div>
            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">Correo Electrónico</label>
              <div class="col-sm-8">
                
                <!--correo_electrónico-->
                <input type="email" name="correo_electronico" class="form-control form-control-lg" required="required">
              </div>
            </div>
            
            
            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">WhatsApp</label>
              <div class="col-sm-8">
              
                <!--whastapp-->
                <input type="number" name="telefono" class="form-control form-control-lg" required="required">
              </div>
            </div>

            
            <!--EN CASO DE EMERGENCIA AVISAR AA-->


            <div class="form-group form-row p-2">
           
              <label class="col-sm-4 col-form-label col-form-label-lg">Contacto A/A</label>
              <div class="col-sm-5">
              
                <!--contacto-eme-->
                <input type="text" name="aa_nombre" class="form-control form-control-lg" placeholder="En caso de emergencia..." required="required">
              </div>

              <div class="col-sm-3">
              <!--telf-eme-->
              <input type="number" name="aa_telefono" class="form-control form-control-lg" placeholder="Teléfono Emergencia"  required="required">
            </div>


            </div>


            <!--FIN EN CASO DE EMERGENCIA AVISAR AA-->


            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">Tratamiento</label>
              <div class="col-sm-8">

                <!--coso-->
                <select name="tratamiento" class="custom-control custom-select form-control-lg custom-control-inline">
                  
                  <option value=".">Normal</option>
                  <option value="+">Vip</option>
                  <option value="#">Leyenda</option>
                  <option value="" disabled>---Otras Opciones---</option>
                  <option value="$">Escuela</option>
                  <option value="=">Juez</option>
                  <option value="@">Admón</option>

                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block my-2">Enviar</button>
            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">Club</label>
              <div class="col-sm-8">
                <input readonly name="club" value="Atlobox Can Valero" type="text" class="form-control form-control-lg" required="required">
              </div>
            </div>
            <div class="form-group form-row p-2">
              <label class="col-sm-4 col-form-label col-form-label-lg">Retorno</label>
              <div class="col-sm-8">
                <input  value="1" readonly type="text" class="form-control form-control-lg" name="retorno" required="required">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>