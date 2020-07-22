<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabelpelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabelpelanggan_model');
        $this->load->library('form_validation');
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
            $config['base_url'] = base_url() . 'tabelpelanggan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tabelpelanggan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tabelpelanggan/index.html';
            $config['first_url'] = base_url() . 'tabelpelanggan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tabelpelanggan_model->total_rows($q);
        $tabelpelanggan = $this->Tabelpelanggan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tabelpelanggan_data' => $tabelpelanggan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->display('tabelpelanggan/tabelpelanggan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tabelpelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_cust' => $row->nama_cust,
		'no_hp' => $row->no_hp,
		'alamat' => $row->alamat,
		'latitude' => $row->latitude,
		'longitude' => $row->longitude,
	    );
            $this->template->display('tabelpelanggan/tabelpelanggan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabelpelanggan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tabelpelanggan/create_action'),
	    'id' => set_value('id'),
	    'nama_cust' => set_value('nama_cust'),
	    'no_hp' => set_value('no_hp'),
	    'alamat' => set_value('alamat'),
	    'latitude' => set_value('latitude'),
	    'longitude' => set_value('longitude'),
	);
        $this->template->display('tabelpelanggan/tabelpelanggan_form', $data);
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

            $this->Tabelpelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tabelpelanggan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tabelpelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tabelpelanggan/update_action'),
		'id' => set_value('id', $row->id),
		'nama_cust' => set_value('nama_cust', $row->nama_cust),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'alamat' => set_value('alamat', $row->alamat),
		'latitude' => set_value('latitude', $row->latitude),
		'longitude' => set_value('longitude', $row->longitude),
	    );
            $this->template->display('tabelpelanggan/tabelpelanggan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabelpelanggan'));
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

            $this->Tabelpelanggan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tabelpelanggan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tabelpelanggan_model->get_by_id($id);

        if ($row) {
            $this->Tabelpelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tabelpelanggan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabelpelanggan'));
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

	foreach ($this->Tabelpelanggan_model->get_all() as $data) {
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

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tabelpelanggan.doc");

        $data = array(
            'tabelpelanggan_data' => $this->Tabelpelanggan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tabelpelanggan/tabelpelanggan_doc',$data);
    }
    
    public function import()
    {
        $this->load->helper(['form', 'notification', 'string']);
        $this->load->model('Tabelpelanggan_model');

        if (isset($_POST['import'])) {
            $file = $_FILES['scsv']['tmp_name'];

            if (empty($file)) {
                $this->session->set_flashdata('alert', error('Form file data pelanggan wajib diisi!'));
//                $data['result']=$this->Tabelpelanggan_model->upload_sampledata_csv();
//                $data['query']=$this->Tabelpelanggan_model->get_car_features_info();
                $data['form_title'] = "Impor Data Pelanggan";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'tabelpelanggan/customer_import';
                $this->template->display('tabelpelanggan', $data);
            }

            $eks = explode('.', $_FILES['scsv']['name']);

            if (strtolower(end($eks)) === 'csv') {
                $handle = fopen($file, "r");
                while (($row = fgetcsv($handle, 2048))) {

                    for ($i = 1; $i <= count($row) ; $i++) {
                        $id = '';
                    }

                    $data = [
//                        'id' => set_value('id', $row->id),
                        'nama_cust' => $row[1],
                        'no_hp' => $row[2],
                        'alamat' => $row[3],
                        'latitude' => $row[4],
                        'longitude' => $row[5]
                    ];

                    $this->db->insert('tabelpelanggan', $data);
                }

                fclose($handle);
                $this->session->set_flashdata('alert', success('Data pelanggan berhasil diimport.'));
                
                $data['content'] = 'tabelpelanggan';
                redirect('tabelpelanggan');

            } else {
                $this->session->set_flashdata('alert', error('Formal file yang diperbolehkan hanya *.csv.'));
                
                $data['action'] = site_url(uri_string());
                $data['content'] = 'tabelpelanggan/customer_import';
                $this->template->display('tabelpelanggan/customer_import', $data);

            }
        } else {
            
            
            $data['action'] = site_url(uri_string());
            $data['content'] = 'tabelpelanggan/customer_import';
            $this->template->display('tabelpelanggan/customer_import', $data);
        }
    }

}

/* End of file Tabelpelanggan.php */
/* Location: ./application/controllers/Tabelpelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-31 09:25:07 */
/* http://harviacode.com */