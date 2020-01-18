<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Jalur_pendaftaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuth(2);

        $this->load->model('m_pendaftaran');
    }

    public function index()
    {
        $data['title'] = 'Jalur Pendaftaran';
        $data['jalur'] = $this->m_pendaftaran->getJalur();

        getViews($data, 'v_admin/v_jalur_daftar');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Jalur Pendaftaran';

        $this->form_validation->set_rules('nama', 'Jalur Pendaftaran', 'required|trim|callback_cekNama', ['required' => '{field} tidak boleh kosong!', 'cekNama' => 'Jalur Pendaftaran sudah ada!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '{field} tidak boleh kosong!']);
        $this->form_validation->set_rules('persyaratan', 'Persyaratan', 'required|trim', ['required' => '{field} tidak boleh kosong!']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_add_jalur_daftar');
        } else {
            $syarat = explode(PHP_EOL, $this->input->post('persyaratan', true));

            $data = [
                'nama_jalur_pendaftaran' => $this->input->post('nama', true),
                'keterangan' => $this->input->post('deskripsi', true),
                'persyaratan' => json_encode($syarat),
                'status_jalur_pendaftaran' => true
            ];

            $insert = $this->db->insert('jalur_pendaftaran', $data);

            if ($insert) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                redirect('admin/jalur_pendaftaran');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal disimpan');
                redirect('admin/jalur_pendaftaran');
            }
        }
    }

    public function ubah($id)
    {
        $data['title'] = "Perbarui Jalur Pendaftaran";
        $data['jalur'] = $this->db->get_where('jalur_pendaftaran', ['id_jalur_pendaftaran' => $id])->row_array();

        $this->form_validation->set_rules('nama', 'Jalur Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '{field} tidak boleh kosong!']);
        $this->form_validation->set_rules('persyaratan', 'Persyaratan', 'required|trim', ['required' => '{field} tidak boleh kosong!']);

        if ($this->form_validation->run() == false) {
            getViews($data, 'v_admin/v_edit_jalur_daftar');
        } else {
            $syarat = explode(PHP_EOL, $this->input->post('persyaratan', true));

            $data = [
                'nama_jalur_pendaftaran' => $this->input->post('nama', true),
                'keterangan' => $this->input->post('deskripsi', true),
                'persyaratan' => json_encode($syarat)
            ];

            $update = $this->db->update('jalur_pendaftaran', $data, ['id_jalur_pendaftaran' => $id]);

            if ($update) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('admin/jalur_pendaftaran');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                redirect('admin/jalur_pendaftaran');
            }
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('jalur_pendaftaran', ['id_jalur_pendaftaran' => $id]);

        if ($delete) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal dihapus');
            http_response_code(404);
        }
    }

    public function cekNama($str)
    {
        $jalur = $this->db->get_where('jalur_pendaftaran', ['nama_jalur_pendaftaran' => $str])->num_rows();

        if ($jalur > 0) {
            return false;
        } else {
            return true;
        }
    }
}
