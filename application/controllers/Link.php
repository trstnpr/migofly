<?php

	class Link extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
			$this->load->model('Country_model');
			$this->load->model('City_model');
			$this->load->model('Airline_model');
        }

        public function index() {
        	if($this->uri->segment(2,0)) {
        		$segment = $this->uri->segment(2,0);
        		if($segment == 'airlines') {
        			$this->_airlines();
        		} else if($segment == 'country') {
        			$this->_country();
        		} else if($segment == 'city_root') {
        			$this->_country_city_root();
        		} else if($segment == 'cities') {
        			$this->_cities();
        		} else if($segment == 'destination') {
        			$this->_destination();
        		} else if($segment == 'calendar') {
        			$this->_calendar();
        		} else if($segment == 'city_ticket') {
        			$this->_city_tickets();
        		} else if($segment == 'country_cities') {
        			$this->_country_cities();
        		} else if($segment == 'city_to_city') {
        			$this->_city_to_city();
        		} else {
        			show_404();
        		}
        	} else {
        		show_404();
        	}
        }

        public function _airlines() {
			$url = 'http://travel.migofly.com/airline/';
			$airlines = $this->Airline_model->get_airlines();
			foreach($airlines as $airline) {
				echo $url.strtolower($airline->slug).'<br/>';
			}
		}

        public function _country() {
			$url = 'http://travel.migofly.com/country/';
			$countries = $this->Country_model->get_countries();

			foreach($countries as $country) {
				echo $url.strtolower($country->code).'<br/>';
			}

		}

		public function _country_city_root() {
			$url = 'http://travel.migofly.com/city/';
			$countries = $this->Country_model->get_countries();

			foreach($countries as $country) {
				echo $url.strtolower($country->code).'<br/>';
			}
		}

		// Origin
		public function _cities() {
			$url = 'http://travel.migofly.com/city/';
			$cities = $this->City_model->get_cities();
			foreach($cities as $city) {
				echo $url.strtolower($city->code).'<br/>';
			}
		}

		public function _destination() {
			$url = 'http://travel.migofly.com/destination/';
			$cities = $this->City_model->get_cities();
			foreach($cities as $city) {
				echo $url.strtolower($city->code).'<br/>';
			}
		}

		public function _calendar() {
			$url = 'http://travel.migofly.com/destination/';
			$cities = $this->City_model->get_cities();
			foreach($cities as $city) {
				$city_destination = $url.strtolower($city->code).'/';
				for($x=1;$x<=12;$x++) {
					$date = date_yyyy_mm(date('Y').'-'.$x);
					echo $city_destination.$date.'<br/>';
				}				
			}
		}
		public function _country_cities() {
			$url = 'http://travel.migofly.com/country/';
			$countries = $this->Country_model->get_countries();

			foreach($countries as $country) {
				echo $url.strtolower($country->code).'/city'.'<br/>';
			}
		}

		public function _city_to_city() {
			$offset = $this->uri->segment(3,0);
			$url = 'http://travel.migofly.com/city/';
			$cities_from = $this->City_model->get_cities();
			$cities_to = $this->City_model->get_cities_limited(10, $offset);
			foreach($cities_from as $city_from) {
				$from = $url.strtolower($city_from->code).'/';
				foreach($cities_to as $city_to) {
					$to = $from.strtolower($city_to->code).'<br/>';
					echo $to;
				}				
			}
		}

		public function _city_tickets() {
			$offset = $this->uri->segment(3,0);
			$url = 'http://travel.migofly.com/city/';
			$cities_from = $this->City_model->get_cities();
			$cities_to = $this->City_model->get_cities_limited(5, $offset);
			foreach($cities_from as $city_from) {
				$from = $url.strtolower($city_from->code).'/';
				foreach($cities_to as $city_to) {
					$to = $from.strtolower($city_to->code).'/';
					for($x=1;$x<=12;$x++) {
						$date = date_yyyy_mm(date('Y').'-'.$x);
						echo $to.$date.'<br/>';
					}
				}				
			}
		}

	}