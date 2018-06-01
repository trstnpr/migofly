<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Travelpayouts {

		public function __construct() {

			// API Credentials
			$this->api = array(
				'endpoint' => 'http://api.travelpayouts.com/',
				'token' => 'c61c53d4133461b3288bc1a6c2cffc11',
				'marker' => '153002'
			);

			// Api init
			$this->client = new \GuzzleHttp\Client([
	            'base_uri' => $this->api['endpoint'],
	            'http_errors' => false,
	            'headers' => [
				    'Authorization' => 'token' . $this->api['token'],
				    'Content-Type' => 'application/json',
				    'Accept' => 'application/json',
				]
	        ]);

		}

		// FLIGHt PRICE HISTORY
		// https://support.travelpayouts.com/hc/en-us/articles/203956163#the_prices_for_the_airline_tickets
		public function flight_price_history($data) {

			$endpoint = 'v2/prices/latest';
			$params = array(
				'currency' => $data['currency'],
				'period_type' => $data['period_type'],
				'page' => $data['page'],
				'limit' => $data['limit'],
				'show_to_affiliates' => $data['show_to_affiliates'],
				'sorting' => $data['sorting'],
				'trip_class' => $data['trip_class'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// The calendar of prices for a month
		// https://support.travelpayouts.com/hc/en-us/articles/203956163#the_calendar_of_prices_for_a_month
		public function calendar_month_price($data) {

			$endpoint = 'v2/prices/latest';
			$params = array(
				'currency' => $data['currency'],
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'show_to_affiliates' => $data['show_to_affiliates'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// The prices for the alternative directions
		// https://support.travelpayouts.com/hc/en-us/articles/203956163#the_prices_for_the_alternative_directions
		public function alternative_direction_price($data) {

			$endpoint = 'v2/prices/nearest-places-matrix';
			$params = array(
				'currency' => $data['currency'],
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'show_to_affiliates' => $data['show_to_affiliates'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Cheapest tickets
		// https://support.travelpayouts.com/hc/en-us/articles/203956163#cheapest_tickets
		public function cheapest_tickets($data) {

			$endpoint = 'v1/prices/cheap';
			$params = array(
				'currency' => (isset($data['currency'])) ? $data['currency'] : 'usd',
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'depart_date' => $data['depart_date'],
				'return_date' => $data['return_date'],
				'page' => (isset($data['page'])) ? $data['page'] : '',
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Cheapest tichets grouped by month
		// https://support.travelpayouts.com/hc/en-us/articles/203956163#cheapest_tickets_grouped_month
		public function cheapest_tickets_group_month($data) {

			$endpoint = 'v1/prices/monthly';
			$params = array(
				'currency' => $data['currency'],
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Non-stop tickets
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#non_stop_tickets
		public function nonstop_tickets($data) {

			$endpoint = 'v1/prices/direct';
			$params = array(
				'currency' => $data['currency'],
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'depart_date' => $data['depart_date'],
				'return_date' => $data['return_date'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Flight price trends
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#tickets_for_each_day_of_month
		public function flight_price_trends($data) {

			$endpoint = 'v1/prices/calendar';
			$params = array(
				'currency' => $data['currency'],
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'depart_date' => $data['depart_date'],
				'return_date' => $data['return_date'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Popular airline routes
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#popular_airline_routes
		public function popular_airline_routes($data) {

			$endpoint = 'v1/airline-directions';
			$params = array(
				'currency' => $data['currency'],
				'airline_code' => $data['airline_code'],
				'limit' => $data['limit'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// The calendar of prices for a week
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#the_calendar_of_prices_for_a_week
		public function calendar_week_price($data) {

			$endpoint = 'v2/prices/week-matrix';
			$params = array(
				'currency' => (isset($data['currency'])) ? $data['currency'] : 'usd',
				'origin' => $data['origin'],
				'destination' => $data['destination'],
				'show_to_affiliates' => $data['show_to_affiliates'],
				'depart_date' => $data['depart_date'],
				'return_date' => $data['return_date'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// The popular destinations
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#the_popular_directions_from_a_city
		// http://api.travelpayouts.com/v1/city-directions?origin=MOW&currency=usd&token=PutHereYourToken
		public function popular_destination($data) {

			$endpoint = 'v1/city-directions';
			$params = array(
				'currency' => $data['currency'],
				'origin' => $data['origin'],
				'token' => $this->api['token']
			);

			$request = $this->client->request('GET', $endpoint, [
				'query' => $params
			]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Data of countries in json format
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#data_of_countries
		public function countries() {

			$endpoint = 'data/countries.json';
	        $request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );


	        return $response;

		}

		// City data in json format
		public function cities() {

			$endpoint = 'data/cities.json';
	        $request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Airport data in json format
		public function airports() {

			$endpoint = 'data/airports.json';
	        $request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Airline data in json format
		public function airlines() {

			$endpoint = 'data/airlines.json';
			$request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Alliance data in json format
		public function airlines_alliances() {

			$endpoint = 'data/airlines_alliances.json';
			$request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Airplane data in json format
		public function airplanes() {

			$endpoint = 'data/planes.json';
			$request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// Data on the routes in json format
		public function routes() {

			$endpoint = 'data/routes.json';
			$request = $this->client->request('GET', $endpoint);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}

		// The definition of a user's location by IP address
		// https://support.travelpayouts.com/hc/en-us/articles/203956163-Travel-insights-with-Travelpayouts-Data-API#the_definition_of_a_user_location_by_ip_address
		public function user_location() {

			$app =& get_instance();
			$client = new \GuzzleHttp\Client();

			$endpoint = 'https://www.travelpayouts.com/whereami';
			$params = array(
				'locale' => 'en',
				// 'callback' => 'useriata',
				'ip' => $app->input->ip_address()
			);

	        $request = $client->request('GET', $endpoint, [
	        	'http_errors' => false,
	        	'headers' => [
				    'Content-Type' => 'application/json',
				    'Accept' => 'application/json'
				],
				'query' => $params
	        ]);

	        $response = array(
	        	'status' => $request->getStatusCode(),
	        	'body' => json_decode($request->getBody())
	        );

	        return $response;

		}


	}