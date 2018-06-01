<?php

	class Admin extends CI_Controller {

		public function __construct() {
            parent::__construct();
            
            $this->load->helper('general');
			$this->load->model('State_model');
			$this->load->model('City_model');
            $this->load->model('Country_model');
            $this->load->model('Aircraft_model');
            $this->load->model('Airline_model');
            $this->load->model('Page_model');
            $this->load->model('Business_model');
            $this->load->model('User_model');
            $this->load->model('Role_model');
            $this->load->model('Category_model');
            $this->load->model('Configuration_model');
            $this->load->library(array('session'));
            $this->load->helper(array('url'));
            $this->load->library('upload');
            $this->load->library('pagination');
            $this->load->helper('travelpayouts');
            $this->load->library('auth');
        }
        public function index() {
            $this->auth->check_admin();
            redirect(base_url('admin/dashboard'));
        }
        public function login($page = 'login') {
            if($this->session->userdata('role') == 1 and $this->session->userdata('logged_in') === true) {
                redirect(base_url('admin/dashboard'));
            } else {
                if(!$this->uri->segment(3)) {
                    if(!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
                        show_404();
                    } else {
                        $data['title'] = 'Admin | '.the_config('site_name');
                        $this->load->view('admin/'.$page, $data);
                    }
                } else {
                    if($this->uri->segment(3,0) == 'process') {
                        $request = $this->input->post();
                        if($this->auth->login_admin($request['username'], $request['password'])) {
                            $response = json_encode(array('result' => 'success', 'message' => 'Successfully Logged In', 'redirect' => base_url('admin/dashboard')));
                            echo $response;
                        } else {
                            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Invalid credentials'));
                            echo $response;
                        }
                    } else {
                        show_404();
                    }
                }
            }
        }
        public function logout() {
            if($this->session->userdata('role') == 1 and $this->session->userdata('logged_in') === true) {
                foreach ($this->session->userdata as $key => $value) {
                    unset($_SESSION[$key]);
                }
                redirect(base_url('admin'));
            } else {
                redirect(base_url('admin'));
            }
        }
        public function dashboard($page = 'dashboard') {
            $this->auth->check_admin();
            $data['title'] = 'Dashboard - Admin | '.the_config('site_name');
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data); 
        }
        public function validateslug() {
            $this->auth->check_admin();
            if($this->input->get()) {
                if($this->input->get('type') == 'page' OR $this->input->get('type') == 'post') {
                    $req = array(
                        'slug' => $this->input->get('slug'),
                        'layout' => $this->input->get('type')
                    );
                    $result = $this->Page_model->validate_slug($req['slug']);
                    if($result == 0) {
                        $slug = slugify($req['slug']);
                        $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                    } else {
                        $slug = slugify($req['slug'].'-'.strtotime('now'));
                        $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                    }
                    echo $response;
                } else if($this->input->get('type') == 'category') {
                    $req = array(
                        'slug' => $this->input->get('slug')
                    );
                    $result = $this->Category_model->cat_validate_slug($req['slug']);
                    if($result == 0) {
                        $slug = slugify($req['slug']);
                        $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                    } else {
                        $slug = slugify($req['slug'].'-'.strtotime('now'));
                        $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                    }
                    echo $response;
                } else if($this->input->get('type') == 'state') {
                    $req = array(
                        'slug' => $this->input->get('slug')
                    );
                    $result = $this->State_model->state_validate_slug($req['slug']);
                    if($result == 0) {
                        $slug = slugify($req['slug']);
                        $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                    } else {
                        $slug = slugify($req['slug'].'-'.strtotime('now'));
                        $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                    }
                    echo $response;
                } else if($this->input->get('type') == 'city') {
                    $req = array(
                        'slug' => $this->input->get('slug')
                    );
                    $result = $this->City_model->get_city_from_slug($req['slug']);
                    if($result == 0) {
                        $slug = slugify($req['slug']);
                        $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $req['slug']));
                    } else {
                        $slug = slugify($req['slug'].'-'.strtotime('now'));
                        $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                    }
                    echo $response;
                } else {
                    redirect(base_url('admin/dashboard'));
                }
            } else {
                redirect(base_url('admin/dashboard'));
            }
        }
        public function validatenewslug() {
            $this->auth->check_admin();
            if($this->input->get()) {
                if($this->input->get('type') == 'page' OR $this->input->get('type') == 'post') {
                    $req = array(
                        'slug' => $this->input->get('slug'),
                        'permalink' => $this->input->get('permalink'),
                        'layout' => $this->input->get('type')
                    );
                    if($req['slug'] != $req['permalink']) {
                        $result = $this->Page_model->validate_slug($req['slug']);
                        if($result == 0) {
                            $slug = slugify($req['slug']);
                            $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                        } else {
                            $slug = slugify($req['slug'].'-'.strtotime('now'));
                            $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                        }
                    } else {
                        $response = json_encode(array('result' => 'success', 'message' => 'No Change', 'data' => $req['permalink']));
                    }
                    echo $response;
                } else if($this->input->get('type') == 'category') {
                    $req = array(
                        'slug' => $this->input->get('slug'),
                        'permalink' => $this->input->get('permalink')
                    );
                    if($req['slug'] != $req['permalink']) {
                        $result = $this->Category_model->cat_validate_slug($req['slug']);
                        if($result == 0) {
                            $slug = slugify($req['slug']);
                            $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                        } else {
                            $slug = slugify($req['slug'].'-'.strtotime('now'));
                            $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                        }
                    } else {
                        $response = json_encode(array('result' => 'success', 'message' => 'No Change', 'data' => $req['permalink']));
                    }
                    echo $response;
                } else if($this->input->get('type') == 'state') {
                    $req = array(
                        'slug' => $this->input->get('slug'),
                        'permalink' => $this->input->get('permalink')
                    );
                    if($req['slug'] != $req['permalink']) {
                        $result = $this->State_model->state_validate_slug($req['slug']);
                        if($result == 0) {
                            $slug = slugify($req['slug']);
                            $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                        } else {
                            $slug = slugify($req['slug'].'-'.strtotime('now'));
                            $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                        }
                    } else {
                        $response = json_encode(array('result' => 'success', 'message' => 'No Change', 'data' => $req['permalink']));
                    }
                    echo $response;
                } else if($this->input->get('type') == 'city') {
                    $req = array(
                        'slug' => $this->input->get('slug'),
                        'permalink' => $this->input->get('permalink')
                    );
                    if($req['slug'] != $req['permalink']) {
                        $result = $this->City_model->city_validate_slug($req['slug']);
                        if($result == 0) {
                            $slug = slugify($req['slug']);
                            $response = json_encode(array('result' => 'success', 'message' => 'Slug Available', 'data' => $slug));
                        } else {
                            $slug = slugify($req['slug'].'-'.strtotime('now'));
                            $response = json_encode(array('result' => 'success', 'message' => 'New Slug', 'data' => $slug));
                        }
                    } else {
                        $response = json_encode(array('result' => 'success', 'message' => 'No Change', 'data' => $req['permalink']));
                    }
                    echo $response;
                } else {
                    redirect(base_url('admin/dashboard'));
                }
            } else {
                redirect(base_url('admin/dashboard'));
            }
        }

        /**
        ** PAGES Section START
        **/
        public function pages() {
            $this->auth->check_admin();
            if($this->uri->segment(3, 0)) {
                $segment = $this->uri->segment(3, 0);
                if(is_numeric($segment)) {
                    $this->_all_pages();
                } else {
                    if($segment == 'search') {
                        $this->_pages_search();
                    } else if($segment == 'new') {
                        $this->_add_pages();
                    } else if($segment == 'edit') {
                        $this->_edit_pages();
                    } else if($segment == 'trash') {
                        $this->_trash_pages();
                    } else if($segment == 'recover') {
                        $this->_recover_page_post();
                    } else if($segment == 'delete') {
                        $this->_delete_page_post();
                    } else {
                        show_404();
                    }
                }

            } else {
                $this->_all_pages();
            }
        }
        public function _all_pages($page = 'pages') {
            $offset = $this->uri->segment(3, 0);
            $limit = 10;
            $count = count($this->Page_model->get_active_pages());
            $result = $this->Page_model->get_active_pages_paginate($limit, $offset);
            $data['pages'] = $result['data']->result();
            $config['base_url'] = site_url('admin/pages');
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
            $data['title'] = 'Pages - Admin | '.the_config('site_name');        
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data);
        }
        public function _pages_search($page = 'pages') {
            if($this->input->get('keyword')) {
                $offset = $this->uri->segment(4, 0);
                $limit = 10;
                $count = count($this->Page_model->get_active_pages($this->input->get('keyword')));
                $result = $this->Page_model->get_active_pages_paginate($limit, $offset, $this->input->get('keyword'));
                $data['pages'] = $result['data']->result();
                $config['base_url'] = site_url('admin/pages/search');
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
                $data['title'] = 'Search Pages - Admin | '.the_config('site_name');    
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            } else {

                redirect(base_url('admin/pages'));

            }
        }
        public function _add_pages($page = 'add_page') {
            if($this->input->post()) {
                $req = $this->input->post();
                if(!empty($_FILES['featured_image']['name'])) {
                    $date = date('Y');
                    $path = APPPATH.'../uploads/images/page/';
                    if(!file_exists($path.$date)) {
                        mkdir($path.$date, 0777, true);
                    }
                    $config['upload_path'] = 'uploads/images/page/'.$date.'/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name'] = $_FILES['featured_image']['name'];
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('featured_image')){
                        $uploadData = $this->upload->data();
                        $featured_image = $uploadData['file_name'];
                        $photo_dir = $config['upload_path'].$featured_image;
                    } else {
                        $photo_dir = NULL;
                    }
                } else {
                    $photo_dir = NULL;
                }
                $data = array(
                    'title' => $req['title'],
                    'slug' => slugify($req['slug']),
                    'content' => $req['content'],
                    'excerpt' => $req['excerpt'],
                    'layout' => $req['layout'],
                    'meta_keyword' => $req['meta_keyword'],
                    'meta_description' => $req['meta_description'],
                    'featured_image' => $photo_dir,
                    'author' => $this->auth->session_data()['username'],
                    'status' => $req['status'],
                    'created_at' => datetime_now()
                );
                if($this->Page_model->add_page($data)) {
                    $id = $this->db->insert_id();
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/pages/edit/'.$id)));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                $data['title'] = 'Add New Page - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _edit_pages($page = 'edit_page') {
            if($this->input->post()) {
                $req = $this->input->post();
                $current_img = ($this->input->post('current_img')) ? $this->input->post('current_img') : NULL;
                $current_status = ($this->input->post('current_status')) ? $this->input->post('current_status') : NULL;
                if(!empty($_FILES['featured_image']['name'])) {
                    $date = date('Y');
                    $path = APPPATH.'../uploads/images/page/';
                    if(!file_exists($path.$date)) {
                        mkdir($path.$date, 0777, true);
                    }
                    $config['upload_path'] = 'uploads/images/page/'.$date.'/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name'] = $_FILES['featured_image']['name'];
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('featured_image')){
                        if($current_img != NULL) {
                            if(file_exists($current_img)) {
                                unlink($current_img);
                            }
                        }
                        $uploadData = $this->upload->data();
                        $featured_image = $uploadData['file_name'];
                        $photo_dir = $config['upload_path'].$featured_image;
                    } else {
                        $photo_dir = NULL;
                    }
                } else {
                    if($current_img != NULL) {
                        $photo_dir = $current_img;
                    } else {
                        if(file_exists($current_status)) {
                            unlink($current_status);
                        }
                        $photo_dir = NULL;
                    }
                }
                $id = $req['id'];
                $data = array(
                    'title' => $req['title'],
                    'slug' => slugify($req['slug']),
                    'content' => $req['content'],
                    'excerpt' => $req['excerpt'],
                    'layout' => $req['layout'],
                    'meta_keyword' => $req['meta_keyword'],
                    'meta_description' => $req['meta_description'],
                    'featured_image' => $photo_dir,
                    'author' => $this->auth->session_data()['username'],
                    'status' => $req['status'],
                    'updated_at' => datetime_now()
                );
                if($this->Page_model->update_page($id, $data)) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated', 'data' => $data['slug']));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                }
               echo $response;
            } else {
                $slug_uri = $this->uri->segment(4, 0);
                $res = $this->Page_model->get_page_from_id($slug_uri);
                if($res != 0) {
                    $data['page'] = $res[0];
                } else {
                    redirect(base_url('admin/pages'));
                }
                $data['title'] = 'Edit Page - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _trash_pages($page = 'trash_pages') {
            if($this->input->post()) {
                $this->_trash_page_post();
            } else {
                $data['title'] = 'Trash Pages - Admin | '.the_config('site_name');
                $pages = $this->Page_model->get_trash_pages();
                if($pages != 0) {
                    $data['pages'] = $pages;
                } else {
                    $data['pages'] = 0;
                }
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        /**
        ** PAGES Section END
        **/

        /**
        ** POST Section START
        **/
        public function posts() {
            $this->auth->check_admin();
            if($this->uri->segment(3, 0)) {
                $segment = $this->uri->segment(3, 0);
                if(is_numeric($segment)) {
                    $this->_all_posts();
                } else {
                    if($segment == 'search') {
                        $this->_posts_search();
                    } else if($segment == 'new') {
                        $this->_add_posts();
                    } else if($segment == 'edit') {
                        $this->_edit_posts();
                    } else if($segment == 'trash') {
                        $this->_trash_posts();
                    } else if($segment == 'recover') {
                        $this->_recover_page_post();
                    } else if($segment == 'delete') {
                        $this->_delete_page_post();
                    } else {
                        show_404();
                    }
                }
            } else {
                $this->_all_posts();
            }
        }
        public function _all_posts($page = 'posts') {
            $offset = $this->uri->segment(3, 0);
            $limit = 10;
            $count = count($this->Page_model->get_active_posts());
            $result = $this->Page_model->get_active_posts_paginate($limit, $offset);
            $data['posts'] = $result['data']->result();
            $config['base_url'] = site_url('admin/posts');
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
            $data['title'] = 'Posts - Admin | '.the_config('site_name');
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data);
        }
        public function _posts_search($page = 'pages') {
            if($this->input->get('keyword')) {
                $offset = $this->uri->segment(4, 0);
                $limit = 10;
                $count = count($this->Page_model->get_active_posts($this->input->get('keyword')));
                $result = $this->Page_model->get_active_posts_paginate($limit, $offset, $this->input->get('keyword'));
                $data['pages'] = $result['data']->result();
                $config['base_url'] = site_url('admin/posts/search');
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
                $data['title'] = 'Search Pages - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            } else {
                redirect(base_url('admin/pages'));
            }
        }
        public function _add_posts($page = 'add_post') {
            if($this->input->post()) {
                $req = $this->input->post();
                if(!empty($_FILES['featured_image']['name'])) {
                    $date = date('Y');
                    $path = APPPATH.'../uploads/images/page/';
                    if(!file_exists($path.$date)) {
                        mkdir($path.$date, 0777, true);
                    }
                    $config['upload_path'] = 'uploads/images/page/'.$date.'/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name'] = $_FILES['featured_image']['name'];
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('featured_image')){
                        $uploadData = $this->upload->data();
                        $featured_image = $uploadData['file_name'];
                        $photo_dir = $config['upload_path'].$featured_image;
                    } else {
                        $photo_dir = NULL;
                    }
                } else {
                    $photo_dir = NULL;
                }
                $category = ($this->input->post('category')) ? $this->input->post('category') : array('Uncategorized');
                $data = array(
                    'title' => $req['title'],
                    'slug' => slugify($req['slug']),
                    'content' => $req['content'],
                    'excerpt' => $req['excerpt'],
                    'layout' => $req['layout'],
                    'meta_keyword' => $req['meta_keyword'],
                    'meta_description' => $req['meta_description'],
                    'category' => serialize($category),
                    'tag' => $req['tag'],
                    // 'featured_image' => $config['upload_path'].$featured_image,
                    'featured_image' => $photo_dir,
                    'author' => $this->auth->session_data()['username'],
                    'status' => $req['status'],
                    'created_at' => datetime_now()
                );
                if($this->Page_model->add_post($data)) {
                    $id = $this->db->insert_id();
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/posts/edit/'.$id)));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                $data['title'] = 'Add New Post - Admin | '.the_config('site_name');
                $data['category'] = $this->Category_model->get_categories();
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _edit_posts($page = 'edit_post') {
            if($this->input->post()) {
                $req = $this->input->post();
                $current_img = ($this->input->post('current_img')) ? $this->input->post('current_img') : NULL;
                $current_status = ($this->input->post('current_status')) ? $this->input->post('current_status') : NULL;
                $category = ($this->input->post('category')) ? $this->input->post('category') : array('Uncategorized');
                if(!empty($_FILES['featured_image']['name'])) {
                    $date = date('Y');
                    $path = APPPATH.'../uploads/images/page/';
                    if(!file_exists($path.$date)) {
                        mkdir($path.$date, 0777, true);
                    }
                    $config['upload_path'] = 'uploads/images/page/'.$date.'/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_name'] = $_FILES['featured_image']['name'];
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('featured_image')){
                        if($current_img != NULL) {
                            if(file_exists($current_img)) {
                                unlink($current_img);
                            }
                        }
                        $uploadData = $this->upload->data();
                        $featured_image = $uploadData['file_name'];
                        $photo_dir = $config['upload_path'].$featured_image;
                    } else {
                        $photo_dir = NULL;
                    }
                } else {
                    if($current_img != NULL) {
                        $photo_dir = $current_img;
                    } else {
                        if(file_exists($current_status)) {
                            unlink($current_status);
                        }
                        $photo_dir = NULL;
                    }
                }
                $id = $req['id'];
                $data = array(
                    'title' => $req['title'],
                    'slug' => slugify($req['slug']),
                    'content' => $req['content'],
                    'excerpt' => $req['excerpt'],
                    'layout' => $req['layout'],
                    'meta_keyword' => $req['meta_keyword'],
                    'meta_description' => $req['meta_description'],
                    'category' => serialize($category),
                    'tag' => $req['tag'],
                    'featured_image' => $photo_dir,
                    'author' => $this->auth->session_data()['username'],
                    'status' => $req['status'],
                    'updated_at' => datetime_now()
                );
                $res = $this->Page_model->update_page($id, $data);
               if($res != 0) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated', 'data' => $data['slug']));
               } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
               }
               echo $response;
            } else {
                $slug_uri = $this->uri->segment(4, 0);
                $data['category'] = $this->Category_model->get_categories();
                $res = $this->Page_model->get_page_from_id($slug_uri);
                if($res != 0) {
                    $data['post'] = $res[0];
                } else {
                    redirect(base_url('admin/posts'));
                }
                $data['title'] = 'Edit Post - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _trash_posts($page = 'trash_posts') {
            if($this->input->post()) {
                $this->_trash_page_post();
            } else {
                $data['title'] = 'Trash Posts - Admin | '.the_config('site_name');
                $pages = $this->Page_model->get_trash_posts();
                if($pages != 0) {
                    $data['pages'] = $pages;
                } else {
                    $data['pages'] = 0;
                }
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        /**
        ** POST Section END
        **/

         /**
        ** PAGES & POST TRASH Section START
        **/
        public function _trash_page_post() {
            $req = $this->input->post();
            $id = $req['id'];
            $trash = $this->Page_model->trash_page_post($id);
            if($trash != 0) {
                $response = json_encode(array('result' => 'success', 'message' => 'Transferred to trash'));
           } else {
                $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
           }
           echo $response;
        }
        public function _recover_page_post() {
            if($this->input->post()) {
                $req = $this->input->post();
                $id = $req['id'];
                if($this->Page_model->recover_page_post($id)) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Recovered'));
               } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
               }
               echo $response;
            } else {
                redirect(base_url());
            }
        }
        public function _delete_page_post() {
            if($this->uri->segment(4,0) and $this->uri->segment(4,0) == 'all') {
                $this->_empty_page_post_trash();
            } else {
                if($this->input->post()) {
                    $req = $this->input->post();
                    $id = $req['id'];
                    $entry = $this->Page_model->get_page_from_id($id);
                    $photo = $entry[0]->featured_image;
                    if($photo != NULL) {
                        if(file_exists($photo)) {
                            unlink($photo);
                        }
                    }
                    if($this->Page_model->delete_page_post($id)) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                   } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                   }
                   echo $response;
                } else {
                    redirect(base_url());
                }
            }
        }
        public function _empty_page_post_trash() {
            if($this->input->post()) {
                $req = $this->input->post();
                $type = $req['type'];
                $empty = $this->Page_model->empty_page_post_trash($type);
                if($empty != 0) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Trash is now Empty'));
               } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
               }
               echo $response;
            } else {
                redirect(base_url());
            }
        }
        /**
        ** PAGES & POST TRASH Section END
        **/

        /**
        ** CITY Section START
        **/
        public function cities() {
            $this->auth->check_admin();
            if($this->uri->segment(3, 0)) {
                $segment = $this->uri->segment(3, 0);
                if(is_numeric($segment)) {
                    $this->_all_cities();
                } else {
                    if($segment == 'search') {
                        $this->_city_search();
                    } else if($segment == 'new') {
                        $this->_add_city();
                    } else if($segment == 'edit') {
                        $this->_edit_city();
                    } else if($segment == 'import') {
                        $this->_city_import();
                    } else if($segment == 'delete') {
                        $this->_delete_city();
                    } else {
                        show_404();
                    }
                }
            } else {
                $this->_all_cities();
            }
        }
        public function _all_cities($page = 'cities') {

            $offset = $this->uri->segment(3, 0);
            $limit = 20;
            
            $count = count($this->City_model->get_cities());

            $result = $this->City_model->get_cities_paginate($limit, $offset);
            $data['cities'] = $result['data']->result();
            
            $config['base_url'] = site_url('admin/cities');
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

            $data['title'] = 'Cities - Admin | '.the_config('site_name');
                        
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data);
        }
        public function _city_search($page = 'cities') {

            if($this->input->get('keyword')) {

                $offset = $this->uri->segment(4, 0);
                $limit = 20;
                
                $count = count($this->City_model->get_cities($this->input->get('keyword')));

                $result = $this->City_model->get_cities_paginate($limit, $offset, $this->input->get('keyword'));
                $data['cities'] = $result['data']->result();
                
                $config['base_url'] = site_url('admin/cities/search');
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

                $data['title'] = 'Search City - Admin | '.the_config('site_name');
                            
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);

            } else {

                redirect(base_url('admin/cities'));

            }
        }
        public function _add_city($page = 'add_city') {
            if($this->input->post()) {
                $request = array(
                    'name' => $this->input->post('name'),
                    'code' => $this->input->post('code'),
                    'country' => $this->input->post('country'),
                    'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('code')),
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                    'created_at' => datetime_now()
                );
                if($this->City_model->add_city($request)) {
                    $id = $this->db->insert_id();
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/cities/edit/'.$id)));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                $data['title'] = 'Add New City - Admin | '.the_config('site_name');
                
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _edit_city($page = 'edit_city') {
            if($this->uri->segment(4, 0) and is_numeric($this->uri->segment(4, 0))) {
                $id = $this->uri->segment(4, 0);
                if($city = $this->City_model->get_city_from_id($id)) {
                    if($this->input->post()) {
                        $request = array(
                            'name' => $this->input->post('name'),
                            'code' => $this->input->post('code'),
                            'country' => $this->input->post('country'),
                            'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('code')),
                            'latitude' => $this->input->post('latitude'),
                            'longitude' => $this->input->post('longitude'),
                            'updated_at' => datetime_now()
                        );
                        if($this->City_model->update_city($id, $request)) {
                            $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated'));
                        } else {
                            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                        }
                       echo $response;
                    } else {
                        $data['city'] = $city[0];
                        $data['title'] = 'Edit City - Admin | '.the_config('site_name');
                        $this->load->view('admin/templates/header', $data);
                        $this->load->view('admin/'.$page, $data);
                        $this->load->view('admin/templates/footer', $data);
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
        public function _city_import($page = 'import_city') {
            if(!empty($_FILES['city']['tmp_name'])) {
                $this->_city_import_process();
            } else {
                $data['title'] = 'Import City - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _city_import_process() {
            if(!empty($_FILES['city']['tmp_name'])) {
                $fh = fopen($_FILES['city']['tmp_name'], 'r+');
                $success_ctr = 0;
                $duplicate_ctr = 0;
                $failed_ctr = 0;
                $result = array();
                $x = 1;
                while(($row = fgetcsv($fh, 8192)) !== FALSE ) {
                    $cdata = array(
                        'slug' => slugify(trim($row['0'].' '.$row['2'], '/[\s]/')),
                        'code' => $row['0'],
                        'name' => $row['1'],
                        'country' => (isset($row['2'])) ? $row['2'] : NULL,
                        'latitude' => (isset($row['3'])) ? $row['3'] : NULL,
                        'longitude' => (isset($row['4'])) ? $row['4'] : NULL,
                        'created_at' => datetime_now()
                    );

                    if(!$this->City_model->get_city_from_slug($cdata['slug'])) {

                        if($this->City_model->add_city($cdata)) {

                            $result[] = "<strong>(Log: $x) </strong><span class='text-success'>Success Importing: </span>{$cdata['name']}. Slug set to `{$cdata['slug']}`.<br><hr style='margin: 2px'>";
                            $success_ctr++;

                        } else {

                            $result[] = "<strong>(Log: $x) </strong><span class='text-danger'>Failed Importing: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
                            $failed_ctr++;
                        }

                    } else {

                        $result[] = "<strong>(Log: $x) </strong><span class='text-warning'>Duplicate Data: </span>{$cdata['name']}. Slug `{$cdata['slug']}`.<br><hr style='margin: 4px'>";
                        $duplicate_ctr++;
                    }

                    $x++;
                }
                fclose($fh);
                $result[] = "<strong>Report</strong><br/>";
                $result[] = "<strong> ".$success_ctr."</strong> successfully imported records.<br>";
                $result[] = "<strong> ".$duplicate_ctr."</strong> duplicated records.<br>";
                $result[] = "<strong> ".$failed_ctr."</strong> failed importing records.<br>";
                $log = implode('', $result);
                $response = json_encode(array('result' => 'success', 'message' => 'Successfully Imported', 'log' => $log));
                echo $response;
            } else {
                $response = json_encode(array('result' => 'error', 'message' => 'Something went wrong'));
                echo $response;
            }
        }
        public function _delete_city() {
            if($this->uri->segment(4,0) and $this->uri->segment(4,0) == 'all') {
                if($this->input->post()) {
                    $delete = $this->City_model->delete_all_city();
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                    } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                    }
                    echo $response;
                } else {
                    redirect(base_url());
                }
            } else {
                if($this->input->post()) {
                    $req = $this->input->post();
                    $id = $req['id'];
                    $delete = $this->City_model->delete_city($id);
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                   } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                   }
                   echo $response;
                } else {
                    redirect(base_url());
                }
            }
        }
        /**
        ** CITY Section END
        **/

        /**
        ** COUNTRY Section START
        **/
        public function countries() {
            $this->auth->check_admin();
            if($this->uri->segment(3, 0)) {
                $segment = $this->uri->segment(3, 0);
                if(is_numeric($segment)) {
                    $this->_all_countries();
                } else {
                    if($segment == 'search') {
                        $this->_country_search();
                    } else if($segment == 'new') {
                        $this->_add_country();
                    } else if($segment == 'edit') {
                        $this->_edit_country();
                    } else if($segment == 'import') {
                        $this->_import_country();
                    } else if($segment == 'delete') {
                        $this->_delete_country();
                    } else {
                        show_404();
                    }
                }
            } else {
                $this->_all_countries();
            }
        }
        public function _all_countries($page = 'countries') {
            $offset = $this->uri->segment(3, 0);
            $limit = 20;
            
            $count = count($this->Country_model->get_countries());

            $result = $this->Country_model->get_countries_paginate($limit, $offset);
            $data['countries'] = $result['data']->result();
            
            $config['base_url'] = site_url('admin/countries');
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

            $data['title'] = 'Countries - Admin | '.the_config('site_name');
                        
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data);
        }
        public function _country_search($page = 'countries') {
            if($this->input->get('keyword')) {

                $offset = $this->uri->segment(4, 0);
                $limit = 20;
                
                $count = count($this->Country_model->get_countries($this->input->get('keyword')));

                $result = $this->Country_model->get_countries_paginate($limit, $offset, $this->input->get('keyword'));
                $data['countries'] = $result['data']->result();
                
                $config['base_url'] = site_url('admin/countries/search');
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

                $data['title'] = 'Search Country - Admin | '.the_config('site_name');
                            
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);

            } else {

                redirect(base_url('admin/countries'));

            }
        }
        public function _add_country($page = 'add_country') {
            if($this->input->post()) {
                $request = array(
                    'code' => $this->input->post('code'),
                    'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('code')),
                    'name' => $this->input->post('name'),
                    'background' => $this->input->post('background'),
                    'map_reference' => $this->input->post('map_reference'),
                    'coordinates' => $this->input->post('coordinates'),
                    'area' => $this->input->post('area'),
                    'population' => $this->input->post('population'),
                    'nationality' => $this->input->post('nationality'),
                    'ethnic_groups' => $this->input->post('ethnic_groups'),
                    'languages' => $this->input->post('languages'),
                    'religions' => $this->input->post('religions'),
                    'conventional_name' => $this->input->post('conventional_name'),
                    'government_type' => $this->input->post('government_type'),
                    'capital' => $this->input->post('capital'),
                    'administrative_divisions' => $this->input->post('administrative_divisions'),
                    'independence' => $this->input->post('independence'),
                    'economy_overview' => $this->input->post('economy_overview'),
                    'gdp_exchange_rate' => $this->input->post('gdp_exchange_rate'),
                    'agriculture' => $this->input->post('agriculture'),
                    'industries' => $this->input->post('industries'),
                    'labor_force' => $this->input->post('labor_force'),
                    'exports' => $this->input->post('exports'),
                    'electricity' => $this->input->post('electricity'),
                    'crude_oil' => $this->input->post('crude_oil'),
                    'refined_petroleum' => $this->input->post('refined_petroleum'),
                    'natural_gas' => $this->input->post('natural_gas'),
                    'aircraft_code_prefix' => $this->input->post('aircraft_code_prefix'),
                    'airports' => $this->input->post('airports'),
                    'heliports' => $this->input->post('heliports'),
                    'pipelines' => $this->input->post('pipelines'),
                    'railways' => $this->input->post('railways'),
                    'roadways' => $this->input->post('roadways'),
                    'waterways' => $this->input->post('waterways'),
                    'created_at' => datetime_now()
                );
                if($this->Country_model->add_country($request)) {
                    $id = $this->db->insert_id();
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/countries/edit/'.$id)));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                $data['title'] = 'Add New Country - Admin | '.the_config('site_name');
                        
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _edit_country($page = 'edit_country') {
            if($this->uri->segment(4,0) and is_numeric($this->uri->segment(4,0))) {
                $id = $this->uri->segment(4,0);
                if($country = $this->Country_model->get_country_from_id($id)) {
                    if($this->input->post()) {
                        $request = array(
                            'code' => $this->input->post('code'),
                            'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('code')),
                            'name' => $this->input->post('name'),
                            'background' => $this->input->post('background'),
                            'map_reference' => $this->input->post('map_reference'),
                            'coordinates' => $this->input->post('coordinates'),
                            'area' => $this->input->post('area'),
                            'population' => $this->input->post('population'),
                            'nationality' => $this->input->post('nationality'),
                            'ethnic_groups' => $this->input->post('ethnic_groups'),
                            'languages' => $this->input->post('languages'),
                            'religions' => $this->input->post('religions'),
                            'conventional_name' => $this->input->post('conventional_name'),
                            'government_type' => $this->input->post('government_type'),
                            'capital' => $this->input->post('capital'),
                            'administrative_divisions' => $this->input->post('administrative_divisions'),
                            'independence' => $this->input->post('independence'),
                            'economy_overview' => $this->input->post('economy_overview'),
                            'gdp_exchange_rate' => $this->input->post('gdp_exchange_rate'),
                            'agriculture' => $this->input->post('agriculture'),
                            'industries' => $this->input->post('industries'),
                            'labor_force' => $this->input->post('labor_force'),
                            'exports' => $this->input->post('exports'),
                            'electricity' => $this->input->post('electricity'),
                            'crude_oil' => $this->input->post('crude_oil'),
                            'refined_petroleum' => $this->input->post('refined_petroleum'),
                            'natural_gas' => $this->input->post('natural_gas'),
                            'aircraft_code_prefix' => $this->input->post('aircraft_code_prefix'),
                            'airports' => $this->input->post('airports'),
                            'heliports' => $this->input->post('heliports'),
                            'pipelines' => $this->input->post('pipelines'),
                            'railways' => $this->input->post('railways'),
                            'roadways' => $this->input->post('roadways'),
                            'waterways' => $this->input->post('waterways'),
                            'updated_at' => datetime_now()
                        );
                        // $request = $this->input->post();
                        if($this->Country_model->update_country($id, $request)) {
                            $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated'));
                        } else {
                            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                        }
                       echo $response;
                    } else {
                        $data['country'] = $country[0];
                        $data['title'] = 'Edit Country - Admin | '.the_config('site_name');
                        $this->load->view('admin/templates/header', $data);
                        $this->load->view('admin/'.$page, $data);
                        $this->load->view('admin/templates/footer', $data);
                    }
                } else {
                    redirect(base_url('admin/countries'));
                }
            } else {
                show_404();
            }
        }
        public function _import_country($page = 'import_country') {
            if(!empty($_FILES['country']['tmp_name'])) {
                $this->_country_import_process();
            } else {
                $data['title'] = 'Import Country - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _country_import_process() {
            if(!empty($_FILES['country']['tmp_name'])) {
                $fh = fopen($_FILES['country']['tmp_name'], 'r+');
                $success_ctr = 0;
                $duplicate_ctr = 0;
                $failed_ctr = 0;
                $result = array();
                $x = 1;
                while(($row = fgetcsv($fh, 8192)) !== FALSE ) {
                    $cdata = array(
                        'code' => $row['0'],
                        'slug' => slugify($row['0']),
                        'name' => $row['1'],
                        'background' => $row['2'],
                        'map_reference' => $row['3'],
                        'coordinates' => $row['4'],
                        'area' => $row['5'],
                        'population' => $row['6'],
                        'nationality' => $row['7'],
                        'ethnic_groups' => $row['8'],
                        'languages' => $row['9'],
                        'religions' => $row['10'],
                        'conventional_name' => $row['11'],
                        'government_type' => $row['12'],
                        'capital' => $row['13'],
                        'administrative_divisions' => $row['14'],
                        'independence' => $row['15'],
                        'economy_overview' => $row['16'],
                        'gdp_exchange_rate' => $row['17'],
                        'agriculture' => $row['18'],
                        'industries' => $row['19'],
                        'labor_force' => $row['20'],
                        'exports' => $row['21'],
                        'electricity' => $row['22'],
                        'crude_oil' => $row['23'],
                        'refined_petroleum' => $row['24'],
                        'natural_gas' => $row['25'],
                        'aircraft_code_prefix' => $row['26'],
                        'airports' => $row['27'],
                        'heliports' => $row['28'],
                        'pipelines' => $row['29'],
                        'railways' => $row['30'],
                        'roadways' => $row['31'],
                        'waterways' => $row['32'],
                        'created_at' => datetime_now()
                    );

                    if(!$this->Country_model->get_country_from_slug($cdata['slug'])) {

                        if($this->Country_model->add_country($cdata)) {

                            $result[] = "<strong>(Log: $x) </strong><span class='text-success'>Success Importing: </span>{$cdata['name']}. Slug set to `{$cdata['slug']}`.<br><hr style='margin: 2px'>";
                            $success_ctr++;

                        } else {

                            $result[] = "<strong>(Log: $x) </strong><span class='text-danger'>Failed Importing: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
                            $failed_ctr++;
                        }

                    } else {

                        $result[] = "<strong>(Log: $x) </strong><span class='text-warning'>Duplicate Data: </span>{$cdata['name']}. Slug `{$cdata['slug']}`.<br><hr style='margin: 4px'>";
                        $duplicate_ctr++;
                    }

                    $x++;
                }
                fclose($fh);
                $result[] = "<strong>Report</strong><br/>";
                $result[] = "<strong> ".$success_ctr."</strong> successfully imported records.<br>";
                $result[] = "<strong> ".$duplicate_ctr."</strong> duplicated records.<br>";
                $result[] = "<strong> ".$failed_ctr."</strong> failed importing records.<br>";
                $log = implode('', $result);
                $response = json_encode(array('result' => 'success', 'message' => 'Successfully Imported', 'log' => $log));
                echo $response;
            } else {
                $response = json_encode(array('result' => 'error', 'message' => 'Something went wrong'));
                echo $response;
            }
        }
        public function _delete_country() {
            if($this->uri->segment(4,0) and $this->uri->segment(4,0) == 'all') {
                if($this->input->post()) {
                    if($this->Country_model->delete_all_country()) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                    } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                    }
                    echo $response;
                } else {
                    show_404();
                }
            } else {
                if($this->input->post()) {
                    $req = $this->input->post();
                    $id = $req['id'];
                    $delete = $this->Country_model->delete_country($id);
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                   } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                   }
                   echo $response;
                } else {
                    show_404();
                }
            }
        }
        /**
        ** COUNTRY Section END
        **/

        /**
        ** AIRCRAFT Section START
        **/
        public function aircrafts() {
            $this->auth->check_admin();
            if($this->uri->segment(3, 0)) {
                $segment = $this->uri->segment(3, 0);
                if(is_numeric($segment)) {
                    $this->_all_aircrafts();
                } else {
                    if($segment == 'search') {
                        $this->_aircraft_search();
                    } else if($segment == 'new') {
                        $this->_add_aircraft();
                    } else if($segment == 'edit') {
                        $this->_edit_aircraft();
                    } else if($segment == 'import') {
                        $this->_import_aircraft();
                    } else if($segment == 'delete') {
                        $this->_delete_aircraft();
                    } else {
                        show_404();
                    }
                }
            } else {
                $this->_all_aircrafts();
            }
        }
        public function _all_aircrafts($page = 'aircrafts') {
            $offset = $this->uri->segment(3, 0);
            $limit = 20;
            $count = count($this->Aircraft_model->get_aircrafts());
            $result = $this->Aircraft_model->get_aircrafts_paginate($limit, $offset);
            $data['aircrafts'] = $result['data']->result();
            $config['base_url'] = site_url('admin/aircrafts');
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
            $data['title'] = 'Aircrafts - Admin | '.the_config('site_name');        
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data);
        }
        public function _aircraft_search($page = 'aircrafts') {
            if($this->input->get('keyword')) {
                $offset = $this->uri->segment(4, 0);
                $limit = 20;
                $count = count($this->Aircraft_model->get_aircrafts($this->input->get('keyword')));
                $result = $this->Aircraft_model->get_aircrafts_paginate($limit, $offset, $this->input->get('keyword'));
                $data['aircrafts'] = $result['data']->result();
                $config['base_url'] = site_url('admin/aircrafts/search');
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
                $data['title'] = 'Search Aircrafts - Admin | '.the_config('site_name');       
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            } else {
                redirect(base_url('admin/aircrafts'));
            }
        }
        public function _add_aircraft($page = 'add_aircraft') {
            if($this->input->post()) {
                $request = array(
                    'name' => $this->input->post('name'),
                    'code' => $this->input->post('code'),
                    'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('code').'-'.$this->input->post('name')),
                    'created_at' => datetime_now()
                );
                if($this->Aircraft_model->add_aircraft($request)) {
                    $id = $this->db->insert_id();
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/aircrafts/edit/'.$id)));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                $data['title'] = 'Add New Aircrafts - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _edit_aircraft($page = 'edit_aircraft') {
            if($this->uri->segment(4, 0) and is_numeric($this->uri->segment(4, 0))) {
                $id = $this->uri->segment(4, 0);
                if($aircraft = $this->Aircraft_model->get_aircraft_from_id($id)) {
                    if($this->input->post()) {
                        $request = array(
                            'name' => $this->input->post('name'),
                            'code' => $this->input->post('code'),
                            'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('code').'-'.$this->input->post('name')),
                            'updated_at' => datetime_now()
                        );
                        if($this->Aircraft_model->update_aircraft($id, $request)) {
                            $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated'));
                        } else {
                            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                        }
                       echo $response;
                    } else {
                        $data['aircraft'] = $aircraft[0];
                        $data['title'] = 'Edit Aircraft - Admin | '.the_config('site_name');
                        $this->load->view('admin/templates/header', $data);
                        $this->load->view('admin/'.$page, $data);
                        $this->load->view('admin/templates/footer', $data);
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
        public function _import_aircraft($page = 'import_aircraft') {
            if(!empty($_FILES['aircraft']['tmp_name'])) {
                $this->_aircraft_import_process();
            } else {
                $data['title'] = 'Import Aricarft - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _aircraft_import_process() {
            if(!empty($_FILES['aircraft']['tmp_name'])) {
                $fh = fopen($_FILES['aircraft']['tmp_name'], 'r+');
                $success_ctr = 0;
                $duplicate_ctr = 0;
                $failed_ctr = 0;
                $result = array();
                $x = 1;
                while(($row = fgetcsv($fh, 8192)) !== FALSE ) {
                    $cdata = array(
                        'slug' => slugify($row['0'].' '.$row['1']),
                        'code' => $row['0'],
                        'name' => $row['1'],
                        'created_at' => datetime_now()
                    );
                    if(!$this->Aircraft_model->get_aircraft_from_slug($cdata['slug'])) {
                        if($this->Aircraft_model->add_aircraft($cdata)) {
                            $result[] = "<strong>(Log: $x) </strong><span class='text-success'>Success Importing: </span>{$cdata['name']}. Slug set to `{$cdata['slug']}`.<br><hr style='margin: 2px'>";
                            $success_ctr++;
                        } else {
                            $result[] = "<strong>(Log: $x) </strong><span class='text-danger'>Failed Importing: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
                            $failed_ctr++;
                        }
                    } else {
                        $result[] = "<strong>(Log: $x) </strong><span class='text-warning'>Duplicate Data: </span>{$cdata['name']}. Slug `{$cdata['slug']}`.<br><hr style='margin: 4px'>";
                        $duplicate_ctr++;
                    }
                    $x++;
                }
                fclose($fh);
                $result[] = "<strong>Report</strong><br/>";
                $result[] = "<strong> ".$success_ctr."</strong> successfully imported records.<br>";
                $result[] = "<strong> ".$duplicate_ctr."</strong> duplicated records.<br>";
                $result[] = "<strong> ".$failed_ctr."</strong> failed importing records.<br>";
                $log = implode('', $result);
                $response = json_encode(array('result' => 'success', 'message' => 'Successfully Imported', 'log' => $log));
                echo $response;
            } else {
                $response = json_encode(array('result' => 'error', 'message' => 'Something went wrong'));
                echo $response;
            }
        }
        public function _delete_aircraft() {
            if($this->uri->segment(4,0) and $this->uri->segment(4,0) == 'all') {
                if($this->input->post()) {
                    $delete = $this->Aircraft_model->delete_all_aircraft();
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                    } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                    }
                    echo $response;
                } else {
                    redirect(base_url());
                }
            } else {
                if($this->input->post()) {
                    $req = $this->input->post();
                    $id = $req['id'];
                    $delete = $this->Aircraft_model->delete_aircraft($id);
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                   } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                   }
                   echo $response;
                } else {
                    redirect(base_url());
                }
            }
        }
        /**
        ** AIRCRAFT Section END
        **/

        /**
        ** AIRLINE Section START
        **/
        public function airlines() {
            $this->auth->check_admin();
            if($this->uri->segment(3, 0)) {
                $segment = $this->uri->segment(3, 0);
                if(is_numeric($segment)) {
                    $this->_all_airlines();
                } else {
                    if($segment == 'search') {
                        $this->_airline_search();
                    } else if($segment == 'new') {
                        $this->_add_airline();
                    } else if($segment == 'edit') {
                        $this->_edit_airline();
                    } else if($segment == 'import') {
                        $this->_import_airline();
                    } else if($segment == 'delete') {
                        $this->_delete_airline();
                    } else {
                        show_404();
                    }
                }
            } else {
                $this->_all_airlines();
            }
        }
        public function _all_airlines($page = 'airlines') {
            $offset = $this->uri->segment(3, 0);
            $limit = 20;
            $count = count($this->Airline_model->get_airlines());
            $result = $this->Airline_model->get_airlines_paginate($limit, $offset);
            $data['airlines'] = $result['data']->result();
            $config['base_url'] = site_url('admin/airlines');
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
            $data['title'] = 'Airlines - Admin | '.the_config('site_name');       
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/'.$page, $data);
            $this->load->view('admin/templates/footer', $data);
        }
        public function _airline_search($page = 'airlines') {
            if($this->input->get('keyword')) {
                $offset = $this->uri->segment(4, 0);
                $limit = 20;
                $count = count($this->Airline_model->get_airlines($this->input->get('keyword')));
                $result = $this->Airline_model->get_airlines_paginate($limit, $offset, $this->input->get('keyword'));
                $data['airlines'] = $result['data']->result();
                $config['base_url'] = site_url('admin/airlines/search');
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
                $data['title'] = 'Search Airlines - Admin | '.the_config('site_name');     
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            } else {
                redirect(base_url('admin/airlines'));
            }
        }
        public function _add_airline($page = 'add_airline') {
            if($this->input->post()) {
                $request =array(
                    'name' => $this->input->post('name'),
                    'alias' => $this->input->post('alias'),
                    'iata' => strtoupper($this->input->post('iata')),
                    'icao' => strtoupper($this->input->post('icao')),
                    'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('iata').' '.$this->input->post('icao').' '.$this->input->post('name')),
                    'callsign' => $this->input->post('callsign'),
                    'country' => $this->input->post('country'),
                    'is_active' => $this->input->post('is_active'),
                    'created_at' => datetime_now()
                );
                if($this->Airline_model->add_airline($request)) {
                    $id = $this->db->insert_id();
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/airlines/edit/'.$id)));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                $data['title'] = 'Add New Airlines - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _edit_airline($page = 'edit_airline') {
            if($this->uri->segment(4, 0) and is_numeric($this->uri->segment(4, 0))) {
                $id = $this->uri->segment(4, 0);
                if($airline = $this->Airline_model->get_airline_from_id($id)) {
                    if($this->input->post()) {
                        $request =array(
                            'name' => $this->input->post('name'),
                            'alias' => $this->input->post('alias'),
                            'iata' => strtoupper($this->input->post('iata')),
                            'icao' => strtoupper($this->input->post('icao')),
                            'slug' => ($this->input->post('slug')) ? slugify($this->input->post('slug')) : slugify($this->input->post('iata').' '.$this->input->post('icao').' '.$this->input->post('name')),
                            'callsign' => $this->input->post('callsign'),
                            'country' => $this->input->post('country'),
                            'is_active' => $this->input->post('is_active'),
                            'updated_at' => datetime_now()
                        );
                        if($this->Airline_model->update_airline($id, $request)) {
                            $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated'));
                        } else {
                            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                        }
                       echo $response;
                    } else {
                        $data['airline'] = $airline[0];
                        $data['title'] = 'Edit Airline - Admin | '.the_config('site_name');
                        $this->load->view('admin/templates/header', $data);
                        $this->load->view('admin/'.$page, $data);
                        $this->load->view('admin/templates/footer', $data);
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
        public function _import_airline($page = 'import_airline') {
            if(!empty($_FILES['airline']['tmp_name'])) {
                $this->_airline_import_process();
            } else {
                $data['title'] = 'Import Airlines - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _airline_import_process() {
            if(!empty($_FILES['airline']['tmp_name'])) {
                $fh = fopen($_FILES['airline']['tmp_name'], 'r+');
                $success_ctr = 0;
                $duplicate_ctr = 0;
                $failed_ctr = 0;
                $result = array();
                $x = 1;
                while(($row = fgetcsv($fh, 8192)) !== FALSE ) {
                    $name = $row['0'];
                    $cdata = array(
                        'slug' => slugify($row['2'].' '.$row['3'].' '.$name),
                        'name' => $name,
                        'alias' => (isset($row['1'])) ? $row['1'] : NULL,
                        'iata' => (isset($row['2'])) ? $row['2'] : NULL,
                        'icao' => (isset($row['3'])) ? $row['3'] : NULL,
                        'callsign' => (isset($row['4'])) ? $row['4'] : NULL,
                        'country' => (isset($row['5'])) ? $row['5'] : NULL,
                        'is_active' => $row['6'],
                        'created_at' => datetime_now()
                    );
                    if(!$this->Airline_model->get_airline_from_slug($cdata['slug'])) {
                        if($this->Airline_model->add_airline($cdata)) {
                            $result[] = "<strong>(Log: $x) </strong><span class='text-success'>Success Importing: </span>{$cdata['name']}. Slug set to `{$cdata['slug']}`.<br><hr style='margin: 2px'>";
                            $success_ctr++;
                        } else {
                            $result[] = "<strong>(Log: $x) </strong><span class='text-danger'>Failed Importing: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
                            $failed_ctr++;
                        }
                    } else {
                        $result[] = "<strong>(Log: $x) </strong><span class='text-warning'>Duplicate Data: </span>{$cdata['name']}. Slug `{$cdata['slug']}`.<br><hr style='margin: 4px'>";
                        $duplicate_ctr++;
                    }
                    $x++;
                }
                fclose($fh);
                $result[] = "<strong>Report</strong><br/>";
                $result[] = "<strong> ".$success_ctr."</strong> successfully imported records.<br>";
                $result[] = "<strong> ".$duplicate_ctr."</strong> duplicated records.<br>";
                $result[] = "<strong> ".$failed_ctr."</strong> failed importing records.<br>";
                $log = implode('', $result);
                $response = json_encode(array('result' => 'success', 'message' => 'Successfully Imported', 'log' => $log));
                echo $response;
            } else {
                $response = json_encode(array('result' => 'error', 'message' => 'Something went wrong'));
                echo $response;
            }
        }
        public function _delete_airline() {
            if($this->uri->segment(4,0) and $this->uri->segment(4,0) == 'all') {
                if($this->input->post()) {
                    $delete = $this->Airline_model->delete_all_airline();
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                    } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                    }
                    echo $response;
                } else {
                    redirect(base_url());
                }
            } else {
                if($this->input->post()) {
                    $req = $this->input->post();
                    $id = $req['id'];
                    $delete = $this->Airline_model->delete_airline($id);
                    if($delete != 0) {
                        $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
                   } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                   }
                   echo $response;
                } else {
                    redirect(base_url());
                }
            }
        }
        /**
        ** AIRLINE Section END
        **/

        /**
        ** CATEGORY Section START
        **/
        public function category($page = 'category') {
            $this->auth->check_admin();
            if($this->uri->segment(3,0)) {
                $segment = $this->uri->segment(3,0);
                if($segment == 'new') {
                    $this->_add_category();
                } else if($segment == 'edit') {
                    $this->_edit_category();
                } else if($segment == 'delete') {
                    $this->_delete_category();
                } else {
                    show_404();
                }
            } else {
                $data['title'] = 'Category - Admin | '.the_config('site_name');
                $data['categories'] = $this->Category_model->get_categories();
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _add_category() {
            if($this->input->post()) {
                $req = $this->input->post();
                $data = array(
                    'name' => $req['name'],
                    'slug' => slugify($req['slug']),
                    'description' => $req['description']
                );
                if($this->Category_model->add_category($data)) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Posted', 'redirect' => base_url('admin/category')));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
                }
                echo $response;
            } else {
                redirect(base_url('admin/category'));
            }
        }
        public function _edit_category($page = 'edit_category') {
            if($this->input->post()) {
                $req = $this->input->post();
                $id = $req['id'];
                $data = array(
                    'name' => $req['name'],
                    'slug' => slugify($req['slug']),
                    'description' => $req['description'],
                    'updated_at' => datetime_now()
                );
                if($this->Category_model->update_category($id, $data)) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated', 'data' => $data['slug'], 'redirect' => base_url('admin/category')));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                }
               echo $response;
            } else {
                $slug_uri = $this->uri->segment(4, 0);
                $data['categories'] = $this->Category_model->get_categories();
                $res = $this->Category_model->get_category_from_id($slug_uri);
                if($res != 0) {
                    $data['cat'] = $res[0];
                } else {
                    redirect(base_url('admin/dashboard'));
                }
                $data['title'] = 'Update Category - Admin | '.the_config('site_name');
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _delete_category() {
            if($this->input->post()) {
                $req = $this->input->post();
                $id = $req['id'];
                if($this->Category_model->delete_category($id)) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Deleted'));
               } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
               }
               echo $response;
            } else {
                redirect(base_url('admin/category'));
            }
        }
        /**
        ** CATEGORY Section END
        **/

        /**
        ** SETTING Section START
        **/
        public function configuration($page = 'configuration') {
            $this->auth->check_admin();
            if($this->input->post()) {
                $config = $this->input->post('config');
                $config_reponse = array();
                foreach($config as $key => $conf) {
                    $config_response[] = $this->Configuration_model->set_config($key, $conf[0]);
                }
                if($config_response) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated'));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Something went wrong'));
                }
                echo $response;
            } else {
                $data['title'] = 'Configurations - Admin | '.the_config('site_name');
                $data['config'] = $this->Configuration_model->get_config();
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function user($page = 'user') {
            $this->auth->check_admin();
            if($this->uri->segment(3,0)) {
                $segment = $this->uri->segment(3,0);
                if($segment == 'information') {
                    $this->_update_information();
                } else if($segment == 'password') {
                    $this->_update_password();
                } else {
                    show_404();
                }
            } else {
                $data['title'] = 'User Account - Admin | '.the_config('site_name');
                $data['user'] = $this->User_model->get_user($this->auth->session_data()['id']);
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/'.$page, $data);
                $this->load->view('admin/templates/footer', $data);
            }
        }
        public function _update_information() {
            if($this->input->post()) {
                $res = $this->User_model->update_user($this->auth->session_data()['id'], $this->input->post());
                if($res != 0) {
                    $response = json_encode(array('result' => 'success', 'message' => 'Successfully Updated'));
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Oops! Something went wrong.'));
                }
               echo $response;
            } else {
                redirect(base_url('admin/user'));
            }
        }
        public function _update_password() {
            if($this->input->post()) {
                $req = $this->input->post();
                $id = $this->auth->session_data()['id'];
                if($this->User_model->match_password($id, $req['password'])) {
                    if($req['new_pass'] == $req['conf_pass']) {
                        if($req['password'] == $req['new_pass']) {
                            $response = json_encode(array('result' => 'success', 'message' => 'Password changed!', 'redirect' => base_url('admin/logout')));
                        } else {
                            $data['password'] = md5($req['new_pass']);
                            $res = $this->User_model->update_password($id, $data);
                            if($res) {
                                $response = json_encode(array('result' => 'success', 'message' => 'Password changed', 'redirect' => base_url('admin/logout')));
                            } else {
                                $response = json_encode(array('error' => 'success', 'message' => 'Something went wrong!'));
                            } 
                        }
                    } else {
                        $response = json_encode(array('result' => 'error', 'message' => 'Password didn\'t match!'));
                    }
                } else {
                    $response = json_encode(array('result' => 'error', 'message' => 'Incorrect password!'));
                }
               echo $response;                 
            } else {
                redirect(base_url('admin/user'));
            }
        }
        /**
        ** SETTING Section END
        **/
	}