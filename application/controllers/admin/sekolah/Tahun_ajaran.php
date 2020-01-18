<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Tahun_ajaran extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(2);

        //load whatever you want bitch!!
        $this->load->model('m_tahun_ajaran');
    }

    public function index()
    {
        $data['tahun_ajaran'] = $this->m_tahun_ajaran->getAll();

        $this->form_validation->set_rules('tahun1', 'Tahun Awal', 'required|trim');
        $this->form_validation->set_rules('tahun2', 'Tahun Akhir', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tahun Ajaran';

            $this->load->view('templates/admin_header', $data);
            $this->load->view('v_admin/v_tahun_ajaran', $data);
            $this->load->view('templates/admin_footer');
        } else {
            //insert new data
            $tahun1 = $this->input->post('tahun1', true);
            $tahun2 = $this->input->post('tahun2', true);

            if ($tahun2 > $tahun1 + 1) {
                $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh lebih dari satu tahun!');
                redirect('admin/sekolah/tahun_ajaran');
                return false;
            }

            if ($tahun1 >= $tahun2) {
                $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh kurang atau sama dengan tahun awal!');
                redirect('admin/sekolah/tahun_ajaran');
                return false;
            }

            for ($i = 0; $i < count($data['tahun_ajaran']); $i++) {
                if ($data['tahun_ajaran'][$i]['tahun_mulai'] == $tahun1 && $data['tahun_ajaran'][$i]['tahun_akhir'] == $tahun2) {
                    $this->session->set_flashdata('msg_failed', 'Tahun Ajaran sudah ada!');
                    redirect('admin/sekolah/tahun_ajaran');
                    return false;
                }
            }

            $data = [
                'tahun_mulai' => $tahun1,
                'tahun_akhir' => $tahun2
            ];

            if ($this->m_tahun_ajaran->addTahun($data)) {
                $this->session->set_flashdata('msg_success', 'Selamat, data tahun ajaran berhasil ditambahkan');
                redirect('admin/sekolah/tahun_ajaran');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, data tahun ajaran gagal ditambahkan');
                redirect('admin/sekolah/tahun_ajaran');
            }
        }
    }

    public function update()
    {
        //getting data for update
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
            $id_tahunAjaran = $_POST['id_get_update'];

            $tahunAjaran = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => $id_tahunAjaran])->row_array();

            echo json_encode($tahunAjaran);
        }

        if (isset($_POST['simpan'])) {
            $id = $_POST['id'];

            $this->form_validation->set_rules('tahun1', 'Tahun Awal', 'required|trim');
            $this->form_validation->set_rules('tahun2', 'Tahun Akhir', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal diperbarui');
                redirect('admin/sekolah/tahun_ajaran');
            } else {

                $tahun1 = $this->input->post('tahun1', true);
                $tahun2 = $this->input->post('tahun2', true);

                if ($tahun2 > $tahun1 + 1) {
                    $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh lebih dari satu tahun!');
                    redirect('admin/sekolah/tahun_ajaran');
                    return false;
                }

                if ($tahun1 >= $tahun2) {
                    $this->session->set_flashdata('msg_failed', 'Tahun Akhir tidak boleh kurang atau sama dengan tahun awal!');
                    redirect('admin/sekolah/tahun_ajaran');
                    return false;
                }

                $data = [
                    'tahun_mulai' => $tahun1,
                    'tahun_akhir' => $tahun2
                ];

                if ($this->db->update('tahun_ajaran', $data, ['id_tahun_ajaran' => $id])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data tahun ajaran berhasil diperbarui');
                    redirect('admin/sekolah/tahun_ajaran');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal diperbarui');
                    redirect('admin/sekolah/tahun_ajaran');
                }
            }
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('tahun_ajaran', ['id_tahun_ajaran' => $id]);

        if ($delete) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data tahun ajaran berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal dihapus');
            http_response_code(404);
        }
    }
}
