<?php

  class Login_model extends CI_Model {

    public function login($user)
    {   
        $sql = "SELECT usuarios.*,
                       usuarios_permissoes.menu_colaboradores,
                       usuarios_permissoes.menu_produtos,
                       usuarios_permissoes.menu_pedidos,
                       colaboradores.status
                FROM usuarios
                INNER JOIN usuarios_permissoes
                  ON usuarios_permissoes.id_colaborador = usuarios.id_colaborador
                INNER JOIN colaboradores
                  ON colaboradores.id = usuarios.id_colaborador
                WHERE usuarios.usuario = ?
                  AND usuarios.senha = ?
                  AND colaboradores.status = 'ATIVO'
                LIMIT 1";
        $logged_user = $this->db->query($sql, array(
            $user["user"],
            $user["pass"])
        )->result_array();
        return $logged_user;
    }

    public function failed_login($user)
    {
      $time_login = date("Y-m-d H:i:s", strtotime("-10 minutes"));
      $sql = "SELECT * FROM failed_login 
              WHERE ip = ?
                AND horario >= ?";
      $failed_login = $this->db->query($sql, 
        array(
          $user["user_ip"],
          $time_login)
      )->result_array();

      if (count($failed_login) >= 3) {
        return FALSE;
      } else {
        return TRUE;
      }
    }

    public function add_failed_login($user)
    {
      $ip = $user["user_ip"];
      $sql = "INSERT INTO failed_login 
              (ip, horario)
              VALUES 
              (?, ?)";
      $this->db->query($sql, array(
        $ip,
        date("Y-m-d H:i:s"))
      );
    }

    public function clean_failed_login($user)
    {
      $ip = $user["user_ip"];
      $sql = "DELETE FROM failed_login WHERE ip = ?";
      $this->db->query($sql, $ip);
    }
  }
?>