<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Texto extends CI_Controller {


    public function r_pdf(){

        ob_start();
        $file = file_get_contents("php://input"); //Gets binary PDF Data
        $time = microtime(true);

        //Names pdf file based on the time to the microsecond so nothing gets overwritten.  Obviously you can change this to whatever you want or do something like $_REQUEST['formName'] and just include the form name in your URL from your pdf submit button
        //$newfile = $time. "p.pdf"; 
        file_put_contents('00_00/pdf/_fd.pdf', $file); //Creates File
        
        ob_end_clean();
        echo "Comp11110";
    }

    public function prueba_1(){

        echo "hola";
        $message = ''; 
        if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
        {
          if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
          {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
            $fileName = $_FILES['uploadedFile']['name'];
            $fileSize = $_FILES['uploadedFile']['size'];
            $fileType = $_FILES['uploadedFile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            // sanitize file-name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'pdf');
            if (in_array($fileExtension, $allowedfileExtensions))
            {
              // directory in which the uploaded file will be moved
              $uploadFileDir = '00_00/';
              $dest_path = $uploadFileDir . $newFileName;
              if(move_uploaded_file($fileTmpPath, $dest_path)) 
              {
                $message ='File is successfully uploaded.';
              }
              else 
              {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
              }
            }
            else
            {
              $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
          }
          else
          {
            $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $_FILES['uploadedFile']['error'];
          }
        }
        echo $message;
        //header("Location: index.php");
    }


    public function formularios(){


        $this->load->model('bs_model'); 
        $this->bs_model->base_1('Formularios');
        $this->load->helper('form');

        /*<div class="form-group">
          <label for=""></label>
          <input type="text|password|email|number|submit|date|datetime|datetime-local|month|color|range|search|tel|time|url|week"
            class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>*/


        //type = text|password|email|number|submit|date|datetime|datetime-local|month|color|range|search|tel|time|url|week
        
        //form-control form-control-lg

        $data = array(
            'type'          => 'text',
            //'name'          => 'name',
            'id'            => 'username',
            'value'         => 'AAAAAAA',
            'maxlength'     => '100',
            'size'          => '50',
            'style'         => 'width:50%; color:red',
            'readonly'      => 'readonly',
            //'onclick'       => '',
            'class'         => 'form-control form-control-lg'
           
        );
        echo form_label('What is your Name', 'username', 'class="h2"');
        echo form_input($data);

        echo '<hr>';

        //form_dropdown([$name = ''[, $options = array()[, $selected = array()[, $extra = '']]]])


        $opciones = array(
            'small'         => 'Small Shirt',
            'med'           => 'Medium Shirt',
            'large'         => 'Large Shirt',
            'xlarge'        => 'Extra Large Shirt',
        );
    
        $seleccionado = array('small', 'large');


        $data = array(
            //'type'          => 'text',
            'name'          => 'name2',
            'id'            => 'username',
            //'value'         => '',
            //'maxlength'     => '100',
            //'size'          => '50',
            'style'         => 'width:50%; color:red',
            //'onclick'       => '',
            'class'         => 'form-control form-control-lg'
           
        );


        echo form_dropdown('nombre1', $opciones, 'large' ,$data);


        /*<div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
            Display value
          </label>
        </div>*/

        echo '<br>';
        echo form_checkbox('newsletter', 'accept', TRUE, 'class="form-check-input"');

        //<input name="" id="" class="btn btn-primary|secondary|success|danger|warning|info|light|dark|link" type="button" value="">

        /*
        t - for classes that set margin-top or padding-top
        b - for classes that set margin-bottom or padding-bottom
        l - for classes that set margin-left or padding-left
        r - for classes that set margin-right or padding-right
        x - for classes that set both *-left and *-right
        y - for classes that set both *-top and *-bottom
        blank - for classes that set a margin or padding on all 4 sides of the element
        */

        $data = array(
            'name'          => 'button',
            'id'            => 'button',
            'value'         => 'true',
            'type'          => 'reset',
            'content'       => 'Reset',
            'class'         => 'btn btn-dark btn-lg btn-block p-1 mx-3'
        );
    
        echo form_button($data);

        $this->bs_model->base_2();


    }




    public function camara($datos=0000,$descripcion=""){

    echo '<!doctype html>
    <html lang="en">
      <head>
        <title>Mensajería</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">


        <style>


            .float{
                position:fixed;
                width:60px;
                height:60px;
                bottom:40px;
                right:40px;
                background-color:green;
                color:#FFF;
                border-radius:50px;
                text-align:center;
                box-shadow: 2px 2px 3px #999;
                z-index: 9;
            }
            
            .my-float{
                margin-top:22px;
            }
            /* The side navigation menu */
        .sidenav {
            height: 100%; /* 100% Full-height */
            width: 0; /* 0 width - change this with JavaScript */
            position: fixed; /* Stay in place */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background-color: #111; /* Black*/
            overflow-x: hidden; /* Disable horizontal scroll */
            /* padding-top: 60px; /* Place content 60px from the top */
            transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
        }

        /* The navigation menu links */
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
            color: #f1f1f1;
        }

        /* Position and style the close button (top right corner) */
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
        #main {
            
            transition: margin-left .5s;
            padding: 20px;
            overflow-x: hidden;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
      </style>

    

      </head>
      <body>';


      echo '
      
      
      
      <form id="myForm" name="myForm" enctype="multipart/form-data" action="https://v1.atlo.es/index.php/texto/enviar" method="POST">





        <a onclick="openNav()" href="#" id="float" class="float">
            <i class="fas fa-arrow-right my-float"></i>
        </a>
          

        <div id="mySidenav" class="sidenav">
        
            <div style="position: relative; top: 0;
        border: 3px solid blue;" id="divCanvas">
        
        </div>

  

    
        <div class="alert alert-warning m-1 p-1" role="alert">
            <small><strong>Firme dentro del <span style="color:blue;">recuadro azul</span> <i class="fas fa-level-up-alt"></i></strong></small> <br>
            <div class="form-group">
            <label for="nombre"><i class="text-danger fas fa-exclamation-circle"></i> ¿QUIÉN RECIBE EL PAQUETE?</label>
            
            <div class="input-group">
            



            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" aria-describedby="nombrehpelp" placeholder="Sus Apellidos, DNI, etc...">

            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-keyboard"></i></div>
            </div>


            </div>
            

            <div class="form-group">
        
            <input type="hidden" class="form-control" name="geocode2" id="geocode2" value="---">
        
        </div>
        
            
        </div>

        </div>


    
          <div>
              <input type="button"  style=" width:25%" value="Borrar" onclick="resetSignature()" class="btn p-1 btn-danger btn-lg">
              <!--<input type="submit" value="submit" onclick="printLocData()" class="btn  btn-success btn-lg">-->
              
              
              <input style=" width:70%" type="button" id="submit1" name="submit1" value="CONFIRMAR ------> " onclick="enviar_form()"
             class="btn-lg p-1 btn btn-success">
              
            </div>
    
            <div id="divLog"></div>
            <div id="divSignature"></div>
    
            <input type="hidden" name="casilla" id="casilla" class="form-control" id="casilla" placeholder="">
    
        </div>
    
        <div id="main">';


        echo'<div class="container-fluid">



            <div class="form-group">
              <label for="datosalbaran">Datos del Albarán</label>
              <input type="text" readonly class="form-control" name="datosalbaran" id="datosalbaran" aria-describedby="datosalbaranhelp" value="'.urldecode($datos).'"placeholder="Datos">
              <small id="datosalbaranhelp" class="form-text text-muted"></small>
            </div>



            <div class="form-group">
              <label for="datosadicionales">Datos Adicionales</label>
              <textarea class="form-control" name="datosadicionales" id="datosadicionales" rows="5">'.urldecode($descripcion).'</textarea>
            </div>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong><i class="fas fa-camera"></i> Hacer una foto</strong> Pulsar el botón "Seleccionar archivo". <hr>
              <div class="form-group">
              <input id="imgInp" name="imgInp" class="form-control" onclick="getLocation()" type="file" accept="image/*" capture="camera"> 
              </div>
            
            
            
          </div>
            
            
     

          

            <div class="form-group">
                <img id="blah" src="https://v1.atlo.es/00_img/firma/firma.PNG" class="img-thumbnail" alt="Foto">
            </div>
            

            <p id="demo"></p>
            <div id="mapholder"></div>

            <div class="form-group">
              <input type="hidden" class="form-control" name="geocode" id="geocode">
            </div>

           
            <div>
        </div>

        </form>

  


        <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function getLocation_2() {
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(showPosition_2, showError);

            } else {

                x.innerHTML = "Geolocation is not supported by this browser.";
                captureData();
                
            }
        }

        function showPosition_2(position) {
            var latlon = position.coords.latitude + "," + position.coords.longitude;

            document.getElementById("geocode2").value = "https://www.google.com/maps/search/?api=1&query="+latlon;



            
                
            var form = document.getElementById("myForm");

                document.getElementById("submit1").addEventListener("click", function () {
                  form.submit();
                });


           
                   
            
        }

 


        function showPosition(position) {
            var latlon = position.coords.latitude + "," + position.coords.longitude;
            document.getElementById("geocode").value = "https://www.google.com/maps/search/?api=1&query="+latlon;
        }


       

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }
        </script>

        <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "287px";
            document.getElementById("main").style.marginLeft = "300px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            document.getElementById("main").style.display = "none";
            document.getElementById("float").style.display = "none";
        }
  
        /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
      </script>

      
          
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>


        <script>
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $("#blah").attr("src", e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        

        $("#imgInp").click(function(){
            alert("Repite la foto hasta que salga en buena resolución.");
        });


        $("#imgInp").change(function(){
            readURL(this);
        });

        </script>


        <script src="https://v1.atlo.es/01_js/firma/firma.js"></script>

        <script type="text/javascript">
            window.onbeforeunload = function(e) {
        return "Deseas volver a cargar la página. Perderás todos los cambios.";
        }



        function enviar_form(){

            document.getElementById("submit1").value=" --- Enviar ---";

            document.getElementById("submit1").style.backgroundColor= "#448857";


            getLocation_2();           
            captureData();
            window.onbeforeunload = null;
            
        }

        
        </script>

        

      </body>
    </html>';




    }


    public function enviar(){


        $config['file_name'] = "foto";
        $config['overwrite'] = TRUE; 
        
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        
        $this->load->library('upload', $config);

        $field_name = "imgInp";
        $coso = $this->upload->do_upload($field_name);
        $extension = './uploads/'.$this->upload->data('file_name');

    
   
        $datos = $this->input->post('datosalbaran');
        $info = $this->input->post('datosadicionales');
      
        $nombre = $this->input->post('nombre');
        $casilla = $this->input->post('casilla');


        $geo1 = $this->input->post('geocode');
        $geo2 = $this->input->post('geocode2');
          
        //echo $foto = $this->input->post('foto');


        date_default_timezone_set('Europe/Berlin');     
        $fecha = date('Y-m-d');  


        $this->load->library('email');

        $this->email->from('info@mensajeriaresponsable.com', 'Mensajería');
        $this->email->to('segurarxiu@gmail.com');
        
        $this->email->subject('Albarán MR-'.$fecha.'-'.$datos);
        

        $mensaje = "<html><body><h2>Mensajería</h2>";
        $mensaje = $mensaje."<br><br>CONFIRMACION...";

        $mensaje = $mensaje."<h3>Albarán: ".$datos."</h3>";
        $mensaje = $mensaje."<h2>Operación: ".$info."</h2>";

        $mensaje = $mensaje."<hr>";

       
        $mensaje = $mensaje."<h3>Recepción: ".$nombre."</h3> <br>";

        $mensaje = $mensaje."<p>".$geo1."</p>";
        $mensaje = $mensaje."<p>".$geo2."</p></html>";

        $mensaje = $mensaje."<br><img src='".$casilla."' /> <pre>".$casilla."</pre></body></html>";


        $this->email->message($mensaje);



        $this->email->attach($extension, 'attachment', 'report.jpg');


        $this->email->send();


        echo "<br><br><br><h1>CONFIRMADO</h1>";

     




    }


    public function index(){

        $this->load->library('markdown');

        $markdown1 = 
        
'# capitulo1

*Hola* '; 


        $markdownText = 
       
'An h1 header
============
Paragraphs are separated by a blank line.

2nd paragraph. *Italic*, **bold**, and `monospace`. 


Itemized lists

* this one
* that one
* the other one

Note that --- not considering the asterisk --- the actual text
content starts at 4-columns in.

> Block quotes are
> written like so.
>
> They can span multiple paragraphs,
> if you like.

> Quoted text. 

> > Quoted quote. 

> * Quoted 
> * List


Markdown converts text to HTML.
*[HTML]: HyperText Markup Language.


Use 3 dashes for an em-dash. Use 2 dashes for ranges (ex., "its all
in chapters 12--14"). Three dots ... will be converted to an ellipsis.

Unicode is supported. ☺

An h2 header
------------
Heres a numbered list:

1. first item
2. second item
3. third item

Note again how the actual text starts at 4 columns in (4 characters
from the left side). Heres a code sample:

    # Let me re-iterate ...
    for i in 1 .. 10 { do-something(i) }

As you probably guessed, indented 4 spaces. By the way, instead of
indenting the block, you can use delimited blocks, if you like:

~~~
define foobar() {
    print "Welcome to flavor country!";
}
~~~


(which makes copying & pasting easier). You can optionally mark the
delimited block for Pandoc to syntax highlight it:

~~~python
import time
# Quick, count to ten!
for i in range(10):
    # (but not *too* quick)
    time.sleep(0.5)
    print(i)
~~~

### An h3 header ###

Now a nested list:

1. First, get these ingredients:
    * carrots
    * celery
    * lentils
2. Boil some water.
3. Dump everything in the pot and follow
    this algorithm:
        find wooden spoon
        uncover pot
        stir
        cover pot
        balance wooden spoon precariously on pot handle
        wait 10 minutes
        goto first step (or shut off burner when done)
    Do not bump wooden spoon or it will fall.

Notice again how text always lines up on 4-space indents (including
that last line which continues item 3 above).
Heres a link to [a website](http://foo.bar), to a [local
doc](local-doc.html), and to a [section heading in the current
doc](#an-h2-header). Heres a footnote [^1].
[^1]: Some footnote text.


Tables can look like this:



</td><td> Tables        </td><td> Are           </td><td> Cool  </td><td>
</td><td> ------------- </td><td>:-------------:</td><td> -----:</td><td>
</td><td> col 3 is      </td><td> right-aligned </td><td> $1600 </td><td>
</td><td> col 2 is      </td><td> centered      </td><td>   $12 </td><td>
</td><td> zebra stripes </td><td> are neat      </td><td>    $1 </td><td>


A horizontal rule follows.
***
Heres a definition list:

apples
: Good for making applesauce.

oranges
: Citrus!

tomatoes
: Theres no "e" in tomatoe.

Again, text is indented 4 spaces. (Put a blank line between each
term and  its definition to spread things out more.)
Heres a "line block" (note how whitespace is honored):

</td><td> Line one
</td><td>   Line too
</td><td> Line tree

and images can be specified like so:
![example image](example-image.jpg "An exemplary image")

Inline math equation: $\omega = d\phi / dt$. Display
math should get its own line like so:
$$I = \int \rho R^{2} dV$$

And note that you can backslash-escape any punctuation characters
which you wish to be displayed literally, ex.: \`foo\`, \*bar\*, etc.
';

        echo $this->markdown->parse($markdownText);

    }

    
//DIAS ENTRENOS




    function tabla_entrenos($dia1="no",$dia2="no",$dia3="no",$dia4="no",$dia5="no",$dia6="no",$dia7="no"){


        $dtable1 = "";
        $dtable2 = "";
        $dtable3 = "";
        $dtable4 = "";
        $dtable5 = "";
        $dtable6 = "";
        $dtable7 = "";

        echo "<a target='_blanck' href='https://docs.google.com/spreadsheets/u/0/'>https://docs.google.com/spreadsheets/u/0/</a>";
   
        $this->load->database();
        
        $dtable = "
        <tr>

        <th> ref    </th>
        <th> día    </th>
        <th> fecha  </th>
        <th> A1     </th>
        <th> A2     </th>
        <th> A3     </th>
        <th> B1     </th>
        <th> B2     </th>
        <th> B3     </th>
        <th> C1     </th>
        <th> C2     </th>

        </tr>";
            
        
        if ($dia1=="no"){

            $dtable1 = "<tr></tr>";

        }else{

            $sql ="SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia1 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";

            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            if (isset($data[3]->entowod_descripcion)) { $data3 = $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable1 = "
            <tr>
                <td> 1 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.



        if ($dia2=="no"){

            $dtable2 = "<tr></tr>";

        }else{


            $sql= "SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia2 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";




            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            

            if (isset($data[3]->entowod_descripcion)) { $data3 = '<br><br>'. $data[3]->entowod_clase. '<br>'. $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable2= "
            <tr>
                <td> 2 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.

        if ($dia3=="no"){

            $dtable3 = "<tr></tr>";

        }else{

            $sql = "SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia3 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";
            

            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            if (isset($data[3]->entowod_descripcion)) { $data3 = $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable3 = "
            <tr>
                <td> 3 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.


        if ($dia4=="no"){

            $dtable4 = "<tr></tr>";

        }else{

            $sql = "SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia4 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";


            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            if (isset($data[3]->entowod_descripcion)) { $data3 = $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable4 = "
            <tr>
                <td> 4 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.

        if ($dia5=="no"){

            $dtable5 = "<tr></tr>";

        }else{

            $sql = "SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia5 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";


            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            if (isset($data[3]->entowod_descripcion)) { $data3 = $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable5 = "
            <tr>
                <td> 5 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.

        if ($dia6=="no"){

            $dtable6 = "<tr></tr>";

        }else{

            $sql = "SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia6 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";


            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            if (isset($data[3]->entowod_descripcion)) { $data3 = $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable6 = "
            <tr>
                <td> 6 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.
        
        if ($dia7=="no"){

            $dtable7 = "<tr></tr>";

        }else{

            $sql = "SELECT * FROM `at_temp_dias`, `at_def_entowod`, `at_def_entoprogram` WHERE `at_temp_dias`.`dias_id` = `at_def_entoprogram`.`dia_id` AND `at_def_entoprogram`.`entowod_id` = `at_def_entowod`.`entowod_id` AND `at_def_entowod`.`entowod_descripcion` != '' AND `at_def_entowod`.`entowod_clase` NOT LIKE 'eXtra' AND `at_temp_dias`.`dias_id` = $dia7 ORDER BY `at_def_entoprogram`.`entoprogram_orden` ASC";


            $markdowntext =""; 

            $query = $this->db->query($sql);

            $data = $query->result();

            if (isset($data[3]->entowod_descripcion)) { $data3 = $data[3]->entowod_descripcion; } else { $data3 =""; }

            $dtable7 = "
            <tr>
                <td> 7 </td>
                <td> ".$data[0]->dias_nom." </td>
                <td> ".$data[0]->dias_date." </td>
                <td> ".$data[0]->entowod_clase." </td>
                <td> ".nl2br($data[0]->entowod_descripcion, FALSE)." </td>
                <td> -.- </td>
                <td> ".$data[1]->entowod_clase." </td>
                <td> ".nl2br($data[1]->entowod_descripcion)." </td>
                <td> -.- </td>
                <td> ".$data[2]->entowod_clase." </td>
                <td> ".nl2br($data[2]->entowod_descripcion).nl2br($data3)." </td>
            </tr>
            ";

        }//fin del else.


        //fin de los if

        $dtable = '<br><br><br><html><table>'.$dtable.$dtable1.$dtable2.$dtable3.$dtable4.$dtable5.$dtable6.$dtable7.'</table></html>';
    
        echo "<style>table, th, td {
            border: 1px solid black;
        }</style>";
        echo $dtable; 

    

    }


}

?>