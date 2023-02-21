<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador extends CI_Controller {

	function __construct() { 
        parent::__construct();
		permission(); 
        $this->load->model('colaborador_model');
    } 

	public function index()
	{
		
		$data["colaboradores"] = $this->colaborador_model->index();
		$data["title"] = "Colaboradores - ManyMinds Teste";
		$data["menu"] = 'COLABORADORES';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/colaborador/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data["title"] = "Adicionar Colaborador - ManyMinds Teste";
		$data["menu"] = 'COLABORADORES';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/colaborador/form');
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$data["title"] = "Editar Colaborador - ManyMinds Teste";
		$data["menu"] = 'COLABORADORES';
		$data["colaborador"] = $this->colaborador_model->get_colaborador($this->security->xss_clean($id));
		$data["colaborador"]["enderecos"] = $this->colaborador_model->get_address($this->security->xss_clean($id));
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/colaborador/form', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$colaborador = array (
			"nome" => $this->input->post("form-nome"),
			"cpf" => $this->input->post("form-cpf"),
			"data_nascimento" => $this->input->post("form-data-nascimento"),
			"email" => $this->input->post("form-email"),
			"celular" => $this->input->post("form-celular"),
			"funcao" => $this->input->post("form-funcao"),
			"status" => $this->input->post("form-status")
		);
		$id_colaborador = $this->colaborador_model->store($this->security->xss_clean($colaborador));
		$this->colaborador_model->store_address($id_colaborador, $this->security->xss_clean($this->input->post("endereco")));

		// Se for colaborador, insiro na tabela de usuários
		if ($this->input->post("form-funcao") == "COLABORADOR") {
			$user = array (
				"id_colaborador" => $id_colaborador,
				"usuario" => $this->input->post("form-usuario"),
				"senha" => sha1($this->input->post("form-senha")),
				"menu_colaboradores" => $this->input->post("form-menu-colaboradores"),
				"menu_produtos" => $this->input->post("form-menu-produtos"),
				"menu_pedidos" => $this->input->post("form-menu-pedidos")
			);
			$this->colaborador_model->store_user($this->security->xss_clean($user));
		}
		redirect("colaborador/index");
	}

	public function alterar($id){
		$colaborador = array (
			"id_colaborador" => $id,
			"nome" => $this->input->post("form-nome"),
			"cpf" => $this->input->post("form-cpf"),
			"data_nascimento" => $this->input->post("form-data-nascimento"),
			"email" => $this->input->post("form-email"),
			"celular" => $this->input->post("form-celular"),
			"status" => $this->input->post("form-status")
		);
		$this->colaborador_model->update($this->security->xss_clean($colaborador));
		$this->colaborador_model->update_address($id, $this->security->xss_clean($this->input->post("endereco")));

		// Se for colaborador, altero na tabela de usuários
		if ($this->input->post("form-hidden-funcao") == "COLABORADOR") {
			$user = array (
				"id_colaborador" => $id,
				"usuario" => $this->input->post("form-usuario"),
				"senha" => sha1($this->input->post("form-senha")),
				"menu_colaboradores" => $this->input->post("form-menu-colaboradores"),
				"menu_produtos" => $this->input->post("form-menu-produtos"),
				"menu_pedidos" => $this->input->post("form-menu-pedidos")
			);
			
			// Se tiver preenchido algo na senha
			if (($this->input->post("form-confirmacao-senha") == $this->input->post("form-senha")) && ($this->input->post("form-senha") != "")) {
				$this->colaborador_model->update_user($this->security->xss_clean($user));
			}

			$this->colaborador_model->update_permission($this->security->xss_clean($user));
		}
		redirect("colaborador/index");
	}

	public function desativar_colaborador($id) {
		$this->colaborador_model->desativar_colaborador($this->security->xss_clean($id));
		redirect("colaborador/index");
	}

	public function ativar_colaborador($id) {
		$this->colaborador_model->ativar_colaborador($this->security->xss_clean($id));
		redirect("colaborador/index");
	}
}