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
    }

    public function index()
    {
        $data['title'] = 'Dashboard Operator';
        getViews($data, 'v_operator/dashboard');
    }
}
