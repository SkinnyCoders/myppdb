<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pengguna extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(2);

        //load whatever you want bitch!!
        $this->load->model('m_users');
    }

    public function index()
    {
        $data['title'] = 'Pengguna';
        $data['users'] = $this->m_users->getAllUser();

        getViews($data, 'v_admin/v_users');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pengguna';

        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            ['required' => '{field} tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'gender',
            'Jenis Kelamin',
            'required',
            ['required' => '{field} tidak boleh kosong']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|trim|callback_CekEmail',
            ['required' => '{field} tidak boleh kosong', 'valid_email' => 'Maaf, {field} tidak valid', 'CekEmail' => 'Maaf, {field} sudah digunakan!']
        );
        $this->form_validation->set_rules(
            'role',
            'Sebagai',
            'required',
            ['required' => 'Harap, Pilih salah satu!']
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            ['min_lenght' => '{field} terlalu pendek', 'required' => '{field} tidak boleh kosong']
        );
        $this->form_validation->set_rules(
            'password1',
            'Konfirm Password',
            'required|matches[password]',
            ['matches' => 'Password tidak sama', 'required' => '{field} tidak boleh kosong']
        );

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_add_user');
        } else {
            $nama       = $this->input->post('nama', true);
            $gender     = $this->input->post('gender');
            $email      = $this->input->post('email', true);
            $role       = $this->input->post('role', true);
            $password   = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $foto       = $this->_uploadImage();

            $data = [
                'id_role' => $role,
                'nama_pengguna' => $nama,
                'foto_pengguna' => $foto,
                'email_pengguna' => $email,
                'password' => $password,
                'jenis_kelamin' => $gender
            ];

            //proses insert data
            $insertUser = $this->m_users->addUser($data);
            if ($insertUser) {
                $this->session->set_flashdata('msg_success', 'Selamat, Pengguna berhasil digunakan');
                redirect('admin/pengguna');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Pengguna gagal ditambahkan');
                redirect('admin/pengguna');
            }
        }
    }

    public function update($id)
    {
        $data['title']  = 'Ubah Pengguna';
        $data['user']   = $this->m_users->editUser($id);


        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            ['required' => 'Nama tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'gender',
            'Jenis Kelamin',
            'required',
            ['required' => 'Jenis Kelamin tidak boleh kosong']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|trim|callback_CekEmail',
            ['required' => 'Email tidak boleh kosong', 'valid_email' => 'Maaf, Email tidak valid', 'CekEmail' => 'Maaf, {field} sudah digunakan!']
        );
        $this->form_validation->set_rules(
            'role',
            'Sebagai',
            'required',
            ['required' => 'Harap, Pilih salah satu!']
        );
        // $this->form_validation->set_rules('password', 'Password', 'required', 
        //     ['min_lenght' => 'Password terlalu pendek', 'required' => 'Password tidak boleh kosong']);
        // $this->form_validation->set_rules('password1', 'Konfirm Password', 'required|matches[password]', ['matches' => 'Password tidak sama', 'required' => 'Konfirmasi Password tidak boleh kosong']);

        if (!empty($data['user'])) {
            if ($this->form_validation->run() == FALSE) {
                getViews($data, 'v_admin/v_edit_user');
            } else {
                if (!empty($_FILES['foto']['name'])) {
                    //do upload for new image
                    $foto = $this->_uploadImage();

                    //deleting old image
                    if ($foto && $data['user'][0]['foto_pengguna'] !== 'default.png') {
                        unlink('assets/img/user/' . $data['user'][0]['foto_pengguna']);
                    }
                } else {
                    $foto = $data['user'][0]['foto_pengguna'];
                }

                $data = [
                    'id_role'       => $this->input->post('role'),
                    'nama_pengguna' => $this->input->post('nama', true),
                    'foto_pengguna' => $foto,
                    'email_pengguna' => $this->input->post('email', true),
                    'jenis_kelamin' => $this->input->post('gender')
                ];

                //update user
                $update = $this->m_users->updateUser($data, $id);
                if ($update) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data pengguna berhasil diubah');
                    redirect('admin/pengguna');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data pengguna gagal diubah');
                    redirect('admin/pengguna/ubah/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data pengguna tidak ditemukan');
            redirect('admin/pengguna');
        }
    }

    public function delete($id)
    {
        if (!empty($id)) {
            //delete proses
            $delete = $this->db->delete('pengguna', ['id_pengguna' => $id]);

            if ($delete) {

                $data['user']   = $this->m_users->editUser($id);
                if ($data['user'][0]['foto_pengguna'] !== 'default.png') {
                    unlink('assets/img/user/' . $data['user'][0]['foto_pengguna']);
                }
                $this->session->set_flashdata('msg_success', 'Selamat, Data pengguna berhasil dihapus');
                http_response_code(200);
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data pengguna gagal dihapus');
                http_response_code(404);
            }
        }
    }

    public function CekEmail($str)
    {
        if ($this->m_users->cekUser($str) >= 1) {
            return false;
        } else {
            return true;
        }
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return 'default.png';
        } else {
            return $this->upload->data('file_name');
        }
    }
}
