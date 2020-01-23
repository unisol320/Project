<?php

class User_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getUser($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$user = $query->row();

		return $user;
	}

	public function deleteUser($id)
	{
		$this->db->delete('users', array('id' => $id));
	}

	public function updateUser($id , $formArray)
	{
		$this->db->where('id', $id);
		$this->db->update('users' , $formArray);
	}

	public function addToFavorite($startup , $user)
	{
		$this->db->select('*');
		$this->db->from('user_startups_map');
		$this->db->where('user_id' , $user);
		$this->db->where('startup_id' , $startup);
		$query = $this->db->get();
		$connection = $query->row();

		if($connection){
			$error = 'This post in your favorite';
			return $error;
		}else{
			$arrayForm = [
				'user_id' => $user,
				'startup_id' => $startup
			];

			$this->db->insert('user_startups_map' , $arrayForm);
		}
	}

	public function getUserStartups($id)
	{
		$this->db->select('startups.id');
		$this->db->select('startups.country');
		$this->db->select('startups.company');
		$this->db->select('startups.title');
		$this->db->select('startups.descriptions');
		$this->db->from('user_startups_map');
		$this->db->join('startups' , 'startup_id = startups.id');
		$this->db->where('user_startups_map.user_id' , $id);
		$query = $this->db->get();
		$startups = $query->result_array();

		return $startups;
	}

	public function destroyFavorite($user , $id)
	{
		$this->db->delete('user_startups_map', array('user_id' => $user , 'startup_id' => $id));
	}

}
