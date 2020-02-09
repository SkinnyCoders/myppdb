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
        getAuth(1);

        $this->load->model('m_pendaftaran');
        $this->load->model('m_operator');
        $this->load->helper('cektahun');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        $data['pendaftar'] = $this->m_pendaftaran->getTotalPendaftar(getIdTahun(getTahun()));
        $data['rincian'] = $this->m_operator->rincianPendaftaran(getIdTahun(getTahun()));

        getViews($data, 'v_kepsek/dashboard');
    }

    public function peserta()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        getViews($data, 'v_kepsek/v_pendaftar');
    }

    public function get_dataChart(){
        $data_rincian = $this->m_operator->rincianPendaftaran(getIdTahun(getTahun()));

        $data = ['total' => [$data_rincian['pendaftar'],$data_rincian['diterima'], $data_rincian['tidakditerima'], $data_rincian['dicadangkan'], $data_rincian['daftar_ulang']]];

        echo json_encode($data);

    }

    public function get_dataChart3(){

        $jurusan = $this->m_pendaftaran->getTotalJurusan(getIdTahun(getTahun()));

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

        $total = $this->m_pendaftaran->getTotalGender(getIdTahun(getTahun()));
        

        $data = ['jumlah' => $total];

        echo json_encode($data);
    }
}
