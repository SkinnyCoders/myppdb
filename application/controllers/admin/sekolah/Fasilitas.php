<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Fasilitas extends CI_controller
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
        $data['title'] = 'Fasilitas';
        $data['fasilitas'] = $this->m_home->getAllFacility();

        getViews($data, 'v_admin/v_fasilitas');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Fasilitas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Fasilitas';

            getViews($data, 'v_admin/v_add_fasilitas');
        } else {
            if (!empty($_FILES['foto']['name'])) {
                $gambar = uploadImage('foto', './assets/img/uploads/', '');
            } else {
                $gambar = 'default-image.png';
            }

            $data = [
                'nama_fasilitas' => $this->input->post('nama', true),
                'deskripsi_fasilitas' => $this->input->post('deskripsi', true),
                'foto_fasilitas' => $gambar
            ];

            if (insertData('fasilitas', $data)) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data Fasilitas berhasil ditambahkan');
                redirect('admin/sekolah/fasilitas');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Fasilitas gagal ditambahkan');
                redirect('admin/sekolah/fasilitas/tambah');
            }
        }
    }

    public function update()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $_POST['id']])->row_array();
            $gambar = 'assets/img/uploads/' . $fasilitas['foto_fasilitas'];

            $dataFasilitas = [
                'id' => $fasilitas['id_fasilitas'],
                'nama' => $fasilitas['nama_fasilitas'],
                'deskripsi' => $fasilitas['deskripsi_fasilitas'],
                'foto' => base_url($gambar)
            ];

            echo json_encode($dataFasilitas);
        }

        if (isset($_POST['simpan'])) {
            $this->form_validation->set_rules('nama', 'Nama Fasilitas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf Data gagal diperbarui');
                redirect('admin/sekolah/fasilitas');
            } else {
                $id_fasilitas = $fasilitas['id_fasilitas'];

                if (!empty($_FILES['foto']['name'])) {
                    $gambar = uploadImage('foto', './assets/img/uploads/', '');
                    if ($fasilitas['foto_fasilitas'] !== 'default-image.png') {
                        unlink('assets/img/uploads/' . $fasilitas['foto_fasilitas']);
                    }
                } else {
                    $gambar = $fasilitas['foto_fasilitas'];
                }

                $data = [
                    'nama_fasilitas' => $this->input->post('nama', true),
                    'deskripsi_fasilitas' => $this->input->post('deskripsi', true),
                    'foto_fasilitas' => $gambar
                ];

                //update
                $update = $this->db->update('fasilitas', $data, ['id_fasilitas' => $id_fasilitas]);

                if ($update) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                    redirect('admin/sekolah/fasilitas');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, data Penghargaan gagal diperbarui');
                    redirect('admin/sekolah/fasilitas');
                }
            }
        }
    }

    public function delete($id)
    {
        if (!empty($id)) {
            //delete proses
            $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id])->row_array();
            $delete = $this->db->delete('fasilitas', ['id_fasilitas' => $id]);

            if ($delete) {
                if ($fasilitas['foto_fasilitas'] !== 'default-image.png') {
                    unlink('assets/img/uploads/' . $fasilitas['foto_fasilitas']);
                }
                $this->session->set_flashdata('msg_success', 'Selamat, Data fasilitas berhasil dihapus');
                http_response_code(200);
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data fasilitas gagal dihapus');
                http_response_code(404);
            }
        }
    }
}
