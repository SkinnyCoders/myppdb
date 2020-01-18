<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_auth extends CI_Model
{
    public function cekUser($email){
        $this->db->select('*');
    	$this->db->from('pengguna');
    	$this->db->join('role', 'role.id_role = pengguna.id_role');
    	$this->db->where('email_pengguna', $email);
    	return $this->db->get()->row_array();
    }

    public function updateStatus($id, $status){
    	//update login status
        $this->db->set('login_status', $status);
        $this->db->where('id_pengguna',$id);
        return $this->db->update('pengguna');
    }
}