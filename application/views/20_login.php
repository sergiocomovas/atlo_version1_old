<div class="mt-1" style="max-width:700px; margin: 0 auto;    ">


<h5 class="mt-1 text-center"><small>BIENVENIDOS A </small>A<small>TLO</small>
<p class="mt-0 text-center"><small><small><small><small><a href="https://atlo.es">CONTINÚA SIN REGISTRARSE >></a></small></small></small></small></p></h5>



     <?php
    if ( isset($_GET['MENSAJE']) ){
  
      echo '
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <h1 class="text-light"><br>'.str_replace('_',' ',$_GET['MENSAJE']).'</h1>
  
                <p><a href="https://www.atlo.es/"> <i class="fas fa-redo"></i> Volver</a>
                </p>
  
                <p>
                Para incidencias ponte en contacto con el  
                <a href="mailto:sergio@mallorcainterbox.com"> equipo de soporte técnico</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    '; }
    ?>




    <form name="formulario_sin" id="formulario_sin" method="post" action="<?= base_url();?>index.php/zonaprivada/acceder_sin">

        <input type="hidden" id="username_sin" name="username_sin" class="form-control" />
       
    </form>






    <div class="container mt-0"> 



        

        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    
                    <a class="p-2 nav-link active text-center" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-user-check"></i> <span class="d-none d-sm-block">Clientes</span></a>


                    <a class="p-2 my-2 nav-link text-center" id="v-pills-escuela-tab" data-toggle="pill" href="#v-pills-escuela" role="tab" aria-controls="v-pills-escuela" aria-selected="false"><i class="fas fa-university"></i><span class="d-none d-sm-block"> Escuela Atlo<span></a>

                    <a class="p-2 nav-link text-center" id="v-pills-instrucciones-tab" data-toggle="pill" href="#v-pills-instrucciones" role="tab" aria-controls="v-pills-instrucciones" aria-selected="false"><i class="fas fa-question-circle"></i></a>
                    

                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <?php 
                    $this->load->helper(array('form', 'url'));
                    date_default_timezone_set('Europe/Berlin');     
                    $fecha = date('Y-m-d');  
                    ?>
                    
                    <div id="email"></div>
                    <form name="formulario_con" id="formulario_con" method="post" action="<?= base_url();?>index.php/zonaprivada/login_validation"> 

                    <small> 
                            
                        <div class="border border-primary mb-2 rounded-bottom shadow-lg" class="form-group">  
                                <p class="m-3"><code>1.</code> Introduce tu e-mail. <i>Enter e-mail, PIN and symbol.</i>  
                                <input type="text" id="username" name="username" class="form-control" />  
                                <span class="text-danger"><?php echo form_error('username'); ?></span>   

                                <span class="float-right"> <i class="fas fa-rotate-90 fa-sort"></i> | 
                                <a href="#aviso" onclick="enviar_formulario_sin()"><i class="fas fa-unlock-alt"></i>  ACCEDER SIN PIN</a> |</span>      </p>         
                        </div>  
                        
                        <div class="form-group">  

                                <p class="m-3"><code>2a.</code> Introduce tu PIN
                                <input pattern="[0-9]*" inputmode="numeric" type="password" name="password" class="form-control" />  
                                <span class="text-danger"><?php echo form_error('password'); ?></span> </p> 
                        </div>  
                        
                        <div class="form-group">  
                                <p class="m-3"><code>2b.</code> Pulsa sobre tu icono.</p> 

                                <div class="row ml-1">

                                <!--<div class="col">
                                    <input style="background-color:ED2C31;" type="button" name="insert" onclick="simbolo('♥')" value="♥" class="btn btn-dark px-3 sombra" />
                                </div> -->

                                <div class="col-3">
                                    <input style="background-color:E641EB;" type="button" name="insert" id="b1" onclick="simbolo('♦')" value="♦" class="btn btn-dark px-3 sombra" /> 
                                </div> 

                                <div class="col-3">
                                    <input  style="background-color:4DCA00;" type="button" name="insert" id="b2" onclick="simbolo('♣')" value="♣" class="btn btn-dark px-3 sombra" /> 
                                </div> 

                                <div class="col-3">
                                    <input style="background-color:2A5FFB;" type="button" name="insert" id="b3" onclick="simbolo('♠')" value="♠" class="btn btn-dark px-3 sombra" /> 
                                </div> </div>

                                <div class="row text-right"> 

                                    <div id="espere1" style="display:none; background-color:#fff;"><pre> <i class="fas fa-pulse fa-slash"></i> Un segundo... </pre></div>

                                    <p class="text-center py-2">                         <?php  
                                    echo '<label class="text-danger ">'.$this->session->flashdata("error").'</label>';  
                                    ?>  </p>

                                </div>

                                

                            
                            </div>  

                            <input type="hidden" id="symbol" name="symbol" value="" class="my-5 btn btn-dark px-3" /> 
                    </small>
                    </form>  

                    

                   <div id="aviso"></div> 

                </div>   

                    <div class="tab-pane fade" id="v-pills-escuela" role="tabpanel" aria-labelledby="v-pills-escuela-tab">
                    
                    <div style="background-color:grey;"class=" rounded jumbotron jumbotron-fluid">
                        <div  class="container text-dark">
                            <h1 class="display-6">Escuela Atlo</h1>
                            <p class="lead">Próximamente</p>
                            <hr class="my-2">
                            <p>Para más información escibre a <a href="mailto:atlo@atlo.es">atlo@atlo.es</a></p>
                            <p class="lead">
                                <a class="btn btn-primary btn-lg" href="mailto:atlo@atlo.es" role="button">OK</a>
                            </p>
                        </div>
                    </div>
                    
                    </div>


                    <div class="tab-pane fade" id="v-pills-instrucciones" role="tabpanel" aria-labelledby="v-pills-instrucciones-tab">
                    <h3>Ayuda e Instrucciones.</h3><hr>
                    <div class="alert alert-dark" role="alert">
                        Por su <strong>seguridad</strong>, la <strong style="color:blue">contraseña</strong> de los usuarios están compuesta por un <strong style="color:blue">PIN</strong> y un <strong style="color:red;">símbolo</strong>.
                    </div> 

                    <div class="alert alert-dark" role="alert">
                        El <strong style="color:blue">PIN</strong> es numérico y puede tener <strong>cuatro o cinco</strong> cifras.
                    </div> 

                    <div class="alert alert-dark" role="alert">
                         Los <strong style="color:red">símbolos</strong> son una medida de seguridad única que se asigna aleatoriamente. Pueden ser: ♣, ♦ o ♠. 
                    </div> 

                    <div class="alert alert-primary" role="alert">
                        Si aún no tienes una contraseña o la has olvidado escribe tu <strong>e-mail</strong>, luego pulsa en <a style="color:#000;  text-decoration: underline;" href="#aviso" onclick="enviar_formulario_sin()"><i class="fas fa-unlock-alt"></i> ACCEDER SIN PIN</a>.
                    </div> 

                    <div class="alert alert-dark" role="alert">
                    Para recibir ayuda, por favor, escriba al <a style="color:#000;  text-decoration: underline;" href="mailto:sergio@mallorcainterbox.com"><i class="fas fa-heartbeat"></i> departamento de soporte</a>.
                    </div> 




             

                    <br /> 
                    
                    </div>
                  
                </div>
            </div>
        </div>

        
        

   
      <script>

            function simbolo(valor){
               document.getElementById("b1").disabled = true;
               document.getElementById("b2").disabled = true;
               document.getElementById("b3").disabled = true;
               document.getElementById("espere1").style.display = 'block';      
             
               document.getElementById('symbol').value=valor;
               document.getElementById('formulario_con').submit();
            }

            function enviar_formulario_sin(){ 

                //alert(document.getElementById("username").value);

                var value1 = document.getElementById("username").value;
                document.getElementById("username_sin").value = value1;
            
                document.formulario_sin.submit();
               
                //document.location.hash = "#ancla";
            } 
    
    </script> 


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</div>
    
