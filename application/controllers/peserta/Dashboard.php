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
        // getAuth(1);
        $this->load->model('m_peserta');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        $data['berkas'] = $this->m_peserta->getBerkas(4);
        $data['data_all'] = $this->m_peserta->getAllDataPeserta(4);
        getViews($data, 'v_peserta/dashboard');
    }

    public function peserta()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        getViews($data, 'v_kepsek/v_pendaftar');
    }
}
