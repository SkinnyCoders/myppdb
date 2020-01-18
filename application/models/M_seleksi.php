<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_seleksi extends CI_Model
{
    public function add_seleksi($data)
    {
        $this->db->insert('tes_seleksi', $data);
        return $this->db->insert_id();
    }

    public function getAll()
    {
        return $this->db->query('SELECT `id_tes_seleksi`, `nama_tes_seleksi`, `deskripsi_tes_seleksi`, `bobot_tes` FROM `tes_seleksi` WHERE 1 ORDER BY id_tes_seleksi DESC')->result_array();
    }

    public function getAllSoal($id)
    {
        // return $this->db->get_where('soal_tes_seleksi', ['id_tes_seleksi' => $id])->result_array();
        return $this->db->query("SELECT * FROM `soal_tes_seleksi` INNER JOIN tes_seleksi ON tes_seleksi.id_tes_seleksi=soal_tes_seleksi.id_tes_seleksi WHERE tes_seleksi.id_tes_seleksi = $id")->result_array();
    }

    public function getSeleksi($id)
    {
        return $this->db->get_where('tes_seleksi', ['id_tes_seleksi' => $id])->row_array();
    }

    public function updateSeleksi($data, $id)
    {
        return $this->db->update('tes_seleksi', $data, ['id_tes_seleksi' => $id]);
    }

    public function updateSoal($data, $id)
    {
        return $this->db->update('soal_tes_seleksi', $data, ['id_tes_seleksi' => $id]);
    }

    public function getDetail($id)
    {
        $this->db->select('id_soal_tes_seleksi, tes_seleksi.id_tes_seleksi, soal_tes_seleksi, file_tes, jawaban_a, jawaban_b, jawaban_c, jawaban_d, jawaban_benar, nama_tes_seleksi');
        $this->db->from('soal_tes_seleksi');
        $this->db->join('tes_seleksi', 'soal_tes_seleksi.id_tes_seleksi=tes_seleksi.id_tes_seleksi');
        $this->db->where('tes_seleksi.id_tes_seleksi', $id);
        return $this->db->get()->result_array();
    }
}
