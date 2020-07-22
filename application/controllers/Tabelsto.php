<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabelsto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabelsto_model');
        $this->load->library('form_validation');
        $this->load->model('map_model');
        if ($this->session->userdata('level')<>"admin") {
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
            $config['base_url'] = base_url() . 'tabelsto/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tabelsto/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tabelsto/index.html';
            $config['first_url'] = base_url() . 'tabelsto/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tabelsto_model->total_rows($q);
        $tabelsto = $this->Tabelsto_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tabelsto_data' => $tabelsto,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->display('tabelsto/tabelsto_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tabelsto_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'witel' => $row->witel,
        'datel' => $row->datel,
        'sto' => $row->sto,
        'latitude' => $row->latitude,
        'longitude' => $row->longitude,
        'alamat' => $row->alamat,
        );
            $config['center'] = $row->latitude.','.$row->longitude;
        
        $circle['center'] = $row->latitude.','.$row->longitude;
        $circle['radius'] = '250';
        $config['zoom'] = '17';
        $config['map_name'] = 'map_one';
        $config['map_div_id'] = 'map_canvas_one';
        
        $this->googlemaps->initialize($config);
        $this->googlemaps->add_circle($circle);

        $tabelsto = $this->map_model->get_coordinates3();

        // // Loop through the coordinates we obtained above and add them to the map
        foreach ($tabelsto as $coordinate) {
        $marker = array();
        $marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
        $marker['zoom'] = '19';
        $marker['infowindow_content'] = '<p class="media-heading">'."<b>Nama STO</b> : ".$coordinate->witel.'</p> <p>'."<b>Witel</b> : ".$coordinate->witel.'</p>  <p>'."<b>Alamat</b> : ".$coordinate->alamat.'</p> <p>'.$coordinate->alamat.'</p>';
        $marker['icon'] = base_url("public/icon/sto1.png");
        $this->googlemaps->add_marker($marker);
        }

        // Create the map
        $data['map_one'] = $this->googlemaps->create_map();
            $this->template->display('tabelsto/tabelsto_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabelsto'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tabelsto/create_action'),
        'id' => set_value('id'),
        'witel' => set_value('witel'),
        'datel' => set_value('datel'),
        'sto' => set_value('sto'),
        'latitude' => set_value('latitude'),
        'longitude' => set_value('longitude'),
        'alamat' => set_value('alamat'),
    );
        $this->template->display('tabelsto/tabelsto_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'witel' => $this->input->post('witel',TRUE),
        'datel' => $this->input->post('datel',TRUE),
        'sto' => $this->input->post('sto',TRUE),
        'latitude' => $this->input->post('latitude',TRUE),
        'longitude' => $this->input->post('longitude',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        );

            $this->Tabelsto_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tabelsto'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tabelsto_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tabelsto/update_action'),
        'id' => set_value('id', $row->id),
        'witel' => set_value('witel', $row->witel),
        'datel' => set_value('datel', $row->datel),
        'sto' => set_value('sto', $row->sto),
        'latitude' => set_value('latitude', $row->latitude),
        'longitude' => set_value('longitude', $row->longitude),
        'alamat' => set_value('alamat', $row->alamat),
        );
            $this->template->display('tabelsto/tabelsto_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabelsto'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
        'witel' => $this->input->post('witel',TRUE),
        'datel' => $this->input->post('datel',TRUE),
        'sto' => $this->input->post('sto',TRUE),
        'latitude' => $this->input->post('latitude',TRUE),
        'longitude' => $this->input->post('longitude',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        );

            $this->Tabelsto_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tabelsto'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tabelsto_model->get_by_id($id);

        if ($row) {
            $this->Tabelsto_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tabelsto'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabelsto'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('witel', 'witel', 'trim|required');
    $this->form_validation->set_rules('datel', 'datel', 'trim|required');
    $this->form_validation->set_rules('sto', 'sto', 'trim|required');
    $this->form_validation->set_rules('latitude', 'latitude', 'trim|required|numeric');
    $this->form_validation->set_rules('longitude', 'longitude', 'trim|required|numeric');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tabelsto.xls";
        $judul = "tabelsto";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Witel");
    xlsWriteLabel($tablehead, $kolomhead++, "Datel");
    xlsWriteLabel($tablehead, $kolomhead++, "Sto");
    xlsWriteLabel($tablehead, $kolomhead++, "Latitude");
    xlsWriteLabel($tablehead, $kolomhead++, "Longitude");
    xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

    foreach ($this->Tabelsto_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->witel);
        xlsWriteLabel($tablebody, $kolombody++, $data->datel);
        xlsWriteLabel($tablebody, $kolombody++, $data->sto);
        xlsWriteNumber($tablebody, $kolombody++, $data->latitude);
        xlsWriteNumber($tablebody, $kolombody++, $data->longitude);
        xlsWriteLabel($tablebody, $kolombody++, $data->alamat);

        $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tabelsto.php */
/* Location: ./application/controllers/Tabelsto.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-14 04:45:09 */
/* http://harviacode.com */