<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() { 
        parent::__construct(); 
        $this->load->model('login_model');
    }

	public function index()
	{
		$data["title"] = "Login - ManyMinds Teste";
		// Verifico se o sistema está logado
		if (isset($_SESSION["logged_user"])) {
			redirect('dashboard');
		} else {
			$this->load->view('pages/login');
		}
	}

	public function check_login()
	{
		$user_login = array (
			"user" => $this->input->post("form-user"),
			"pass" => sha1($this->input->post("form-password")),
			"user_ip" => $_SERVER['REMOTE_ADDR']
		);

		if ($this->login_model->failed_login($this->security->xss_clean($user_login))) {
			$logged_user = $this->login_model->login($this->security->xss_clean($user_login));
		} else {
			$this->session->set_userdata("fail_login", "2");
			redirect('login');
		}

		// Caso tenha um usuário logado
		if (count($logged_user) > 0) {
			$this->session->set_userdata("logged_user", $logged_user);
			$this->session->unset_userdata("fail_login");
			$this->login_model->clean_failed_login($this->security->xss_clean($user_login));
			redirect('dashboard');
		} else {
			$this->session->set_userdata("fail_login", "1");
			$this->session->unset_userdata("logged_user");
			$this->login_model->add_failed_login($this->security->xss_clean($user_login));
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("logged_user");
		redirect('login');
	}
}