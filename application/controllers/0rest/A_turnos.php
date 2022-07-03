<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class A_turnos extends CI_Controller {

    public function index( )
    {
        echo 'Hello World! ';
    }

    public function semanas($tabla, $semana, $anyo)
    {
        $this->load->model('Turnos_model');

        $var = $this->Turnos_model->get_Semana($tabla, $semana, $anyo);

        echo json_encode ($var); 
    }

    public function radio($semana, $anyo)
    {
        echo $semana;
        echo $anyo;
        echo $ra_lu_mm = $this->input->get('ra_lu_mm');
        echo $ra_lu_tt = $this->input->get('ra_lu_tt');
        echo $ra_ma_mm = $this->input->get('ra_ma_mm');
        echo $ra_ma_tt = $this->input->get('ra_ma_tt');
        echo $ra_mi_mm = $this->input->get('ra_mi_mm');
        echo $ra_mi_tt = $this->input->get('ra_mi_tt');
        echo $ra_ju_mm = $this->input->get('ra_ju_mm');
        echo $ra_ju_tt = $this->input->get('ra_ju_tt');
        echo $ra_vi_mm = $this->input->get('ra_vi_mm');
        echo $ra_vi_tt = $this->input->get('ra_vi_tt');
        echo $ra_sa_tt = $this->input->get('ra_sa_tt');
        echo $ra_comentarios = $this->input->get('ra_comentarios');

        $table_name = "rr_radio";
        $retorno = "radio";
        date_default_timezone_set("Europe/Madrid");
        echo $current_timestamp = date("Y-m-d H:i:s");

        //UPDATE `rr_radio` SET `ra_lu_mm` = 'rr_11_rr' WHERE `rr_radio`.`ra_id` = 1;

        $this->load->database();
        
        $data = array('ra_autodate' => $current_timestamp,
                      'ra_tipo' => "TURNOS",
                      'ra_lu_mm' => $ra_lu_mm, 
                      'ra_lu_tt' => $ra_lu_tt, 
                      'ra_ma_mm' => $ra_ma_mm,
                      'ra_ma_tt' => $ra_ma_tt, 
                      'ra_mi_mm' => $ra_mi_mm, 
                      'ra_mi_tt' => $ra_mi_tt,
                      'ra_ju_mm' => $ra_ju_mm, 
                      'ra_ju_tt' => $ra_ju_tt, 
                      'ra_vi_mm' => $ra_vi_mm,
                      'ra_vi_tt' => $ra_vi_tt, 
                      'ra_sa_tt' => $ra_sa_tt,
                      'ra_comentarios' => $ra_comentarios
                    );
        $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

        echo "<br><br>";
        echo $str = $this->db->update_string($table_name, $data, $where);
        $this->db->query($str);

        $this->load->helper('url');

        $redirect='http://oklgrtuhcu.log99.es/MENS_R213/5_TURNOS_DATA/index.php?semana='.$anyo.$semana."#html_radio";
        redirect($redirect);

        echo "fin"; 

    }

    public function television($semana, $anyo)
    {
        echo $semana;
        echo $anyo;
        echo $tv_lu_mm = $this->input->get('tv_lu_mm');
        echo $tv_lu_tt = $this->input->get('tv_lu_tt');
        echo $tv_ma_mm = $this->input->get('tv_ma_mm');
        echo $tv_ma_tt = $this->input->get('tv_ma_tt');
        echo $tv_mi_mm = $this->input->get('tv_mi_mm');
        echo $tv_mi_tt = $this->input->get('tv_mi_tt');
        echo $tv_ju_mm = $this->input->get('tv_ju_mm');
        echo $tv_ju_tt = $this->input->get('tv_ju_tt');
        echo $tv_vi_mm = $this->input->get('tv_vi_mm');
        echo $tv_vi_tt = $this->input->get('tv_vi_tt');
        echo $tv_sa_tt = $this->input->get('tv_sa_tt');
        echo $tv_comentarios = $this->input->get('tv_comentarios');
        echo $tv_ordenanza = $this->input->get('tv_ordenanza');

        #CAMBIAR
        $table_name = "rr_tv";
        $retorno = "television";
        #CAMBIAR
        date_default_timezone_set("Europe/Madrid");
        echo $current_timestamp = date("Y-m-d H:i:s");

        //UPDATE `rr_radio` SET `tv_lu_mm` = 'rr_11_rr' WHERE `rr_radio`.`tv_id` = 1;

        $this->load->database();
        
        $data = array('tv_autodate' => $current_timestamp,
                      'tv_tipo' => "TURNOS",
                      'tv_lu_mm' => $tv_lu_mm, 
                      'tv_lu_tt' => $tv_lu_tt, 
                      'tv_ma_mm' => $tv_ma_mm,
                      'tv_ma_tt' => $tv_ma_tt, 
                      'tv_mi_mm' => $tv_mi_mm, 
                      'tv_mi_tt' => $tv_mi_tt,
                      'tv_ju_mm' => $tv_ju_mm, 
                      'tv_ju_tt' => $tv_ju_tt, 
                      'tv_vi_mm' => $tv_vi_mm,
                      'tv_vi_tt' => $tv_vi_tt, 
                      'tv_sa_tt' => $tv_sa_tt,
                      'tv_comentarios' => $tv_comentarios,
                      'tv_ordenanza' => $tv_ordenanza
                    );
        $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

        echo "<br><br>";
        echo $str = $this->db->update_string($table_name, $data, $where);
        $this->db->query($str);

        $this->load->helper('url');
        $redirect='http://oklgrtuhcu.log99.es/MENS_R213/5_TURNOS_DATA/index.php?semana='.$anyo.$semana."#html_television";
        redirect($redirect);
        
        echo "fin"; 

    }

    public function avingudes($semana, $anyo)
    {
        echo $semana;
        echo $anyo;
        echo $bm_lu = $this->input->get('bm_lu');     
        echo $bm_ma = $this->input->get('bm_ma');   
        echo $bm_mi = $this->input->get('bm_mi');
        echo $bm_ju = $this->input->get('bm_ju');
        echo $bm_vi = $this->input->get('bm_vi');
        echo $bm_comentarios = $this->input->get('bm_comentarios');
       
        #CAMBIAR
        $table_name = "rr_avingudes";
        $retorno = "avingudes";
        #CAMBIAR
        date_default_timezone_set("Europe/Madrid");
        echo $current_timestamp = date("Y-m-d H:i:s");

        //UPDATE `rr_radio` SET `bm_lu` = 'rr_11_rr' WHERE `rr_radio`.`bm_id` = 1;

        $this->load->database();
        
        $data = array('bm_autodate' => $current_timestamp,
                      'bm_tipo' => "TURNOS",
                      'bm_lu' => $bm_lu, 
                      'bm_ma' => $bm_ma,
                      'bm_mi' => $bm_mi, 
                      'bm_ju' => $bm_ju, 
                      'bm_vi' => $bm_vi,
                      'bm_comentarios' => $bm_comentarios
                    );
        $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

        echo "<br><br>";
        echo $str = $this->db->update_string($table_name, $data, $where);
        $this->db->query($str);

        $this->load->helper('url');
        $redirect='http://oklgrtuhcu.log99.es/MENS_R213/5_TURNOS_DATA/index.php?semana='.$anyo.$semana."#html_avingudes";
        redirect($redirect);

        echo "fin"; 

    }

    public function segurarxiu($semana, $anyo)
    {
        echo $semana;
        echo $anyo;
        echo $sa_lu = $this->input->get('sa_lu');     
        echo $sa_ma = $this->input->get('sa_ma');   
        echo $sa_mi = $this->input->get('sa_mi');
        echo $sa_ju = $this->input->get('sa_ju');
        echo $sa_vi = $this->input->get('sa_vi');
        echo $sa_comentarios = $this->input->get('sa_comentarios');
       
        #CAMBIAR
        $table_name = "rr_segurarxiu";
        $retorno = "segurarxiu";
        #CAMBIAR
        date_default_timezone_set("Europe/Madrid");
        echo $current_timestamp = date("Y-m-d H:i:s");

        //UPDATE `rr_radio` SET `sa_lu` = 'rr_11_rr' WHERE `rr_radio`.`sa_id` = 1;

        $this->load->database();
        
        $data = array('sa_autodate' => $current_timestamp,
                      'sa_tipo' => "TURNOS",
                      'sa_lu' => $sa_lu, 
                      'sa_ma' => $sa_ma,
                      'sa_mi' => $sa_mi, 
                      'sa_ju' => $sa_ju, 
                      'sa_vi' => $sa_vi,
                      'sa_comentarios' => $sa_comentarios
                    );
        $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

        echo "<br><br>";
        echo $str = $this->db->update_string($table_name, $data, $where);
        $this->db->query($str);

        $this->load->helper('url');
        $redirect='http://oklgrtuhcu.log99.es/MENS_R213/5_TURNOS_DATA/index.php?semana='.$anyo.$semana."#html_segurarxiu";
        redirect($redirect);

        echo "fin"; 

    }

    public function hotel($semana, $anyo)
    {
        echo $semana;
        echo $anyo;

        echo $hm_hotel_mac = $this->input->get('hm_hotel_mac');
        echo $hm_comentarios = $this->input->get('hm_comentarios');
       
        #CAMBIAR
        $table_name = "rr_hotel";
        $retorno = "hotel";
        #CAMBIAR
        date_default_timezone_set("Europe/Madrid");
        echo $current_timestamp = date("Y-m-d H:i:s");

        //UPDATE `rr_radio` SET `hm_hotel_mac` = 'rr_11_rr' WHERE `rr_radio`.`hm_id` = 1;

        $this->load->database();
        
        $data = array('hm_autodate' => $current_timestamp,
                      'hm_tipo' => "TURNOS",
                      'hm_hotel_mac' => $hm_hotel_mac, 
                      'hm_comentarios' => $hm_comentarios
                    );
        $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

        echo "<br><br>";
        echo $str = $this->db->update_string($table_name, $data, $where);
        $this->db->query($str);

        $this->load->helper('url');
        $redirect='http://oklgrtuhcu.log99.es/MENS_R213/5_TURNOS_DATA/index.php?semana='.$anyo.$semana."#html_hotel";
        redirect($redirect);

        echo "fin"; 

    }

    public function mensajeria($semana, $anyo)
    {
        echo $semana;
        echo $anyo;

        echo $mr_triciclo_1 = $this->input->get('mr_triciclo_1');
        echo $mr_triciclo_2 = $this->input->get('mr_triciclo_2');
        echo $mr_moto_1 = $this->input->get('mr_moto_1');
        echo $mr_moto_2 = $this->input->get('mr_moto_2');
        echo $mr_moto_3 = $this->input->get('mr_moto_3');
        echo $mr_extra_1 = $this->input->get('mr_extra_1');
        echo $mr_extra_2 = $this->input->get('mr_extra_2');

        echo $mr_mensajeria_mac = $this->input->get('mr_mensajeria');     
        echo $mr_comentarios = $this->input->get('mr_comentarios');
       
        #CAMBIAR
        $table_name = "rr_mensajeria";
        $retorno = "mansajeria";
        #CAMBIAR
        date_default_timezone_set("Europe/Madrid");
        echo $current_timestamp = date("Y-m-d H:i:s");

        //UPDATE `rr_radio` SET `mr_mensajeria` = 'rr_11_rr' WHERE `rr_radio`.`mr_id` = 1;

        $this->load->database();
        
        //mensajeria

        $data = array('mr_autodate' => $current_timestamp,
        'mr_tipo' => "TURNOS",
        'mr_triciclo_1' => $mr_triciclo_1,
        'mr_triciclo_2' => $mr_triciclo_2,
        'mr_moto_1' => $mr_moto_1,
        'mr_moto_2' => $mr_moto_2,
        'mr_moto_3' => $mr_moto_3,
        'mr_extra_1' => $mr_extra_1,
        'mr_extra_2' => $mr_extra_2,
        'mr_comentarios' => $mr_comentarios
        );

        $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

        echo "<br><br>";
        echo $str = $this->db->update_string($table_name, $data, $where);
        $this->db->query($str);

        $this->load->helper('url');
        $redirect='http://oklgrtuhcu.log99.es/MENS_R213/5_TURNOS_DATA/index.php?semana='.$anyo.$semana."#html_mensajeria";
        redirect($redirect);

        echo "fin"; 

    }

    public function emaya($semana, $anyo)
    {

        #Retorno:

            $retorno = "mensajeria";

        #Parte "Máquina 1".
            
            echo $mr_semana = $semana;
            echo '<br>';
            echo $mr_anyo =$anyo;
            
            //em_01_tipo
            date_default_timezone_set("Europe/Madrid");
            $current_timestamp = date("Y-m-d H:i:s");
            echo $em_01_autodate=$current_timestamp;
            echo '<br>';
            
            echo $em_01_persona = $this->input->get('em_01_persona');  echo '<br>';
            echo $em_01_com = $this->input->get('em_01_com');  echo '<br>';

            echo $em_01_lu = $this->input->get('em_01_lu');  echo '<br>';
            echo '<br>pillar las tres últimas';
            echo $em_01_lu_mq = substr($em_01_lu, -3);
            echo '<br>pillar la primera cifra';
            echo $em_01_lu = $em_01_lu[0];
        
            echo '<hr>';

            echo $em_01_ma = $this->input->get('em_01_ma');  echo '<br>';
            echo '<br>pillar las tres últimas';
            echo $em_01_ma_mq = substr($em_01_ma, -3);
            echo '<br>pillar la primera cifra';
            echo $em_01_ma = $em_01_ma[0];
        
            echo '<hr>';

            echo $em_01_mi = $this->input->get('em_01_mi');  echo '<br>';
            echo '<br>pillar las tres últimas';
            echo $em_01_mi_mq = substr($em_01_mi, -3);
            echo '<br>pillar la primera cifra';
            echo $em_01_mi = $em_01_mi[0];
        
            echo '<hr>';

            echo $em_01_ju = $this->input->get('em_01_ju');  echo '<br>';
            echo '<br>pillar las tres últimas';
            echo $em_01_ju_mq = substr($em_01_ju, -3);
            echo '<br>pillar la primera cifra';
            echo $em_01_ju = $em_01_ju[0];
        
            echo '<hr>';

            echo $em_01_vi = $this->input->get('em_01_vi');  echo '<br>';
            echo '<br>pillar las tres últimas';
            echo $em_01_vi_mq = substr($em_01_vi, -3);
            echo '<br>pillar la primera cifra';
            echo $em_01_vi = $em_01_vi[0];
        
            echo '<hr>';

            if ($em_01_lu == 'V'){$slu = '0';} else {$slu = $em_01_lu;}  echo '<br>';
            if ($em_01_ma == 'V'){$sma = '0';} else {$sma = $em_01_ma;}  echo '<br>';
            if ($em_01_mi == 'V'){$smi = '0';} else {$smi = $em_01_mi;}  echo '<br>';
            if ($em_01_ju == 'V'){$sju = '0';} else {$sju = $em_01_ju;}  echo '<br>';
            if ($em_01_vi == 'V'){$svi = '0';} else {$svi = $em_01_vi;}  echo '<br>';

            echo $em_01_total = $slu + $sma + $smi + $sju + $svi;   echo '<br>';
            
            echo '<hr>';      
            echo '<hr>';

            #CAMBIAR
            $table_name = "rr_emaya1";

            #Actualizar datos. 

            $this->load->database();

            $data = array(
                        'em_01_tipo' => "TURNOS",
                        'em_01_com' => $em_01_com,
                        'em_01_autodate' => $em_01_autodate,
                        'em_01_persona' => $em_01_persona,
                        'em_01_lu' => $em_01_lu,
                        'em_01_ma' => $em_01_ma,
                        'em_01_mi' => $em_01_mi,
                        'em_01_ju' => $em_01_ju,
                        'em_01_vi' => $em_01_vi,
                        'em_01_lu_mq' => $em_01_lu_mq,
                        'em_01_ma_mq' => $em_01_ma_mq,
                        'em_01_mi_mq' => $em_01_mi_mq,
                        'em_01_ju_mq' => $em_01_ju_mq,
                        'em_01_vi_mq' => $em_01_vi_mq,
                        'em_01_total' => $em_01_total
                      );

            
            $where = "mr_semana =".$semana." AND mr_anyo = ".$anyo ;

            echo "<br><br>";
            echo $str = $this->db->update_string($table_name, $data, $where);
            $this->db->query($str);


           


    }


}