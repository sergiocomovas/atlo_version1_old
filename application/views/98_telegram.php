<?php 

$url = "";
$data = "";
$codigo = "";

$url = $this->input->get('telegraf');
$data = file_get_contents($url);
$codigo = json_decode($data, false);

if (!isset($url)){$pega = "url";}
else{$pega = "<script>$('#modal1').modal('hide')</script>";}
if (!isset($data)){$pega = "url";}
else{$pega = "<script>$('#modal1').modal('hide')</script>";}
if (!isset($codigo)){$pega = "url";}
else{$pega = "<script>$('#modal1').modal('hide')</script>";}

echo $pega;




?> 

<!-- MODAL TELEGRAF -->
<!--<script src="https://v1.atlo.es/01_js/telegraf_decode.js"></script>-->


<div id="article">
    
<div id="comprobar" class="text-center fa-3x">
  
  <i class="fas fa-circle-notch fa-spin"></i>
  <p>Cargando... <?= $pega ?></p>
  <br>
  <small><small><small><strong class="animated fadeInUp" style="animation-delay: 5s;">🤔 Si tarda demasiado... <a href="javascript:void(0);" id="repetir">pulsa aquí.</a></strong> </small></small></small>
  
</div>

</div><!-- fin div article-->



 
<script>

        var realizado="NO";

    

        $( document ).ready(function() {



            $('#repetir').click(function (e) {
                
                mega();
                
            });            
            
            $('#modal1').on('shown.bs.modal', function (e) {
                //console.log("abriendo...");
                
                setTimeout(mega(),3000);
                
            });

        });


        function replace(){

            var str = document.getElementById('article').innerHTML;
            //var wat = str.replace("src='/file/", "https://telegra.ph/file/");
            var wat = str.replace(/img src="\/file\//g, 'img class="img-fluid" src="https://telegra.ph/file/');
            document.getElementById('article').innerHTML = wat;

            var hecho = "<br>dos<br>";

        }

        function nodeToDom(node) {
            if (typeof node === 'string' || node instanceof String) {
                return document.createTextNode(node);
            }
            if (node.tag) {
                var domNode = document.createElement(node.tag);
                if (node.attrs) {
                for (var name in node.attrs) {
                    var value = node.attrs[name];
                    domNode.setAttribute(name, value);
                }
                }
            } else {
                var domNode = document.createDocumentFragment();
            }
            if (node.children) {
                for (var i = 0; i < node.children.length; i++) {
                var child = node.children[i];
                domNode.appendChild(nodeToDom(child));
                }
            }
            return domNode;
        }


        function mega() {

            listo();

            var cargando = '<div class="text-center fa-3x"><i class="fas fa-sync fa-spin"></i><p>Espere...</p></div>';
            var hecho = '<br>uno<br>';

            document.getElementById('article').innerHTML=cargando;

            var article = document.getElementById('article');
            var tempArray = <?php echo json_encode($codigo->result->content) ?>;
            var coso = tempArray;

            length = coso.length;

            document.getElementById('article').innerHTML='';
            for (var i = 0; i < length; i++) {

                    article.appendChild(nodeToDom(coso[i]));
                    
                }

                //replace();
                var str = document.getElementById('article').innerHTML;
                //var wat = str.replace("src='/file/", "https://telegra.ph/file/");
                var wat = str.replace(/img src="\/file\//g, 'img class="img-fluid" src="https://telegra.ph/file/');
                document.getElementById('article').innerHTML = wat;
                realizado = "SI";                

            //alert(hecho);

            //var prueba = {tag:"p", children:["dsfds"]};
            //console.log(nodeToDom(coso[0]));
            //article.appendChild(nodeToDom(coso));


        }  

        
        function repetir(){
            
           
            if(realizado = "NO"){alert("conectando....");mega();}
        }

        function listo()
        {
         setTimeout(console.log(realizado),10000);   
        }
        
      

</script>





