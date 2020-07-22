<?php 
if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Map extends CI_Controller {
    
     function __construct()
  {
    parent::__construct();
    $this->load->library('googlemaps');
    // Load our model
    $this->load->model('map_model');
  }
    function index()
    {
    // Load the library
    // Initialize the map, passing through any parameters

    $config['center'] = '-1.21794755, 116.8551307';
        // $config['map_name'] = 'map_one';
        // $config['map_div_id'] = 'map_canvas_one';
        $circle['center'] = '-1.21794755, 116.8551307';
        $circle['radius'] = '500';
        $config['zoom'] = '17';
        $config['map_name'] = 'map_one';
        $config['map_div_id'] = 'map_canvas_one';
        
        $this->googlemaps->initialize($config);
        $this->googlemaps->add_circle($circle);

        $tabelodp = $this->map_model->get_coordinates();
        $tabelpelanggan = $this->map_model->get_coordinates2();
        

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

        // Create the map
        $data['map_one'] = $this->googlemaps->create_map();

        // Map Two
        $config['center'] = '-0.04752606,109.36420262';
        $circle['center'] = '-0.04752606,109.36420262';
        $circle['radius'] = '1500';
        $config['zoom'] = '17';
        $config['map_name'] = 'map_two';
        $config['map_div_id'] = 'map_canvas_two';
        
        
        $this->googlemaps->initialize($config);
        $this->googlemaps->add_circle($circle);

        foreach ($tabelpelanggan as $coordinate) {
        $marker = array();
        $marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
        $marker['infowindow_content'] = '<h4 class="media-heading">'.$coordinate->id.'. '.$coordinate->nama_cust.'</h4> <h5>'.$coordinate->no_hp.'</h5> <p>'.$coordinate->alamat.'</p> ';
        $marker['icon'] = base_url("public/icon/house.png");
        $this->googlemaps->add_marker($marker);
        }

        
//         foreach ($get->odp as $odp) {
//         $marker = array();
//         $marker['position'] = $odp->latitude.','.$odp->longitude;
//         $marker['icon'] = base_url("public/icon/odp.png");
//         $this->googlemaps->add_marker($marker);

// }
        // Create the map
        $data['map_two'] = $this->googlemaps->create_map();
    $this->load->view('welcome_message', $data);
    }

}