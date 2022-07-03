<!doctype html>
<html lang="en">
  <head>
    <title>Lo que sea</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


  
    
  </head>
  <body>

    <!--ajax-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>    


    <script>

       
        $(document).ready(function(){
        $("#enlaceajax").click(function(evento){
            evento.preventDefault();
            $("#destino").load("https://v1.atlo.es/index.php/telegram/ajax");
        });
        })


    </script>

    <!-- fin ajax-->

    <?php 

            $url = 'https://api.telegra.ph/getPage/Hola-mundo-12-04-3?return_content=true';
            $data = file_get_contents($url);
            $codigo = json_decode($data, false);
            echo  json_encode($codigo->result->content[0])  ;
                
    
    ?>

    <a name="enlaceajax" id="enlaceajax" class="enlaceajax btn btn-secondary" href="#" role="button">ajax</a>

    <div id="destino"></div>

    <button type="button" onclick="mega()" class="btn btn-primary">Aprieta</button>

     <div id="article">holhh</div>

     <div class="form-group">
       <label for="value"></label>
       <input type="test"
         class="form-control" name="article" id="article1" aria-describedby="helpId" placeholder="">
       <small id="helpId" class="form-text text-muted">Help text</small>
     </div>


    
      
    <!-- Optional JavaScript -->

    <script>

        function mega() {

           var article = document.getElementById('article');
           var tempArray = <?php echo json_encode($codigo->result->content) ?>;
           var coso = tempArray;
           console.log(coso.length);

           length = coso.length;

           for (var i = 0; i < length; i++) {
                console.log(coso[i]);
                console.log(nodeToDom(coso[i])) ;
                article.appendChild(nodeToDom(coso[i]));
                
            }

            replace();

           //var prueba = {tag:"p", children:["dsfds"]};
           //console.log(nodeToDom(coso[0]));
           //article.appendChild(nodeToDom(coso));


        }

        function replace(){
        var str = document.getElementById('article').innerHTML;
        var wat = str.replace("/file/", "https://telegra.ph/file/");
        document.getElementById('article').innerHTML = wat;
}
        
        function domToNode(domNode) {
        if (domNode.nodeType == domNode.TEXT_NODE) {
            return domNode.data;
        }
        if (domNode.nodeType != domNode.ELEMENT_NODE) {
            return false;
        }
        var nodeElement = {};
        nodeElement.tag = domNode.tagName.toLowerCase();
        for (var i = 0; i < domNode.attributes.length; i++) {
            var attr = domNode.attributes[i];
            if (attr.name == 'href' || attr.name == 'src') {
            if (!nodeElement.attrs) {
                nodeElement.attrs = {};
            }
            nodeElement.attrs[attr.name] = attr.value;
            }
        }
        if (domNode.childNodes.length > 0) {
            nodeElement.children = [];
            for (var i = 0; i < domNode.childNodes.length; i++) {
            var child = domNode.childNodes[i];
            nodeElement.children.push(domToNode(child));
            }
        }
        return nodeElement;
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

        /*var article = document.getElementById('article');
        var content = domToNode(article).children;
        $.ajax('https://api.telegra.ph/createPage', {
        data: {
            access_token:   '%access_token%',
            title:          'Title of page',
            content:        JSON.stringify(content),
            return_content: true
        },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            if (data.content) {
            while (article.firstChild) {
                article.removeChild(article.firstChild);
            }
            article.appendChild(nodeToDom({children: data.content}));
            }
        }
        });*/
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>