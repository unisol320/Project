<?php

class Startup_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getUserStartups($id , $order='desc' , $limit , $start)
	{
		$this->db->select('*');
		$this->db->from('startups');
		$this->db->where('user_id' , $id);
		$this->db->order_by('id' , $order);
		$this->db->limit($limit , $start);
		$query = $this->db->get();
		$startups = $query->result();

		return $startups;
	}

	public function getPhotos($id)
	{
		$this->db->select('galery.photo');
		$this->db->select('galery.id');
		$this->db->from('startups');
		$this->db->join('galery' , 'startup_id = startups.id');
		$this->db->where('startup_id' , $id);
		$query = $this->db->get();
		$photos = $query->result_array();

		return $photos;
	}

	public function getAllStartups($status , $order='desc' , $limit , $start , $category='default')
	{
		if($category == 'default'){
			$this->db->select('*');
			$this->db->from('startups');
			$this->db->where('status' , $status);
			$this->db->order_by('id' , $order);
			$this->db->limit($limit , $start);
			$query = $this->db->get();
			$startups = $query->result();
		}else{
			$this->db->select('startups.id');
			$this->db->select('startups.user_id');
			$this->db->select('startups.country');
			$this->db->select('startups.company');
			$this->db->select('startups.title');
			$this->db->select('startups.descriptions');
			$this->db->select('startups.status');
			$this->db->from('category_startup');
			$this->db->join('startups' , 'startup_id = startups.id');
			$this->db->where('category_id' , $category);
			$this->db->where('startups.status' , $status);
			$this->db->order_by('id' , $order);
			$this->db->limit($limit , $start);
			$query = $this->db->get();
			$startups = $query->result();
		}

		return $startups;
	}

	public function updateStartup($id , $formArray)
	{
		$this->db->where('id', $id);
		$this->db->update('startups' , $formArray);
	}

	public function destroy($id)
	{
		$this->db->delete('startups', array('id' => $id));
	}

	public function getOneStartup($id)
	{
		$this->db->select('*');
		$this->db->from('startups');
		$this->db->where('id' , $id);
		$query = $this->db->get();
		$startup = $query->row();

		return $startup;
	}

	public function search($search)
	{
		$this->db->select('*');
		$this->db->from('startups');
		$this->db->like('title' , $search);
		$this->db->or_like('country' , $search);
		$this->db->or_like('company' , $search);
		$this->db->or_like('country' , $search);
		$this->db->or_like('descriptions' , $search);
		$this->db->or_like('country' , $search);
		$query = $this->db->get();
		$startups = $query->result();

		return $startups;
	}

	public function getUserNumberStartups($id , $order)
	{
		$this->db->select('*');
		$this->db->from('startups');
		$this->db->where('user_id' , $id);
		$this->db->order_by('id' , $order);
		$query = $this->db->get();
		$startups = $query->num_rows();

		return $startups;
	}

	public function getAllNumberStartups($status , $order)
	{
		$this->db->select('*');
		$this->db->from('startups');
		$this->db->where('status' , $status);
		$this->db->order_by('id' , $order);
		$query = $this->db->get();
		$startups = $query->num_rows();

		return $startups;
	}

	public function store($startup , $categories , $galery)
	{
		$this->db->insert('startups' , $startup);

		$startup_id = $this->db->insert_id();

		foreach ($galery as $image){
			$arrayGalery = [
				'startup_id' => $startup_id,
				'photo' => $image
			];
			$this->db->insert('galery' , $arrayGalery);
		}

		foreach ($categories as $key => $value){
			$arrayCategories = [
				'category_id' => $value,
				'startup_id' => $startup_id
			];
			$this->db->insert('category_startup' , $arrayCategories);
		}
	}

	public function getStartupCategories($id)
	{
		$this->db->select('categories.name');
		$this->db->from('category_startup');
		$this->db->join('categories' , 'category_id = categories.id');
		$this->db->where('startup_id' , $id);
		$query = $this->db->get();
		$category = $query->result_array();

		return $category;
	}

}

