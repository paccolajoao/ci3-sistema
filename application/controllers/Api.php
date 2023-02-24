<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('api_model');
    }
    
    public function pedidos_finalizados() 
    {
        $headers = $this->input->request_headers();
        
        if(isset($headers['Authorization']) && !empty($headers['Authorization'])) {
            $token = $headers['Authorization'];
            if($this->tokenValido($token)) {
                $pedidos = $this->api_model->pedidos_finalizados();
                $response = array(
                    'success' => true,
                    'pedidos_finalizados' => $pedidos
                );
            } else {
                $response = array(
                    'success' => false,
                    'mensagem' => 'Token invalido'
                );
            }
        } else {
            $response = array(
                'success' => false,
                'mensagem' => 'Token nao encontrado'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    private function tokenValido($token) 
    {
        /**
         * 
         * AUTENTICAÇÃO BASIC COM USUARIO E SENHA DO SISTEMA
         * 
         */
        // Verifico se o token é valido
        if ($this->api_model->verificaAutenticacao($token)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}