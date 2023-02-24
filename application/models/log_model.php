<?php 

class Log_model extends CI_Model {

    public function add_log($id_usuario, $descricao) 
    {
        $sql = "INSERT INTO logs 
                    (id_usuario, descricao, data_criacao)
                VALUES 
                    (?, ?, ?)";
        $this->db->query($sql, array(
                'id_usuario' => $id_usuario,
                'descricao' => $descricao,
                'data_criacao' => date('Y-m-d H:i:s')
            )
        );
    }
    
}