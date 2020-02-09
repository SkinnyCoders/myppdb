<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_kepsek extends CI_Model
{

	public function getPesertaDiterima($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran,peserta.id_peserta,pendaftaran.no_pendaftaran, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran, program_studi.nama_program_studi, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.id_tahun_ajaran = $id_tahun AND `status_kelulusan` = 'lulus' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->result_array();
	}

	public function getPesertaDitolak($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran,peserta.id_peserta,pendaftaran.no_pendaftaran, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran, program_studi.nama_program_studi, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.id_tahun_ajaran = $id_tahun AND `status_kelulusan` = 'tidak_lulus' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->result_array();
	}

	public function getDicadangkan($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran,peserta.id_peserta,pendaftaran.no_pendaftaran, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran, program_studi.nama_program_studi, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.id_tahun_ajaran = $id_tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->result_array();
	}

	public function getCabutBerkas($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran,peserta.id_peserta,pendaftaran.no_pendaftaran, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran, program_studi.nama_program_studi, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.id_tahun_ajaran = $id_tahun AND EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->result_array();
	}

	public function getDaftarUlang($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran,peserta.id_peserta,pendaftaran.no_pendaftaran, data_diri.nama_lengkap, DATE(daftar_ulang.tanggal) AS tgl, jalur_pendaftaran.nama_jalur_pendaftaran, program_studi.nama_program_studi, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir FROM `daftar_ulang` JOIN peserta ON peserta.id_peserta=daftar_ulang.id_peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.id_tahun_ajaran = $id_tahun AND daftar_ulang.status = 'sudah' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->result_array();
	}
}