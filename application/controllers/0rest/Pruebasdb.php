<?php

//clausula de protección

defined('BASEPATH') OR exit('No direct script access allowed');


class Pruebasdb extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        //carga  $this->load->database(); al principio de cada funcion
        
        $this->load->database();

    }


    public function insertar(){

        $data = array(
            'nombre' => 'sergio',
            'apellido' => 'rigo'
            
    );
    
    $this->db->insert('alumnos_test', $data);
    // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
    
    $respuesta = array(
        'err' => FALSE,
        'id_insertado' => $this->db->insert_id()
    );

    echo json_encode( $respuesta ); 


    }

    public function insertar_muchos(){
        
        $data = array(
            array(
                    'nombre' => 'juan',
                    'apellido' => 'perez',
                    
            ),
            array(
                    'nombre' => 'maria',
                    'apellido' => 'herrera',
                    
            )
    );
    
    $this->db->insert_batch('alumnos_test', $data);
    // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date'),  ('Another title', 'Another name', 'Another date')

    echo $this->db->affected_rows();

    }
        

    public function tabla(){
        //https://codeigniter.com/user_guide/database/query_builder.html
        
        $query = $this->db->get('clientes', 10, 20);
        //echo json_encode( $query -> result() );

        foreach ($query->result() as $fila)
        {
                echo $fila->nombre . '<br>';
        }

    }//


    public function tabla2(){
        //https://codeigniter.com/user_guide/database/query_builder.html
        
        //arreglo de selectes
        //se pueden hacer sub-querys entre paréntesis
        
        $this->db->select('id, correo, (select count(*) from clientes) as conteo');

        //arreglo de condiciones
        //$query = $this->db->get_where('clientes', array('id' => $id), $limit, $offset);
        $query = $this->db->get_where('clientes', array('id' => 1));
        
        echo json_encode( $query -> row() ); //quita el arreglo, las llaves [].


    }//    

    public function tabla3(){
        //https://codeigniter.com/user_guide/database/query_builder.html
        
        //$this->db->select_max('id', 'id_max');
        $this->db->select_sum('id', 'id_sum');
        
        $query = $this->db->get('clientes');

        echo json_encode( $query -> row() ); //row o result 


    }//

    public function tabla4(){
        //https://codeigniter.com/user_guide/database/query_builder.html
        
        $this->db->select('id, nombre, correo');
        $this->db->from('clientes');
        
        
        //$this->db->where('id !=', 1); // Produces: WHERE id... 127 146
        
        $ids = array(127,146);
        $this->db->where_in('id', $ids); 

        //$this->db->where('nombre like', '%AR%'); // AND nombre = xavier...
        $this->db->like('nombre', 'AR', 'both');
        
        $this->db->or_where('nombre like', 'SE%' ); // Produces: WHERE id...
        
        $query = $this->db->get();

        echo json_encode( $query -> result() );


    }//

    public function tabla5(){
        //https://codeigniter.com/user_guide/database/query_builder.html
        
        $this->db->select('pais, count(*) as contar_pais');
        $this->db->from('clientes');

        $this->db->group_by("pais"); // Produces: GROUP BY title


        $query = $this->db->get();
        echo json_encode( $query -> result() );
        
    }

    public function tabla6(){
        //https://codeigniter.com/user_guide/database/query_builder.html
        
        $this->db->distinct(); 
        $this->db->select('pais');
        $this->db->from('clientes');
        $this->db->order_by('pais ASC');
        
        //echo $this->db->count_all_results();

        //echo "<br>";


        $query = $this->db->get();
       

        foreach ( $query->result() as $fila) {
            echo "<h3>". $fila->pais. '</h3><br>';
        }
        
    }


    public function clientes_beta(){

        //$this->load->database();

        //standar query (objetos)

        $sql = "SELECT id, nombre, correo, telefono1 FROM `clientes` LIMIT 15";
        $query = $this->db->query($sql);
        
        //foreach ($query->result() as $row)
        //{
        //        echo $row->id;
        //        echo $row->nombre;
        //        echo $row->correo;
        //}
        //echo 'Total registros: ' . $query->num_rows();


        $respuesta = array(

            'err' => FALSE,
            'err_mensaje' => 'Ninguno',
            'total_registros' => $query->num_rows(),
            'clientes' => $query->result()

        );

        echo json_encode($respuesta);

    }//fin clientes_beta

    public function cliente($id){

        //$this->load->database();
        
        
        $sql = "SELECT *  FROM `clientes` WHERE `id` =".$id;

        $query = $this->db->query($sql);

        $fila = $query -> row();

        if ( isset ($fila)){
            //FILA EXISTE
            $respuesta = array(
                
                            'err' => FALSE,
                            'err_mensaje' => 'Ninguno',
                            'total_registros' => 1,
                            'clientes' => $fila
                
                        );

        }else{
            //FILA NO EXISTE
            $respuesta = array(
                
                            'err' => TRUE,
                            'err_mensaje' => 'El registro '.$id.' no existe',
                            'total_registros' => $query->num_rows(),
                            'clientes' => null
                
                        );


        }

    

        echo json_encode($respuesta);
    

    }

}//cierre 