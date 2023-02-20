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
      return $this->db->insert_id();
    }

    public function update($data)
    {
      $sql = "UPDATE colaboradores
              SET   nome = ?,
                    cpf = ?,
                    data_nascimento = ?,
                    email = ?,
                    celular = ?,
                    status = ?
              WHERE id = ?";
      $this->db->query($sql, 
      array(
        $data["nome"],
        $data["cpf"],
        $data["data_nascimento"],
        $data["email"],
        $data["celular"],
        $data["status"],
        $data["id_colaborador"]
        )
      ); 
    }

    public function store_address($id_colaborador, $endereco)
    {
      foreach ($endereco["cep"] as $key => $value):
        $sql = "INSERT INTO colaboradores_enderecos (id_colaborador, cep, rua, numero, bairro, cidade, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, 
          array(
            $id_colaborador,
            $value,
            $endereco["rua"][$key],
            $endereco["numero"][$key],
            $endereco["bairro"][$key],
            $endereco["cidade"][$key],
            $endereco["estado"][$key])
        );
      endforeach;
    }

    public function update_address($id_colaborador, $endereco)
    {
      $sql = "DELETE FROM colaboradores_enderecos WHERE id_colaborador = ?";
      $this->db->query($sql, $id_colaborador);

      foreach ($endereco["cep"] as $key => $value):
        $sql = "INSERT INTO colaboradores_enderecos (id_colaborador, cep, rua, numero, bairro, cidade, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, 
          array(
            $id_colaborador,
            $value,
            $endereco["rua"][$key],
            $endereco["numero"][$key],
            $endereco["bairro"][$key],
            $endereco["cidade"][$key],
            $endereco["estado"][$key])
        );
      endforeach;
    }

    public function store_user($user) 
    {
      $sql = "INSERT INTO usuarios (usuario, senha, data_criacao, id_colaborador)
              VALUES (?, ?, ?, ?)";
      $this->db->query($sql, 
        array(
          $user["usuario"],
          $user["senha"],
          date("Y-m-d H:i:s"),
          $user["id_colaborador"])
      );

      $sql = "INSERT INTO usuarios_permissoes (id_colaborador, menu_colaboradores, menu_produtos, menu_pedidos)
              VALUES (?, ?, ?, ?)";
      $this->db->query($sql, 
        array(
          $user["id_colaborador"],
          $user["menu_colaboradores"],
          $user["menu_produtos"],
          $user["menu_pedidos"])
      );
    }

    public function update_user($user)
    {
      $sql = "UPDATE usuarios
              SET usuario = ?,
                  senha = ?
              WHERE id_colaborador = ?";
      $this->db->query($sql, 
        array(
          $user["usuario"],
          $user["senha"],
          $user["id_colaborador"])
      );
    }

    public function update_permission($user)
    {
      $sql = "UPDATE usuarios_permissoes
      SET menu_colaboradores = ?,
          menu_produtos = ?,
          menu_pedidos = ?
      WHERE id_colaborador = ?";
      $this->db->query($sql, 
      array(
        $user["menu_colaboradores"],
        $user["menu_produtos"],
        $user["menu_pedidos"],
        $user["id_colaborador"]
        )
      );
    }
    
    public function get_colaborador($id)
    {
      $sql = "SELECT colaboradores.*,
                     usuarios.usuario,
                     usuarios_permissoes.menu_colaboradores,
                     usuarios_permissoes.menu_produtos,
                     usuarios_permissoes.menu_pedidos
              FROM colaboradores
              LEFT JOIN usuarios
                ON usuarios.id_colaborador = colaboradores.id
              LEFT JOIN usuarios_permissoes
                ON usuarios_permissoes.id_colaborador = colaboradores.id
              WHERE colaboradores.id = ?";
      return $this->db->query($sql, $id)->result_array()[0];
    }

    public function get_address($id)
    {
      $sql = "SELECT * FROM colaboradores_enderecos WHERE id_colaborador = ?";
      return $this->db->query($sql, $id)->result_array();
    }

    public function ativar_colaborador($id)
    {
      $sql = "UPDATE colaboradores SET status = 'ATIVO' WHERE id = ? ";
      $this->db->query($sql, $id);
    }

    public function desativar_colaborador($id)
    {
      $sql = "UPDATE colaboradores SET status = 'INATIVO' WHERE id = ? ";
      $this->db->query($sql, $id);
    }
  }
?>