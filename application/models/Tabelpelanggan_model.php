<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tabelpelanggan_model extends CI_Model
{

    public $table = 'odp_pelanggan';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama_cust', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('latitude', $q);
	$this->db->or_like('longitude', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('id', $q);
	$this->db->or_like('nama_cust', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('latitude', $q);
	$this->db->or_like('longitude', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    
    
//    hem
//    function upload_sampledata_csv(){
//        if(isset($_POST['submit'])){
//              $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
//                while(($line = fgetcsv($fp)) !== FALSE){
//                    //check whether there are duplicate rows of data in database
//                    $prevQuery = array(
//                                    
//                                    'nama_cust' => $line[1],
//                                    'no_hp' => $line[2],
//                                    'alamat' => $line[3],
//                                    'latitude' => $line[4],
//                                    'longitude' => $line[5]
//                                    );
//
//                    $q=$this->db->select('tabelpelanggan', $prevQuery)
//                          =>where('nama_cust' => $line[1],
//                                    'no_hp' => $line[2],
//                                    'alamat' => $line[3],
//                                    'latitude' => $line[4],
//                                    'longitude' => $line[5]);
//
//                $prevResult = $this -> db->query($q);
//
//                if($prevResult->num_rows > 0){
//                    //update process data
//
//                    $data = array(
//                                'nama_cust' => $line[1],
//                                    'no_hp' => $line[2],
//                                    'alamat' => $line[3],
//                                    'latitude' => $line[4],
//                                    'longitude' => $line[5]
//                                );
//
//
//                    $this->db->set
//                    (
//                                    'nama_cust' => $line[1],
//                                    'no_hp' => $line[2],
//                                    'alamat' => $line[3],
//                                    'latitude' => $line[4],
//                                    'longitude' => $line[5]
//                    );
//
//                    $this->db->where('nama_cust' => $line[1],
//                                    'no_hp' => $line[2],
//                                    'alamat' => $line[3],
//                                    'latitude' => $line[4],
//                                    'longitude' => $line[5]
//                                     ); 
//
//                    $this->db->update('tabelpelanggan');
//
//
//                }else{
//                for($i = 0, $j = count($line); $i < $j; $i++){  
//                      $data = array('nama_cust' => $line[1],
//                                    'no_hp' => $line[2],
//                                    'alamat' => $line[3],
//                                    'latitude' => $line[4],
//                                    'longitude' => $line[5]
//                                     );
//
//            $data['crane_features']=$this->db->insert('tabelpelanggan', $data);
//                }
//                 $i++;
//            }
//}
//fclose($fp) or die("can't close file");
//
//}
//}
//function get_car_features_info(){
//     $get_cardetails=$this->db->query("select * from tabelpelanggan");
//      return $get_cardetails;
//}
    
    
}

/* End of file Tabelpelanggan_model.php */
/* Location: ./application/models/Tabelpelanggan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-31 09:25:07 */
/* http://harviacode.com */