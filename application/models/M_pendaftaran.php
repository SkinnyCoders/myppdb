<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_pendaftaran extends CI_Model
{
    public function getJalurJadwal()
    {
        $this->db->select('jalur_pendaftaran.id_jalur_pendaftaran, nama_jalur_pendaftaran');
        $this->db->from('jadwal_pendaftaran');
        $this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=jadwal_pendaftaran.id_jalur_pendaftaran');
        return $this->db->get()->result_array();
    }

    public function getJalur()
    {
        return $this->db->get('jalur_pendaftaran')->result_array();
    }

    public function getJadwal()
    {
        $this->db->select('*');
        $this->db->from('jadwal_pendaftaran');
        $this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=jadwal_pendaftaran.id_jalur_pendaftaran');
        return $this->db->get()->result_array();
    }
}
