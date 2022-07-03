<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Instagram extends CI_Controller {

    public function index(){

        //https://v1.atlo.es/index.php/5instagram/instagram

        //pillar json de mi instagram
        //https://www.instagram.com/atlobarbellclub/?__a=1

        $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=7320445835.1677ed0.5392ad95a96544dfb7caaf5e5737618d&count=5";

        $data = file_get_contents($url);
        $instagram = json_decode($data, false);

        // 7320445835.9563f48.b82ad390cbc845a98f3d981242fdd873

        //print_r($instagram->data[0]->link);


        $url_emb = "https://api.instagram.com/oembed?url=".$instagram->data[0]->link."&maxwidth=290";
        $data = file_get_contents($url_emb);
        $instagram_emb = json_decode($data, false);

        print_r($instagram_emb);

        print_r($instagram_emb->html);

        $url_emb = "https://api.instagram.com/oembed?url=".$instagram->data[1]->link;
        $data = file_get_contents($url_emb);
        $instagram_emb = json_decode($data, false);

        print_r($instagram_emb->html);

        $url_emb = "https://api.instagram.com/oembed?url=".$instagram->data[2]->link;
        $data = file_get_contents($url_emb);
        $instagram_emb = json_decode($data, false);

        print_r($instagram_emb->html);



     

    }

    public function ultimos(){

      
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);


        //https://v1.atlo.es/index.php/5instagram/instagram/ultimos

        //session_start();
        session_write_close();

        $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=7320445835.1677ed0.5392ad95a96544dfb7caaf5e5737618d&count=4";

        $data = file_get_contents($url);
        $instagram = json_decode($data, false);

        $url_emb_0 = "https://api.instagram.com/oembed?url=".$instagram->data[0]->link."&maxwidth=360&hidecaption=true";
        $data_0 = file_get_contents($url_emb_0);
        $i_emb_0 = json_decode($data_0, false);

        $url_emb_1 = "https://api.instagram.com/oembed?url=".$instagram->data[1]->link."&maxwidth=360&hidecaption=true";
        $data_1 = file_get_contents($url_emb_1);
        $i_emb_1 = json_decode($data_1, false); 


        $url_emb_2 = "https://api.instagram.com/oembed?url=".$instagram->data[2]->link."&maxwidth=360&hidecaption=true";
        $data_2 = file_get_contents($url_emb_2);
        $i_emb_2 = json_decode($data_2, false);
    
        $url_emb_3 = "https://api.instagram.com/oembed?url=".$instagram->data[3]->link."&maxwidth=360&hidecaption=true";
        $data_3 = file_get_contents($url_emb_3);
        $i_emb_3 = json_decode($data_3, false);
    

        echo'
  
        <table >
            
            
                <tr>
                  <th class="align-top">'; print_r($i_emb_0->html);session_write_close(); echo'</th>
                  
                  <th class="align-top">'; print_r($i_emb_1->html); session_write_close(); echo'</th>
                  
                  <th class="align-top">'; print_r($i_emb_2->html);session_write_close(); echo'</th>
                  
                  <th class="align-top">'; print_r($i_emb_3->html);session_write_close(); echo'</th>


                  <th class="align-top"> -- </th>
                            
                </tr>
              
        </table>';
  



     



    }

    


}