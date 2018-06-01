<?php
	class Airline extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            $this->load->helper('general');
            $this->load->model('Configuration_model');
            $this->load->model('Airline_model');
            $this->load->model('Page_model');
            $this->load->library('travelpayouts');
            $this->load->helper('travelpayouts');
            $this->load->library('pagination');
        }

		public function index() {
			if($this->uri->segment(2,0)) {
				if(is_numeric($this->uri->segment(2,0))) {
					$this->_all_airlines();
				} else {
					$this->_single_airline();
				}
			} else {
				$this->_all_airlines();
			}
		}

		public function _all_airlines($page = 'airlines') {
			
			$offset = ($this->uri->segment(2, 0)) ? $this->uri->segment(2, 0) : 0;
            $limit = 10;
            $airline_count = count($this->Airline_model->get_airlines());
            $result = $this->Airline_model->get_airlines_paginate($limit, $offset);
            $data['airlines'] = $result['data'];

            $config['base_url'] = site_url('airline');
            $config['total_rows'] = $airline_count;
            $config['per_page'] = $limit;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 1;
            $config['full_tag_open'] = '<nav><ul class="pager">';
            $config['prev_tag_open'] = '<li>';
            $config['prev_link'] = '&laquo;';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#"><strong>';
            $config['cur_tag_close'] = '</strong></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_link'] = '&raquo;';
            $config['next_tag_close'] = '</li>';                
            $config['full_tag_close'] = '</ul></nav>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

			$data['title'] = 'All Airlines | '.the_config('site_name');
            $data['meta_title'] = $data['title'];
            $data['meta_keyword'] = '';
            $data['meta_description'] = $data['title'];

			$this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
		}

		public function _single_airline($page = 'airline') {
			$segment = $this->uri->segment(2,0);
			if($airline = $this->Airline_model->get_airline_from_slug($segment)) {
				$data['airline'] = $airline[0];

				$data['title'] = $data['airline']->name.' | '.the_config('site_name');
	            $data['meta_title'] = $data['title'];
	            $data['meta_keyword'] = '';
	            $data['meta_description'] = $data['title'];

				$this->load->view('templates/header', $data);
	            $this->load->view('pages/'.$page, $data);
	            $this->load->view('templates/footer');
			} else {
				show_404();
			}
		}

	}