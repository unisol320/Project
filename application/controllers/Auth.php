<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}


	public function register()
	{
		$error = '';
		if (isset($_POST['register'])) {

			$validate = $this->validate('username', 'email', 'password', 'password_confirm', 'role');

			try {
				if ($validate) {

					$data = array(
						'login' => $_POST['username'],
						'email' => $_POST['email'],
						'password' => trim(password_hash($_POST['password'], PASSWORD_BCRYPT)),
						'role' => $_POST['role']
					);

					 $this->db->insert('users', $data);

						$db_error = $this->db->error();

					if (!empty($db_error)){
						throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
						return false;
					}

					return TRUE;

					$this->session->set_flashdata("success", "Your accoun created.");
					redirect("/auth/register", "reload");
				}

			} catch (Exception $e) {
				$error =  'error: '. $e->getMessage();
				$data['error'] = $error;
			}

		}

		$data['title'] = "register";
		$data['view_name'] = 'auth/registration';


		$this->load->view('layouts/main_template', $data);
	}

	public function login()
	{

		$validate = $this->validate('username', 'default', 'password');

		if ($validate) {
			$user = $this->auth_model->getUser($_POST['username']);
			if(!empty($user)){
				if (password_verify($_POST['password'], $user->password)) {
					if ($user->email) {
						$this->session->set_flashdata("success", "You are logged");
						$_SESSION['user_logged'] = TRUE;
						$_SESSION['id'] = $user->id;
						$data['user'] = $user;
						redirect('/main', 'refresh');
					} else {
						$data['error'] = "User password wrong.";
					}
				}
			}else{
				$data['error'] = "User login not exist.";
			}
		}


		$data['title'] = "login";
		$data['view_name'] = 'auth/login';


		$this->load->view('layouts/main_template', $data);
	}

	public function destroy()
	{
		$this->session->sess_destroy();
		redirect('main', 'refresh');
	}

	private function validate($username = 'default', $email = 'default', $password = 'default', $password_confirm = 'default', $role = 'default')
	{

		if ($email != 'default') {
			$this->form_validation->set_rules($username, 'Username', 'required');
			$this->form_validation->set_rules($email, 'Email', 'required');
			$this->form_validation->set_rules($password, 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules($password_confirm, 'Confirm password', 'required|min_length[6]|matches[password]');
			$this->form_validation->set_rules($role ,'required');
		} else {
			$this->form_validation->set_rules($username, 'Username', 'required');
			$this->form_validation->set_rules($password, 'Password', 'required|min_length[6]');
		}
		return $this->form_validation->run();

	}

}
