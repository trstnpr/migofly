<?php
	
	function user_location() {
		$app =& get_instance();

		try {
			// $response = $app->travelpayouts->user_location();
			$response = curl_user_location();

			if(isset($response['status']) and $response['status'] == 200) {

				return $response['body'];

			} else {
				return FALSE;
			}

		} catch (\Exception $e) {
	    	return FALSE;
	    }

	}
	

	function cheapest_tickets($data) {
		$app =& get_instance();

		try {
			// $response = $app->travelpayouts->cheapest_tickets($data);
			$response = curl_cheapest_tickets($data);

			if(isset($response['status']) and $response['status'] == 200) {
				return $response['body'];
			} else {
				return FALSE;
			}
		} catch(\Exception $e) {
			return FALSE;
		}

	}

	function airline($code) {
		$app =& get_instance();
		$app->load->model('Airline_model');
		
		$data = $app->Airline_model->get_airline_from_iata($code);

    	if($data) {
    		return $data[0];
    	} else {
    		return FALSE;
    	}

	}

	function airline_logo($code, $height=null, $width=null) {
		$endpoint = 'https://pics.avs.io/';
		$h = (isset($height)) ? $height : '500';
		$w = (isset($width)) ? $width : '1000'; 
		$logo = $endpoint.$h.'/'.$w.'/'.$code.'@2x.png';
		return $logo;
	}
	function countries() {
		$app =& get_instance();
		$app->load->model('Country_model');
		$data = $app->Country_model->get_countries();
		return $data;
	}
	function cities_of_country($code) {
		$app =& get_instance();
		$app->load->model('City_model');
		$data = $app->City_model->get_cities_from_country_code($code);
		if($data) {
    		return $data;
    	} else {
    		return FALSE;
    	}
	}

	function flight_search_url($data, $passenger = null) {

		$endpoint = 'https://www.migofly.com/flights/';

		$depart = date('dm', strtotime($data['depart_date']));
		$return = date('dm', strtotime($data['return_date']));

		$origin = strtoupper($data['origin'].$depart);
		$destination = strtoupper($data['destination'].$return);
		$pax = (isset($passenger) and is_numeric($passenger)) ? $passenger: 1;

		$surl = $endpoint.$origin.$destination.$pax;

		return $surl;

	}

	// CURL
	function curl_user_location() {
		$app =& get_instance();
		$app->load->library('user_agent');

		$endpoint = 'http://www.travelpayouts.com/whereami?';
		$locale = 'locale=en';
		$callback = 'callback=useriata';
		$ip = 'ip='.$app->input->ip_address();

		$user_agent = $app->agent->agent;

		// $request_url = $endpoint.$locale.'&'.$callback.'&'.$ip;
		$request_url = $endpoint.$locale.'&'.$ip;

		$ch = curl_init($request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_USERAGENT, $user_agent);
		$result = curl_exec($ch);
		curl_close($ch);

		if($result !== FALSE) {
			$response = array(
	        	'status' => 200,
	        	'body' => json_decode($result)
	        );
		} else {
			$response = array(
	        	'status' => 500,
	        	'body' => json_decode($result)
	        );
		}

		return $response;
	}
	function curl_cheapest_tickets($data) {
		$app =& get_instance();
		$app->load->library('user_agent');

		$user_agent = $app->agent->agent;
		$endpoint = 'http://api.travelpayouts.com/v1/prices/cheap?';
		$params = array(
			'currency' => (isset($data['currency'])) ? $data['currency'] : 'usd',
			'origin' => $data['origin'],
			'destination' => $data['destination'],
			'depart_date' => $data['depart_date'],
			'return_date' => $data['return_date'],
			'page' => (isset($data['page'])) ? $data['page'] : '',
			'token' => 'c61c53d4133461b3288bc1a6c2cffc11'
		);

		$request_url = $endpoint.'currency='.$params['currency'].'&origin='.$params['origin'].'&destination='.$data['destination'].'&depart_date='.$data['depart_date'].'&return_date='.$params['return_date'].'&token='.$params['token'];


		$ch = curl_init($request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_USERAGENT, $user_agent);
		$result = curl_exec($ch);
		curl_close($ch);

		if($result !== FALSE) {
			$response = array(
	        	'status' => 200,
	        	'body' => json_decode($result)
	        );
		} else {
			$response = array(
	        	'status' => 500,
	        	'body' => json_decode($result)
	        );
		}

		return $response;

	}
	// .CURL