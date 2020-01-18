<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getAuth($role)
{
    $CI = &get_instance();
    if ($CI->session->userdata('is_login') !== 'punten') {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Harus login terlebih dahulu!');
        redirect('admin/login');
        return false;
    } elseif ($CI->session->userdata('role') !== "$role") {
        $CI->session->set_flashdata('msg_failed', 'Maaf, Anda tidak berhak mengakses laman!');
        switch ($CI->session->userdata('role')) {
            case "1":
                redirect('kepsek');
                break;

            case "2":
                redirect('admin');
                break;

            case "3":
                redirect('operator');
                break;

            case "4":
                redirect('peserta');
                break;
        }

        return false;
    }
}
