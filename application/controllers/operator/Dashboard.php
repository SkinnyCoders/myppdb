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
        getAuth(3);

        $this->load->model('m_pendaftaran');
        $this->load->helper('cektahun');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Operator';
        $data['pendaftar'] = $this->m_pendaftaran->getTotalPendaftar(getIdTahun(getTahun()));
        $data['lengkap_data'] = $this->db->get_where('pendaftaran', ['status_kelengkapan_data' => 'lengkap'])->num_rows();
        $data['lengkap_berkas'] = $this->db->get_where('pendaftaran', ['status_kelengkapan_berkas' => 'lengkap'])->num_rows();
        $data['total_ujian'] = $this->m_pendaftaran->getTotalPesertaSeleksi();

        $data['belum_verify_data'] = $this->db->get_where('pendaftaran', ['status_kelengkapan_data' => 'lengkap', 'status_verifikasi_data' => 'belum'])->num_rows();
        $data['belum_verify_berkas'] = $this->db->get_where('pendaftaran', ['status_kelengkapan_berkas' => 'lengkap', 'status_verifikasi_berkas' => 'belum'])->num_rows();

        getViews($data, 'v_operator/dashboard');
    }

    public function get_dataChart(){

        $jurusan = $this->m_pendaftaran->getTotalJurusan();

        foreach ($jurusan as $jtotal) {
            $total = explode(',', $jtotal['total']);
            $totalJurusan[] = array_sum($total);
        }

        foreach ($jurusan as $jlabel) {
            $label[] = $jlabel['nama'];
        }

        $dataJurusan = ['jurusan' => $totalJurusan,
                        'nama_jurusan' => $label];
        echo json_encode($dataJurusan);
    }

    public function get_dataChart2(){

        $total = $this->m_pendaftaran->getTotalGender();
        

        $data = ['jumlah' => $total];

        echo json_encode($data);
    }
}
