<?php

/**
 * 
 */
class Data extends CI_Controller
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
			'daftar' => $this->m_operator->getPesertaVerifData(getIdTahun(getTahun()))
		];

		getViews($data, 'v_operator/v_verif_data');
	}

	public function verifikasi(){
		$data['title'] = 'Verifikasi Data Peserta';
		$data['peserta'] = $this->db->query("SELECT pendaftaran.no_pendaftaran, data_diri.nama_lengkap, id_peserta FROM peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri WHERE pendaftaran.status_kelengkapan_data = 'lengkap' AND pendaftaran.status_verifikasi_data = 'belum'")->result_array();
		getViews($data, 'v_operator/v_add_verif_data');
	}

	public function verif($id){
		$this->db->set('status_verifikasi_data', 'sudah');
		$this->db->where('id_pendaftaran', $id);
		$verifikasi = $this->db->update('pendaftaran');

		if ($verifikasi) {
			$this->session->set_flashdata('msg_success', 'Selamat, data peserta berhasil diverifikasi');
            http_response_code(200);
		}else{
			$this->session->set_flashdata('msg_failed', 'Maaf, data peserta gagal diverifikasi');
            http_response_code(500);
		}
	}

	public function tolak($id){
		$this->db->set('status_verifikasi_data', 'tolak');
		$this->db->where('id_pendaftaran', $id);
		$verifikasi = $this->db->update('pendaftaran');

		if ($verifikasi) {
			$this->session->set_flashdata('msg_success', 'Selamat, data peserta berhasil diverifikasi dengan status tolak');
            http_response_code(200);
		}else{
			$this->session->set_flashdata('msg_failed', 'Maaf, data peserta gagal diverifikasi');
            http_response_code(500);
		}
	}

	public function get_peserta(){
		$id_peserta = $_POST['id_peserta'];
		$data = $this->db->query("SELECT peserta.id_pendaftaran, data_sekolah_asal.*, data_ortu.*,data_diri.* FROM peserta JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN data_ortu ON data_ortu.id_ortu=peserta.id_ortu JOIN data_sekolah_asal ON data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal WHERE peserta.id_peserta = $id_peserta")->row_array();

		echo json_encode($data);
	}
}