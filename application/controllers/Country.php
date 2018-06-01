<?php

	class Country extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
            $this->load->model('Page_model');
			$this->load->model('Configuration_model');
            $this->load->model('Country_model');
            $this->load->helper('travelpayouts_helper');
            $this->load->library('travelpayouts');
            $this->load->library('pagination');

        }

        public function index($page = 'countries') {

        	if(!$this->uri->segment(2, 0) or is_numeric($this->uri->segment(2, 0))) {
        		$this->_all_countries();
        	} else {

        		if($this->uri->segment(2, 0) == 'test') {
        			$this->test();
        		} else if($this->uri->segment(2, 0) == 'test2') {
        			$this->test2();
        		} else if($this->uri->segment(2, 0) == 'test3') {
        			$this->test3();
        		} else {
        			$this->_single_country();
        		}

        	}

        }

        public function _all_countries($page = 'countries') {

        	$offset = ($this->uri->segment(2, 0)) ? $this->uri->segment(2, 0) : 0;
        	$limit = 33;

        	$country_count = count($this->Country_model->get_countries());
        	$result = $this->Country_model->get_paginated_country($offset, $limit);
        	$data['countries'] = $result['data'];

        	$config = array();
        	$config['base_url'] = site_url('country');
	        $config['total_rows'] = $country_count;
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

        	$data['title'] = 'All Countries | '.the_config('site_name');
			$data['meta_title'] = $data['title'];
			$data['meta_keyword'] = '';
			$data['meta_description'] = $data['title'];

        	$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');

        }

        public function _single_country($page = 'country') {

        	if($this->Country_model->get_country_from_slug($this->uri->segment(2, 0))) {

        		if($this->uri->segment(3, 0)) {
                    if($this->uri->segment(3, 0) == 'city') {
                        $this->_country_cities();
                    } else {
                        $this->load->view('errors/custom/error');
                    }

        		} else {
	        		$country = $this->Country_model->get_country_from_slug($this->uri->segment(2, 0));

		        	$data['country'] = $country[0];

		        	$data['title'] = $data['country']->name.' | '.the_config('site_name');
					$data['meta_title'] = $data['title'];
					$data['meta_keyword'] = '';
					$data['meta_description'] = truncate($data['country']->background, 200);

		        	$this->load->view('templates/header', $data);
					$this->load->view('pages/'.$page, $data);
					$this->load->view('templates/footer');
				}

			} else {
				show_404();
			}
        }

        public function _country_cities($page = 'cities') {
        	$data['code'] = $this->uri->segment(2, 0);
        	$offset = $this->uri->segment(4, 0);
            $limit = 10;
            
            $count = count(cities_of_country($data['code']));
            $result = $this->City_model->get_cities_from_country_code_paginate($limit, $offset, $data['code']);
            $data['cities'] = $result['data'];
            
            $config['base_url'] = site_url('country/'.$data['code'].'/city');
            $config['total_rows'] = $count;
            $config['per_page'] = $limit;
            $config['uri_segment'] = 4;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string']=TRUE;
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

            if(user_location()) {

            	$data['origin'] = user_location();

	            $data['title'] = country_name($data['code']).' Cities | '.the_config('site_name');
				$data['meta_title'] = $data['title'];
				$data['meta_keyword'] = '';
				$data['meta_description'] = $data['title'];

	        	$this->load->view('templates/header', $data);
				$this->load->view('pages/'.$page, $data);
				$this->load->view('templates/footer');

			} else {

				$this->load->view('errors/custom/error');

			}

        }

        public function test($page = 'test') {

        	if($this->input->get()) {

        		$data['request_params'] = array(
	        		'currency' => 'usd',
					'origin' => strtoupper($this->input->get('origin')),
					'destination' => strtoupper($this->input->get('destination')),
					'depart_date' => date_yyyy_mm($this->input->get('depart_date')),
					'return_date' => date_yyyy_mm($this->input->get('return_date'))
	        	);

	        	$data['data'] = cheapest_tickets($data['request_params']);

	        	$from_dest = city($data['request_params']['origin']);
	        	$to_dest = city($data['request_params']['destination']);
	        	$data['label'] = $from_dest->name.' - '.$to_dest->name;

        	} else {

	        	$data['data'] = NULL;

	        }

	        $this->load->view($page.'/'.$page, $data);

        }

        public function test2() {

        	// dump(user_location());
            $this->load->view('errors/custom/error');

        }


	}