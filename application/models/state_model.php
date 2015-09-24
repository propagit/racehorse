<?php
class State_model extends CI_Model{
	function __contruct(){
		parent::__contruct();
	}
	
	function get_all() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('state');
		return $query->result_array();
	}
	
	
}