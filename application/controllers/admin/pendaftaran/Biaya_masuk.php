<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Biaya_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuth(2);

        $this->load->model('m_pendaftaran');
    }

    public function index()
    {
        $data= [ 
            'title' => 'Biaya Masuk',
            'biaya' => $this->m_pendaftaran->getBiaya(),
            'jurusan' => $this->m_pendaftaran->getJurusan(),
            'tahun_ajaran' => $this->db->get('tahun_ajaran')->result_array()
        ];


        getViews($data, 'v_admin/v_biaya_masuk');
    }

    public function tambah(){
        $data['title'] = 'Tambah Biaya Masuk';
        $data['jurusan'] = $this->m_pendaftaran->getJurusan();
        $data['tahun_ajaran'] = $this->db->get('tahun_ajaran')->result_array();

        $this->form_validation->set_rules('biaya', 'Biaya Masuk', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jalur', 'Jalur Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jurusan', 'Program Studi', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jumlah', 'Jumlah Biaya', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka']);
        $this->form_validation->set_rules('batas', 'Batas Pembayaran', 'required', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_add_biaya');
        }else{
            $batas = DateTime::createFromFormat('m/d/Y', $this->input->post('batas'))->format('Y-m-d');

            $data = [
                'id_jalur_pendaftaran' => $this->input->post('jalur'),
                'id_program_studi' => $this->input->post('jurusan'),
                'id_tahun_ajaran' => $this->input->post('tahun_ajaran'),
                'jenis_biaya_masuk' => $this->input->post('biaya', true),
                'jumlah_biaya_masuk' => $this->input->post('jumlah', true),
                'batas_pembayaran' => $batas
            ];

            if (insertData('biaya_masuk', $data)) {
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('admin/pendaftaran/biaya_masuk');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/pendaftaran/biaya_masuk');
            }
        }
    }

    public function update(){
        $id_biaya = $_POST['id'];

        $this->form_validation->set_rules('biaya', 'Biaya Masuk', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jalur', 'Jalur Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jurusan', 'Program Studi', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('jumlah', 'Jumlah Biaya', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka']);
        $this->form_validation->set_rules('batas', 'Batas Pembayaran', 'required', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {$this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/pendaftaran/biaya_masuk');getViews($data, 'v_admin/v_add_biaya');
        }else{
            $batas = DateTime::createFromFormat('m/d/Y', $this->input->post('batas'))->format('Y-m-d');

            $data = [
                'id_jalur_pendaftaran' => $this->input->post('jalur'),
                'id_program_studi' => $this->input->post('jurusan'),
                'id_tahun_ajaran' => $this->input->post('tahun_ajaran'),
                'jenis_biaya_masuk' => $this->input->post('biaya', true),
                'jumlah_biaya_masuk' => $this->input->post('jumlah', true),
                'batas_pembayaran' => $batas
            ];

            if (updateData('biaya_masuk', $data, 'id_biaya_masuk', $id_biaya)) {
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                redirect('admin/pendaftaran/biaya_masuk');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/pendaftaran/biaya_masuk');
            }
        }
    }

    public function delete($id){
        $delete = $this->db->delete('biaya_masuk', ['id_biaya_masuk' => $id]);

        if ($delete) {
            $this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
            http_response_code(200);
        }else{
            $this->session->set_flashdata('msg_failed', 'Maaf, data gagal dihapus');
            http_response_code(500);
        }
    }

    public function get_jalur(){
        if (isset($_POST['id'])) {
            $id_prodi = $_POST['id'];
            $data = $this->m_pendaftaran->getJalurJurusan($id_prodi);

            echo json_encode($data);
        }
    }

    public function get_data(){
        if (isset($_POST['id'])) {
            $id_biaya = $_POST['id'];

            $biaya = $this->db->get_where('biaya_masuk', ['id_biaya_masuk' => $id_biaya])->row_array();
            $batas = DateTime::createFromFormat('Y-m-d', $biaya['batas_pembayaran'])->format('m/d/Y');

            $data = [
                'id_biaya_masuk' => $biaya['id_biaya_masuk'],
                'id_jalur_pendaftaran' => $biaya['id_jalur_pendaftaran'],
                'id_program_studi' => $biaya['id_program_studi'],
                'id_tahun_ajaran' => $biaya['id_tahun_ajaran'],
                'jenis_biaya_masuk' => $biaya['jenis_biaya_masuk'],
                'jumlah_biaya_masuk' => $biaya['jumlah_biaya_masuk'],
                'batas_pembayaran' => $batas
            ];
            echo json_encode($data);
        }
    }
}