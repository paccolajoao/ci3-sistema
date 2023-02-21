<?php

  class Produto_model extends CI_Model {

    public function index()
    {
      $sql = "SELECT * FROM produtos ORDER BY `nome`";
      return $this->db->query($sql)->result_array();
    }

    public function store($data)
    {
      $sql = "INSERT INTO produtos (nome, codigo_barras, descricao, status)
              VALUES (?, ?, ?, ?)";
      $this->db->query($sql, 
        array(
          $data["nome"],
          $data["codigo_barras"],
          $data["descricao"],
          $data["status"])
      );
      return $this->db->insert_id();
    }

    public function update($data)
    {
      $sql = "UPDATE produtos
              SET   nome = ?,
                    codigo_barras = ?,
                    descricao = ?,
                    status = ?
              WHERE id = ?";
      $this->db->query($sql, 
      array(
        $data["nome"],
        $data["codigo_barras"],
        $data["descricao"],
        $data["status"],
        $data["id_produto"]
        )
      ); 
    }

    public function get_produto($id)
    {
      $sql = "SELECT * FROM produtos
              WHERE id = ?";
      return $this->db->query($sql, $id)->result_array()[0];
    }

    public function ativar_produto($id)
    {
      $sql = "UPDATE produtos SET status = 'ATIVO' WHERE id = ? ";
      $this->db->query($sql, $id);
    }
  
    public function desativar_produto($id)
    {
      $sql = "UPDATE produtos SET status = 'INATIVO' WHERE id = ? ";
      $this->db->query($sql, $id);
    }
  }

?>