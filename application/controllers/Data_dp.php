<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_dp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_dp_model');
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
            $config['base_url'] = base_url() . 'data_dp/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_dp/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_dp/index.html';
            $config['first_url'] = base_url() . 'data_dp/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_dp_model->total_rows($q);
        $data_dp = $this->Data_dp_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_dp_data' => $data_dp,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->display('data_dp/data_dp_list', $data);
    }

    public function read($id)
    {
        $row = $this->Data_dp_model->get_by_id($id);
        if ($row)
        {
            $data = array
            (
        		'id' => $row->id,
        		'witel' => $row->witel,
        		'device_name' => $row->device_name,
        		'latitude' => $row->latitude,
        		'longitude' => $row->longitude,
    	    );
                $this->template->display('data_dp/data_dp_radius', $data);
        }

        else
        {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_dp'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_dp/create_action'),
	    'id' => set_value('id'),
	    'witel' => set_value('witel'),
	    //'kandatel' => set_value('kandatel'),
	    //'devicesto' => set_value('devicesto'),
	    'sto' => set_value('sto'),
	    //'device_id' => set_value('device_id'),
	    'device_name' => set_value('device_name'),
	    'latitude' => set_value('latitude'),
	    'longitude' => set_value('longitude'),
	);
        $this->load->view('data_dp/data_dp_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'witel' => $this->input->post('witel',TRUE),
		'sto' => $this->input->post('sto',TRUE),
		'device_name' => $this->input->post('device_name',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
	    );

            $this->Data_dp_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_dp'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_dp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_dp/update_action'),
		'id' => set_value('id', $row->id),
		'witel' => set_value('witel', $row->witel),
		'sto' => set_value('sto', $row->sto),
		'device_name' => set_value('device_name', $row->device_name),
		'latitude' => set_value('latitude', $row->latitude),
		'longitude' => set_value('longitude', $row->longitude),
        'odp' => set_value('odp', $row->odp),        
	    );
            $this->template->display('data_dp/data_dp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_dp'));
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
		'sto' => $this->input->post('sto',TRUE),
		'device_name' => $this->input->post('device_name',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
           'odp' => $this->input->post('odp',TRUE),     
	    );

            $this->Data_dp_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_dp'));
        }
    }



    public function delete($id)
    {
        $row = $this->Data_dp_model->get_by_id($id);

        if ($row) {
            $this->Data_dp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_dp'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_dp'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('witel', 'witel', 'trim|required');
	$this->form_validation->set_rules('sto', 'sto', 'trim|required');
	$this->form_validation->set_rules('device_name', 'device name', 'trim|required');
	$this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
	$this->form_validation->set_rules('longitude', 'longitude', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function excel()
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
    xlsWriteLabel($tablehead, $kolomhead++, "Witel");
    xlsWriteLabel($tablehead, $kolomhead++, "Sto");
    xlsWriteLabel($tablehead, $kolomhead++, "Device Name");
    xlsWriteLabel($tablehead, $kolomhead++, "Latitude");
    xlsWriteLabel($tablehead, $kolomhead++, "Longitude");
    xlsWriteLabel($tablehead, $kolomhead++, "ODP");

    foreach ($this->Data_dp_model->get_all() as $data) {
            $kolombody = 0;


            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->witel);
            xlsWriteLabel($tablebody, $kolombody++, $data->sto);
            xlsWriteLabel($tablebody, $kolombody++, $data->device_name);
            xlsWriteLabel($tablebody, $kolombody++, $data->latitude);
            xlsWriteLabel($tablebody, $kolombody++, $data->longitude);
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
    xlsWriteLabel($tablehead, $kolomhead++, "Witel");
    xlsWriteLabel($tablehead, $kolomhead++, "Sto");
    xlsWriteLabel($tablehead, $kolomhead++, "Device Name");
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
                      xlsWriteLabel($tablebody, $kolombody++, $data->witel);
                      xlsWriteLabel($tablebody, $kolombody++, $data->sto);
                      xlsWriteLabel($tablebody, $kolombody++, $data->device_name);
                      xlsWriteLabel($tablebody, $kolombody++, $data->latitude);
                      xlsWriteLabel($tablebody, $kolombody++, $data->longitude);
                      xlsWriteLabel($tablebody, $kolombody++, $key);

                          $tablebody++;
                          $nourut++;
                        }
                    }
            }

        xlsEOF();
        exit();
    }
            ///////////////////////////////////////////////////////////////
    public function updateODP(){

      set_time_limit(0);
      date_default_timezone_set( 'Asia/Makassar' );

      foreach ($this->Data_dp_model->get_some() as $data) {

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
                     $data = array
                          (
                            'odp' => $netloc,
                            'update_date' => date('y-m-d'),
                            'times'=> date('h:i:s'),
                            'flag'=> $updated
                          );
              $this->Data_dp_model->update($data->id, $data);
            
            }
       }

      else
            {
              $gada = "Tidak ada ODP";
              $updated = "Updated";
              $data = array
                  (
                    'odp' => $gada,
                    'update_date' => date('y-m-d'),
                    'times'=> date('h:i:s'),
                    'flag'=> $updated
                  );
             $this->Data_dp_model->update($data->id, $data);
               
            }
        }
    }

    public function reset_flag()
    {
      set_time_limit(0);

      foreach ($this->Data_dp_model->get_all() as $data)
      {
          $gada = "Not Updated";
          $data2 = array
              (
                'flag' => $gada
              );
          $this->Data_dp_model->update($data->id, $data2);

      }

    }

}

/* End of file Data_dp.php */
/* Location: ./application/controllers/Data_dp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-03-15 14:23:33 */
/* http://harviacode.com */
