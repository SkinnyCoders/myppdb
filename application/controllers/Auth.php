<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Auth extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->helper('cookie');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', ['required' => 'Maaf, Email belum diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Maaf, Password belum diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_admin/v_login');
        } else {
            $user = $this->m_auth->cekUser($this->input->post('email', TRUE));

            if (!empty($user)) {
                if (password_verify($this->input->post('password'), $user['password'])) {
                    if ($user['login_status'] == 'false') {
                        $data = [
                            'is_login' => 'punten',
                            'nama' => $user['nama_pengguna'],
                            'role' => $user['id_role'],
                            'nama_role' => $user['nama_role'],
                            'foto' => $user['foto_pengguna'],
                            'id' => $user['id_pengguna']
                        ];

                        $this->session->set_userdata($data);
                        $status = 'true';
                        $this->m_auth->updateStatus($user['id_pengguna'], $status);
                        switch ($user['id_role']) {
                            case "1":
                                $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                                redirect('kepsek');
                                break;

                            case "2":
                                $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                                redirect('admin');
                                break;

                            case "3":
                                $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                                redirect('operator');
                                break;

                            case "4":
                                $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                                redirect('peserta');
                                break;
                        }
                        $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('msg_failed', 'Akun sedang online!');
                        redirect('admin/login');
                    }
                } else {
                    $this->session->set_flashdata('msg_failed', 'Ups!, Password anda salah!');
                    redirect('admin/login');
                }
            } else {
                $this->session->set_flashdata('msg_failed', 'Ups!, Akun anda belum terdaftar!');
                redirect('admin/login');
            }
        }
    }

    public function logout()
    {

        //update login status
        $status = 'false';
        $id = $this->session->userdata('id');
        $update = $this->m_auth->updateStatus($id, $status);

        if ($update) {
            $this->session->unset_userdata('is_login');
            $this->session->unset_userdata('nama');
            $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil logut');
            redirect('admin/login');
        } else {
            $this->session->set_flashdata('msg_failed', 'Gagal Logout!');
            redirect('admin');
        }
    }
}
