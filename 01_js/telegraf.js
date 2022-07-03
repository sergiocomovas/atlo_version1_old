
    
    $(".ajaxtelegraf").click(function(evento){
    
        evento.preventDefault();
        div_destino = $(this).attr('data-div-destino');
 
        $.get("https://v1.atlo.es/index.php/telegram/data", {
            
            telegraf: $(this).attr('data-url-telegraf')}, 
            
            function(respuesta){
        $("#"+div_destino).html(respuesta);
                //document.getElementById('selection'+select).disabled = true;
    })
 
        
    });
