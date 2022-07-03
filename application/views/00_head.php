<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?>


<!--<!DOCTYPE html>-->
<html lang="es">
<head>
  <link rel="manifest" href="<?= base_url()?>web_manifest.json"> 
  <meta http-equiv="refresh" content="3000; url=<?= base_url()?>" />
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/x-icon">
  <title><?php echo $title; ?></title>
  <meta name="description" content="Contrata ahora la mejor tarifa de nuestro centro de entrenamiento para nuevos atletas en Palma de Mallorca.">
  <meta name="keywords" content="socios, crossfit, fitness, atlo, can valero, gym, tarifas, precios, descuentos, entrenador personal, ofertas, compra ahora, gimnasio barato, crossfit barato, mejor precio.">

  
  <!--webfonts-->
  <link rel="stylesheet" href="<?= base_url()?>00_webfonts/stylesheet.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <!--estilos-->
  <!--<link rel="stylesheet" href="<?= base_url()?>01_css/snow.css">-->
  <link rel="stylesheet" href="<?= base_url()?>01_css/animate.css?v=2">
  <link rel="stylesheet" href="<?= base_url()?>01_css/neon.css?v=1">
  <link rel="stylesheet" href="<?= base_url()?>01_css/css.css?v=<?= rand(5, 999) ?><?= rand(5, 999) ?><?= rand(5, 999) ?>">
  

  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




  <!--AXAX-->
  <script src="https://v1.atlo.es/01_js/jquery.min.js"></script>
  

</head>