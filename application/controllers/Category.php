<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Category extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('category_model');
	}

	public function create($id)
	{
		$post = $this->input->post();

		if(isset($post['save'])){
			$validate = $this->validate('category');
			try {
				if ($validate) {

					$this->category_model->store($post['category']);

					$db_error = $this->db->error();

					if (!empty($db_error)) {
						throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
						return false;
					}

					return TRUE;

				}
			}catch (Exception $e){
				$error =  'error: '. $e->getMessage();
				$data['error'] = $error;
			}

		}

		$user = $this->user_model->getUser($id);
		$data['user'] = $user;
		$data['view_name'] = 'admin/categories/create_category';
		$data['title'] = 'Create category';

		$this->load->view('layouts/main_template' , $data);
	}

	public function show($id)
	{
		$categories = $this->category_model->getAll();
		$user = $this->user_model->getUser($id);

		$data['categories'] = $categories;
		$data['user'] = $user;
		$data['view_name'] = 'admin/categories/show_categories';
		$data['title'] = 'Show categories';

		$this->load->view('layouts/main_template' , $data);
	}

	public function edit($id , $cat)
	{
		$post = $this->input->post();
		if(isset($post['save']))
		{
			$validate = $this->validate('category');
			 try{
			 	if($validate){
					$categoryNew = [
						'name' => $post['category']
					];

					$this->category_model->updateCategory($cat, $categoryNew);

					$db_error = $this->db->error();

					if (!empty($db_error)) {
						throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
						return false;
					}

					return TRUE;

				}
			 }catch(Exception $e){
				 $error =  'error: '. $e->getMessage();
				 $data['error'] = $error;
			 }
		}

		$category = $this->category_model->getOne($cat);
		$user = $this->user_model->getUser($id);

		$data['category'] = $category;
		$data['user'] = $user;
		$data['view_name'] = 'admin/categories/edit_category';
		$data['title'] = 'Edit categories';

		$this->load->view('layouts/main_template' , $data);
	}

	public function destroy($id , $category)
	{
		$this->category_model->destroy($category);

		redirect('/category/show/'.$id , 'reload');
	}

	private function validate($category)
	{
		$this->form_validation->set_rules($category, 'Category' ,'required');

		return $this->form_validation->run();
	}

}
