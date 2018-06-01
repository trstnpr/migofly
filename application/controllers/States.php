<?php

	// class States extends CI_Controller {

	// 	public function __construct()
 //        {
 //                parent::__construct();
                
	// 			$this->load->model('State_model');
	// 			$this->load->model('City_model');
 //        }

	// 	public function index($page='states') {

	// 		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
	// 			show_404();
	// 		} else {

	// 			$data['title'] = 'Locksmiths by '.ucwords($page).' - '.SITE_TITLE;

	// 			$data['states'] = $this->State_model->get_states();
	// 			$data['location'] = 'United States';

	// 			// META
	// 			$data['meta_title'] = '24 Hour Locksmith Directory | '.SITE_TITLE;
	// 			$data['meta_keyword'] = '24 Hour Emergency Locksmith, Residential Locksmith Service, Commercial Locksmith Service, Automotive Locksmith Service, Emergency Locksmith Service, Industrial Locksmith Service';
	// 			$data['meta_description'] = 'We are a directory of 24 hour locksmith company servicing residential, commercial, automotive, industrial and emergency situation.';

	// 			$this->load->view('templates/header', $data);
	// 			$this->load->view('pages/'.$page, $data);
	// 			$this->load->view('templates/footer');

	// 		}
			
	// 	}



	// }