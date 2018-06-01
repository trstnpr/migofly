<?php

	class City extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
            $this->load->model('Page_model');
			$this->load->model('Configuration_model');
            $this->load->model('Country_model');
            $this->load->model('City_model');
            $this->load->helper('travelpayouts_helper');
            $this->load->library('travelpayouts');
            $this->load->library('pagination');

        }

        public function index() {
        	if($this->uri->segment(2, 0)) {
                $segment = $this->uri->segment(2, 0);
                if(strlen($segment) == 2) {
                    if($this->Country_model->get_country_from_code(strtoupper($segment))) {
                        $this->_all_cities_from_country();
                    } else {
                        $this->load->view('errors/custom/error');
                    }
                } else {
                    if($this->City_model->get_city_from_code($segment)) {
                        $this->_country_city();
                    } else {
                        $this->load->view('errors/custom/error');
                    }
                }
        	} else {
                $this->load->view('errors/custom/error');
        	}
        }

        public function _all_cities_from_country($page = 'country_cities') {
            $country_data = $this->Country_model->get_country_from_code(strtoupper($this->uri->segment(2, 0)))[0];
            $offset = $this->uri->segment(3, 0);
            $limit = 10;
            $count = count(cities_of_country($country_data->code));
            $result = $this->City_model->get_cities_from_country_code_paginate($limit, $offset, $country_data->code);
            $data['cities'] = $result['data'];
            
            $config['base_url'] = site_url('city/'.strtolower($country_data->code));
            $config['total_rows'] = $count;
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

            $data['country'] = $country_data;

            $data['title'] = $country_data->name.' to popular destinations | '.the_config('site_name');
            $data['meta_title'] = $data['title'];
            $data['meta_keyword'] = '';
            $data['meta_description'] = 'Travel from any point in '.$country_data->name.' to popular destinations.';

            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');

        }

        public function _country_city() {
            if($this->uri->segment(3,0)) {
                if(is_numeric($this->uri->segment(3))) {
                    $this->_origin_city();
                } else {
                    $this->_destination_city();
                }
                
            } else {
                $this->_origin_city();
            }
        }

        public function _origin_city($page = 'country_city') {
            $city_data = $this->City_model->get_city_from_code($this->uri->segment(2, 0))[0];
            $offset = ($this->uri->segment(3, 0)) ? $this->uri->segment(3, 0) : 0;
            $limit = 10;
            $city_count = count($this->City_model->get_cities());
            $result = $this->City_model->get_paginated_city($offset, $limit);
            $data['cities'] = $result['data'];

            $config = array();
            $config['base_url'] = site_url('city/'.strtolower($city_data->code));
            $config['total_rows'] = $city_count;
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
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

            $data['origin'] = $city_data;

            $data['title'] = 'Book a flight '.$city_data->name.', '.country_name($city_data->country).' to All Destinations All Destinations | '.the_config('site_name');
            $data['meta_title'] = $data['title'];
            $data['meta_keyword'] = '';
            $data['meta_description'] = 'Buy a flight ticket from '.$city_data->name.', '.country_name($city_data->country).' to any popular destinations around the globe.';

            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

        public function _destination_city($page = 'calendar_city') {
            
            $segment = $this->uri->segment(3,0);
            if($destination = $this->City_model->get_city_from_code($segment)) {
                if($this->uri->segment(4,0)) {
                    $this->_month_ticket_city();
                } else {

                    $data['origin'] = $this->City_model->get_city_from_code($this->uri->segment(2, 0))[0];
                    $data['city'] = $destination[0];
                    $data['title'] = 'Buy ticket for '.$data['origin']->name.', '.country_name($data['origin']->country).' to '.$data['city']->name.', '.country_name($data['city']->country).' flight | '.the_config('site_name');
                    $data['meta_title'] = $data['title'];
                    $data['meta_keyword'] = '';
                    $data['meta_description'] = 'Great time to book a flight for '.$data['origin']->name.', '.country_name($data['origin']->country).' to '.$data['city']->name.', '.country_name($data['city']->country);

                    $this->load->view('templates/header', $data);
                    $this->load->view('pages/'.$page, $data);
                    $this->load->view('templates/footer');
                }

            } else {
                $this->load->view('errors/custom/error');
            }
        }

        public function _month_ticket_city($page = 'ticket_city') {
            $date = date_yyyy_mm($this->uri->segment(4, 0));
            $data['origin'] = $this->City_model->get_city_from_code(strtoupper($this->uri->segment(2, 0)))[0];
            $city = $this->City_model->get_city_from_code(strtoupper($this->uri->segment(3, 0)));
            $data['city'] = $city[0];
            $data['month'] = date_month($date);
            
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

            $data['title'] = 'Purchasable flight tickets for '.$data['origin']->name.', '.country_name($data['origin']->country).' to '.$data['city']->name.', '.country_name($data['city']->country).' as of '.$data['month'].' '.date('Y').' | '.the_config('site_name');
            $data['meta_title'] = $data['title'];
            $data['meta_keyword'] = '';
            $data['meta_description'] = 'Available tickets for '.$data['origin']->name.', '.$data['origin']->country.' to '.$data['city']->name.', '.$data['city']->country.' flight for '.$data['month'].' '.date('Y').' - '.$results;

            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

	}