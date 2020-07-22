<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_dp_model extends CI_Model
{

    public $table = 'newdp';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $query = $this->db->query("SELECT * FROM newdp");
        return $query->result();
    }

    function get_some()
    {
        $query = $this->db->query("SELECT * FROM newdp WHERE odp IS NULL LIMIT 800; ");
        return $query->result();
    }


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $q = str_replace(" ", "%", $q);
        $query = $this->db->query("SELECT * FROM newdp WHERE
                                    (id LIKE '%$q%' OR
                                    witel LIKE '%$q%' OR
                                   # kandatel LIKE '%$q%' OR
                                   # devicesto LIKE '%$q%' OR
                                    sto LIKE '%$q%' OR
                                    device_name LIKE '%$q%' OR
                                   # odp LIKE '%$q%' OR
                                    latitude LIKE '%$q%' OR
                                    longitude LIKE '%$q%')
                                   # ORDER BY jumlah_odp DESC
                                    ");
        $result = $query->result();
        $count = count($result);
        return $count;
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $q = str_replace(" ", "%", $q);
        $query = $this->db->query("SELECT * FROM newdp WHERE
                                    (id LIKE '%$q%' OR
                                    witel LIKE '%$q%' OR
                                   # kandatel LIKE '%$q%' OR
                                   # devicesto LIKE '%$q%' OR
                                    sto LIKE '%$q%' OR
                                    device_name LIKE '%$q%' OR
                                   # odp LIKE '%$q%' OR
                                    latitude LIKE '%$q%' OR
                                    longitude LIKE '%$q%')
                                   # ORDER BY jumlah_odp DESC
                                    LIMIT $start,$limit");
        return $query->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data/
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


}

/* End of file Data_dp_model.php */
/* Location: ./application/models/Data_dp_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-03-15 14:23:33 */
/* http://harviacode.com */