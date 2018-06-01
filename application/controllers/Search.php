 <?php

	class Search extends CI_Controller {

		public function __construct()
        {
                parent::__construct();
                
                $this->load->helper('general');
				$this->load->model('State_model');
				$this->load->model('City_model');
				$this->load->model('Configuration_model');
        }

		public function index($page = 'search') {

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			} else {

				$data['location'] = $this->input->get('location');

				$data['title'] = 'Search Results for \''.$data['location'].'\' - '.the_config('site_name');
				$data['term'] = 'locksmith';

				$popular_cities = $this->City_model->get_popular_city();
				if($popular_cities != 0) {
					$data['popular_city'] = array('result' => 'success', 'message' => 'Has Popular City', 'data' => $popular_cities);
				} else {
					$data['popular_city'] = array('result' => 'error', 'message' => 'No Popular City');
				}

				if(!empty($data['location']) AND isset($data['location'])) {

					$data['meta_title'] = $data['title'];
					$data['meta_keyword'] = '24 Hour Emergency Locksmith, Residential Locksmith Service, Commercial Locksmith Service, Automotive Locksmith Service, Emergency Locksmith Service, Industrial Locksmith Service';
					$data['meta_description'] = '';

					// $srch_chars = preg_replace('/[^0-9a-zA-Z_\s]/', '', $data['location']);
					// $slug = preg_replace('/ +/', '-', $srch_chars);
					$slug = preg_replace('~[^\\pL\d]+~u', '-', $data['location']);


					$search_proper = $this->City_model->get_city_from_slug($slug);

					if($search_proper != 0) {
						$search_data = $search_proper[0];
						$data['search_data'] = $search_proper[0];
						// header('Location: '.base_url('city/'.$data['search_data']->slug));
						$data['redirect'] = base_url('city/'.$data['search_data']->slug);
						echo'<script>window.location.href = "'.$data['redirect'].'";</script>';

					} else if(is_numeric($data['location']) AND strlen($data['location']) == 5) { // Validate if numeric & zip format

						$search_zip = $this->City_model->search_zip($data['location']);

						if($search_zip != 0) {
							$data['search_data'] = $search_zip;
							$data['redirect'] = base_url('zip/'.$data['location']);
							echo'<script>window.location.href = "'.$data['redirect'].'";</script>';
						} else {
							$data['search_data'] = NULL;

							$this->load->view('templates/header', $data);
							$this->load->view('pages/'.$page, $data);
							$this->load->view('templates/footer');
						}

					} else {
						$search_free = $this->City_model->search_city($data['location']);

						if($search_free != 0) {
							
							$data['search_data'] = $search_free;

						} else {
							
							$data['search_data'] = NULL;

						}

						$this->load->view('templates/header', $data);
						$this->load->view('pages/'.$page, $data);
						$this->load->view('templates/footer');
					}

				} else {
					show_404();
				}
			}
		}

		public function suggest() {

			$city_data = $this->City_model->get_cities();

			$result = array();

			foreach($city_data as $city) {

				$result[] = $city->name.', '.strtoupper($city->state);
				
				// $zips = preg_split('/,([\s])+/', $city->zip_code);
				// foreach ($zips as $zip) {
				// 	$result[] = $city->name.', '.strtoupper($city->state).' '.$zip;
				// }

			}

			$json_data = json_encode($result);

			print_r($json_data);

		}

		public function validate() {

			$request = $this->input->get('location');

			if(isset($request) AND !empty($request)) {

				$key_data = explode(', ', $request);

				$vald_city = (isset($key_data[0])) ? $key_data[0] : NULL ;
				$vald_state = (isset($key_data[1])) ? $key_data[1] : NULL ;

				if($vald_city != NULL AND $vald_state != NULL) {
					$res_city = $this->City_model->search_city_from_name_state($vald_city, $vald_state);
					if($res_city != 0) {
						$response = json_encode(array('result' => 'success', 'message' => 'Data Exist'));
					} else {
						$response = json_encode(array('result' => 'error', 'message' => 'No results for "'.$request.'"'));
					}
				} else {
					$response = json_encode(array('result' => 'error', 'message' => 'No results for "'.$request.'"'));
				}


				echo $response;

			} else {
				show_404();
			}
		}

	}