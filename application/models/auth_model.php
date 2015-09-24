<?php
class Auth_model extends CI_Model{
	
	
	function validate($username,$password)
	{
		$admin = $this->db->where('username',$username)
						->where('password',md5($password))
						->get('admin')
						->first_row('array');
					
					
					
		if($admin){
			return $admin;	
		}
		return false;
	}
	
	
}