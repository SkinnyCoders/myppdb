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
        getAuth(4);
        $this->load->model('m_peserta');
        $this->load->helper('string');
    }

    public function index()
    {
        $id_peserta = $this->session->userdata('id_peserta');
        $data['title'] = 'Daftar Tes Seleksi';
        $data['berkas'] = $this->m_peserta->getBerkas($id_peserta);
        $data['data_all'] = $this->m_peserta->getAllDataPeserta($id_peserta);
        // $data['token'] = $this->getToken($id_peserta, $id_seleksi);
        $id_prodi = $this->m_peserta->getIdProdi($id_peserta);
        $id_prodi = $id_prodi['id_program_studi'];
        $data['tes_seleksi'] = $this->db->get_where('konfigurasi_tes_seleksi', ['id_program_studi' => $id_prodi])->result_array();

        //tampil data seleksi berdasarkan konfigurasi
        getViews($data, 'v_peserta/v_seleksi');
    }

    public function token($id_tes){

        $id_peserta = $this->session->userdata('id_peserta');
        $data['title'] = 'Token Seleksi';
        $data['berkas'] = $this->m_peserta->getBerkas($id_peserta);
        $data['data_all'] = $this->m_peserta->getAllDataPeserta($id_peserta);
        $data['token'] = $this->getToken($id_peserta, $id_tes);

        $data_token = $data['token'];
        //cek sudah ikut tes belum
        if ($this->db->get_where('token_seleksi', ['token' => $data_token, 'selesai' => true])->num_rows() > 0) {
            $this->session->set_flashdata('msg_failed', 'Maaf, Anda sudah mengikuti tes tersebut');
            redirect('peserta/seleksi');
        }

        $this->form_validation->set_rules('token', 'Token' , 'required', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_peserta/v_token_seleksi');
        }else{
            $token = $this->input->post('token');

            $id_prodi = $this->m_peserta->getIdProdi($id_peserta);
            $id_prodi = $id_prodi['id_program_studi'];

            //get id konfigurasi seleksi
            $id_konfigur = $this->m_peserta->getIdKonfigur($id_prodi, $id_tes);

            $cekToken = $this->db->get_where('token_seleksi', ['id_konfigurasi_seleksi' => $id_konfigur, 'id_peserta' => $id_peserta, 'token' => $token])->num_rows();
            if ($cekToken <= 0) {

                $this->session->set_flashdata('msg_failed', 'Maaf, Token yang anda masukan salah');
                redirect('peserta/seleksi/token/'.$id_tes);
            }else{
                $cekMulai = $this->db->get_where('token_seleksi', ['token' => $token])->row_array();
                $cekMulai = $cekMulai['mulai'];

                if ($cekMulai >= 3) {
                    $this->session->set_flashdata('msg_failed', 'Maaf, Anda sudah 3 kali mencoba');
                    redirect('peserta/seleksi/token/'.$id_tes);
                }else{
                    $updateMulai = $this->m_peserta->tambah_mulai($token);
                    redirect('peserta/seleksi/tes/'.$id_tes);
                }
            }
        }
        
    }

    public function tes($id_seleksi){
        $data['title'] = "Tes Seleksi";
        $data['soal'] = $this->m_peserta->getSoal($id_seleksi);
        $data_tes = $this->db->get_where('tes_seleksi', ['id_tes_seleksi' => $id_seleksi])->row_array();

        getViews($data, 'v_peserta/v_tes_seleksi');

        if (isset($_POST['selesai'])) {
            $total_soal = count($this->input->post('id_soal'));
            $point_awal = 0;
            $point_benar = 1;

            for ($i=0; $i < $total_soal ; $i++) { 
                $jawaban = $this->input->post('jawaban'.$i);
                $jawaban_benar = $this->input->post('jawaban_benar');

                if ($jawaban == $jawaban_benar[$i]) {
                    $benar[] = $point_awal + $point_benar;
                }else{
                    $benar[] = $point_awal;
                }
                
            }
            $total_benar = array_sum($benar);
            $nilai_akhir = $total_benar/$total_soal*100;

            $bobot = $data_tes['bobot_tes'];

            if ($nilai_akhir >= $bobot) {
                $status = 'lulus';
            }else{
                $status = 'tidak';
            }

            //insert ke hasil tes
            $data_hasil = [
                'id_peserta' => $this->session->userdata('id_peserta'),
                'id_tes_seleksi' => $id_seleksi,
                'nilai_benar' => $total_benar,
                'nilai_akhir' => $nilai_akhir,
                'status' => $status
            ];

            $insertHasil = $this->db->insert('hasil_tes_seleksi', $data_hasil);
            if ($insertHasil) {
                //update selesai di table token
                $token = $this->getToken($this->session->userdata('id_peserta'), $id_seleksi);

                $updateSelesai = $this->m_peserta->updateSelesai($token);

                if ($updateSelesai) {
                    $this->session->set_flashdata('msg_success', 'Selamat, Anda baru saja mengikuti tahapan tes seleksi');
                    redirect('peserta/seleksi');
                }else{
                    $this->session->set_flashdata('msg_success', 'Selamat, Anda baru saja mengikuti tahapan tes seleksi');
                    redirect('peserta/seleksi');
                }
            }
        }
    }

    private function getToken($id_peserta, $id_seleksi)
    {

        $id_prodi = $this->m_peserta->getIdProdi($id_peserta);
        $id_prodi = $id_prodi['id_program_studi'];

        //get id konfigurasi seleksi
        $id_konfigur = $this->m_peserta->getIdKonfigur($id_prodi, $id_seleksi);

        $getDataToken = $this->db->get_where('token_seleksi', ['id_peserta' => $id_peserta, 'id_konfigurasi_seleksi' => $id_konfigur])->row_array();
        if (!empty($getDataToken)) {
            $token = $getDataToken['token'];
        } else {
            $token = random_string('alnum', 20);
            
            //insert ke table token
            $data = [
                'id_konfigurasi_seleksi' => $id_konfigur,
                'id_peserta' => $id_peserta,
                'token' => $token
            ];

            $this->db->insert('token_seleksi', $data);
        }
        return $token;
    }
}
