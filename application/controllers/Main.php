<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		if (isset($_SESSION['id'])){
			$user = $this->user_model->getUser($_SESSION['id']);
			$data['user'] = $user;
		}
		$data['title'] = "Main";

		$this->load->view('layouts/header' , $data);
		$this->load->view('main' , $data);
		$this->load->view('layouts/footer');
	}


}
