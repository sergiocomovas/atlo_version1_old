<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nieve extends CI_Controller {


    public function puta(){

        echo "hola mundo";
    }


	public function index()
	{

        echo "<!DOCTYPE html><html lang='en' class=''>
        <head>
        
        
        <style>body {
          background: #333;
          background-image: url('https://assets.codepen.io/images/classy_fabric.png');
        }
        
        #snow {
            background-color: transparent;
            background-image: url(https://atlo.es/barbellclub/tarifaclub/assets/img/aaa_cafe.png), url(https://atlo.es/barbellclub/tarifaclub/assets/img/aaa_cafe.png);
            -webkit-animation: snow 20s linear infinite;
            -moz-animation: snow 20s linear infinite;
            -ms-animation: snow 20s linear infinite;
            animation: snow 20s linear infinite;
            z-index: 999;
            right: 0;
          top: 0;
          left: 0;
          bottom: 0;
            margin-top: 0;
            pointer-events: none;
            position: absolute;
        }
        
        /*Keyframes*/
        
        @keyframes snow { 
            0% { background-position: 0px 0px, 0px 0px, 0px 0px }
        
            100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
        }
        
        @-moz-keyframes snow { 
            0% { background-position: 0px 0px, 0px 0px, 0px 0px }
        
            100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
        }
        
        @-webkit-keyframes snow { 
            0% { background-position: 0px 0px, 0px 0px, 0px 0px }
        
            100% {
                background-position: 500px 1000px, 400px 400px, 300px 300px;
            }
        }
        
        @-ms-keyframes snow { 
            0% { background-position: 0px 0px, 0px 0px, 0px 0px }
        
            100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
        }
        </style></head><body>
        <section id='snow'></section>
        kjiojui
        </body></html>";

	}


}
