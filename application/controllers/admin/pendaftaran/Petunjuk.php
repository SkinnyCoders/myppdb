<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Petunjuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuth(2);

        $this->load->model('m_pendaftaran');
    }

    public function index()
    {
        $data = [
            'title' => 'Petunjuk Pendaftaran',
            'petunjuk' => $this->db->get('petunjuk_pendaftaran')->row_array()
        ];

        $this->form_validation->set_rules('petunjuk', 'Petunjuk Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_petunjuk_daftar');
        }else{
            if (!empty($_FILES['foto']['name'])) {
                $gambar = uploadImage('foto', './assets/img/uploads/','');
            }else{
                $gambar = '';
            }

            $ket = explode(PHP_EOL, $this->input->post('petunjuk', true));

            $data = [
                'gambar' => $gambar,
                'keterangan' => json_encode($ket)
            ];

            $cek = $this->db->get('petunjuk_pendaftaran')->row_array();
            if ($cek > 0) {
                $update = $this->db->update('petunjuk_pendaftaran', $data);

                if ($update) {
                    unlink('./assets/img/uploads/'.$cek['gambar']);
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                    redirect('admin/pendaftaran/petunjuk');
                }else{
                    $this->session->set_flashdata('msg_success', 'Maaf, Data gagal disimpan');
                    redirect('admin/pendaftaran/petunjuk');
                }
           
            }else{
                $insert = $this->db->insert('petunjuk_pendaftaran', $data);

                if ($insert) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                    redirect('admin/pendaftaran/petunjuk');
                }else{
                    $this->session->set_flashdata('msg_success', 'Maaf, Data gagal disimpan');
                    redirect('admin/pendaftaran/petunjuk');
                }
            }
        }

        
    }
}