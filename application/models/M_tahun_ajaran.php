<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_tahun_ajaran extends CI_Model
{
    public function getAll()
    {
        $this->db->select('*');
        $this->db->order_by('tahun_mulai', 'DESC');
        return $this->db->get('tahun_ajaran')->result_array();
    }

    public function addTahun($data)
    {
        return $this->db->insert('tahun_ajaran', $data);
    }
}
