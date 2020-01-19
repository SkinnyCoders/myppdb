<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Data_ortu extends CI_controller
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
            'title' => 'Data Orang Tua',
            'data_ortu' => $this->m_peserta->getDataOrtu(4)
        ];

        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('telp_ayah', 'No Telp Ayah', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka']);
        $this->form_validation->set_rules('alamat_ayah', 'Alamat Ayah', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('telp_ibu', 'No Telp Ibu', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka']);
        $this->form_validation->set_rules('alamat_ibu', 'Alamat Ibu', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_peserta/v_ortu');
        }else{
            $data = [
                'nama_ortu_ayah' => $this->input->post('nama_ayah', true),
                'pekerjaan_ortu_ayah' => $this->input->post('pekerjaan_ayah', true),
                'alamat_ortu_ayah' => $this->input->post('alamat_ayah', true),
                'no_hp_ortu_ayah' => $this->input->post('telp_ayah', true),
                'nama_ortu_ibu' => $this->input->post('nama_ibu', true),
                'pekerjaan_ortu_ibu' => $this->input->post('pekerjaan_ibu', true),
                'alamat_ortu_ibu' => $this->input->post('alamat_ibu', true),
                'no_hp_ortu_ibu' => $this->input->post('telp_ibu', true)
            ];

            if($this->m_peserta->getDataOrtu(4) != NULL){
                $update = $this->db->update('data_ortu', $data, ['id_ortu' => $this->input->post('id')]);

                if($update){
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                    redirect('peserta/data_ortu');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                    redirect('peserta/data_ortu');
                }
            }else{
                $insert = $this->db->insert('data_ortu', $data);
                $id_ortu = $this->db->insert_id();
 
                if($insert){
                    //update ke table peserta
                    $updatePeserta = $this->m_peserta->updatePesertaOrtu($id_ortu, $id_peserta);
                    if($updatePeserta){
                        //berhasil update
                        $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil ditambahkan');
                        redirect('peserta/data_ortu');
                    }else{
                        $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal ditambahkan');
                        redirect('peserta/data_ortu');
                        //gagal update peserta
                    }
                }else{
                    //gagal insert
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal ditambahkan');
                    redirect('peserta/data_ortu');
                }
            }
        }

    }
}
