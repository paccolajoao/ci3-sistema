<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador extends CI_Controller {
	public function index()
	{
		$this->load->model('colaborador_model');
		$data["colaboradores"] = $this->colaborador_model->index();
		$data["title"] = "Colaboradores - ManyMinds Teste";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/colaborador/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data["title"] = "Colaboradores - ManyMinds Teste";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/colaborador/form');
		$this->load->view('templates/footer');
	}

	public function store()
	{
		/*
		*
		*	VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
		*
		*/
		$this->form_validation->set_rules('form-nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('form-cpf', 'CPF', 'trim|required|min_length[14]');

		if ($this->form_validation->run() == FALSE)
		{
				echo "Deu erro na vailidação";
		}
		else
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
			$this->load->model('colaborador_model');
			$error = $this->colaborador_model->store($this->security->xss_clean($colaborador));
			/*
			 * 
			 *	se não houver erro, retorno um ok na inserção
			 *  
			 */
			if ($error["message"] == "") {
				echo "inseriu de boa";
			}
		}

	}
}