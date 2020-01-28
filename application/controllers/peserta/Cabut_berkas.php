<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Cabut_berkas extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		//login cek and authentication
		getAuth(4);
		$this->load->model('m_peserta');
		$this->load->helper('cektahun');
	}

	public function index()
	{
		$pendaftaran = $this->m_peserta->getPendaftaran($this->session->userdata('id_peserta'));
		$id_pendaftaran = $pendaftaran['id_pendaftaran'];
		$data['title'] = 'Cabut Berkas';
		$data['cabut'] = $this->db->get_where('pencabutan', ['id_pendaftaran' => $id_pendaftaran])->row_array();

		getViews($data, 'v_peserta/v_cabut_berkas');
	}

	public function cabut($id)
	{
		$pendaftaran = $this->m_peserta->getPendaftaran($id);
		$id_pendaftaran = $pendaftaran['id_pendaftaran'];
		$id_jurusan = $pendaftaran['id_program_studi'];
		$status = $pendaftaran['status_kelulusan'];

		$data_berkas = $this->m_peserta->getBerkas($id);

		$data = [
			'id_pendaftaran' => $id_pendaftaran,
			'keterangan' => $_POST['keterangan']
		];

		$insert = $this->db->insert('pencabutan', $data);

		if ($insert) {

			foreach ($data_berkas as $berkas) {
				unlink('assets/uploads/berkas_peserta/' . $berkas);
			}
			$id_berkas = $data_berkas['id_berkas'];
			$deleteBerkas = $this->db->delete('data_berkas', ['id_berkas' => $id_berkas]);

			//ubah status kelulusan
			if ($status == 'lulus') {
				$this->db->set('status_kelulusan', NULL);
				$this->db->where('id_pendaftaran', $id_pendaftaran);
				$this->db->update('pendaftaran');
			}

			if ($pendaftaran['status_kelengkapan_berkas'] == 'lengkap') {
				$this->db->set('status_kelengkapan_berkas', 'belum');
				$this->db->set('status_verifikasi_berkas', 'belum');
				$this->db->where('id_pendaftaran', $id_pendaftaran);
				$this->db->update('pendaftaran');
			}

			//get pencadangan
			$data_cadangan = $this->db->query("SELECT pencadangan.id_pencadangan FROM `pencadangan` JOIN pendaftaran AS daftar ON daftar.id_pendaftaran=pencadangan.id_pendaftaran WHERE daftar.id_program_studi = $id_jurusan")->result_array();

			//get sisa kuota
			$sisa = $this->m_peserta->cekSisaKuota($id_jurusan, getIdTahun(getTahun()));
			//cek ada sisa kuota atau tidak
			if ($sisa > 0) {
				//ubah status pencadangan
				for ($i = 0; $i < $sisa; $i++) {
					//deleting peserta from pencadangan
					$this->db->delete('pencadangan', ['id_pencadangan' => $data_cadangan[$i]['id_pencadangan']]);
				}
			}

			if ($deleteBerkas) {
				$this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan pencabutan');
				http_response_code(200);
			} else {
				$this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan pencabutan');
				http_response_code(404);
			}
		} else {
			$this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan pencabutan');
			http_response_code(404);
		}
	}

	public function batal($id)
	{
		$pendaftaran = $this->m_peserta->getPendaftaran($id);
		$id_pendaftaran = $pendaftaran['id_pendaftaran'];
		$id_jurusan = $pendaftaran['id_program_studi'];

		$delete = $this->db->delete('pencabutan', ['id_pendaftaran' => $id_pendaftaran]);

		if ($delete) {

			//get sisa kuota
			$sisa = $this->m_peserta->cekSisaKuota($id_jurusan, getIdTahun(getTahun()));

			if ($sisa <= 0) {
				//masukan ke pencadangan
				$data_pencadangan = [
					'id_pendaftaran' => $id_pendaftaran,
					'status_pencadangan' => 'true',
					'keterangan' => 'Pembatalan pencabutan berkas'
				];

				$this->db->insert('pencadangan', $data_pencadangan);
			}

			$this->session->set_flashdata('msg_success', 'Selamt, berhasil mambatalkan pencabutan');
			http_response_code(200);
		} else {
			$this->session->set_flashdata('msg_failed', 'Maaf, gagal membatalkan pencabutan');
			http_response_code(404);
		}
	}
}
