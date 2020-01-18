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
    }

    public function index()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        getViews($data, 'v_kepsek/dashboard');
    }

    public function peserta()
    {
        $data['title'] = 'Dashboard Kepala Sekolah';
        getViews($data, 'v_kepsek/v_pendaftar');
    }
}
