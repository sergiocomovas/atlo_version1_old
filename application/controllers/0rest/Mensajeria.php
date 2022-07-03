<?php

//clausula de protección
defined('BASEPATH') OR exit('No direct script access allowed');

//poner nombre de la clase
class Mensajeria extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        
        //carga  $this->load->database(); al principio de cada funcion
        $this->load->database();

    }




    public function insertar( $retorno, $carrer, $etiqueta, $numero = "0", $cp, $urgencia, $comentarios="Ninguno" ){

        //ultimo insert
        

        $query = $this->db->query(" SELECT MAX(RE_ID) AS q
                                    FROM 1_MR_REPARTO ");
        $row = $query->row();

        $sumaid = $row->q;

        $sumaid = $sumaid+1; 

        $c100=urldecode($carrer).' '.$numero.' 0,'.$cp.' Palma de Mallorca';
         
        $data_arr = $this->geocode($c100);
        //$data_arr = $this->geocode('Plaza Segovia 5, Palma de Mallorca');
        echo $latitude = $data_arr[0];
        echo $longitude = $data_arr[1];
        echo $formatted_address = $data_arr[2];
        
        $data = array(

            'RE_ID'	        =>null,
            'RE_AUTODATE'   =>null,
            'RE_ETIQUETA'	=>$sumaid.' - '.urldecode($etiqueta),
            'RE_CARRERNUM'	=>urldecode($carrer).', '.$numero,
            'CP_CARRER'	    =>urldecode($carrer),
            'CP_CIUDAD'	    =>'Palma de Mallorca',
            'CP_CP'	        =>'0'.$cp,
            'RE_URGENCIA'   =>urldecode($urgencia),
            'RE_LAT'        =>$latitude,
            'RE_LON'        =>$longitude,
            'RE_OFICIAL'    =>$formatted_address,
            'RE_COMENTARIOS'=>urldecode($comentarios)
             
    );


  

    $this->db->insert('1_MR_REPARTO', $data);
    // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    
    $respuesta = array(
        'err' => FALSE,
        'id_insertado' => $this->db->insert_id()
    );

    $this->load->helper('url');
    $redirect = 'http://oklgrtuhcu.log99.es/MENS_R213/1_INICIO/index.php?retorno='.$retorno; 
    redirect($redirect);

    }


    public function geocode($address){
 
        // url encode the address
        $address = urlencode($address).'&key=AIzaSyB4UhVZs3x6ocx7R92qwK18IOJ1mPcYgeo';
      
        // google map geocode api url
        $url = "https://maps.google.com/maps/api/geocode/json?address={$address}";
        
     
        // get the json response
        $resp_json = file_get_contents($url);
         
        // decode the json
        $resp = json_decode($resp_json, true);
     
        // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){
     
            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];
             
            // verify if data is complete
            if($lati && $longi && $formatted_address){
             
                // put the data in the array
                $data_arr = array();            
                 
                array_push(
                    $data_arr, 
                        $lati, 
                        $longi, 
                        $formatted_address
                    );
                 
                return $data_arr;
                 
            }else{
                return false;
            }
             
        }else{
            return false;
        }
    }
   

}//cierre 