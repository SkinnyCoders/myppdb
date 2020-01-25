<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Program_studi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(2);

        //load whatever you want bitch!!
    }

    public function index()
    {
        $data['title'] = 'Program Studi';
        $data['jurusan'] = $this->db->get('program_studi')->result_array();

        getViews($data, 'v_admin/v_program_studi');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Program Studi';

        $this->form_validation->set_rules(
            'nama',
            'Nama Program Studi',
            'required|trim|callback_CekJurusan',
            ['required' => '{field} tidak boleh kosong', 'CekJurusan' => 'Maaf, Nama Program Studi sudah digunakan!']
        );
        $this->form_validation->set_rules(
            'akreditasi',
            'Akreditasi',
            'required',
            ['required' => 'Harap pilih {field}!']
        );
        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi',
            'required|trim',
            ['required' => '{field} tidak boleh kosong']
        );

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_add_program_studi');
        } else {

            if (!empty($_FILES['foto']['name'])) {
                $gambar = uploadImage('foto', './assets/img/uploads/', '');
            } else {
                $gambar = 'default-image.png';
            }

            $slug = str_replace(' ', '-', $this->input->post('nama'));

            $data = [
                'nama_program_studi' => strtolower($this->input->post('nama', true)),
                'akreditasi_program_studi' => $this->input->post('akreditasi', true),
                'deskripsi_program_studi' => $this->input->post('deskripsi', true),
                'foto_program_studi' => $gambar,
                'slug' => strtolower($slug)
            ];

            if ($this->db->insert('program_studi', $data)) {
                $this->session->set_flashdata('msg_success', 'Selamt, Data Program Studi berhasil ditambahkan');
                redirect('admin/sekolah/program_studi');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Program Studi gagal ditambahkan');
                redirect('admin/sekolah/program_studi');
            }
        }
    }

    public function update()
    {
        //getting data for update
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {

            $dataJurusan = $this->db->get_where('program_studi', ['id_program_studi' => $_POST['id_get_update']])->row_array();

            $gambar = 'assets/img/uploads/' . $dataJurusan['foto_program_studi'];

            $data = [
                'id' => $dataJurusan['id_program_studi'],
                'nama' => $dataJurusan['nama_program_studi'],
                'akreditasi' => $dataJurusan['akreditasi_program_studi'],
                'deskripsi' => $dataJurusan['deskripsi_program_studi'],
                'foto' => base_url($gambar)
            ];

            echo json_encode($data);
        } elseif (isset($_POST['simpan'])) {
            $this->form_validation->set_rules('nama', 'Nama Program Studi', 'required|trim', ['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('akreditasi', 'Akreditasi', 'required', ['required' => 'Harap pilih {field}!']);
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/sekolah/program_studi');
            } else {
                $id_program = $_POST['id'];
                $dataJurusan = $this->db->get_where('program_studi', ['id_program_studi' => $id_program])->row_array();

                if (!empty($_FILES['foto']['name'])) {
                    $gambar = uploadImage('foto', './assets/img/uploads/', '');
                    if ($dataJurusan['foto_program_studi'] !== 'default-image.png') {
                        unlink('assets/img/uploads/' . $dataJurusan['foto_program_studi']);
                    }
                } else {
                    $gambar = $dataJurusan['foto_program_studi'];
                }

                $slug = str_replace(' ', '-', $this->input->post('nama'));

                $data = [
                    'nama_program_studi' => strtolower($this->input->post('nama', true)),
                    'akreditasi_program_studi' => $this->input->post('akreditasi'),
                    'deskripsi_program_studi' => $this->input->post('deskripsi', true),
                    'foto_program_studi' => $gambar,
                    'slug' => $slug
                ];

                $update = $this->db->update('program_studi', $data, ['id_program_studi' => $id_program]);

                if ($update) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data Program Studi berhasil diperbarui');
                    redirect('admin/sekolah/program_studi');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data Program Studi gagal diperbarui');
                    redirect('admin/sekolah/program_studi');
                }
            }
        }
    }

    public function delete($id)
    {
        $data = $this->db->get_where('program_studi', ['id_program_studi' => $id])->row_array();
        $delete = $this->db->delete('program_studi', ['id_program_studi' => $id]);

        if ($delete) {
            if ($data['foto_program_studi'] !== 'default-image.png') {
                unlink('assets/img/uploads/' . $data['foto_program_studi']);
            }

            $this->session->set_flashdata('msg_success', 'Selamat, Data Program Studi berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data Program Studi gagal dihapus');
            http_response_code(404);
        }
    }

    public function CekJurusan($str)
    {
        if ($this->db->get_where('program_studi', ['nama_program_studi' => $str])->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
