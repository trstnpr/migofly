<?php

	class Airline_model extends CI_Model {

	    protected $table = 'airlines';
		protected $key = 'id';


	    function __construct()
	    {
	        parent::__construct();
	    }

	    public function get_airlines($keyword=null)
	    {
			if(isset($keyword)) {
				$this->db->like('name', $keyword);
            	$this->db->or_like('alias', $keyword);
            	$this->db->or_like('iata', $keyword);
            	$this->db->or_like('icao', $keyword);
            	$this->db->or_like('callsign', $keyword);
            	$this->db->or_like('country', $keyword);
			}

            $dataset = $this->db->get($this->table);

			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }

	    public function get_airlines_paginate($limit, $offset, $keyword=null)
	    {
	    	$offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;
            if(isset($keyword)) {
            	$this->db->like('name', $keyword);
            	$this->db->or_like('alias', $keyword);
            	$this->db->or_like('iata', $keyword);
            	$this->db->or_like('icao', $keyword);
            	$this->db->or_like('callsign', $keyword);
            	$this->db->or_like('country', $keyword);
			}

			$this->db->order_by('name', 'ASC');
			$result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;
	    }

	    public function get_airline_from_iata($iata)
	    {	
	    	$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('iata', $iata);

			$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function get_airline_from_icao($icao)
	    {	
	    	$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('icao', $icao);

			$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function get_airline_from_slug($slug)
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

	    public function get_airline_from_id($id)
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

	    public function search_airline($keyword) {

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


	    public function delete_airline($id) {

			$this->db->where('id', $id);

			return $this->db->delete($this->table);

		}

		public function delete_all_airline() {

			return $this->db->empty_table($this->table);

		}

		public function add_airline($data) {

	        return $this->db->insert($this->table, $data);

		}

		public function update_airline($id, $data) {

			$this->db->where('id', $id);
			
			return $this->db->update($this->table, $data);

		}

		public function get_paginated_airline($offset, $limit) {

	        $offset = ($offset > 0) ? ($offset - 1) * $limit : $offset;

	        $this->db->order_by('name', 'ASC');

	        $result['data'] = $this->db->get($this->table, $limit, $offset);

	        return $result;
		}

	}