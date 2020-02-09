<?php

/**
 * 
 */
class Berkas extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_peserta');
		$this->load->model('m_operator');
		$this->load->helper('cektahun');
	}

	public function index()
	{
		$data = [
			'title' => 'Verifikasi Berkas',
			'daftar' => $this->m_operator->getPesertaVerifBerkas(getIdTahun(getTahun()))
		];

		getViews($data, 'v_operator/v_verif_berkas');
	}

	public function detail()
	{
		$data = [
			'title' => 'Detail Berkas Peserta'
		];

		$data['peserta'] = $this->db->query("SELECT pendaftaran.no_pendaftaran, data_diri.nama_lengkap, id_peserta FROM peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri WHERE pendaftaran.status_kelengkapan_berkas = 'lengkap' AND pendaftaran.status_verifikasi_berkas = 'belum'")->result_array();

		getViews($data, 'v_operator/v_detail_berkas');
	}

	public function get_berkas(){
		$id = $_POST['id_berkas'];
		$data = $this->db->query("SELECT data_berkas.*, peserta.id_pendaftaran FROM `peserta` JOIN data_berkas ON data_berkas.id_berkas=peserta.id_berkas WHERE peserta.id_peserta = $id")->row_array();

		$data_berkas = [
			'ijazah' => base_url('assets/uploads/berkas_peserta/'.$data['ijazah_terakhir']),
			'skhun' => base_url('assets/uploads/berkas_peserta/'.$data['skhun']),
			'kk' => base_url('assets/uploads/berkas_peserta/'.$data['kartu_keluarga']),
			'sk_sehat' => base_url('assets/uploads/berkas_peserta/'.$data['keterangan_sehat']),
			'foto' => base_url('assets/uploads/berkas_peserta/'.$data['pas_foto']),
			'id_berkas' => $data['id_berkas'],
			'id_pendaftaran' => $data['id_pendaftaran']
		];

		echo json_encode($data_berkas);
	}

	public function verify($id)
	{
		$status = $_POST['status'];

		if ($status == 'verif') {
			$verifikasi = $this->m_operator->verifikasiBerkas($id, 'sudah');

			if ($verifikasi) {
				$this->session->set_flashdata('msg_success', 'Selamat, Data berkas berhasil diverifikasi');
				http_response_code(200);
			} else {
				$this->session->set_flashdata('msg_failed', 'Maaf, Data berkas gagal diverifikasi');
				http_response_code(500);
			}
		}

		if ($status == 'tolak') {
			$verifikasi = $this->m_operator->verifikasiBerkas($id, 'tolak');

			if ($verifikasi) {
				$this->session->set_flashdata('msg_success', 'Selamat, Data berkas berhasil diverifikasi');
				redirect('operator/verifikasi/berkas');
			} else {
				$this->session->set_flashdata('msg_failed', 'Maaf, Data berkas gagal diverifikasi');
				redirect('operator/verifikasi/berkas');
			}
		}
	}
}
