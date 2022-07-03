<?php 

if (  isset( $_GET['date_invent']) ) {


    echo $_GET['date_invent']."<hr>";
    echo $_GET['date_invent2']."<hr>";
    echo $_GET['dia_id']."<hr>";
    echo $_GET['orden_num']."<hr>";



    //Primer paso:
    /*Mirar si existe dia_id.orden_num en la base de datos de entrenos

    entoprogram_id | dia_id | entoprogram_orden | entowod_id

    select * from entoprogram_id weher dia_id = 1 and entoprogram_odren  = 2; 

    SI HAY RESULTADOS

    ==> UPTADE entowod

    SI NO HAY RESULTADOS
    
    ==> primero, añadir entowod
    ==> segundo, añadir entoprogram*/


    
    



}else{

    echo "Sin guardar";

}

?>



