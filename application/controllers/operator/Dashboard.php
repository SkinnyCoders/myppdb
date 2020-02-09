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
        $this->load->model('m_operator');
        $this->load->helper('cektahun');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Operator';
        $data['pendaftar'] = $this->m_pendaftaran->getTotalPendaftar(getIdTahun(getTahun()));
        $data['lengkap_data'] = $this->m_operator->getTotalLengkapData(getIdTahun(getTahun()))->num_rows();
        $data['lengkap_berkas'] = $this->m_operator->getTotalLengkapBerkas(getIdTahun(getTahun()))->num_rows();
        $data['total_cabut'] = $this->m_pendaftaran->getTotalPencabutan(getIdTahun(getTahun()));

        $data['belum_verify_data'] = $this->m_operator->getBelumVerifiData(getIdTahun(getTahun()))->num_rows();
        $data['belum_verify_berkas'] = $this->m_operator->getBelumVerifiBerkas(getIdTahun(getTahun()))->num_rows();

        getViews($data, 'v_operator/dashboard');
    }

    public function get_dataChart(){

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
