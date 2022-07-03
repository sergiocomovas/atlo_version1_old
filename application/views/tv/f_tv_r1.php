

<?php 

//echo '<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>';
    
$url = 'https://v1.atlo.es/index.php/0rest/A_atlo_tv/clase_siguiente';
$data = file_get_contents($url);
$clase_next = json_decode($data, false);




if(is_null($clase_next)){$next=20712; $hora="--:--";}else{$next=$clase_next->clases_id; $hora = substr($clase_next->clases_hora,0,5); }


$url =base_url().'index.php/0rest/A_atlo_reservas/def_lista_lista_sinbarco/'.$next;
$data = file_get_contents($url);
$lista_clase = json_decode($data, false);


//[clases_id] => 20713;
//clase siguente



/*if (is_null($clase_next)){echo "<h6>Hoy no hay más clases. <br> <small> Síguenos en instagram: <span class='text-primary'>@atlobarbellclub</span></small></h6>";}else{

    $clase_next_hora = new DateTime(substr($clase_next->clases_hora,0,5));

    $dateInterval = $actual_hora->diff($clase_next_hora);
    if ($next_next == TRUE){echo $dateInterval->format('<p class="animated fadeInUp delay-12s slower">Siguiente clase en %H horas %i minutos.</p>');}    
    

    }*/


?>


<h6 class="text center p-1 m-2">PRÓXIMOS HÉROES</h6>
<h2 class="text center">Clase de las <?=  $hora ?></h2>

<!--ROW 1-->
<div class="row w-100 p-1 ">
    
     <!--COL 0-->
    <div class="col-sm-3">
   

    <div class="card border border-dark bg-dark text-white">
    <img class="card-img" <?php if (isset($lista_clase[0]->listas_data1))
    { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
        
        <div class="card-img-overlay">
            <div class="media align-self-top">
                <div class="mr-1 w-100 text-truncate">
                    <div class="perso1"><h6> 01.  <br></h6></div>
                    <div class="perso2"><p style="text-shadow: 1px 1px #000;"> <?php 
                    
                    if (isset($lista_clase[0]->listas_data1))
                    { $coso1= $lista_clase[0]->listas_data1; }else{$coso1 = "---";}
                    echo $coso1; 
                    
                    ?><p></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--FIN COL 0-->

    <!--COL 1-->
    <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[1]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 02.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[1]->listas_data1))
                   { $coso1= $lista_clase[1]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 1-->

       <!--COL 2-->
       <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[2]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 03.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[2]->listas_data1))
                   { $coso1= $lista_clase[2]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 32-->


       <!--COL 43-->
       <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[3]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 04.  <br></h6></div>
                   <div class="perso1 w-100"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[3]->listas_data1))
                   { $coso1= $lista_clase[3]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?><p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 1-->




   
  


</div><!--FIN ROW-->


<!--ROW 2-->
<div class="row w-100 p-1 ">
    
     <!--COL 54-->
    <div class="col-sm-3">
   

    <div class="card border border-dark bg-dark text-white">
    <img class="card-img" <?php if (isset($lista_clase[4]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
        
        <div class="card-img-overlay">
            <div class="media align-self-top">
                <div class="mr-1 w-100 text-truncate">
                    <div class="perso1"><h6> 05.  <br></h6></div>
                    <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                    
                    if (isset($lista_clase[4]->listas_data1))
                    { $coso1= $lista_clase[4]->listas_data1; }else{$coso1 = "---";}
                    echo $coso1; 
                    
                    ?> <p></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--FIN COL 0-->

    <!--COL 65-->
    <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[5]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 06.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[5]->listas_data1))
                   { $coso1= $lista_clase[5]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 1-->

       <!--COL 76-->
       <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[6]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 07.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[6]->listas_data1))
                   { $coso1= $lista_clase[6]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 32-->


       <!--COL 87-->
       <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[7]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 08.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[7]->listas_data1))
                   { $coso1= $lista_clase[7]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 1-->




   
  


</div><!--FIN ROW-->


<!--ROW 3-->
<div class="row w-100 p-1 ">
    
     <!--COL 98-->
    <div class="col-sm-3">
   

    <div class="card border border-dark bg-dark text-white">
    <img class="card-img" <?php if (isset($lista_clase[8]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
        
        <div class="card-img-overlay">
            <div class="media align-self-top">
                <div class="mr-1 w-100 text-truncate">
                    <div class="perso1"><h6> 09.  <br></h6></div>
                    <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                    
                    if (isset($lista_clase[8]->listas_data1))
                    { $coso1= $lista_clase[8]->listas_data1; }else{$coso1 = "---";}
                    echo $coso1; 
                    
                    ?> <p></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--FIN COL 0-->

    <!--COL 10-9-->
    <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[9]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 10.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[9]->listas_data1))
                   { $coso1= $lista_clase[9]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 1-->

       <!--COL 1110-->
       <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[10]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 11.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[10]->listas_data1))
                   { $coso1= $lista_clase[10]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 32-->


       <!--COL 1211-->
       <div class="col-sm-3">
   

   <div class="card border border-dark bg-dark text-white">
   <img class="card-img" <?php if (isset($lista_clase[11]->listas_data1))     { $bg="https://v1.atlo.es/00_img/normal.png"; }else{$bg = "https://v1.atlo.es/00_img/fondo_negro.jpg";}?>src="<?=$bg?>" height="90px" >
       
       <div class="card-img-overlay">
           <div class="media align-self-top">
               <div class="mr-1 w-100 text-truncate">
                   <div class="perso1"><h6> 12.  <br></h6></div>
                   <div class="perso2"><p style="text-shadow: 1px 1px #000;">  <?php 
                   
                   if (isset($lista_clase[11]->listas_data1))
                   { $coso1= $lista_clase[11]->listas_data1; }else{$coso1 = "---";}
                   echo $coso1; 
                   
                   ?> <p></div>
               </div>
           </div>
       </div>
   </div>
   </div>
   <!--FIN COL 1-->




   
  


</div><!--FIN ROW-->




