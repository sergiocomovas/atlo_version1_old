<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Zonaprivada_model extends CI_Model  
 {  
      function can_login_old($username, $password)  
      {  
           $this->load->database();
           $this->db->where('username', $username);  
           $this->db->where('password', $password);  

           //USUARIOS REGISTRADOS

           $query = $this->db->get('at_temp_users1');  

           //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  
      } 

      function existe_usuario($username){


        $username = trim($username); 
        $username = strtolower($username);
        $this->load->database();

        $this->db->where('clientes_email', $username);  
    

        //USUARIOS REGISTRADOS

        $query = $this->db->get('at_def_clientes'); 

        if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  


      }
      
      function can_login($username, $password, $symbol)  
      {  
           $this->load->database();

           $password=$password*615890787; 

           $query = $this->db->query(' 
           
           SELECT * FROM at_def_contrasenas, at_def_clientes WHERE at_def_contrasenas.stripe_customer_id = at_def_clientes.stripe_customer_id AND at_def_clientes.clientes_email = "'.$username.'" AND at_def_contrasenas.contrasena_contrasena = "'.$password.'" and at_def_contrasenas.contrasena_simbolo = "'.$symbol.'"

            ');

           //


           //$this->db->where('username', $username);  
           //$this->db->where('password', $password);  

           //USUARIOS REGISTRADOS

           //$query = $this->db->get('at_temp_users1');  
           
           //SELECT * FROM users WHERE username = '$username' AND password = '$password' 
           
           
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  
      }  

      function can_login_auto($username, $password)  
      {  
           
          $username = trim($username);
          $username = strtolower($username);
          $password = trim($password);
           $this->load->database();

           //$password=$password; 

           echo $query = $this->db->query(' 
           
           SELECT * FROM at_def_contrasenas, at_def_clientes WHERE at_def_contrasenas.stripe_customer_id = at_def_clientes.stripe_customer_id AND at_def_clientes.clientes_email = "'.$username.'" AND at_def_contrasenas.contrasena_contrasena = "'.$password.'" 

            ');

           //


           //$this->db->where('username', $username);  
           //$this->db->where('password', $password);  

           //USUARIOS REGISTRADOS

           //$query = $this->db->get('at_temp_users1');  
           
           //SELECT * FROM users WHERE username = '$username' AND password = '$password' 
           
           
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  
      }  





      function existe_contrasena($username)  
      
      {  
           
           $username = trim($username);
           $username = strtolower($username);
          
           $this->load->database();

           $query = $this->db->query(' 
           
           SELECT * FROM at_def_contrasenas, at_def_clientes WHERE at_def_contrasenas.stripe_customer_id = at_def_clientes.stripe_customer_id AND at_def_clientes.clientes_email = "'.$username.'"

            ');

           //


           //$this->db->where('username', $username);  
           //$this->db->where('password', $password);  

           //USUARIOS REGISTRADOS

           //$query = $this->db->get('at_temp_users1');  
           
           //SELECT * FROM users WHERE username = '$username' AND password = '$password' 
           
           
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  
      }  


    


 }  
