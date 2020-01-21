<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Seleksi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_peserta');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        $data['berkas'] = $this->m_peserta->getBerkas(4);
        $data['data_all'] = $this->m_peserta->getAllDataPeserta(4);
        $data['token'] = $this->getToken(4);

        //tampil data seleksi berdasarkan konfigurasi

        getViews($data, 'v_peserta/v_token_seleksi');
    }

    private function getToken($id_peserta)
    {
        $data['berkas'] = $this->m_peserta->getBerkas($id_peserta);
        $data['data_all'] = $this->m_peserta->getAllDataPeserta($id_peserta);

        if ($data['data_all'] !== NULL || !in_array(NULL, $data['data_all']) || !in_array(NULL, $data['berkas'])) {
            $getDataToken = $this->db->get_where('token_seleksi', ['id_peserta' => $id_peserta])->row_array();
            if (!empty($getDataToken)) {
                $token = $getDataToken['token'];
            } else {
                $token = random_string('alnum', 20);
                //get id konfigurasi seleksi
                $id_konfigur = $this->db->get_where('konfigurasi_tes_seleksi', ['id_program_studi' => 4])->row_array();

                //insert ke table token
                $data = [
                    'id_konfigurasi_seleksi' => $id_konfigur['id_konfigurasi_tes_seleksi'],
                    'id_peserta' => 4,
                    'token' => $token
                ];

                $this->db->insert('token_seleksi', $data);
            }
            return $token;
        }
    }
}
