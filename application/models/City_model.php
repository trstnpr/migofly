<?php

	class City_model extends CI_Model {

	    protected $table = 'cities';
		protected $key = 'id';


	    function __construct()
	    {
	        parent::__construct();
	    }

	    public function get_cities($keyword=null)
	    {
	    	$this->db->select($this->table.'.*, countries.name as country_name');

            if(isset($keyword)) {
            	$this->db->like($this->table.'.code', $keyword);
            	$this->db->or_like($this->table.'.name', $keyword);
            	$this->db->or_like($this->table.'.country', $keyword);
            	$this->db->or_like('countries.name', $keyword);
			}

			$this->db->join('countries', $this->table.'.country = countries.code', 'left');

            $dataset = $this->db->get($this->table);
			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }

	    public function get_cities_paginate($limit, $offset, $keyword=null)
	    {
	    	$offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

	    	$this->db->select($this->table.'.*, countries.name as country_name');

            if(isset($keyword)) {
            	$this->db->like($this->table.'.code', $keyword);
            	$this->db->or_like($this->table.'.name', $keyword);
            	$this->db->or_like($this->table.'.country', $keyword);
            	$this->db->or_like('countries.name', $keyword);
			}

			$this->db->join('countries', $this->table.'.country = countries.code', 'left');
			$this->db->limit($limit, $offset);
			$this->db->order_by($this->table.'.name', 'ASC');

			$result['data'] = $this->db->get($this->table);

	        return $result;
	    }

	    public function get_city_from_code($code)
	    {	
	    	$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('code', $code);

			$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function get_cities_from_country_code($code)
	    {	
			$this->db->where('country', $code);

			$dataset = $this->db->get($this->table);

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function get_cities_from_country_code_paginate($limit, $offset, $code)
	    {
	    	$offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

	    	$this->db->select($this->table.'.*, countries.name as country_name');
			$this->db->where($this->table.'.country', $code);
			$this->db->join('countries', $this->table.'.country = countries.code', 'left');
			$this->db->limit($limit, $offset);
			$this->db->order_by($this->table.'.name', 'ASC');

			$result['data'] = $this->db->get($this->table);

	        return $result;
	    }

	    public function get_city_from_slug($slug)
	    {	
	    	$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('slug', $slug);

			$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function get_city_from_id($id)
	    {	
	    	$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id', $id);

			$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function search_city($keyword) {

	    	$this->db->select('*');

	    	$this->db->from($this->table);

	    	$this->db->like('name', $keyword);

	    	$this->db->limit(10);

	    	$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }


	    public function delete_city($id) {

			$this->db->where('id', $id);

			return $this->db->delete($this->table);

		}

		public function delete_all_city() {

			return $this->db->empty_table($this->table);

		}

		public function add_city($data) {

	        return $this->db->insert($this->table, $data);

		}

		public function update_city($id, $data) {

			$this->db->where('id', $id);
			
			return $this->db->update($this->table, $data);

		}

		public function search_count($keyword) {
			$this->db->select($this->table.'.*, countries.name as country_name');
	    	$this->db->from($this->table);
	    	$this->db->join('countries', $this->table.'.country = countries.code', 'left');
			$this->db->like($this->table.'.name', $keyword);
			$this->db->or_like($this->table.'.code', $keyword);
			$this->db->or_like($this->table.'.country', $keyword);
			$this->db->or_like('countries.code', $keyword);
			$this->db->or_like('countries.name', $keyword);
			$this->db->order_by($this->table.'.name', 'ASC');
			$dataset = $this->db->count_all_results();

			return $dataset;
		}

		public function search_paginated($keyword, $offset, $limit) {

			$offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

			$this->db->select($this->table.'.*, countries.name as country_name');
	    	$this->db->from($this->table);
	    	$this->db->join('countries', $this->table.'.country = countries.code', 'left');
			$this->db->like($this->table.'.name', $keyword);
			$this->db->or_like($this->table.'.code', $keyword);
			$this->db->or_like($this->table.'.country', $keyword);
			$this->db->or_like('countries.code', $keyword);
			$this->db->or_like('countries.name', $keyword);
			$this->db->order_by($this->table.'.name', 'ASC');
			$this->db->limit($limit, $offset);

	        $dataset = $this->db->get();

			if($dataset->num_rows()) {
				$result['data'] = $dataset->result();
				return $result;
			} else {
				return FALSE;
			}

		}

		public function get_paginated_city($offset, $limit) {

	        $offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

	        // $this->db->join('countries', $this->table.'.country = countries.code', 'left');
	        $this->db->order_by('name', 'ASC');

	        $result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;

		}

		public function get_cities_limited($limit, $offset)
	    {
			$this->db->limit($limit, $offset);
            $dataset = $this->db->get($this->table);
			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }

	}