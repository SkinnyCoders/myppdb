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
        getAuth(2);

        $this->load->model('m_home');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        getViews($data, 'v_admin/dashboard');
    }
}
