<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class auth {

	    public function __construct() {
	        $this->app =& get_instance();
			$this->app->load->library('session');
			$this->app->load->model('User_model');
			$this->app->load->model('Role_model');
	    }
		
		public function login_admin($username, $pass) {
			$password = md5($pass);
			if($this->app->User_model->resolve_user_login($username, $password)) {
				$user_id = $this->app->User_model->get_user_id_from_username($username);
	            $user = $this->app->User_model->get_user($user_id);
	            $user_data = array(
	            	'id' => $user->id,
	            	'username' => $user->username,
	            	'email' => $user->email,
	            	// 'first_name' => $user->first_name,
	            	// 'last_name' => $user->last_name,
	            	'password' => $user->password,
	            );
	            $session = array(
	            	'role' => $user->role,
	            	'logged_in' => true,
	            	'user_data' => $user_data
	            );
	            $this->app->session->set_userdata($session);
	            return TRUE;
			} else {
				return FALSE;
			}
		}
		
		public function check_admin() {
			$sess_role = $this->app->session->userdata('role');
			$sess_status = $this->app->session->userdata('logged_in');
			if($this->app->Role_model->get_admin_from_role($sess_role) and $sess_status) {
				return true;
			} else {
				redirect(base_url('admin/login'));
			}
		}

		public function session() {
			return $this->app->session->userdata();
		}

		public function session_data() {
			return $this->app->session->userdata('user_data');
		}
	}