<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Profil extends CI_controller
{
    public function __construct()
    {
        parent::__construct();

        //login cek and authentication
        getAuth(2);

        //load whatever you want bitch!!
        $this->load->model('m_home');
    }

    public function index()
    {
        $data['title'] = 'Profil Sekolah';
        $data['profile'] = $this->m_home->getProfil();

        $this->form_validation->set_rules('nama', 'Nama Sekolah', 'required|trim');
        $this->form_validation->set_rules('visi', 'Visi Sekolah', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi Sekolah', 'required|trim');
        $this->form_validation->set_rules('profil', 'Profil Sekolah', 'required|trim');
        $this->form_validation->set_rules('kepsek', 'Kepala Sekolah', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Sekolah', 'trim');
        $this->form_validation->set_rules('telp', 'Telp Sekolah', 'trim');
        $this->form_validation->set_rules('social', 'Social Sekolah', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat Sekolah', 'required|trim');
        $this->form_validation->set_rules('sambutan', 'Sambutan Kepala Sekolah', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('v_admin/v_profil', $data);
            $this->load->view('templates/admin_footer');
        } else {

            if (!empty($_FILES['foto1']['name'])) {
                $foto_kepsek = uploadImage('foto1', './assets/img/uploads/', '');

                //deleting old image
                if ($foto_kepsek && $data['profile']['foto_kepala_sekolah'] !== 'default.png') {
                    unlink('assets/img/uploads/' . $data['profile']['foto_kepala_sekolah']);
                }
            } else {
                $foto_kepsek = $data['profile']['foto_kepala_sekolah'];
            }

            if (!empty($_FILES['foto2']['name'])) {
                $logo_sekolah = uploadImage('foto2', './assets/img/uploads/', '');

                //deleting old image
                if ($logo_sekolah && $data['profile']['logo_sekolah'] !== 'default.png') {
                    unlink('assets/img/uploads/' . $data['profile']['logo_sekolah']);
                }
            } else {
                $logo_sekolah = $data['profile']['logo_sekolah'];
            }

            $kontak = [
                'telp' => $this->input->post('telp', true),
                'email' => $this->input->post('email', true),
                'social' => $this->input->post('social', true)
            ];

            $misi = explode(PHP_EOL, $this->input->post('misi', true));

            $data = [
                'nama_sekolah' => $this->input->post('nama', true),
                'logo_sekolah' => $logo_sekolah,
                'profil_sekolah' => $this->input->post('profil', true),
                'visi_sekolah' => $this->input->post('visi', true),
                'misi_sekolah' => json_encode($misi),
                'nama_kepala_sekolah' => $this->input->post('kepsek', true),
                'foto_kepala_sekolah' => $foto_kepsek,
                'sambutan_kepala_sekolah' => $this->input->post('sambutan', true),
                'alamat_sekolah' => $this->input->post('alamat', true),
                'kontak_sekolah' => json_encode($kontak)
            ];

            if (!empty($this->m_home->getProfil())) {
                //update profi
                $updateProfil = $this->m_home->updateProfil($data);

                if ($updateProfil) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                    redirect('admin/sekolah/profil');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal disimpan');
                    redirect('admin/sekolah/profil');
                }
            } else {
                $insertProfil = $this->m_home->addProfil($data);

                if ($insertProfil) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                    redirect('admin/sekolah/profil');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal disimpan');
                    redirect('admin/sekolah/profil');
                }
            }
        }
    }
}
