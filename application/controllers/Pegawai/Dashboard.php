<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Odppelanggan_model');
        $this->load->library('form_validation');
        $this->load->model('map_model');
        $this->load->model('Tabelodp_model');
        $this->load->model('Tabelsto_model');
        $this->load->model('Tabelpelanggan_model');
        if ($this->session->userdata('level')<>"pegawai") {
        echo "<script>
                      alert('Silakan Login Terlebih Dahulu');window.location.href='auth';  
             </script>";
        }
    }

    public function index()
    {
        

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            
            $config['base_url'] = base_url() . 'pegawai/dashboard/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pegawai/dashboard/index.html?q=' . urlencode($q);
            // $config['base_url'] = base_url() . 'dashboard' . urlencode($q);
            // $config['first_url'] = base_url() . 'dashboard' . urlencode($q);

        } else {

            // $config['base_url'] = base_url() . 'dashboard/index.html';
            // $config['first_url'] = base_url() . 'dashboard/index.html';
            $config['base_url'] = base_url() . 'pegawai/dashboard';
            $config['first_url'] = base_url() . 'pegawai/dashboard';
        }
        
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Odppelanggan_model->total_rows($q);
        $dashboard = $this->Odppelanggan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'dashboard_data' => $dashboard,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->tampilkan('dashboards/dashboard_list', $data);
    }

    public function read($id) 
    {
        

        $row = $this->Odppelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_cust' => $row->nama_cust,
		'no_hp' => $row->no_hp,
		'alamat' => $row->alamat,
		'latitude' => $row->latitude,
		'longitude' => $row->longitude,
	    );
            $config['center'] = $row->latitude.','.$row->longitude;
        $circle['center'] = $row->latitude.','.$row->longitude;
        $circle['radius'] = '500';
        $circle['radius1'] = '250';
        $config['zoom'] = '17';
//        $config['map_name'] = 'map_one';
//        $config['map_div_id'] = 'map_canvas_one';
        
        $this->googlemaps->add_circle($circle);
        $this->googlemaps->initialize($config);
        $tabelodp = $this->map_model->get_coordinates();
            
       
            
        $tabelpelanggan = $this->map_model->get_coordinates2();
            $tabelsto = $this->map_model->get_coordinates3();
        // // Loop through the coordinates we obtained above and add them to the map
        
        foreach ($tabelodp as $coordinate) {
        $marker = array();
        $marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
        $marker['infowindow_content'] = '<h4 class="media-heading">'.$coordinate->id.'. '.$coordinate->pd_name.'</h4> <p>'.$coordinate->witel.'</p> <h5>Port Available '.$coordinate->is_avail.'</h5> <h5>Port Blocking '.$coordinate->is_blocking.'</h5> <h5>Port Others '.$coordinate->is_other.'</h5> <h5>Port Reserved '.$coordinate->is_reserve.'</h5> <h5>Port Service '.$coordinate->is_service.'</h5>';
        $marker['icon'] = base_url("public/icon/odp.png");
        $this->googlemaps->add_marker($marker);

        }

         
        foreach ($tabelpelanggan as $coordinate) {
        $marker = array();
        $marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
        $marker['zoom'] = '19';
        $marker['infowindow_content'] = '<h4 class="media-heading">'.$coordinate->id.'. '.$coordinate->nama_cust.'</h4> <h5>'.$coordinate->no_hp.'</h5> <p>'.$coordinate->alamat.'</p> ';
        $marker['icon'] = base_url("public/icon/house.png");
        $this->googlemaps->add_marker($marker);
            

        }
    foreach ($tabelsto as $coordinate) {
    $marker = array();
    $marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
    $marker['infowindow_content'] = '<p class="media-heading">'."<b>Nama STO</b> : ".$coordinate->witel.'</p> <p>'."<b>Witel</b> : ".$coordinate->witel.'</p>  <p>'."<b>Alamat</b> : ".$coordinate->alamat.'</p> <p>'.$coordinate->alamat.'</p>';
    $marker['icon'] = base_url("public/icon/sto1.png");
    $this->googlemaps->add_marker($marker);
    }

            // Create the map
            $data['map1'] = $this->googlemaps->create_map();

            $this->template->tampilkan('dashboards/dashboard_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/dashboard'));
        }


    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/dashboard/create_action'),
	    'id' => set_value('id'),
	    'nama_cust' => set_value('nama_cust'),
	    'no_hp' => set_value('no_hp'),
	    'alamat' => set_value('alamat'),
	    'latitude' => set_value('latitude'),
	    'longitude' => set_value('longitude'),
	);
        $this->template->tampilkan('dashboards/dashboard_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_cust' => $this->input->post('nama_cust',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
	    );

            $this->Odppelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai/dashboard'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Odppelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/dashboard/update_action'),
		'id' => set_value('id', $row->id),
		'nama_cust' => set_value('nama_cust', $row->nama_cust),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'alamat' => set_value('alamat', $row->alamat),
		'latitude' => set_value('latitude', $row->latitude),
		'longitude' => set_value('longitude', $row->longitude),
	    );
            $this->template->tampilkan('dashboards/dashboard_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/dashboard'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_cust' => $this->input->post('nama_cust',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
	    );

            $this->Odppelanggan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai/dashboard'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Odppelanggan_model->get_by_id($id);

        if ($row) {
            $this->Odppelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai/dashboard'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/dashboard'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_cust', 'nama cust', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('latitude', 'latitude', 'trim|required|numeric');
	$this->form_validation->set_rules('longitude', 'longitude', 'trim|required|numeric');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tabelpelanggan.xls";
        $judul = "tabelpelanggan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Cust");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Latitude");
	xlsWriteLabel($tablehead, $kolomhead++, "Longitude");

	foreach ($this->Odppelanggan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_cust);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->latitude);
	    xlsWriteNumber($tablebody, $kolombody++, $data->longitude);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-01 04:53:46 */
/* http://harviacode.com */