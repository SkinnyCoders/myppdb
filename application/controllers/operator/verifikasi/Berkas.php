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
			'daftar' => $this->m_operator->getDaftarPeserta(getIdTahun(getTahun()))
		];

		getViews($data, 'v_operator/v_verif_berkas');
	}

	public function detail($id)
	{
		$data = [
			'title' => 'Detail Berkas Peserta',
			'berkas' => $this->m_peserta->getBerkas($id)
		];

		getViews($data, 'v_operator/v_detail_berkas');
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
