<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Kuota extends CI_controller
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
        $data['kouta'] = $this->db->get('kouta_pendaftaran')->result_array();
        $data['tahun'] = $this->db->get('tahun_ajaran')->result_array();
        $data['jurusan'] = $this->db->get('program_studi')->result_array();
        $data['all_kuota'] = $this->db->query('SELECT id_kouta_pendaftaran, t.tahun_mulai, t.tahun_akhir, `jumlah`, s.nama_program_studi FROM `kouta_pendaftaran` AS k INNER JOIN program_studi AS s ON s.id_program_studi=k.`id_program_studi` INNER JOIN tahun_ajaran AS t ON t.id_tahun_ajaran=k.id_tahun_ajaran ORDER BY t.tahun_mulai DESC ')->result_array();

        $this->form_validation->set_rules('tahun', 'Tahun Ajaran', 'required|callback_CekKuota', ['required' => 'Harap pilih tahun ajaran!', 'CekKuota' => '{field} sudah dikonfigurasi']);
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|callback_CekKuota', ['required' => 'Harap pilih {field}!', 'CekKuota' => '{field} sudah dikonfigurasi']);
        $this->form_validation->set_rules('kouta', 'Kouta Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Kouta Pendaftaran';
            getViews($data, 'v_admin/v_kuota');
        } else {
            $data = [
                'id_program_studi' => $this->input->post('jurusan', true),
                'id_tahun_ajaran' => $this->input->post('tahun', true),
                'jumlah' => $this->input->post('kouta', true)
            ];

            $insert = $this->db->insert('kouta_pendaftaran', $data);

            if ($insert) {
                $this->session->set_flashdata('msg_success', 'Selamt, Data kouta pendaftaran berhasil ditambah');
                redirect('admin/sekolah/kuota');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data kouta pendaftaran gagal ditambah');
                redirect('admin/sekolah/kuota');
            }
        }
    }

    public function update()
    {
        //getting data for update
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
            $id_kuota = $_POST['id_get_update'];

            $kuota = $this->db->get_where('kouta_pendaftaran', ['id_kouta_pendaftaran' => $id_kuota])->row_array();

            echo json_encode($kuota);
        }

        if (isset($_POST['simpan'])) {
            $id = $_POST['id'];

            $this->form_validation->set_rules('tahun', 'Tahun Ajaran', 'required', ['required' => 'Harap pilih tahun ajaran!']);
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', ['required' => 'Harap pilih {field}!']);
            $this->form_validation->set_rules('kouta', 'Kouta Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal diperbarui');
                redirect('admin/sekolah/kuota');
            } else {
                $data = [
                    'id_program_studi' => $this->input->post('jurusan', true),
                    'id_tahun_ajaran' => $this->input->post('tahun', true),
                    'jumlah' => $this->input->post('kouta', true)
                ];

                if ($this->db->update('kouta_pendaftaran', $data, ['id_kouta_pendaftaran' => $id])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data tahun ajaran berhasil diperbarui');
                    redirect('admin/sekolah/kuota');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal diperbarui');
                    redirect('admin/sekolah/kuota');
                }
            }
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('kouta_pendaftaran', ['id_kouta_pendaftaran' => $id]);

        if ($delete) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal dihapus');
            http_response_code(404);
        }
    }

    public function CekKuota()
    {
        $tahun = $this->input->post('tahun');
        $jurusan = $this->input->post('jurusan');

        $flag = $this->db->get_where('kouta_pendaftaran', ['id_program_studi' => $jurusan, 'id_tahun_ajaran' => $tahun])->num_rows();
        if ($flag > 0) {
            return false;
        } else {
            return true;
        }
    }
}
