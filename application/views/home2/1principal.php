<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->library('session');
?>


<?php
$pantalla_loading="<div class='h-100'><i class='p-1 m-1 fas fa-circle-notch fa-spin'></i></div>";

?>


<html lang="es"><head>
    <link rel="manifest" href="<?= base_url()?>web_manifest.json"> 
    <meta http-equiv="refresh" content="6000; url=<?= base_url()?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- PAGE settings -->
    <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/x-icon">

    <title><?php echo $title; ?></title>

    <meta name="description" content="Contrata ahora la mejor tarifa de nuestro centro de entrenamiento para nuevos atletas en Palma de Mallorca.">
    <meta name="keywords" content="socios, crossfit, fitness, atlo, can valero, gym, tarifas, precios, descuentos, entrenador personal, ofertas, compra ahora, gimnasio barato, crossfit barato, mejor precio.">

    <!--webfonts-->
    <link rel="stylesheet" href="<?= base_url()?>00_webfonts/stylesheet.css">
    <link rel="stylesheet" href="https://v1.atlo.es/01_css/emoji.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!--estilos-->
    <!--<link rel="stylesheet" href="<?= base_url()?>01_css/snow.css">-->
    <link rel="stylesheet" href="<?= base_url()?>01_css/animate.css?v=2">
    <link rel="stylesheet" href="<?= base_url()?>01_css/neon.css?v=1">
    <link rel="stylesheet" href="<?= base_url()?>01_css/css.css?v=<?= rand(5, 999) ?><?= rand(5, 999) ?><?= rand(5, 999) ?>">
  
    <!-- CSS dependencies -->
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">-->
    <script src="https://kit.fontawesome.com/8d55c2b16b.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--AXAX-->
    <!--<script src="https://v1.atlo.es/01_js/jquery.min.js"></script>-->
  
</head>

<body>

    <!-- AJAX -->
    <!-- CLASS PUNTO, ID # -->
    <script src="https://v1.atlo.es/01_js/ajax-js.min.js"></script>

    <script>
        $(document).ready(function(){


            $(".menuajax").click(function(evento){
         
                evento.preventDefault(); 

                var datadestino = $(this).attr('data-destino');
                var vid = $(this).attr('id');

                //ir arriba
                $('html, body').animate( { scrollTop : 0 }, 800 );

                //remover clases
                $(".menuajax").removeClass("active");
                $('#'+vid).addClass("active");

                //<i class="far fa-caret-square-up"></i>
                $(".ico_camb").removeClass("fa-caret-square-up");
                $('.ico_camb').addClass("fa-minus-square");
                $('#ico_'+vid).removeClass("fa-minus-square");
                $('#ico_'+vid).addClass("fa-caret-square-up");

                $('#destino_principal').html(`<?php echo $pantalla_loading; ?>`);
                $("#destino_principal").load(datadestino);

            });
        
        })
    </script>

    <!--comprobar si estás logeado-->

    <?php 

    //echo $this->session->userdata('nivel');

        switch ($this->session->userdata('nivel')) {
            case 'Premium':
                $nivel = $this->session->userdata('nivel');
                $username = $this->session->userdata('username');
                $simbolo = $this->session->userdata('simbolo');
                $portada = "home2/portada_premium";
                $menu = "home2/menu_premium";
                $logeado = "Y"; 
                break;

            default:
                $usuario = "";
                $simbolo = "";
                $logeado = "";
                $portada = "home2/portada_invitados";
                $menu = "home2/menu_invitados";
                $logeado = "N";   
        }
       
    ?>

    <div style="width: 100%;
    min-height: 100%;
    height: auto !important;
    position: fixed;
    top:0; 
    left:0;
    z-index:-100;">
    
    
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#900c3e" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,80C840,32,960,32,1080,80C1200,128,1320,224,1380,272L1440,320L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>

        <!--contenido-->
       

    </div> 
    
    <div id="destino_principal">
            <?php $this->load->view($portada); ?>
        </div>

    <div id="menu1">
        <?php $this->load->view($menu); ?>
    </div>


    <!--scripts finales-->
    <?php $this->load->view('80_cierre.php'); ?>
    


    


</body></html>