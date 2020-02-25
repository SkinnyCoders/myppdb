<?php


/**
 * 
 */
class Penghargaan extends CI_Controller
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
        $data['title'] = 'Penghargaan';
        $data['penghargaan'] = $this->m_home->getArchive();

        getViews($data, 'v_admin/v_penghargaan');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Penghargaan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl', 'Tanggal', 'required', ['required' => '{field} tidak boleh kosong!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Penghargaan';

            getViews($data, 'v_admin/v_add_penghargaan');
        } else {
            if (!empty($_FILES['foto']['name'])) {
                $gambar = uploadImage('foto', 'assets/img/uploads/', '');
            } else {
                $gambar = 'default-image.png';
            }

            $data = [
                'nama_penghargaan' => $this->input->post('nama', true),
                'deskripsi_penghargaan' => $this->input->post('deskripsi', true),
                'foto_penghargaan' => $gambar,
                'tanggal_penghargaan' => $this->input->post('tgl')
            ];

            $insert = $this->m_home->addArchive($data);

            if ($insert) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil disimpan');
                redirect('admin/sekolah/penghargaan');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal disimpan');
                redirect('admin/sekolah/penghargaan');
            }
        }
    }

    public function update()
    {
        if (isset($_POST['id'])) {
            $id_penghargaan = $_POST['id'];

            $dataPenghargaan = $this->db->get_where('penghargaan', ['id_penghargaan' => $id_penghargaan])->row_array();
            $image = 'assets/img/uploads/' . $dataPenghargaan['foto_penghargaan'];
            $data = [
                'id' => $dataPenghargaan['id_penghargaan'],
                'foto' => base_url($image),
                'nama_penghargaan' => $dataPenghargaan['nama_penghargaan'],
                'deskripsi_penghargaan' => $dataPenghargaan['deskripsi_penghargaan'],
                'tanggal_penghargaan' => $dataPenghargaan['tanggal_penghargaan']
            ];
            echo json_encode($data);
        }

        if (isset($_POST['simpan'])) {
            $id_penghargaan = $_POST['id'];

            $this->form_validation->set_rules('nama', 'nama', 'required|trim');
            $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data Penghargaan gagal diperbarui');
                redirect('admin/sekolah/penghargaan');
            } else {
                if (!empty($_FILES['foto']['name'])) {
                    $gambar = uploadImage('foto', 'assets/img/uploads/', '');
                    if ($dataPenghargaan['foto_penghargaan'] !== 'default-image.png') {
                        unlink('assets/img/uploads/' . $dataPenghargaan['foto_penghargaan']);
                    }
                } else {
                    $gambar = $dataPenghargaan['foto_penghargaan'];
                }

                $data = [
                    'nama_penghargaan' => $this->input->post('nama', true),
                    'deskripsi_penghargaan' => $this->input->post('deskripsi', true),
                    'foto_penghargaan' => $gambar,
                    'tanggal_penghargaan' => $this->input->post('tgl')
                ];

                //update
                $update = $this->db->update('penghargaan', $data, ['id_penghargaan' => $id_penghargaan]);

                if ($update) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                    redirect('admin/sekolah/penghargaan');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, data Penghargaan gagal diperbarui');
                    redirect('admin/sekolah/penghargaan');
                }
            }
        }
    }

    public function delete($id)
    {
        if (!empty($id)) {
            //delete proses
            $dataArchive = $this->db->get_where('penghargaan', ['id_penghargaan' => $id])->row_array();
            $delete = $this->db->delete('penghargaan', ['id_penghargaan' => $id]);

            if ($delete) {
                if ($dataArchive['foto_penghargaan'] !== 'default-image.png') {
                    unlink('assets/img/uploads/' . $dataArchive['foto_penghargaan']);
                }
                $this->session->set_flashdata('msg_success', 'Selamat, Data penghargaan berhasil dihapus');
                http_response_code(200);
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, Data penghargaan gagal dihapus');
                http_response_code(404);
            }
        }
    }
}
