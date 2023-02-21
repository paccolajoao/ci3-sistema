<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	function __construct() { 
        parent::__construct();
		permission(); 
		if ($_SESSION["logged_user"][0]["menu_pedidos"] != 1) {
			redirect("dashboard");
		}
        $this->load->model('pedido_model');
    }

	public function index()
	{
		$data["title"] = "Pedidos - ManyMinds Teste";
		$data["menu"] = 'PEDIDOS';
		$data["pedidos"] = $this->pedido_model->index();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/pedidos/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data["title"] = "Adicionar Pedido - ManyMinds Teste";
		$data["menu"] = 'PEDIDOS';
		$data["fornecedores"] = $this->pedido_model->get_fornecedores();
		$data["itens"] = $this->pedido_model->get_itens();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/pedidos/form', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$pedido = array (
			"id_fornecedor" => $this->input->post("form-fornecedor"),
			"status" => $this->input->post("form-status"),
			"observacao" => $this->input->post("form-observacao")
		);

		$id_pedido = $this->pedido_model->store($this->security->xss_clean($pedido));
		$this->pedido_model->store_itens($id_pedido, $this->security->xss_clean($this->input->post("itens")));
		redirect("pedidos/index");
	}

	public function edit($id)
	{
		$data["title"] = "Editar Pedido - ManyMinds Teste";
		$data["menu"] = 'PEDIDOS';
		$data["fornecedores"] = $this->pedido_model->get_fornecedores();
		$data["itens"] = $this->pedido_model->get_itens();
		$data["pedido"] = $this->pedido_model->get_pedido($this->security->xss_clean($id));
		$data["pedido_itens"] = $this->pedido_model->get_pedido_itens($this->security->xss_clean($id));
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('pages/pedidos/form', $data);
		$this->load->view('templates/footer');
	}

	public function alterar($id){
		$pedido = array (
			"id_pedido" => $id,
			"id_fornecedor" => $this->input->post("form-fornecedor"),
			"status" => $this->input->post("form-status"),
			"observacao" => $this->input->post("form-observacao")
		);
		$this->pedido_model->update($this->security->xss_clean($pedido));
		$this->pedido_model->update_itens($id, $this->security->xss_clean($this->input->post("itens")));
		redirect("pedidos/index");
	}

	public function delete($id){
		$this->pedido_model->delete($this->security->xss_clean($id));
		redirect("pedidos/index");
	}

	public function finalizar_pedido($id) {
		$this->pedido_model->finalizar_pedido($this->security->xss_clean($id));
		redirect("pedidos/index");
	}

	public function ativar_pedido($id) {
		$this->pedido_model->ativar_pedido($this->security->xss_clean($id));
		redirect("pedidos/index");
	}
}