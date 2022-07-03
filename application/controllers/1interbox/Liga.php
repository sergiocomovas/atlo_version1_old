<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liga extends CI_Controller {

    public function index($cat=1,$sem=2){

        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');         
        echo "(C) MALLORCA INTERBOX ";

        echo'
        <!doctype html>
        <html lang="es">
          <head>
            <title>Title</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


            <!-- Iconos -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

            <!-- Table Magic -->
            <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">



          </head>
          <body>';

     
          $url = 'http://gsx2json.com/api?id=12mqK-b9m8lxIocvfRbXxRWixtn32TapAuQaRFWXH_08&sheet=3&columns=false';
          $data = file_get_contents($url);
          $tabla = json_decode($data, false);
          $tabla = json_encode($tabla->rows);


          //ID	Nombre	Box	Premium	Categoria	WOD	Nivel	Segundos	Reps	Kg	PUNTOS
  
  
          echo'
          <div class="container">
          <table  id="table" 
                  data-locale="es-ES"
                  data-show-toggle="true"
                  data-search="true"
                  data-height="460"
                  data-show-refresh="true"
                  data-pagination="true"
                  data-sort-name="puntos"
                  data-sort-order="asc"
                            
          >
            <thead>
              <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="nombre" data-sortable="true">Nombre</th>
                <th data-field="box" data-sortable="true">Box</th>
                <th data-field="premium">Premium</th>
                <th data-field="categoria" data-sortable="true">Categoría</th>
                <th data-field="wod" data-sortable="true">WOD</th>
                <th data-field="nivel">Nivel</th>
                <th data-field="segundos" data-sortable="true">Tiempo (segundos)</th>
                <th data-field="reps" data-sortable="true">Reps</th>
                <th data-field="kg" data-sortable="true">Peso</th>
                <th data-field="puntos" data-sortable="true">PUNTOS</th>


               
              </tr>
            </thead>
          </table>
          </div>
          ';





          echo'
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
            <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table-locale-all.min.js"></script>'."<script>

            $(function() {
              var data = ".$tabla."
              
              $('#table').bootstrapTable({data: data})
            })
            </script>".'
            
            
          </body>
        </html>';
        
        

      

    }

  }    