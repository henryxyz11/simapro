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
            $config['base_url'] = base_url() . 'dashboard?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'dashboard?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'dashboard';
            $config['first_url'] = base_url() . 'dashboard';
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
        $this->template->display('dashboard/dashboard_list', $data);
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
        $circle['radius'] = '250';
        $config['zoom'] = '17';
        $config['map_name'] = 'map_one';
        $config['map_div_id'] = 'map_canvas_one';
        
        $this->googlemaps->initialize($config);
        $this->googlemaps->add_circle($circle);

        $tabelodp = $this->map_model->get_coordinates();
        $tabelpelanggan = $this->map_model->get_coordinates2();
        $tabelsto = $this->map_model->get_coordinates3();

        // // Loop through the coordinates we obtained above and add them to the map
        
        foreach($this->searchQuery() as $tabelodp => $coordinate){ 
        $marker = array();
        $marker['position'] = "{$coordinate->latitude}, {$coordinate->longitude}";
        $marker['infowindow_content'] = '<h4 class="media-heading">'.$coordinate->id.'. '.$coordinate->pd_name.'</h4> <p>'.$coordinate->witel.'</p> <h5>Port Available '.$coordinate->is_avail.'</h5> <h5>Port Blocking '.$coordinate->is_blocking.'</h5> <h5>Port Others '.$coordinate->is_other.'</h5> <h5>Port Reserved '.$coordinate->is_reserve.'</h5> <h5>Port Service '.$coordinate->is_service.'</h5>';
        // $marker['animation'] = 'DROP';
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
        $marker['zoom'] = '19';
        $marker['infowindow_content'] = '<p class="media-heading">'."<b>Nama STO</b> : ".$coordinate->witel.'</p> <p>'."<b>Witel</b> : ".$coordinate->witel.'</p>  <p>'."<b>Alamat</b> : ".$coordinate->alamat.'</p> <p>'.$coordinate->alamat.'</p>';
        $marker['icon'] = base_url("public/icon/sto.png");
        $this->googlemaps->add_marker($marker);
        }

        // Create the map
        $data['map_one'] = $this->googlemaps->create_map();

            
            $this->template->display('dashboard/dashboard_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dashboard'));
        }
        
             
    }


    public function searchQuery()
        {
            
            switch ($this->input->get('is_avail')) 
            {
                case '<1':
                    $this->db->where('tabelodp.is_avail <=', 1);
                    break;
                case '>1':
                    $this->db->where('tabelodp.is_avail >', 1);
                    break;
            }

    return $this->db->get("tabelodp")->result();  
    }

    
    
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dashboard/create_action'),
	    'id' => set_value('id'),
	    'nama_cust' => set_value('nama_cust'),
	    'no_hp' => set_value('no_hp'),
	    'alamat' => set_value('alamat'),
	    'latitude' => set_value('latitude'),
	    'longitude' => set_value('longitude'),
        'odp' => set_value('odp'),    
	);
        $this->template->display('dashboard/dashboard_form', $data);
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
        'odp' => $this->input->post('odp',TRUE),        
	    );

            $this->Odppelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dashboard'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Odppelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dashboard/update_action'),
		'id' => set_value('id', $row->id),
		'nama_cust' => set_value('nama_cust', $row->nama_cust),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'alamat' => set_value('alamat', $row->alamat),
		'latitude' => set_value('latitude', $row->latitude),
		'longitude' => set_value('longitude', $row->longitude),
        'odp' => set_value('odp', $row->odp),        
	    );
            $this->template->display('dashboard/dashboard_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dashboard'));
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
        'odp' => $this->input->post('odp',TRUE),        
	    );

            $this->Odppelanggan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dashboard'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Odppelanggan_model->get_by_id($id);

        if ($row) {
            $this->Odppelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dashboard'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dashboard'));
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
        $namaFile = "dashboard.xls";
        $judul = "dashboard";
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
        xlsWriteLabel($tablehead, $kolomhead++, "ODP");

  foreach ($this->Odppelanggan_model->get_all() as $data) {
                    $kolombody = 0;
                    
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
      xlsWriteLabel($tablebody, $kolombody++, $data->nama_cust);
      xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
      xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
      xlsWriteNumber($tablebody, $kolombody++, $data->latitude);
      xlsWriteNumber($tablebody, $kolombody++, $data->longitude);
      xlsWriteLabel($tablebody, $kolombody++, $data->odp);
                        
      $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
 
    public function excel_down()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_dp.xls";
        $judul = "data_dp";
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
        xlsWriteLabel($tablehead, $kolomhead++, "ODP");

    foreach ($this->Data_dp_model->get_all() as $data) {
            $kolombody = 0;

                    $str = explode('; ', $data->odp);

                    foreach ($str as $key) {
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    $kolombody = 0;
                    if ($key != "") {
                      xlsWriteNumber($tablebody, $kolombody++, $nourut);
      xlsWriteLabel($tablebody, $kolombody++, $data->nama_cust);
      xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
      xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
      xlsWriteNumber($tablebody, $kolombody++, $data->latitude);
      xlsWriteNumber($tablebody, $kolombody++, $data->longitude);
                      xlsWriteLabel($tablebody, $kolombody++, $key);

                          $tablebody++;
                          $nourut++;
                        }
                    }
            }

        xlsEOF();
        exit();
    }
    
    
   public function updateODP(){

      set_time_limit(0);
      date_default_timezone_set( 'Asia/Makassar' );

      foreach ($this->Odppelanggan_model->get_some() as $data) {

                $lat = $data->latitude;
                $lon = $data->longitude;

                $url="https://starclick.telkom.co.id/noss_prod/data/newoss_get_alpro.php";
                $postinfo = "lat=$lat&lng=$lon&product=MAX SPEED 10M&productlist=MAX SPEED 10M";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_NOBODY, false);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_USERAGENT,
                    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
                $res = curl_exec($ch);
                $get =  json_decode($res); // ini array

                $meters = "";
                $netloc = "";

               if ($get->success)
               {

                 foreach ($get->odp as $odp) {

                 $lat2 = $odp->latitude;
                 $lon2 = $odp->longitude;
                 $unit = "K";

                 $lat1 = $data->latitude;
                 $lon1 = $data->longitude;

                 $theta = $lon1 - $lon2;
                 $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                 $dist = acos($dist);
                 $dist = rad2deg($dist);
                 $miles = $dist * 60 * 1.1515;
                 $unit = strtoupper($unit);

                 if ($unit == "K") {$dis = ($miles * 1.609344);}
                 else if ($unit == "N") {$dis = ($miles * 0.8684);}
                 else {$dis = $miles;}

                 $met = $dis * 1000;
                 $rey = number_format($met, 2, '.', '')." M)";
                 $NL = $odp->networkLocation;
                 $netloc = $netloc . " " . $NL . " (" . $rey . "; " ;

               }

             if ($netloc != $data->odp) //beda di update
             {
                     $updated = "Updated";
                     $data2 = array
                          (
                            'odp' => $netloc,
                            'update_date' => date('y-m-d'),
                            'times'=> date('h:i:s'),
                            'flag'=> $updated
                          );
              $this->Odppelanggan_model->update($data->id, $data2);
            }
       }

      else
            {
              $gada = "Tidak ada ODP";
              $updated = "Updated";
              $data2 = array
                  (
                    'odp' => $gada,
                    'update_date' => date('y-m-d'),
                    'times'=> date('h:i:s'),
                    'flag'=> $updated
                  );
             $this->Odppelanggan_model->update($data->id, $data2);
            }
        }
    }

    public function reset_flag()
    {
      set_time_limit(0);

      foreach ($this->Odppelanggan_model->get_all() as $data)
      {
          $gada = "Not Updated";
          $data2 = array
              (
                'flag' => $gada
              );
          $this->Odppelanggan_model->update($data->id, $data2);

      }

    }
    
public function ajax_update()
	{
		$this->_validate();
		$data = array(
                'nama_cust' => $this->input->post('nama_cust',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
		      'alamat' => $this->input->post('alamat',TRUE),
		      'latitude' => $this->input->post('latitude',TRUE),
		      'longitude' => $this->input->post('longitude',TRUE),
            'odp' => $this->input->post('odp',TRUE), 
			);
		$this->dashboard->update1(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
    
    public function ajax_edit($id)
	{
		$data = $this->dashboard->get_by_id($id);
//		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
}

