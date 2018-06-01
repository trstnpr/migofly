<?php

	class App extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('general');
            $this->load->model('Configuration_model');
            $this->load->library('travelpayouts');

        }

		public function index($page = 'home') {

			// redirect('https://www.migofly.com');
			$data['title'] = the_config('site_name');
            $data['meta_title'] = $data['title'];
            $data['meta_keyword'] = '';
            $data['meta_description'] = '';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/footer');

		}

		public function contactProcess() {

			$mdata = $this->input->post();
			$gr_data = gr_keys();
			$site_key = $gr_data['site_key'];
			$secret_key = $gr_data['secret_key'];
			$site_verify = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$mdata['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
			$response = file_get_contents($site_verify);
			$g_response = json_decode($response);

			if($g_response->success == 1) {

				$emailConfig = mail_config();

		        $from = array(
		            'email' => $mdata['email'],
		            'name' => $mdata['subject'].' - '.ucwords($mdata['name']).' - '.the_config('site_name').' Contact Us'
		        );
		        $body = '
		        		<a href="'.base_url().'" target="_blank">
		        			<img src="'.base_url('build/images/logo-orange.png').'" alt="'.the_config('site_name').'" title="'.the_config('site_name').'" width="30%" />
		        		</a>
		        		<br/>
		        		<br/>
		        		<strong>From : </strong> '.$mdata['name'].'('.$mdata['email'].')
		        		<br/>
		        		<br/>
		        		<strong>Subject : </strong> '.$mdata['subject'].'
		        		<br/>
		        		<br/>
		        		<strong>Message : </strong> '.$mdata['message'].'
		        	';
		       
		        $to = the_config('admin_email');
		        $subject = $mdata['subject'];
		      	$message = $body;
		        $this->load->library('email', $emailConfig);
		        $this->email->set_newline("\r\n");
		        $this->email->from($from['email'], $from['name']);
		        $this->email->to($to);
		        $this->email->subject($subject);
		        $this->email->message($message);
		        if (!$this->email->send()) {
		            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
		        } else {
		            $response = json_encode(array('result' => 'success', 'message' => 'Message successfully sent!'));
		        }

			} else {
				$response = json_encode(array('result' => 'error', 'message' => 'Invalid Captcha!'));
			}

	        echo $response;

		}
		
	}