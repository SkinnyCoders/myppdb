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

    public function getJalurView(){
        return $this->db->query('SELECT jalur_pendaftaran.nama_jalur_pendaftaran, jalur_pendaftaran.keterangan,jalur_pendaftaran.persyaratan, jalur_pendaftaran.id_jalur_pendaftaran,GROUP_CONCAT(program_studi.nama_program_studi) AS jurusan, GROUP_CONCAT(program_studi.id_program_studi) AS id_jurusan, GROUP_CONCAT(slug) AS slug FROM `jalur_pendaftaran` JOIN jalur_prodi ON jalur_prodi.id_jalur=jalur_pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=jalur_prodi.id_prodi GROUP BY jalur_prodi.id_jalur')->result_array();
    }

    public function getJadwal()
    {
        $this->db->select('*');
        $this->db->from('jadwal_pendaftaran');
        $this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=jadwal_pendaftaran.id_jalur_pendaftaran');
        return $this->db->get()->result_array();
    }

    public function getJalurKonfig($id){
        return $this->db->query("SELECT * FROM program_studi WHERE NOT EXISTS (SELECT * FROM jalur_prodi WHERE jalur_prodi.id_prodi=program_studi.id_program_studi AND jalur_prodi.id_jalur=$id)")->result_array();
    }

    public function getJalurJurusan($id){
        $this->db->select('*');
        $this->db->from('jalur_pendaftaran');
        $this->db->join('jalur_prodi', 'jalur_prodi.id_jalur=jalur_pendaftaran.id_jalur_pendaftaran');
        $this->db->where('jalur_prodi.id_prodi', $id);
        return $this->db->get()->result_array();
    }

    public function getNoDaftar(){
        return $this->db->query('SELECT `no_pendaftaran` FROM `pendaftaran` ORDER BY `id_pendaftaran` DESC LIMIT 1')->row_array();
    }

    public function getJurusan(){
        $this->db->select('id_program_studi, nama_program_studi');
        return $this->db->get('program_studi')->result_array();
    }

    public function jurusan($id){
        return $this->db->get_where('program_studi', ['id_program_studi' => $id])->row_array();
    }

    public function getKodeJurusan($id){
        $this->db->select('kode_program_studi');
        return $this->db->get_where('program_studi', ['id_program_studi' => $id])->row_array();
    }

    public function getTotalDaftar($id_ta, $id_prodi){
        return $this->db->query("SELECT COUNT(id_pendaftaran) AS total FROM `pendaftaran` WHERE `id_tahun_ajaran` = $id_ta AND `id_program_studi` = $id_prodi")->row_array();
    }

    public function getKuota($id_ta, $id_prodi){
        return $this->db->query("SELECT `jumlah` FROM `kouta_pendaftaran` WHERE `id_program_studi` = $id_prodi AND `id_tahun_ajaran` = $id_ta")->row_array();
    }
}
