<?php
class Competition_invites_model extends CI_Model{
	function __contruct(){
		parent::__contruct();
	}
	
	function insert($data){
		$this->db->insert('competition_invites',$data);
		return $this->db->insert_id();
	}
	
	function get_invites($entry_id)
	{
		$invites = $this->db->where('entry_id',$entry_id)
						    ->get('competition_invites')
							->result_array();
		return $invites;
			
	}
	
	function get_invites_for_csv($entry_id)
	{
		$invites = $this->db->select('invitee_email')
							->where('entry_id',$entry_id)
						    ->get('competition_invites')
							->result_array();
		return $invites;
			
	}
	
}