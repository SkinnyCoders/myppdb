


<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_operator extends CI_Model
{
	//get data peserta daftar ulang
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

	public function getDaftarPeserta($tahun){
		return $this->db->query("SELECT peserta.id_peserta,peserta.id_berkas,data_diri.nama_lengkap,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran,pendaftaran.* FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi WHERE pendaftaran.id_tahun_ajaran = $tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) ORDER BY status_kelulusan DESC")->result_array();
	}

	public function getDetailPeserta($id){
		return $this->db->query("SELECT data_diri.nama_lengkap, pendaftaran.no_pendaftaran, pendaftaran.id_pendaftaran FROM `peserta` JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran WHERE peserta.id_peserta =$id")->row_array();
	}

	public function getCabutBerkas(){
		$this->db->select('pendaftaran.id_pendaftaran, pendaftaran.no_pendaftaran,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir, data_diri.nama_lengkap');
		$this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=pencabutan.id_pendaftaran');
		$this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran');
		$this->db->join('program_studi','program_studi.id_program_studi=pendaftaran.id_program_studi');
		$this->db->join('peserta', 'peserta.id_pendaftaran=pendaftaran.id_pendaftaran');
		$this->db->join('data_diri', 'data_diri.id_data_diri=peserta.id_data_diri');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran');
		return $this->db->get('pencabutan')->result_array();
	}

	public function verifikasiBerkas($id, $status){
		$this->db->set('status_verifikasi_berkas', $status);
		$this->db->where('id_pendaftaran', $id);
		return $this->db->update('pendaftaran');
	}

}