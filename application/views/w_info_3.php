<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js">
</script>

<script>

$(document).ready(function(){ 

    $("#enlaceajax").click(function(evento){  
    
        evento.preventDefault();
        
        
        //$("#destino").load("https://v1.atlo.es/32_pagos_sepa/s_comprobar.php");
        $.get("https://v1.atlo.es/index.php/informes/recibir_informe", {
            
            date_invent1 : $(invent1).val(),  
            date_invent2 : $(invent2).val(),    
            date_invent3 : $(invent3).val(),  
            date_invent4 : $(invent4).val(),    
            date_invent5 : $(invent5).val(),  
            
            date_invent7 : $(invent7).val(),  
            date_invent8 : $(invent8).val(),    
            date_invent9 : $(invent9).val(),  
            date_invent10 :$(invent10).val(),    
            date_invent11 :$(invent11).val()
            
            }, 
            
            function(respuesta){
                
                $("#resp1").html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
        })

        
    });
})


</script>


<div class="py-5 text-center" style="">
    <div class="container">
      <div class="row" style="" >
        <div class="mx-auto col-lg-6 col-10">
          

        <p id="entrenador">
            
            <button class="btn btn-secondary btn-block" type="button" data-toggle="collapse" data-target="#cReporte" aria-expanded="false" aria-controls="cReporte">
               <i class="fas fa-user-injured"></i> TU ENTRENADOR
            </button>
        </p>
            
        <div class="collapse" id="cReporte">
            <div class="card card-body">
                <code>//Funciona Correctamente.</code>


                <h3 class="">INFORMES AL ENTRENADOR<br><small><small>TODOS LOS CAMPOS SON OPCIONALES</small></small></h3>
        
                <form>

                <input type="hidden" class="form-control" id="invent1" value="<?=$user_id?>">
              
                <input type="hidden" class="form-control" id="invent2" value="<?=$day_id?>">

                <input type="hidden" class="form-control" id="invent3" value="<?=$dias_date?>">
                
                <input type="hidden" class="form-control" id="invent4" value="<?=$clase_id?>">


                <div class="form-group">
                <label for="sel1">Sensación subjetiva tras acabar la clase:</label>
                <select class="form-control" id="invent5">
                    <option>[100] Prefiero no decirlo.</option>
                    <option>[101] Como si nada/indiferencia o desinterés en el entrenamiento.</option>
                    <option>[102] Leve o moderada sensación de agotamiento.</option>
                    <option>[103] Lo justo y necesario para mi :)</option>
                    <option>[104] Un gran reto.</option>
                    <option>[105] Casi muero... pero bien.</option>
                    <option>[106] Casi muero... pero mal/frustrante por lo inalcanzable ;-(</option>
                </select>
                </div>

                <div class="form-group">
                <label for="sel1">Cosas que podríamos haber hecho mejor en el día de hoy:</label>
                <select class="form-control" id="invent7">
                    <option>[200] Todo bien.</option>
                    <option>[201] A la clase de faltaba fluidez y organización.</option>
                    <option>[202] La clase me faltaba variedad: es casi siempre lo mismo.</option>
                    <option>[203] Faltaban un par de explicaciones.</option>
                    <option>[204] La música elegida era horrible.</option>
                    <option>[205] El box estaba sucio o había cosas tiradas por el suelo.</option>
                    <option>[290] OTROS.</option>
                </select>
                </div>

                <div class="form-group">
                <label for="sel3">Lesiones y molestias tras acabar el wod:</label>
                <select class="form-control" id="invent8">
                    <option>[300] NADA.</option>

                    <option disabled>---</option>

                    <option>[311] Molestia Leve: Rodillas, caderas o piernas.</option>
                    <option>[312] Molestia Grave: Rodillas, caderas o piernas.</option>
                    <option>[313] Recuperándome: Rodillas, caderas o piernas.</option>

                    <option disabled>---</option>

                    <option>[321] Molestia Leve: Lumbares o espalda.</option>
                    <option>[322] Molestia Grave: Lumbares o espalda.</option>
                    <option>[323] Recuperándome: Lumbares o espalda.</option>

                    <option disabled>---</option>

                    <option>[331] Molestia Leve: Hombros/Codos/Muñecas/Cervicales.</option>
                    <option>[332] Molestia Grave: Hombros/Codos/Muñecas/Cervicales.</option>
                    <option>[333] Recuperándome: Hombros/Codos/Muñecas/Cervicales.</option>

                    <option disabled>---</option>

                    <option>[351] Falta de aire/asma/problema respiratorio.</option>

                    <option disabled>---</option>

                    <option>[361] Mareo/Pérdida de equilibro/malestar general.</option>

                    <option disabled>---</option>

                    <option>[371] Pulso extraño/molestias o pinchazos (en el corazón).</option>
                    
                    <option disabled>---</option>

                    <option>[390] OTROS.</option>
                </select>
                </div>
                
                
            
                <div class="form-group"> <label for="form18">Comentarios o dudas a tu entrenador (lo leerá el entrenador)</label> <textarea class="form-control form-control-lg" id="invent9" rows="10" placeholder="Hola entrenador, me gustaría pedirte/comentarte que..."></textarea>
                </div>

                <div class="form-row">
                <div class="form-group col-md-6"> <label for="form19">SEGUIMIENTO 1</label> <input type="text" class="form-control" id="invent10" placeholder="Por ejemplo, dieta o peso..."> </div>
                <div class="form-group col-md-6"> <label for="form20">SEGUIMIENTO 2</label> <input type="text" class="form-control" id="invent11" placeholder="Por ejemplo, rendimiento o rehabilitación de Lesiones"> </div>
                </div>
                <br>
               


                <a onclick="main()" name="enlaceajax" id="enlaceajax" class="btn btn-block btn-primary btn-lg" role="button">ENVIAR INFORME</a>


                <br>
                <p id="entrenador">Tu entrenador: <strong>José Dávila</strong> <br>
                <small>Este mes puedes enviar aún: +99 informes más.</small></p>

                <div id="resp1"><code>Informe aún no enviado...</code></div>

            </form>
            </div>
        
        </div>

          
        </div>
      </div>
    </div>
</div>


<script>
function main(){
document.getElementById("resp1").innerHTML =
"<code> ===== ¡ESPERE! ===== </code><br><code style='color:yellow';>El bot wendy está redactando el mensaje al entrenador seleccionado. Recibirás una copia de este por e-mail</code>";
}
</script>
