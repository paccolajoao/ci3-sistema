<?php

  class Colaborador_model extends CI_Model {

    public function index()
    {
      $sql = "SELECT * FROM colaboradores ORDER BY `nome`";
      return $this->db->query($sql)->result_array();
    }

    public function store($data)
    {
      $sql = "INSERT INTO colaboradores (nome, cpf, data_nascimento, email, celular, funcao, status)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
      $this->db->query($sql, 
        array(
          $data["nome"],
          $data["cpf"],
          $data["data_nascimento"],
          $data["email"],
          $data["celular"],
          $data["funcao"],
          $data["status"])
      );
      return $this->db->error(); 
    }
  }
?>