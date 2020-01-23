<?php

class Auth_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}


	public function getUser($login)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('login',$login);
		$query = $this->db->get();
		$user = $query->row();

		return $user;
	}

}
