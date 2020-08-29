<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_usuario extends CI_Model
{

    //busca no bd
    function login($email, $senha)
    {
        $this->db->select('idUsuarios', 'nome');
        $this->db->from('usuarios');
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        $this->db->where('status', '1');
        $this->db->limit('1');
        $query = $this->db->get();

        //se o numero de linhas for =1
        if ($query->num_rows() == 1) {
            $query->result();
        } else {
            return false;
        }
    }
}
