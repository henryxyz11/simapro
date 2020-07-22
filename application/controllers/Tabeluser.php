<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabeluser extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabeluser_model');
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
            $config['base_url'] = base_url() . 'tabeluser/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tabeluser/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tabeluser/index.html';
            $config['first_url'] = base_url() . 'tabeluser/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tabeluser_model->total_rows($q);
        $tabeluser = $this->Tabeluser_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tabeluser_data' => $tabeluser,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->display('tabeluser/tabeluser_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tabeluser_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'username' => $row->username,
		'password' => $row->password,
		'email' => $row->email,
		'level' => $row->level,
	    );
            $this->template->display('tabeluser/tabeluser_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabeluser'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tabeluser/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'email' => set_value('email'),
	    'level' => set_value('level'),
	);
        $this->template->display('tabeluser/tabeluser_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'email' => $this->input->post('email',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Tabeluser_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tabeluser'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tabeluser_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tabeluser/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'email' => set_value('email', $row->email),
		'level' => set_value('level', $row->level),
	    );
            $this->template->display('tabeluser/tabeluser_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabeluser'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'email' => $this->input->post('email',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Tabeluser_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tabeluser'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tabeluser_model->get_by_id($id);

        if ($row) {
            $this->Tabeluser_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tabeluser'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabeluser'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama ', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
   
/* End of file Tabeluser.php */
/* Location: ./application/controllers/Tabeluser.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-31 09:25:07 */
/* http://harviacode.com */