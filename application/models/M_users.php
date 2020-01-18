<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_users extends CI_Model
{
    public function addUser($data)
    {
        return $this->db->insert('pengguna', $data);
    }

    public function cekUser($email)
    {
        return $this->db->get_where('pengguna', ['email_pengguna' => $email])->num_rows();
    }

    public function getAllUser()
    {
        $this->db->select('id_pengguna, nama_pengguna, foto_pengguna, email_pengguna, jenis_kelamin, tgl_registrasi, nama_role');
        $this->db->from('pengguna');
        $this->db->join('role', 'role.id_role = pengguna.id_role');
        return $this->db->get()->result_array();
    }

    public function editUser($id)
    {
        return $this->db->get_where('pengguna', ['id_pengguna' => $id])->result_array();
    }

    public function updateUser($data, $id)
    {
        $this->db->where('id_pengguna', $id);
        return $this->db->update('pengguna', $data);
    }
}
