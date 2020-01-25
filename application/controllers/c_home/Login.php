<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Login extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->load->view('v_peserta/v_login');

	}

	public function auth(){
		$data = array(
            'username_peserta' => $this->input->post('email'),
            'password_peserta' => $this->input->post('password')
        );
        $condition = array('email_peserta' => $data['username_peserta']);
        $data_peserta = $this->db->get_where('peserta', $condition)->row_array();
        if ($data_peserta == null){
            $data_msg = array(
                'tipe' => 'error',
                'msg' => 'Anda belum terdaftar.'
            );
        }else{
            if (password_verify($this->input->post('password'), $data_peserta['password_peserta'])) {

                $data_session = array(
                    'is_login' => 'punten',
                    'nama' => $data_peserta['email_peserta'],
                    'role' => $data_peserta['id_role'],
                    'nama_role' => 'peserta',
                    'id_peserta' => $data_peserta['id_peserta']
                );
                $this->session->set_userdata($data_session);
                $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
           	$data_msg = array(
                    'tipe' => 'success',
                    'msg' => 'Login berhasil'
                );
                
            }else{
                $data_msg = array(
                    'tipe' => 'error',
                    'msg' => 'Password yang anda masukan salah.'
                );
            }
        }
        echo json_encode($data_msg);
	}
}
