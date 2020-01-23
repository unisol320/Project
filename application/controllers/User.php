<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('startup_model');
	}

	public function profile($id)
	{
		$user = $this->user_model->getUser($id);

		$data['user'] = $user;
		$data['title'] = 'Profile';
		$data['view_name'] = 'users/profile';
		$this->load->view('layouts/main_template', $data);
	}

	public function edit($id)
	{

		$user = $this->user_model->getUser($id);

		$validate = $this->validate('username', 'email');

		try {
			if ($validate) {

				$formArray = array(
					'login' => $_POST['username'],
					'email' => $_POST['email'],
				);

				$this->user_model->updateUser($id, $formArray);

				$db_error = $this->db->error();

				if (!empty($db_error)){
					throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
					return false;
				}

				return TRUE;

				$this->session->set_flashdata('sucsses', 'update sucsses');
				redirect("/", "reload");


			}
		}catch (Exception $e){
			$error =  'error: '. $e->getMessage();
			$data['error'] = $error;
		}

		$data['title'] = 'Edit profile';
		$data['view_name'] = 'users/edit_profile';
		$data['user'] = $user;

		$this->load->view('layouts/main_template', $data);

	}

	public function destroy($id)
	{

		$this->user_model->deleteUser($id);
		$this->session->sess_destroy();
		redirect('/','reload');

	}

	public function addtomyfavorite($id , $user)
	{
		$result = $this->user_model->addToFavorite($id , $user);

		if (!empty($result)){
			$this->session->set_flashdata("error", "This startup in your favorite already");
			redirect('/startup/show/'.$user,'reload');
		}else{
			$this->session->set_flashdata("success", "Added to your favorite.");
			redirect('/startup/show/'.$user,'reload');
		}


	}

	public function favorite($id)
	{
		$user = $this->user_model->getUser($id);
		$startups = $this->user_model->getUserStartups($id);

		foreach ($startups as &$startup){
			$categories = $this->startup_model->getStartupCategories($startup['id']);
			$photos = $this->startup_model->getPhotos($startup['id']);

			$startup['photos_id']  = array_map(function($e)
			{
				return is_object($e) ? $e->id : $e['id'];
			}, $photos);

			$startup['photos_photo']  = array_map(function($e)
			{
				return is_object($e) ? $e->photo : $e['photo'];
			}, $photos);

			$startup['categories']  = implode(",",array_map(function($e)
			{
				return is_object($e) ? $e->name : $e['name'];
			}, $categories));
		}

		$data['startups'] = $startups;
		$data['user'] = $user;
		$data['view_name'] = 'users/investor/favorite';
		$data['title'] = 'My favorite';

		$this->load->view('layouts/main_template' , $data);
	}

	public function deletemyfavorite($user , $id)
	{
		$this->user_model->destroyFavorite($user , $id);

		redirect('/user/favorite/'.$user);
	}

	private function validate($username, $email)
	{
		$this->form_validation->set_rules($username, 'Username' , 'required');
		$this->form_validation->set_rules($email, 'Email');

		return $this->form_validation->run();
	}

}
