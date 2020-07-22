<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        
    }
	
	public function index()
	{
		$this->load->view('login');
	}

	public function cek_login()
	{
		$data = array('username' => $this->input->post('username') , 
					  'password' => md5($this->input->post('password'))
					  );
		$hasil = $this->model_user->cek_user($data);
		if ($hasil->num_rows() == 1){
			foreach($hasil->result() as $sess)
            {
              $sess_data['logged_in'] = 'Sudah Login';
              $sess_data['username'] = $sess->username;
              $sess_data['level'] = $sess->level;
              $this->session->set_userdata($sess_data);
            }
			if ($this->session->userdata('level')=='admin'){
				redirect('Dashboard');
			}
			elseif ($this->session->userdata('level')=='pegawai'){
				redirect('Pegawai/Dashboard');
			}
		}
		else
		{
			echo " <script>alert('Gagal Login: Cek username , password!');history.go(-1);</script>";
		}
		
	}

	public function logout() {
		$this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        session_destroy();
		redirect('auth');
	} 

}