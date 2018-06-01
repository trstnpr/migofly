<?php

	class Page extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
            $this->load->library('travelpayouts');
            $this->load->helper('travelpayouts');
            $this->load->model('Page_model');
            $this->load->model('Configuration_model');
            $this->load->helper('travelpayouts_helper');
            $this->load->library('travelpayouts');
        }

		public function slug() {

			$slug = $this->uri->segment(1, 0);

			$res_page = $this->Page_model->get_page($slug);

			if($res_page) {

				$data['page'] = $res_page[0];

				$layout = $data['page']->layout;

				// META
				$data['title'] = $data['page']->title.' | '.the_config('site_name');
				$data['meta_title'] = $data['title'];
				$data['meta_keyword'] = $data['page']->meta_keyword;
				$data['meta_description'] = $data['page']->meta_description;
				
				$this->load->view('templates/header', $data);
				if($slug == 'contact-us') {
					$this->load->view('pages/contact-us', $data);
				} else {
					$this->load->view('pages/'.$layout, $data);
				}
				$this->load->view('templates/footer'); 

			} else {
				show_404();
			}
			
		}
		
	}