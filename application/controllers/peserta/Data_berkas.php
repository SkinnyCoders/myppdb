<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Data_berkas extends CI_controller
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
        $data['title'] = 'Data Berkas';
        $data['berkas'] = $this->m_peserta->getBerkas($id_peserta);

        $data_berkas = [
            $data['berkas']['ijazah_terakhir'],
            $data['berkas']['skhun'],
            $data['berkas']['kartu_keluarga'],
            $data['berkas']['keterangan_sehat'],
            $data['berkas']['pas_foto']
        ];

        getViews($data, 'v_peserta/v_data_berkas');

        if (isset($_POST['uploads'])) {
            $hitung = $_FILES['file']['name'];
            for ($i = 0; $i < count($hitung); $i++) {
                if (!empty($_FILES['file']['name'][$i])) {
                    $_FILES['img']['name'] = $_FILES['file']['name'][$i];
                    $_FILES['img']['type'] = $_FILES['file']['type'][$i];
                    $_FILES['img']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                    $_FILES['img']['error'] = $_FILES['file']['error'][$i];
                    $_FILES['img']['size'] = $_FILES['file']['size'][$i];

                    $config['upload_path']          = './assets/uploads/berkas_peserta/';
                    $config['allowed_types']        = 'pdf|jpg|png';
                    $config['encrypt_name']         = TRUE;
                    $config['overwrite']            = true;
                    $config['max_size']             = 1048; //1mb

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('img')) {
                        $file_peserta[] = '';
                    } else {
                        $file_peserta[] = $this->upload->data('file_name');
                        if (!empty($data['berkas'])) {
                            unlink('assets/uploads/berkas_peserta/' . $data_berkas[$i]);
                        }
                    }
                } else {
                    $file_peserta[] = $data_berkas[$i];
                }
            }

            $data_file = [
                'ijazah_terakhir' => $file_peserta[0],
                'skhun' => $file_peserta[1],
                'kartu_keluarga' => $file_peserta[2],
                'keterangan_sehat' => $file_peserta[3],
                'pas_foto' => $file_peserta[4]
            ];

            if (!empty($data['berkas'])) {
                //update
                $id_berkas = $data['berkas']['id_berkas'];
                $update = $this->db->update('data_berkas', $data_file, ['id_berkas' => $id_berkas]);
                if ($update) {

                    $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                    redirect('peserta/data_berkas');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                    redirect('peserta/data_berkas');
                }
            } else {
                $insert = $this->db->insert('data_berkas', $data_file);
                $id_berkas = $this->db->insert_id();
                if ($insert) {
                    //update ke peserta
                    if ($this->m_peserta->cekDataBerkas($id_peserta) == false) {

                        $update_id = $this->m_peserta->updateDataBerkasPeserta($id_berkas, $id_peserta);
                        if ($update_id) {
                            $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                            redirect('peserta/data_berkas');
                        } else {
                            $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                            redirect('peserta/data_berkas');
                        }
                    }
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                    redirect('peserta/data_berkas');
                }
            }
        }
    }

    public function delete($id)
    {

        $berkas = $this->m_peserta->getBerkas($id);

        switch (trim($_POST['ampas'])) {
            case "IJAZAH":
                $this->db->set('ijazah_terakhir', NULL);
                $this->db->where('id_berkas', $id);
                $update = $this->db->update('data_berkas');
                $berkas = $berkas['ijazah_terakhir'];
                break;

            case "SKHUN":
                $this->db->set('skhun', NULL);
                $this->db->where('id_berkas', $id);
                $update = $this->db->update('data_berkas');
                $berkas = $berkas['skhun'];
                break;

            case "KK":
                $this->db->set('kartu_keluarga', NULL);
                $this->db->where('id_berkas', $id);
                $update = $this->db->update('data_berkas');
                $berkas = $berkas['kartu_keluarga'];
                break;

            case "SK SEHAT":
                $this->db->set('keterangan_sehat', NULL);
                $this->db->where('id_berkas', $id);
                $update = $this->db->update('data_berkas');
                $berkas = $berkas['keterangan_sehat'];
                break;

            case "FOTO":
                $this->db->set('pas_foto', NULL);
                $this->db->where('id_berkas', $id);
                $update = $this->db->update('data_berkas');
                $berkas = $berkas['pas_foto'];
                break;
        }

        if ($update) {
            unlink('assets/uploads/berkas_peserta/' . $berkas);
            $this->session->set_flashdata('msg_success', 'Selamat, Data berkas berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data berkas gagal dihapus');
            http_response_code(404);
        }
    }
}
