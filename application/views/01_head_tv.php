<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?>

<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/x-icon">
  <title><?php echo $title; ?></title>
  
 
  <!-- CSS dependencies -->


  <script src="https://kit.fontawesome.com/8d55c2b16b.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">

  <!--webfonts-->
  <link rel="stylesheet" href="<?= base_url()?>00_webfonts/stylesheet.css?v=2t">
  <link rel="stylesheet" href="<?= base_url()?>01_css/neon.css?v=2t">
  <link rel="stylesheet" href="<?= base_url()?>01_css/css.css?v=2t">
  <link rel="stylesheet" href="<?= base_url()?>01_css/animate.css?v=2t">
  

</head>

<body>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<div id="data"></div>
 

<script>


            $('#data').load('https://v1.atlo.es/index.php/4tv/tv/tv1', function() {
                
                setInterval(function(){ $('#data').load('https://v1.atlo.es/index.php/4tv/tv/tv1'); }, 60000);
            });
        
          
</script>


<script src="https://v1.atlo.es/01_js/simpleslider.min.js">

</script>