<?php

	class State_model extends CI_Model {

	    public $state;
	    public $abbrev;

	    protected $table = 'states';
		protected $key = 'id';


	    function __construct()
	    {
	        parent::__construct();
	    }

	    public function get_states()
	    {

            $this->db->select('*');
			$this->db->from($this->table);

            $dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function get_state_from_abbrev($abbrev)
	    {

	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    	$this->db->where('abbrev', $abbrev);
	    	
	    	$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }

	    public function search_state($location)
	    {

	    	$this->db->select('*');

	    	$this->db->from($this->table);

	    	$this->db->like('state', $location);

	    	$this->db->or_like('abbrev', $location);

	    	$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			}else{
				return FALSE;
			}
	    }

	    public function add_state($data) {

	        return $this->db->insert($this->table, $data);

		}

		public function delete_state($id) {

			$this->db->where('id', $id);

			return $this->db->delete($this->table);

		}

		public function delete_all_state() {

			return $this->db->empty_table($this->table);

		}

		public function get_state_from_slug($abbrev)
	    {

	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    	$this->db->where('abbrev', $abbrev);
	    	
	    	$dataset = $this->db->get();

			if($dataset->num_rows()){
				return $dataset->result();
			} else {
				return FALSE;
			}
	    }


		public function update_state($id, $data) {

			$this->db->where('id', $id);
			
			return $this->db->update($this->table, $data);

		}

		public function state_validate_slug($slug) {
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
	    
	}