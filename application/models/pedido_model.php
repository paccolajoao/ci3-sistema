<?php

  class Pedido_model extends CI_Model {

    public function index()
    {
      $sql = "SELECT pedidos.*,
                     colaboradores.nome as nome_colaborador
              FROM pedidos
              INNER JOIN colaboradores
                ON colaboradores.id = pedidos.id_fornecedor
              ORDER BY pedidos.data_criacao";
      return $this->db->query($sql)->result_array();
    }

    public function get_fornecedores()
    {
      $sql = "SELECT id, nome 
              FROM colaboradores 
              WHERE status = 'ATIVO' 
                AND funcao = 'FORNECEDOR' 
              ORDER BY nome";
      return $this->db->query($sql)->result_array();
    }

    public function get_itens()
    {
      $sql = "SELECT *
              FROM produtos 
              WHERE status = 'ATIVO' 
              ORDER BY nome";
      return $this->db->query($sql)->result_array();
    }

    public function store($data)
    {
      $sql = "INSERT INTO pedidos (data_criacao, id_fornecedor, id_responsavel, observacao, status)
              VALUES (?, ?, ?, ?, ?)";
      $this->db->query($sql, 
        array(
          date("Y-m-d H:i:s"),
          $data["id_fornecedor"],
          $data["id_responsavel"],
          $data["observacao"],
          $data["status"])
      );
      return $this->db->insert_id();
    }

    public function store_itens($id_pedido, $itens)
    {
      foreach ($itens["item"] as $key => $value):
        $valor_un = str_replace(",", ".", str_replace(".", "", $itens["valor_un"][$key]));
        $sql = "INSERT INTO pedidos_itens (id_pedido, id_item, quantidade, valor_unitario)
                VALUES (?, ?, ?, ?)";
        $this->db->query($sql, 
          array(
            $id_pedido,
            $value,
            $itens["qtde"][$key],
            $valor_un)
        );
      endforeach;
    }

    public function update($data)
    {
      $sql = "UPDATE pedidos
              SET   id_fornecedor = ?,
                    observacao = ?,
                    status = ?
              WHERE id = ?";
      $this->db->query($sql, 
      array(
        $data["id_fornecedor"],
        $data["observacao"],
        $data["status"],
        $data["id_pedido"]
        )
      ); 
    }

    public function update_itens($id_pedido, $itens)
    {
      $sql = "DELETE FROM pedidos_itens WHERE id_pedido = ?";
      $this->db->query($sql, $id_pedido);

      foreach ($itens["item"] as $key => $value):
        $valor_un = str_replace(",", ".", str_replace(".", "", $itens["valor_un"][$key]));
        $sql = "INSERT INTO pedidos_itens (id_pedido, id_item, quantidade, valor_unitario)
                VALUES (?, ?, ?, ?)";
        $this->db->query($sql, 
          array(
            $id_pedido,
            $value,
            $itens["qtde"][$key],
            $valor_un)
        );
      endforeach;
    }

    public function delete($id_pedido)
    {
      $sql = "DELETE FROM pedidos WHERE id  = ?";
      $this->db->query($sql, $id_pedido);

      $sql = "DELETE FROM pedidos_itens WHERE id_pedido = ?";
      $this->db->query($sql, $id_pedido);
    }

    public function get_pedido($id)
    {
      $sql = "SELECT * FROM pedidos
              WHERE id = ?";
      return $this->db->query($sql, $id)->result_array()[0];
    }

    public function get_pedido_itens($id)
    {
      $sql = "SELECT * FROM pedidos_itens
              WHERE id_pedido = ?";
      return $this->db->query($sql, $id)->result_array();
    }

    public function finalizar_pedido($id)
    {
      $sql = "UPDATE pedidos SET status = 'FINALIZADO' WHERE id = ? ";
      $this->db->query($sql, $id);
    }
  
    public function ativar_pedido($id)
    {
      $sql = "UPDATE pedidos SET status = 'ATIVO' WHERE id = ? ";
      $this->db->query($sql, $id);
    }

  }

?>