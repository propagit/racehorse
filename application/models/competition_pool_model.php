<?php
class Competition_pool_model extends CI_Model{
	function __contruct(){
		parent::__contruct();
	}
	
	function insert($data){
		$this->db->insert('competition_pool',$data);
		return $this->db->insert_id();
	}
	
	function get_pool_count($entry_id){
		if($entry_id){
			$sql = "SELECT count(pool_id) as total 
					FROM competition_pool 
					WHERE entry_id = ".$entry_id;
			$result = $this->db->query($sql)->row_array();
			return $result['total'];
		}
		return 0;
	}
}