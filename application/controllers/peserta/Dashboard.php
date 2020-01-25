<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(4);
        $this->load->model('m_peserta');
    }

    public function index()
    {
        $id_peserta = $this->session->userdata('id_peserta');
        $pendaftaran = $this->m_peserta->getPendaftaran($this->session->userdata('id_peserta'));
        $id_pendaftaran = $pendaftaran['id_pendaftaran'];
        $cekCabut = $this->db->get_where('pencabutan', ['id_pendaftaran' => $id_pendaftaran])->row_array();

        $data = [
            'title' => 'Dashboard Peserta',
            'berkas' => $this->m_peserta->getBerkas($id_peserta),
            'data_all' => $this->m_peserta->getAllDataPeserta($id_peserta),
            'status' => $this->m_peserta->cekStatus($id_peserta),
            'pencadangan' => $this->m_peserta->cekPencadangan($id_peserta),
            'pendaftaran' => $this->m_peserta->getPendaftaran($id_peserta),
            'seleksi' => $this->db->get_where('token_seleksi', ['id_peserta' => $id_peserta])->result_array(),
            'cabut' => $cekCabut
        ];

        $id_prodi = $data['pendaftaran']['id_program_studi'];
        $id_jalur = $data['pendaftaran']['id_jalur_pendaftaran'];
        $data['data_jadwal'] = $this->m_peserta->getJadwal($id_jalur, $id_prodi);

        if ($data['data_all'] !== NULL) {
            if (!in_array(NULL, $data['data_all'])) {
                //update status kelengkapan data
                $this->m_peserta->updateKelengkapanData($data['pendaftaran']['id_pendaftaran']);
            }
        }

        if ($data['berkas'] !== NULL) {
            if (!in_array(NULL, $data['berkas'])) {
                $this->m_peserta->updateKelengkapanBerkas($data['pendaftaran']['id_pendaftaran']);
            }
        }

        getViews($data, 'v_peserta/dashboard');
    }

    public function peserta()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        getViews($data, 'v_kepsek/v_pendaftar');
    }
}
