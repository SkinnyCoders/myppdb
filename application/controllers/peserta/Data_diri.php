<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Data_diri extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(4);
        $this->load->model('m_peserta');
    }

    public function index()
    {
        $id_peserta = $this->session->userdata('id_peserta');
        $data = [
            'title' => 'Data Diri',
            'data_diri' => $this->m_peserta->getDataDiri($id_peserta)
        ];


        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
        $this->form_validation->set_rules('nisn', 'NISN', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => 'NISN harus berupa angka', 'CekNisn' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('telp', 'No Telp', 'numeric|trim', ['numeric' => '{field} harus berupa angka']);
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_peserta/v_data_diri');
        } else {
            $tgl = $this->input->post('tgl_lahir', true);
            $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');
            $data = [
                'nama_lengkap' => $this->input->post('nama', true),
                'nisn' => $this->input->post('nisn', true),
                'tempat_lahir' => $this->input->post('tempat_lahir', true),
                'tgl_lahir' => $tgl,
                'jenis_kelamin' => $this->input->post('gender'),
                'alamat_rumah' => $this->input->post('alamat', true),
                'agama' => $this->input->post('agama', true),
                'no_hp' => $this->input->post('telp', true)
            ];

            if ($this->m_peserta->updateData($data, $this->input->post('id'))) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('peserta/data_diri');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, data Penghargaan gagal diperbarui');
                redirect('peserta/data_diri');
            }
        }
    }

    public function CekNisn($nisn)
    {
        if ($this->m_peserta->cekNISN($nisn) > 0) {
            return false;
        } else {
            return true;
        }
    }
}
