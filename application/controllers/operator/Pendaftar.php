<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pendaftar extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(3);

        //load whatever you want bitch!!
        $this->load->model('m_seleksi');
    }

    public function list(){
    	$data = [
    		'title' => 'Daftar Pendaftar'
    	];

    	getViews($data, 'v_operator/v_daftar_pendaftar');
    }

    public function detail(){
    	$data['title'] = 'Detail Peserta';
        $data['status'] = 'diterima';
        getViews($data, 'v_peserta/v_detail_peserta');
    }
}