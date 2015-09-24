<?php
class Competition_entry_model extends CI_Model{
	function __contruct(){
		parent::__contruct();
	}
	
	function insert($data){
		$this->db->insert('competition_entry',$data);
		return $this->db->insert_id();
	}
	
	function update($entry_id,$data){
		$this->db->where('entry_id',$entry_id);
		$this->db->update('competition_entry',$data);
		return $this->db->affected_rows();	
	}
	
	function get_entry($entry_id){
		return $this->db->where('entry_id',$entry_id)
						->get('competition_entry')
						->first_row('array');
		
	}
	
	function check_duplicate($email){
		$result =  $this->db->where('email',$email)
						->get('competition_entry')
						->first_row('array');
		if($result){
			return $result;	
		}
		return false;
	}
	
	function get_entry_by_field($field_name,$field_value){
		return $this->db->where($field_name,$field_value)
						->get('competition_entry')
						->first_row('array');
	}
	
	function get_all($order = 'desc'){
		return $this->db->order_by('entry_id',$order)
						->get('competition_entry')
						->result_array();	
	}
	
	# the search only checks the last name first name and the email field
	function search($keyword = ""){
		if($keyword){
			$sql = "SELECT * FROM competition_entry c
					WHERE 
						(c.firstname LIKE '%" . $keyword . "%'
							OR c.lastname LIKE '%" . $keyword . "%'
							OR c.email LIKE '%" . $keyword . "%' 
							OR CONCAT(c.firstname, ' ',c.lastname) LIKE '%" . $keyword . "%')
					ORDER BY c.firstname ASC";
			return $this->db->query($sql)
							->result_array();
					
		}else{
			return $this->get_all();	
		}
		
	}
	
	function get_entry_by_inviter_token_for_csv($token)
	{
		return $this->db->select('email')
						->where('inviter_token',$token)
						->get('competition_entry')
						->result_array();	
	}
	
}