<?php

	class Aircraft_model extends CI_Model {

	    protected $table = 'aircrafts';
		protected $key = 'id';


	    function __construct()
	    {
	        parent::__construct();
	    }

	    public function get_aircrafts($keyword=null)
	    {
			if(isset($keyword)) {
				$this->db->like('code', $keyword);
            	$this->db->or_like('name', $keyword);
			}

            $dataset = $this->db->get($this->table);

			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }

	    public function get_aircrafts_paginate($limit, $offset, $keyword=null)
	    {
	    	$offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;
            if(isset($keyword)) {
            	$this->db->like('code', $keyword);
            	$this->db->or_like('name', $keyword);
			}

			$this->db->order_by('name', 'ASC');
			$result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;
	    }

	    public function get_aircraft_from_code($code)
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

	    public function get_aircraft_from_slug($slug)
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

	    public function get_aircraft_from_id($id)
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

	    public function search_aircraft($keyword) {

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


	    public function delete_aircraft($id) {

			$this->db->where('id', $id);

			return $this->db->delete($this->table);

		}

		public function delete_all_aircraft() {

			return $this->db->empty_table($this->table);

		}

		public function add_aircraft($data) {

	        return $this->db->insert($this->table, $data);

		}

		public function update_aircraft($id, $data) {

			$this->db->where('id', $id);
			
			return $this->db->update($this->table, $data);

		}

		public function get_paginated_aircraft($offset, $limit) {

	        $offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

	        $this->db->order_by('name', 'ASC');

	        $result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;
		}

	}