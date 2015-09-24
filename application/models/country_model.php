<?php
class Country_model extends CI_Model{
	function __contruct(){
		parent::__contruct();
	}
	
	
	function get_all() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('countries');
		return $query->result_array();
	}
	
}