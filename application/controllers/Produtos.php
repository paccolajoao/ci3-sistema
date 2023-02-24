<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

	function __construct() 
	{ 
        parent::__construct();
		permission(); 
		if ($_SESSION["logged_user"][0]["menu_produtos"] != 1) {
			redirect("dashboard");
		}
        $this->load->model('produto_model');
    }

	public function index()
	{
		$data["produtos"] = $this->produto_model->index();
		$data["title"] = "Produtos - ManyMinds Teste";
		$data["menu"] = 'PRODUTOS';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/produtos/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data["title"] = "Adicionar Produto - ManyMinds Teste";
		$data["menu"] = 'PRODUTOS';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/produtos/form');
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$produto = array (
			"nome" => $this->input->post("form-nome"),
			"codigo_barras" => $this->input->post("form-codigo-barras"),
			"descricao" => $this->input->post("form-descricao"),
			"status" => $this->input->post("form-status")
		);
		$this->produto_model->store($this->security->xss_clean($produto));
		redirect("produtos/index");
	}

	public function edit($id)
	{
		$data["title"] = "Editar Produto - ManyMinds Teste";
		$data["menu"] = 'PRODUTOS';
		$data["produto"] = $this->produto_model->get_produto($this->security->xss_clean($id));
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/produtos/form', $data);
		$this->load->view('templates/footer');
	}

	public function alterar($id)
	{
		$produto = array (
			"id_produto" => $id,
			"nome" => $this->input->post("form-nome"),
			"codigo_barras" => $this->input->post("form-codigo-barras"),
			"descricao" => $this->input->post("form-descricao"),
			"status" => $this->input->post("form-status")
		);
		$this->produto_model->update($this->security->xss_clean($produto));
		redirect("produtos/index");
	}

	public function desativar_produto($id)
	{
		$this->produto_model->desativar_produto($this->security->xss_clean($id));
		redirect("produtos/index");
	}

	public function ativar_produto($id)
	{
		$this->produto_model->ativar_produto($this->security->xss_clean($id));
		redirect("produtos/index");
	}
}