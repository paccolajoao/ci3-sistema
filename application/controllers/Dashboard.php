<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		$data["title"] = "Dashboard - ManyMinds Teste";
		$data["menu"] = 'HOME';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/dashboard');
		$this->load->view('templates/footer');
	}
}