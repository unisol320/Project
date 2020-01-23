<?php

class Category_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$query =$this->db->get();
		$categories = $query->result();

		return $categories;
	}

	public function getOne($category)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id' , $category);
		$query =$this->db->get();
		$categories = $query->row();

		return $categories;
	}

	public function updateCategory($id , $formArray)
	{
		$this->db->where('id', $id);
		$this->db->update('categories' , $formArray);
	}

	public function store($categoryName)
	{
		$categoryArray = [
			'name' => $categoryName
		];

		$this->db->insert('categories', $categoryArray);
	}

	public function destroy($id)
	{
		$this->db->delete('categories', array('id' => $id));
	}

}
