<?php

	class Destination extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
            $this->load->model('Page_model');
			$this->load->model('Configuration_model');
            $this->load->model('Country_model');
            $this->load->model('Airline_model');
            $this->load->model('City_model');
            $this->load->helper('travelpayouts_helper');
            $this->load->library('travelpayouts');
            $this->load->library('pagination');

        }

        public function index() {

        	if(!$this->uri->segment(2, 0) or is_numeric($this->uri->segment(2, 0))) {

        		$this->_all_destinations();

        	} else {

        		if($this->uri->segment(2, 0) == 'search') {
        			$this->_search_destinations();
        		} else {
        			$this->_destination_calendar();
        		}

        	}

        }

        public function _all_destinations($page = 'destinations') {

            $offset = ($this->uri->segment(2, 0)) ? $this->uri->segment(2, 0) : 0;
            $limit = 10;

            $city_count = count($this->City_model->get_cities());
            $result = $this->City_model->get_paginated_city($offset, $limit);
            $data['cities'] = $result['data'];

            $config = array();
            $config['base_url'] = site_url('destination');
            $config['total_rows'] = $city_count;
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

            if(user_location()) {

                $data['origin'] = user_location();

                $data['title'] = $data['origin']->name.', '.$data['origin']->country_name.' to All Destinations | '.the_config('site_name');
                $data['meta_title'] = $data['title'];
                $data['meta_keyword'] = '';
                $data['meta_description'] = 'Travel from '.$data['origin']->name.', '.$data['origin']->country_name.' to any popular cities around the world.';

                $this->load->view('templates/header', $data);
                $this->load->view('pages/'.$page, $data);
                $this->load->view('templates/footer');

            } else {

                // Redirect error view
                $this->load->view('errors/custom/error');

            }

        }

        public function _destination_calendar($page = 'calendar') {
            
            if($city = $this->City_model->get_city_from_code($this->uri->segment(2, 0))) {

                if($this->uri->segment(3, 0)) {

                    $this->_month_tickets();

                } else { 

                    if(user_location()) {
                        $origin = user_location();
                        if($city_data = $this->City_model->get_city_from_code($origin->iata)) {
                            $data['origin'] = $city_data[0];
                        } else {
                            $data['origin'] = $this->City_model->get_city_from_code('MNL')[0]; // default manila
                        }
                        $data['city'] = $city[0];

                        $data['title'] = 'Travel from '.$origin->name.', '.$origin->country_name.' to '.$data['city']->name.', '.country_name($data['city']->country).' | '.the_config('site_name');
                        $data['meta_title'] = $data['title'];
                        $data['meta_keyword'] = '';
                        $data['meta_description'] = 'The best month to puchase your tickets for '.$origin->name.', '.$origin->country_name.' going to '.$data['city']->name.', '.country_name($data['city']->country);

                        $this->load->view('templates/header', $data);
                        $this->load->view('pages/'.$page, $data);
                        $this->load->view('templates/footer');

                    } else {

                        $this->load->view('errors/custom/error');

                    }

                }

            } else {

                show_404();

            }

        }

        public function _month_tickets($page = 'tickets') {

            if(user_location()) {
                $date = date_yyyy_mm($this->uri->segment(3, 0));
                $city = $this->City_model->get_city_from_code($this->uri->segment(2, 0));
                $data['city'] = $city[0];
                $data['month'] = date_month($date);
                // $data['origin'] = user_location();
                $origin = user_location();
                if($city_data = $this->City_model->get_city_from_code($origin->iata)) {
                    $data['origin'] = $city_data[0];
                } else {
                    $data['origin'] = $this->City_model->get_city_from_code('MNL')[0]; // default manila
                }

                $data['params'] = array(
                    'origin' => $data['origin']->code,
                    'destination' => $data['city']->code,
                    'depart_date' => $date,
                    'return_date' => $date
                );
                $data['tickets'] = ($tickets = cheapest_tickets($data['params'])) ? $tickets->data : NULL;
                $data['dest_code'] = $data['city']->code;  

                if($data['tickets'] != NULL and isset($data['tickets']->$data['dest_code'])) {
                    $flights = array();
                    foreach($data['tickets']->$data['dest_code'] as $flight) {
                        $flights[] = airline($flight->airline)->name.'(Flight '.$flight->flight_number.')';
                    }
                    $results = join(', ', $flights);
                } else {

                    $results = 'No Results found.';
                }

                   
                $data['title'] = 'Available tickets for '.$origin->name.', '.$origin->country_name.' to '.$data['city']->name.', '.country_name($data['city']->country).' as of '.$data['month'].' '.date('Y').' | '.the_config('site_name');
                $data['meta_title'] = $data['title'];
                $data['meta_keyword'] = '';
                $data['meta_description'] = 'Tickets for '.$origin->name.', '.country_city_code($origin->iata).' to '.$data['city']->name.', '.$data['city']->country.' for the month of '.$data['month'].' '.date('Y').' - '.$results;

                $this->load->view('templates/header', $data);
                $this->load->view('pages/'.$page, $data);
                $this->load->view('templates/footer');

            } else {

                // Redirect error view
                $this->load->view('errors/custom/error');

            }

        }

        public function _search_destinations($page = 'destination-search') {

            if(user_location()) {

                if($keyword = $this->input->get('keyword')) {

                    $offset = ($this->uri->segment(3, 0)) ? $this->uri->segment(3, 0) : 0;
                    $limit = 10;

                    $data['count'] = $this->City_model->search_count($keyword);
                    $result = $this->City_model->search_paginated($keyword, $offset, $limit);
                    $data['cities'] = $result['data'];

                    $config = array();
                    $config['base_url'] = site_url('destination/search');
                    $config['total_rows'] = $data['count'];
                    $config['per_page'] = $limit;
                    $config['uri_segment'] = 3;
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

                    $data['user'] = user_location();

                    $data['title'] = 'Search for "'.$keyword.'" - '.$data['count'].' Result(s) | '.the_config('site_name');
                    $data['meta_title'] = $data['title'];
                    $data['meta_keyword'] = '';
                    $data['meta_description'] = '';

                    $this->load->view('templates/header', $data);
                    $this->load->view('pages/'.$page, $data);
                    $this->load->view('templates/footer');

                } else {
                    redirect(base_url('destination'));
                }

            } else {

                // Redirect error view
                $this->load->view('errors/custom/error');

            }

        }

	}