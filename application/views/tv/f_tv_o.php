<?php

echo $url = 'https://v1.atlo.es/index.php/0rest/A_atlo_tv/clase_siguiente';
$data = file_get_contents($url);
$clase_siguiente = json_decode($data, false);

if (is_null($clase_siguiente)){echo "<h6>Hoy no hay más clases. <br> <small> Síguenos en instagram: <span class='text-primary'>@atlobarbellclub</span></small></h6>";}else{

    echo "nada"; 
    

    }
?>     

<h1>--Hola--</h1>

<!-- foreach(array_chunk($entries, 4) as $entriesRow) {
    echo '<div class="row">';
        foreach ($entriesRow as $entry) {
            echo "<div class='col-md-3'>$entry</div>";
        }
    echo '</div>';
}-->

   

        
                
                
                
