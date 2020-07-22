<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabelodp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabelodp_model');
        $this->load->library('form_validation');
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
            $config['base_url'] = base_url() . 'pegawai/tabelodp/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pegawai/tabelodp/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pegawai/tabelodp/index.html';
            $config['first_url'] = base_url() . 'pegawai/tabelodp/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tabelodp_model->total_rows($q);
        $tabelodp = $this->Tabelodp_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tabelodp_data' => $tabelodp,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->tampilkan('tblodp/tabelodp_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tabelodp_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'reg' => $row->reg,
		'witel' => $row->witel,
		'sto' => $row->sto,
		'pd_name' => $row->pd_name,
		'odp_name' => $row->odp_name,
		'odp_index' => $row->odp_index,
		'f_coor' => $row->f_coor,
		'f_loc' => $row->f_loc,
		'f_olt' => $row->f_olt,
		'latitude' => $row->latitude,
		'longitude' => $row->longitude,
		'is_avail' => $row->is_avail,
		'is_blocking' => $row->is_blocking,
		'is_other' => $row->is_other,
		'is_reserve' => $row->is_reserve,
		'is_service' => $row->is_service,
		'is_total' => $row->is_total,
		'updatedate' => $row->updatedate,
	    );
            $this->template->tampilkan('tblodp/tabelodp_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/tabelodp'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/tabelodp/create_action'),
	    'id' => set_value('id'),
	    'reg' => set_value('reg'),
	    'witel' => set_value('witel'),
	    'sto' => set_value('sto'),
	    'pd_name' => set_value('pd_name'),
	    'odp_name' => set_value('odp_name'),
	    'odp_index' => set_value('odp_index'),
	    'f_coor' => set_value('f_coor'),
	    'f_loc' => set_value('f_loc'),
	    'f_olt' => set_value('f_olt'),
	    'latitude' => set_value('latitude'),
	    'longitude' => set_value('longitude'),
	    'is_avail' => set_value('is_avail'),
	    'is_blocking' => set_value('is_blocking'),
	    'is_other' => set_value('is_other'),
	    'is_reserve' => set_value('is_reserve'),
	    'is_service' => set_value('is_service'),
	    'is_total' => set_value('is_total'),
	    'updatedate' => set_value('updatedate'),
	);
        $this->template->tampilkan('tblodp/tabelodp_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'reg' => $this->input->post('reg',TRUE),
		'witel' => $this->input->post('witel',TRUE),
		'sto' => $this->input->post('sto',TRUE),
		'pd_name' => $this->input->post('pd_name',TRUE),
		'odp_name' => $this->input->post('odp_name',TRUE),
		'odp_index' => $this->input->post('odp_index',TRUE),
		'f_coor' => $this->input->post('f_coor',TRUE),
		'f_loc' => $this->input->post('f_loc',TRUE),
		'f_olt' => $this->input->post('f_olt',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
		'is_avail' => $this->input->post('is_avail',TRUE),
		'is_blocking' => $this->input->post('is_blocking',TRUE),
		'is_other' => $this->input->post('is_other',TRUE),
		'is_reserve' => $this->input->post('is_reserve',TRUE),
		'is_service' => $this->input->post('is_service',TRUE),
		'is_total' => $this->input->post('is_total',TRUE),
		'updatedate' => $this->input->post('updatedate',TRUE),
	    );

            $this->Tabelodp_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai/tabelodp'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tabelodp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/tabelodp/update_action'),
		'id' => set_value('id', $row->id),
		'reg' => set_value('reg', $row->reg),
		'witel' => set_value('witel', $row->witel),
		'sto' => set_value('sto', $row->sto),
		'pd_name' => set_value('pd_name', $row->pd_name),
		'odp_name' => set_value('odp_name', $row->odp_name),
		'odp_index' => set_value('odp_index', $row->odp_index),
		'f_coor' => set_value('f_coor', $row->f_coor),
		'f_loc' => set_value('f_loc', $row->f_loc),
		'f_olt' => set_value('f_olt', $row->f_olt),
		'latitude' => set_value('latitude', $row->latitude),
		'longitude' => set_value('longitude', $row->longitude),
		'is_avail' => set_value('is_avail', $row->is_avail),
		'is_blocking' => set_value('is_blocking', $row->is_blocking),
		'is_other' => set_value('is_other', $row->is_other),
		'is_reserve' => set_value('is_reserve', $row->is_reserve),
		'is_service' => set_value('is_service', $row->is_service),
		'is_total' => set_value('is_total', $row->is_total),
		'updatedate' => set_value('updatedate', $row->updatedate),
	    );
            $this->template->tampilkan('tblodp/tabelodp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/tabelodp'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'reg' => $this->input->post('reg',TRUE),
		'witel' => $this->input->post('witel',TRUE),
		'sto' => $this->input->post('sto',TRUE),
		'pd_name' => $this->input->post('pd_name',TRUE),
		'odp_name' => $this->input->post('odp_name',TRUE),
		'odp_index' => $this->input->post('odp_index',TRUE),
		'f_coor' => $this->input->post('f_coor',TRUE),
		'f_loc' => $this->input->post('f_loc',TRUE),
		'f_olt' => $this->input->post('f_olt',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
		'is_avail' => $this->input->post('is_avail',TRUE),
		'is_blocking' => $this->input->post('is_blocking',TRUE),
		'is_other' => $this->input->post('is_other',TRUE),
		'is_reserve' => $this->input->post('is_reserve',TRUE),
		'is_service' => $this->input->post('is_service',TRUE),
		'is_total' => $this->input->post('is_total',TRUE),
		'updatedate' => $this->input->post('updatedate',TRUE),
	    );

            $this->Tabelodp_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai/tabelodp'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tabelodp_model->get_by_id($id);

        if ($row) {
            $this->Tabelodp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai/tabelodp'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/tabelodp'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('reg', 'reg', 'trim|required');
	$this->form_validation->set_rules('witel', 'witel', 'trim|required');
	$this->form_validation->set_rules('sto', 'sto', 'trim|required');
	$this->form_validation->set_rules('pd_name', 'pd name', 'trim|required');
	$this->form_validation->set_rules('odp_name', 'odp name', 'trim|required');
	$this->form_validation->set_rules('odp_index', 'odp index', 'trim|required');
	$this->form_validation->set_rules('f_coor', 'f coor', 'trim|required');
	$this->form_validation->set_rules('f_loc', 'f loc', 'trim|required');
	$this->form_validation->set_rules('f_olt', 'f olt', 'trim|required');
	$this->form_validation->set_rules('latitude', 'latitude', 'trim|required|numeric');
	$this->form_validation->set_rules('longitude', 'longitude', 'trim|required|numeric');
	$this->form_validation->set_rules('is_avail', 'is avail', 'trim|required');
	$this->form_validation->set_rules('is_blocking', 'is blocking', 'trim|required');
	$this->form_validation->set_rules('is_other', 'is other', 'trim|required');
	$this->form_validation->set_rules('is_reserve', 'is reserve', 'trim|required');
	$this->form_validation->set_rules('is_service', 'is service', 'trim|required');
	$this->form_validation->set_rules('is_total', 'is total', 'trim|required');
	$this->form_validation->set_rules('updatedate', 'updatedate', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tabelodp.xls";
        $judul = "tabelodp";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Reg");
	xlsWriteLabel($tablehead, $kolomhead++, "Witel");
	xlsWriteLabel($tablehead, $kolomhead++, "Sto");
	xlsWriteLabel($tablehead, $kolomhead++, "Pd Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Odp Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Odp Index");
	xlsWriteLabel($tablehead, $kolomhead++, "F Coor");
	xlsWriteLabel($tablehead, $kolomhead++, "F Loc");
	xlsWriteLabel($tablehead, $kolomhead++, "F Olt");
	xlsWriteLabel($tablehead, $kolomhead++, "Latitude");
	xlsWriteLabel($tablehead, $kolomhead++, "Longitude");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Avail");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Blocking");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Other");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Reserve");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Service");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Total");
	xlsWriteLabel($tablehead, $kolomhead++, "Updatedate");

	foreach ($this->Tabelodp_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->reg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->witel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sto);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pd_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->odp_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->odp_index);
	    xlsWriteLabel($tablebody, $kolombody++, $data->f_coor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->f_loc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->f_olt);
	    xlsWriteNumber($tablebody, $kolombody++, $data->latitude);
	    xlsWriteNumber($tablebody, $kolombody++, $data->longitude);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_avail);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_blocking);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_other);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_reserve);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_service);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_total);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updatedate);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tabelodp.php */
/* Location: ./application/controllers/Tabelodp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-01 01:27:53 */
/* http://harviacode.com */