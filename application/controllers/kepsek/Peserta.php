<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Peserta extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(1);
        $this->load->model('m_kepsek');
        $this->load->model('m_peserta');
        $this->load->helper('cektahun');
    }


    public function diterima(){

        $data = [
            'title' => 'Peserta Diterima',
            'peserta' => $this->m_kepsek->getPesertaDiterima(getIdTahun(getTahun()))
        ];
        $this->session->set_userdata('previous_url', current_url());
        getViews($data, 'v_kepsek/v_peserta_diterima');
    }

    public function dicadangkan()
    {
        $data = [
            'title' => 'Peserta Dicadangkan',
            'peserta' => $this->m_kepsek->getDicadangkan(getIdTahun(getTahun()))
        ];
        $this->session->set_userdata('previous_url', current_url());
        getViews($data, 'v_kepsek/v_peserta_dicadangkan');
    }

    public function ditolak()
    {

        $data = [
            'title' => 'Peserta Tidak Diterima',
            'peserta' => $this->m_kepsek->getPesertaDitolak(getIdTahun(getTahun()))
        ];
        $this->session->set_userdata('previous_url', current_url());
        getViews($data, 'v_kepsek/v_peserta_ditolak');
    }

    public function daftar_ulang()
    {
        $data = [
            'title' => 'Peserta Daftar Ulang',
            'peserta' => $this->m_kepsek->getDaftarUlang(getIdTahun(getTahun()))
        ];
        $this->session->set_userdata('previous_url', current_url());
        getViews($data, 'v_kepsek/v_peserta_daftar_ulang');
    }

    public function cabut_berkas()
    {
        $data = [
            'title' => 'Peserta Cabut Berkas',
            'peserta' => $this->m_kepsek->getCabutBerkas(getIdTahun(getTahun()))
        ];
        $this->session->set_userdata('previous_url', current_url());
        getViews($data, 'v_kepsek/v_peserta_cabut');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Peserta';
        $data['status'] = 'diterima';
        $data['detail'] = $this->m_peserta->getAllDataPeserta($id);
        $data['berkas'] = $this->m_peserta->getBerkas($id);
        $data['pendaftaran'] = $this->m_peserta->getPendaftaran($id);

        if (empty($data['detail'])) {
            $this->session->set_flashdata('msg_failed', 'Maaf, Peserta Belum Melengkapi Data');
            redirect($this->session->userdata('previous_url'));
        }
        getViews($data, 'v_peserta/v_detail_peserta');
    }
}
