<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Sekolah_asal extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        // getAuth(1);
        $this->load->model('m_peserta');
    }

    public function index()
    {
        $id_peserta = 4;
        $data = [
            'title' => 'Data Sekolah Asal',
            'data_sekolah' => $this->m_peserta->getDataSekolah($id_peserta)
        ];

        $this->form_validation->set_rules('nama', 'Sekolah Asal', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('telp', 'No Telpon Sekolah Asal', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya boleh angka']);
        $this->form_validation->set_rules('thn_masuk', 'Tahun Masuk', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong' , 'numeric' => '{field} hanya boleh angka']);
        $this->form_validation->set_rules('thn_lulus', 'Tahun Lulus', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya boleh angka']);
        $this->form_validation->set_rules('alamat', 'Tahun Lulus', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_peserta/v_sekolah_asal');
        } else {
            $data = [
                'nama_sekolah_asal' => $this->input->post('nama', true),
                'tahun_masuk_sekolah_asal' => $this->input->post('thn_masuk', true),
                'tahun_lulus_sekolah_asal' => $this->input->post('thn_lulus', true),
                'alamat_sekolah_asal' => $this->input->post('alamat', true),
                'no_telp_sekolah_asal' => $this->input->post('telp', true)
            ];

            if ($this->m_peserta->getDataSekolah($id_peserta) !== NULL) {
                $update = $this->db->update('data_sekolah_asal', $data, ['id_data_sekolah_asal' => $this->input->post('id')]);

                if ($update) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                    redirect('peserta/sekolah_asal');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                    redirect('peserta/sekolah_asal');
                }
            } else {
                $insert = $this->db->insert('data_sekolah_asal', $data);
                $id_sekolah = $this->db->insert_id();
                if ($insert) {
                    $updatePeserta = $this->m_peserta->updatePesertaSekolah($id_sekolah, $id_peserta);
                    if ($updatePeserta) {
                        //berhasil update
                        $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil ditambahkan');
                        redirect('peserta/sekolah_asal');
                    } else {
                        $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal ditambahkan');
                        redirect('peserta/sekolah_asal');
                        //gagal update peserta
                    }
                } else {
                    //gagal insert
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal ditambahkan');
                    redirect('peserta/sekolah_asal');
                }
            }
        }
    }
}
