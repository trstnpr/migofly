<?php

	class Country_model extends CI_Model {
	    protected $table = 'countries';
		protected $key = 'id';

	    function __construct()
	    {
	        parent::__construct();
	    }

	    public function get_countries($keyword=null)
	    {
			if(isset($keyword)) {
				$this->db->like('code', $keyword);
            	$this->db->or_like('name', $keyword);
            	$this->db->or_like('background', $keyword);
            	$this->db->or_like('map_reference', $keyword);
			}

            $dataset = $this->db->get($this->table);

			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }

	    public function get_countries_paginate($limit, $offset, $keyword=null)
	    {
	    	$offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;
            if(isset($keyword)) {
            	$this->db->like('code', $keyword);
            	$this->db->or_like('name', $keyword);
            	$this->db->or_like('background', $keyword);
            	$this->db->or_like('map_reference', $keyword);
			}

			$this->db->order_by('name', 'ASC');
			$result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;
	    }

	    public function get_country_from_code($code)
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

	    public function get_country_from_slug($slug)
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

	    public function get_country_from_id($id)
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

	    public function search_country($keyword) {

	    	$this->db->select('*');

	    	$this->db->from($this->table);

	    	$this->db->like('country', $keyword);

	    	$this->db->limit(10);

	    	$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }


	    public function delete_country($id) {

			$this->db->where('id', $id);

			return $this->db->delete($this->table);

		}

		public function delete_all_country() {

			return $this->db->empty_table($this->table);

		}

		public function add_country($data) {

	        return $this->db->insert($this->table, $data);

		}

		public function update_country($id, $data) {

			$this->db->where('id', $id);
			
			return $this->db->update($this->table, $data);

		}

		public function get_paginated_country($offset, $limit) {

	        $offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

	        $this->db->order_by('name', 'ASC');

	        $result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;
		}

	}