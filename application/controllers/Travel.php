<?php

	class Travel extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
            $this->load->model('Configuration_model');
            $this->load->library('travelpayouts');
            $this->load->helper('travelpayouts_helper');

        }

        public function api() {
			// cheapest_tickets
			// nonstop_tickets
			// flight_price_trends
			$params = array(
				'currency' => 'usd',
				'origin' => 'LED',
				'destination' => 'HKT',
				'depart_date' => date('Y-m'),
				'return_date' => '2018-02',
			);

			dump($this->travelpayouts->airports($params));

		}

		// All Airlines
		public function airlines() {

			dump($this->travelpayouts->airlines());

		}

		// All Airplanes
		public function airplanes() {

			dump($this->travelpayouts->airplanes());
			
		}

		// All Airports
		public function airports() {

			dump($this->travelpayouts->airports());
			
		}

		public function location() {

			dump(user_location('iata'));

		}

		public function city() {

			dump($this->travelpayouts->cities());

		}

	}