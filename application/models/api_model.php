<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }

    public function verificaAutenticacao($token)
    {
        $token_ = explode(" ", $token)[1];
        $user = explode(":", base64_decode($token_))[0];
        $pass = sha1(explode(":", base64_decode($token_))[1]);

        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
        $auth = $this->db->query($sql, 
                    array(
                        $user,
                        $pass)
                );
        
        // Encontrou esse usuário e senha
        if ($auth->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function pedidos_finalizados() 
    {
        // Seleciono os colaboradores
        $sql = "SELECT colaboradores.*
                FROM colaboradores";
        $usuarios = $this->db->query($sql)->result_array();
        $arr_usuarios = [];
        foreach ($usuarios as $key => $usuario) {
            $arr_usuarios[$usuario["id"]] = $usuario;
        }

        $sql = "SELECT pedidos.*
                FROM pedidos
                WHERE pedidos.status = 'FINALIZADO'";
        $pedidos = $this->db->query($sql)->result_array();
        $arr_pedidos_finalizados = [];
        foreach ($pedidos as $key => $pedido) {
            # Seleciono os itens do pedido
            $sql = "SELECT pedidos_itens.*,
                           produtos.*
                    FROM pedidos_itens
                    INNER JOIN produtos
                        ON produtos.id = pedidos_itens.id_item
                    WHERE pedidos_itens.id_pedido = ?";
            $itens = $this->db->query($sql, $pedido["id"])->result_array();
            $pedido["nome_fornecedor"] = $arr_usuarios[$pedido["id_fornecedor"]]["nome"];
            $pedido["nome_responsavel"] = $arr_usuarios[$pedido["id_responsavel"]]["nome"];
            $pedido["itens"] = $itens;
            $arr_pedidos_finalizados[]= $pedido;
        }
        return $arr_pedidos_finalizados;
    }
}