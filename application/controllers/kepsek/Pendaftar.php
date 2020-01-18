<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pendaftar extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(1);
    }

    public function index()
    {
        $data['title'] = 'Peserta Terdaftar';
        getViews($data, 'v_kepsek/v_pendaftar');
    }

    public function diterima()
    {
        $data['title'] = 'Peserta Terdaftar';
        getViews($data, 'v_kepsek/v_peserta_diterima');
    }

    public function dicadangkan()
    {
        $data['title'] = 'Peserta Terdaftar';
        getViews($data, 'v_kepsek/v_peserta_dicadangkan');
    }

    public function ditolak()
    {
        $data['title'] = 'Peserta Tidak Diterima';
        getViews($data, 'v_kepsek/v_peserta_ditolak');
    }

    public function detail()
    {
        $data['title'] = 'Detail Peserta';
        $data['status'] = 'diterima';
        getViews($data, 'v_peserta/v_detail_peserta');
    }
}
