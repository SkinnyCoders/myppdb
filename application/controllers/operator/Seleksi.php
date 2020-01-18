<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Seleksi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(3);

        //load whatever you want bitch!!
        $this->load->model('m_seleksi');
    }

    public function index()
    {
        $data['title'] = "Soal Seleksi";
        $data['seleksi'] = $this->m_seleksi->getAll();

        getViews($data, 'v_operator/v_seleksi');
    }

    public function add()
    {
        $data['title'] = 'Tambah Seleksi';

        $this->form_validation->set_rules('nama', 'Nama Seleksi', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Seleksi', 'required|trim');
        $this->form_validation->set_rules('bobot', 'Bobot Seleksi', 'required|trim|less_than[100]', ['less_than' => 'Bobot Maksimal tidak boleh lebih 100%']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_operator/v_add_seleksi');
        } else {
            //insert tes seleksi
            $data = [
                'nama_tes_seleksi' => $this->input->post('nama', true),
                'deskripsi_tes_seleksi' => $this->input->post('deskripsi', true),
                'bobot_tes' => $this->input->post('bobot')
            ];

            $insert = $this->m_seleksi->add_seleksi($data);

            if ($insert > 0) {
                $soal = $this->input->post('soal', true);
                $jawab_a = $this->input->post('jawab_a', true);
                $jawab_b = $this->input->post('jawab_b', true);
                $jawab_c = $this->input->post('jawab_c', true);
                $jawab_d = $this->input->post('jawab_d', true);
                $jawab_benar = $this->input->post('jawab_benar');
                array_pop($soal);

                for ($i = 0; $i < count($soal); $i++) {

                    $_FILES['img']['name'] = $_FILES['foto']['name'][$i];
                    $_FILES['img']['type'] = $_FILES['foto']['type'][$i];
                    $_FILES['img']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                    $_FILES['img']['error'] = $_FILES['foto']['error'][$i];
                    $_FILES['img']['size'] = $_FILES['foto']['size'][$i];

                    $config['upload_path']          = './assets/img/seleksi_file/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['encrypt_name']         = TRUE;
                    $config['overwrite']            = true;
                    $config['max_size']             = 2048; //2mb

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('img')) {
                        $gambar = 'default.png';
                    } else {
                        $gambar = $this->upload->data('file_name');
                    }

                    $data_soal = [
                        'id_tes_seleksi' => $insert,
                        'soal_tes_seleksi' => strtolower($soal[$i]),
                        'file_tes' => $gambar,
                        'jawaban_a' => strtolower($jawab_a[$i]),
                        'jawaban_b' => strtolower($jawab_b[$i]),
                        'jawaban_c' => strtolower($jawab_c[$i]),
                        'jawaban_d' => strtolower($jawab_d[$i]),
                        'jawaban_benar' => $jawab_benar[$i]
                    ];

                    //insert soal 
                    $insertSoal = $this->db->insert('soal_tes_seleksi', $data_soal);
                }

                $this->session->set_flashdata('msg_success', 'Selamat, Data Seleksi Berhasil Ditambahkan');
                redirect('operator/soal-seleksi');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Seleksi Gagal Ditambahkan');
                redirect('operator/soal-seleksi');
            }
        }
    }

    public function update($id)
    {
        $data['title'] = 'Perbarui Seleksi';
        $data['soal'] = $this->m_seleksi->getAllSoal($id);
        $data['seleksi'] = $this->m_seleksi->getSeleksi($id);

        $this->form_validation->set_rules('nama', 'Nama Seleksi', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Seleksi', 'required|trim');
        $this->form_validation->set_rules('bobot', 'Bobot Seleksi', 'required|trim|less_than[100]', ['less_than' => 'Bobot Maksimal tidak boleh lebih 100%']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_operator/v_edit_seleksi');
        } else {
            //update data
            $data = [
                'nama_tes_seleksi' => $this->input->post('nama', true),
                'deskripsi_tes_seleksi' => $this->input->post('deskripsi', true),
                'bobot_tes' => $this->input->post('bobot')
            ];

            $update = $this->m_seleksi->updateSeleksi($data, $id);

            if ($update) {

                $soal = $this->input->post('soal', true);
                $jawab_a = $this->input->post('jawab_a', true);
                $jawab_b = $this->input->post('jawab_b', true);
                $jawab_c = $this->input->post('jawab_c', true);
                $jawab_d = $this->input->post('jawab_d', true);
                $jawab_benar = $this->input->post('jawab_benar');
                $id_soal = $this->input->post('id_soal');
                $file_tes = $this->input->post('file_image');
                array_pop($soal);

                for ($i = 0; $i < count($soal); $i++) {
                    if (!empty($_FILES['foto']['name'][$i])) {
                        $_FILES['img']['name'] = $_FILES['foto']['name'][$i];
                        $_FILES['img']['type'] = $_FILES['foto']['type'][$i];
                        $_FILES['img']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                        $_FILES['img']['error'] = $_FILES['foto']['error'][$i];
                        $_FILES['img']['size'] = $_FILES['foto']['size'][$i];

                        $config['upload_path']          = './assets/img/seleksi_file/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['encrypt_name']         = TRUE;
                        $config['overwrite']            = true;
                        $config['max_size']             = 2048; //2mb

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('img')) {
                            $gambar = $file_tes[$i];
                        } else {
                            $gambar = $this->upload->data('file_name');
                        }
                    } else {
                        $gambar = $file_tes[$i];
                    }

                    $data_soal = [
                        'soal_tes_seleksi' => strtolower($soal[$i]),
                        'file_tes' => $gambar,
                        'jawaban_a' => strtolower($jawab_a[$i]),
                        'jawaban_b' => strtolower($jawab_b[$i]),
                        'jawaban_c' => strtolower($jawab_c[$i]),
                        'jawaban_d' => strtolower($jawab_d[$i]),
                        'jawaban_benar' => $jawab_benar[$i]
                    ];

                    $this->db->update('soal_tes_seleksi', $data_soal, ['id_soal_tes_seleksi' => $id_soal[$i]]);
                }

                $this->session->set_flashdata('msg_success', 'Selamat, Data Seleksi Berhasil Diperbarui');
                redirect('operator/soal-seleksi');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Seleksi Gagal Diperbarui!');
                redirect('operator/soal-seleksi');
            }
        }
    }

    public function detail($id)
    {
        $data['detail'] = $this->m_seleksi->getDetail($id);
        $data['id_seleksi'] = $this->uri->segment(4);
        if (empty($data['detail'])) {
            $data['title'] = "Detail Soal Seleksi";
            // $this->session->set_flashdata('msg_failed', 'Maaf, Tes Seleksi belum mempunyai Soal!, Harap tambahkan!');
            // return false;
        } else {
            $data['title'] = "Detail Soal Seleksi " . $data['detail'][0]['nama_tes_seleksi'];
        }
        getViews($data, 'v_operator/v_detail_seleksi');
    }

    public function add_soal($id)
    {

        $data['seleksi'] = $this->db->get_where('tes_seleksi', ['id_tes_seleksi' => $id])->row_array();
        $id_seleksi = $data['seleksi']['id_tes_seleksi'];
        $data['title'] = "Tambah Soal " . $data['seleksi']['nama_tes_seleksi'];

        getViews($data, 'v_operator/v_add_soal_seleksi');

        if (isset($_POST['submit'])) {
            $soal_cek = $this->input->post('soal', true);
            array_pop($soal_cek);
        }

        if (!empty($soal_cek)) {

            $soal = $this->input->post('soal', true);
            $jawab_a = $this->input->post('jawab_a', true);
            $jawab_b = $this->input->post('jawab_b', true);
            $jawab_c = $this->input->post('jawab_c', true);
            $jawab_d = $this->input->post('jawab_d', true);
            $jawab_benar = $this->input->post('jawab_benar');

            for ($i = 0; $i < count($soal_cek); $i++) {

                $_FILES['img']['name'] = $_FILES['foto']['name'][$i];
                $_FILES['img']['type'] = $_FILES['foto']['type'][$i];
                $_FILES['img']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                $_FILES['img']['error'] = $_FILES['foto']['error'][$i];
                $_FILES['img']['size'] = $_FILES['foto']['size'][$i];

                $config['upload_path']          = './assets/img/seleksi_file/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['encrypt_name']         = TRUE;
                $config['overwrite']            = true;
                $config['max_size']             = 2048; //2mb

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('img')) {
                    $gambar = 'default.png';
                } else {
                    $gambar = $this->upload->data('file_name');
                }

                $data_soal = [
                    'id_tes_seleksi' => $id_seleksi,
                    'soal_tes_seleksi' => strtolower($soal[$i]),
                    'file_tes' => $gambar,
                    'jawaban_a' => strtolower($jawab_a[$i]),
                    'jawaban_b' => strtolower($jawab_b[$i]),
                    'jawaban_c' => strtolower($jawab_c[$i]),
                    'jawaban_d' => strtolower($jawab_d[$i]),
                    'jawaban_benar' => $jawab_benar[$i]
                ];

                //insert soal 
                $insertSoal = $this->db->insert('soal_tes_seleksi', $data_soal);
            }

            $this->session->set_flashdata('msg_success', 'Selamat, Data Seleksi Berhasil Ditambahkan');
            redirect('operator/soal-seleksi/detail/' . $id_seleksi);
        }
    }

    public function update_soal($id)
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id_soal = $_POST['id'];
            $dataSoal = $this->db->get_where('soal_tes_seleksi', ['id_soal_tes_seleksi' => $id_soal])->row_array();
            $gambar_old = 'assets/img/seleksi_file/' . $dataSoal['file_tes'];

            $data = [
                'id' => $dataSoal['id_soal_tes_seleksi'],
                'soal' => $dataSoal['soal_tes_seleksi'],
                'file' => base_url($gambar_old),
                'jawab_a' => $dataSoal['jawaban_a'],
                'jawab_b' => $dataSoal['jawaban_b'],
                'jawab_c' => $dataSoal['jawaban_c'],
                'jawab_d' => $dataSoal['jawaban_d'],
                'jawab_benar' => $dataSoal['jawaban_benar']
            ];

            echo json_encode($data);
        } else {
            $this->db->select('file_tes');
            $dataFile = $this->db->get_where('soal_tes_seleksi', ['id_soal_tes_seleksi' => $_POST['id_soal']])->row_array();
            $gambar_old = 'assets/img/seleksi_file/' . $dataFile['file_tes'];

            if (!empty($_FILES['foto']['name'])) {
                $gambar = uploadImage('foto', './assets/img/seleksi_file/', '');
                if ($gambar_old !== 'default.png') {
                    unlink($gambar_old);
                }
            } else {
                $gambar = $dataFile['file_tes'];
            }

            $id_soal = $_POST['id_soal'];

            $data_soal = [
                'soal_tes_seleksi' => strtolower($this->input->post('soal', true)),
                'file_tes' => $gambar,
                'jawaban_a' => strtolower($this->input->post('jawab_a', true)),
                'jawaban_b' => strtolower($this->input->post('jawab_b', true)),
                'jawaban_c' => strtolower($this->input->post('jawab_c', true)),
                'jawaban_d' => strtolower($this->input->post('jawab_d', true)),
                'jawaban_benar' => $this->input->post('jawab_benar', true)
            ];

            $update = $this->db->update('soal_tes_seleksi', $data_soal, ['id_soal_tes_seleksi' => $id_soal]);

            if ($update) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data Seleksi Berhasil Ditambahkan');
                redirect('operator/soal-seleksi/detail/' . $id);
            } else {
                $this->session->set_flashdata('msg_success', 'Selamat, Data Seleksi Berhasil Ditambahkan');
                redirect('operator/soal-seleksi/detail/' . $id);
            }
        }
    }

    public function delete_soal()
    {
        if (isset($_POST['id_soal'])) {
            $delete = $this->db->delete('soal_tes_seleksi', ['id_soal_tes_seleksi' => $_POST['id_soal']]);

            if ($delete) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data soal berhasil dihapus');
                http_response_code(200);
                return false;
            }

            if (!$delete) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data soal gagal dihapus');
                http_response_code(404);
                return false;
            }
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data soal gagal dihapus');
            http_response_code(404);
            return false;
        }
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $delete = $this->db->delete('tes_seleksi', ['id_tes_seleksi' => $_POST['id']]);

            if ($delete) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data Seleksi berhasil dihapus');
                http_response_code(200);
                return false;
            }

            if (!$delete) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Seleksi gagal dihapus');
                http_response_code(404);
                return false;
            }
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data Seleksi gagal dihapus');
            http_response_code(404);
            return false;
        }
    }
}
