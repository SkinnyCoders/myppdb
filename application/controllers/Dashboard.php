<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

/**
 * 
 */
class Dashboard extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') !== 'punten') {
            $this->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
            redirect('admin/login');
        }
    }

    public function index()
    {

        switch ($this->session->userdata('role')) {
            case '1':
                $data['title'] = 'Dashboard 1';
                getViews($data, 'v_kepsek/dashboard');
                // $this->load->view('templates/admin_header', $data);
                // $this->load->view('v_kepsek/dashboard');
                // $this->load->view('templates/admin_footer');
                break;

            case '2':
                $data['title'] = 'Dashboard 10';
                getViews($data, 'v_admin/dashboard');
                // $this->load->view('templates/admin_header', $data);
                // $this->load->view('v_admin/dashboard');
                // $this->load->view('templates/admin_footer');
                break;

            default:
                $data['title'] = 'Dashboard 3';
                $this->load->view('templates/admin_header', $data);
                $this->load->view('v_operator/dashboard');
                $this->load->view('templates/admin_footer');
                break;
        }
    }

    private function _salam($clock)
    {
        if ($clock >= '05:00:00' && $clock <= '11:59:00') {
            $data = 'Selamat Pagi';
        } elseif ($clock >= '12:00:00' && $clock <= '15:59:00') {
            $data = 'Selamat Siang';
        } elseif ($clock >= '16:00:00' && $clock <= '18:59:00') {
            $data = 'Selamat Sore';
        } elseif ($clock >= '19:00:00') {
            $data = 'Selamat Malam';
        } elseif ($clock >= '00:00:00') {
            $data = 'Selamat Malam';
        }
        return $data;
    }
}
