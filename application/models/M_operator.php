


<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_operator extends CI_Model
{
	public function getDataPeserta($data, $id_tahun){
		return $this->db->query("SELECT peserta.id_peserta, pendaftaran.no_pendaftaran, pendaftaran.status_kelulusan,data_diri.nama_lengkap, program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran WHERE`status_kelulusan` = 'lulus' AND pendaftaran.id_tahun_ajaran = $id_tahun AND (data_diri.nisn = '$data' OR data_diri.nama_lengkap LIKE '%$data%' OR pendaftaran.no_pendaftaran = '$data')")->result_array();
	}

	public function getDaftarUlang(){
		$this->db->select('peserta.id_peserta,data_diri.nama_lengkap,pendaftaran.no_pendaftaran,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran,daftar_ulang.*');
		$this->db->join('peserta', 'peserta.id_peserta=daftar_ulang.id_peserta');
		$this->db->join('data_diri', 'data_diri.id_data_diri=peserta.id_data_diri');
		$this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
		$this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran');
		$this->db->join('program_studi','program_studi.id_program_studi=pendaftaran.id_program_studi');
		return $this->db->get('daftar_ulang')->result_array();
	}

	public function getDaftar($id){
		return $this->db->get_where('daftar_ulang', ['id_daftar_ulang' => $id])->row_array();
	}

}