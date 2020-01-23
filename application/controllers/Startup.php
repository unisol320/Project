<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Startup extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('startup_model');
		$this->load->model('category_model');
		$this->load->helper('multiuploadfile');
		$this->load->helper('configpagination');
	}

	public function create($id)
	{
		$error = '';
		$categoryArray = [];
		$galery = [];
		$user = $this->user_model->getUser($id);
		$categories = $this->category_model->getAll();
		$validate = $this->validate('company' , 'country' , 'title' , 'descriptions' , 'galery');

		if(isset($_POST['submit'])){

			try {
				if ($validate){

					$post = $this->input->post();

					$galery = multiUpload($_FILES);

					$arrayForm = [
							'user_id' => $id,
							'country' => $post['country'],
							'company' => $post['company'],
							'title' => $post['title'],
							'descriptions' => $post['descriptions'],
						];

					foreach ($this->input->post('category') as $category){
						$categoryArray[] += $category;
					}

					$this->startup_model->store($arrayForm , $categoryArray , $galery);

					$db_error = $this->db->error();


					if (!empty($db_error)) {
						throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
						return false;
					}

					return TRUE;

					redirect('/main' , 'reload');
				}
			} catch (Exception $e) {
				$error =  'error: '. $e->getMessage();
				$data['error'] = $error;
			}

		}

		$data['categories'] = $categories;
		$data['user'] = $user;
		$data['title'] = "Create startup";
		$data['view_name'] = 'startsup/create_startup';

		$this->load->view('layouts/main_template', $data);
	}

	public function show($id , $order = 'desc')
	{
		$user = $this->user_model->getUser($id);
		$categoriesForPage = $this->category_model->getAll();

		$start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$category = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$per_page = 2;
		$uri_segment = 5;
		$base_url = base_url().'startup/show/'.$id.'/'.$order;

		if($user->role == 1){
			$totalRows = $this->startup_model->getUserNumberStartups($id , $order);
			$startups = $this->startup_model->getUserStartups($id , $order , $per_page , $start_index);

			$data['title'] = 'My startap';
		}elseif($user->role == 2){
			$totalRows = $this->startup_model->getAllNumberStartups(1 , $order);
			$startups = $this->startup_model->getAllStartups(1 , $order , $per_page , $start_index, $category);

			$data['title'] = 'Startups';
		}else{
			$totalRows = $this->startup_model->getAllNumberStartups(0 , $order);
			$startups = $this->startup_model->getAllStartups(0 , $order , $per_page , $start_index, $category);

			$data['title'] = 'Admin';
		}

		$config = paginationConfig($base_url ,$id , $order , $totalRows , $per_page , $uri_segment);

		$this->pagination->initialize($config);

		foreach ($startups as $startup)
		{
			$categories = $this->startup_model->getStartupCategories($startup->id);
			$photos = $this->startup_model->getPhotos($startup->id);
			$startup->categories  = implode(",",array_map(function($e)
			{
				return is_object($e) ? $e->name : $e['name'];
			}, $categories));

			$startup->photos_id  = array_map(function($e)
			{
				return is_object($e) ? $e->id : $e['id'];
			}, $photos);

			$startup->photos_photo  = array_map(function($e)
			{
				return is_object($e) ? $e->photo : $e['photo'];
			}, $photos);
		}

		$data["links"] = $this->pagination->create_links();
		$data['categories'] = $categoriesForPage;
		$data['view_name'] = 'startsup/show_all';
		$data['user'] = $user;
		$data['startups'] = $startups;

		$this->load->view('layouts/main_template' , $data);
	}

	public function showEntity($id)
	{
		$startup = $this->startup_model->getOneStartup($id);
		$user = $this->user_model->getUser($startup->user_id);
		$photos = $this->startup_model->getPhotos($id);

		$categories = $this->startup_model->getStartupCategories($startup->id);

		$startup->categories  = implode(",",array_map(function($e)
		{
			return is_object($e) ? $e->id : $e['name'];
		}, $categories));

		$data['photos'] = $photos;
		$data['user'] = $user;
		$data['startup'] = $startup;
		$data['view_name'] = 'startsup/show_one';
		$data['title'] = "One";
		$this->load->view('layouts/main_template' , $data);
	}

	public function doStartupVisible($id , $user)
	{
		$updateArray = [
			'status' => 1
		];

		$this->startup_model->updateStartup($id , $updateArray);

		redirect('/startup/show/'.$user , 'reload');
	}

	public function edit($id , $users)
	{
		$user = $this->user_model->getUser($users);
		$startup = $this->startup_model->getOneStartup($id);
		if(isset($_POST['save'])){
			$validate = $this->validate('company' , 'country' , 'title' , 'descriptions');


			try {
				if ($validate) {

					$formArray = [
						'country' => $_POST['country'],
						'company' => $_POST['company'],
						'title' => $_POST['title'],
						'descriptions' => $_POST['descriptions']
					];

					$this->startup_model->updateStartup($id, $formArray);

					$db_error = $this->db->error();

					if (!empty($db_error)){
						throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
						return false;
					}

					return TRUE;

					$this->session->set_flashdata('sucsses', 'update sucsses');
					redirect("/startup/show/".$users , "reload");

				}
			}catch (Exception $e){
				$error =  'error: '. $e->getMessage();
				$data['error'] = $error;
			}

		}

		$data['user'] = $user;
		$data['startup'] = $startup;
		$data['title'] = 'Edit startup';
		$data['view_name'] = '/startsup/edit_startup';

		$this->load->view('layouts/main_template' , $data);
	}

	public function destroy($id , $user)
	{
		$photos = $this->startup_model->getPhotos($id);
		$this->startup_model->destroy($id);
		foreach ($photos as $photo) {
			unlink("uploads/".$photo['photo']);
		}
		redirect('/startup/show/'.$user , 'reload');
	}

	public function search($id)
	{
		$user = $this->user_model->getUser($id);
		$post = $this->input->post();
		if (isset($post['submit']))
		{
			$startups = $this->startup_model->search($post['search']);
		} else{
			$startups = 0;
		}

		$data['title'] = 'Startups';
		$data['view_name'] = 'startsup/show_all';
		$data['user'] = $user;
		$data['startups'] = $startups;

		$this->load->view('layouts/main_template' , $data);
	}

	private function validate($company , $country , $title , $description , $galery)
	{
		$this->form_validation->set_rules($company, 'Company' ,'required');
		$this->form_validation->set_rules($country, 'Country' ,'required');
		$this->form_validation->set_rules($title, 'Title' ,'required');
		$this->form_validation->set_rules($description, 'Descriptions' ,'required');
		if (empty($_FILES[$galery]['name']))
		{
			$this->form_validation->set_rules($galery, 'File..', 'required');
		}
		return $this->form_validation->run();
	}

}
