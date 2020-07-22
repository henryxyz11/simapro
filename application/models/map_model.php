<?php 

class Map_model extends CI_Model {  

    public $table = 'tabelpelanggan';
    public $id = 'id';  
    
    function __construct()    {        

        parent::__construct();    
    }

    
	function get_coordinates()    {
	        
	        $return = array();
	        $this->db->select("id,pd_name,witel,latitude,longitude,is_avail,is_blocking,is_other,is_reserve,is_service,is_total");        
	        $this->db->from("tabelodp");        
	        $query = $this->db->get();

	        if ($query->num_rows()>0) {            
	            foreach ($query->result() as $row) {                
	                array_push($return, $row);            
	            }        

	        }
	        return $return;
	    
	    }

	function get_coordinates2()    {
	        
	        $return = array();
	        $this->db->select("id,nama_cust,no_hp,alamat,latitude,longitude");        
	        $this->db->from("tabelpelanggan");        
	        $query = $this->db->get();

	        if ($query->num_rows()>0) {            
	            foreach ($query->result() as $row) {                
	                array_push($return, $row);            
	            }        

	        }
	        return $return;
    
    } 

    function get_coordinates3()    {
	        
	        $return = array();
	        $this->db->select("id,witel,datel,sto,latitude,longitude,alamat");        
	        $this->db->from("tabelsto");        
	        $query = $this->db->get();

	        if ($query->num_rows()>0) {            
	            foreach ($query->result() as $row) {                
	                array_push($return, $row);            
	            }        

	        }
	        return $return;
    
    } 
    
    
    
}
