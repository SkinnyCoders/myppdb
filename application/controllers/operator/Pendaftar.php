<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pendaftar extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(3);

        //load whatever you want bitch!!
        $this->load->model('m_operator');
        $this->load->model('m_peserta');
        $this->load->helper('cektahun');
    }

    public function list()
    {
        $data = [
            'title' => 'Daftar Pendaftar',
            'daftar' => $this->m_operator->getDaftarPeserta(getIdTahun(getTahun())),
            'rincian' => $this->m_operator->rincianPendaftaran(getIdTahun(getTahun()))
        ];

        getViews($data, 'v_operator/v_daftar_pendaftar');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Peserta';
        $data['status'] = 'diterima';
        $data['detail'] = $this->m_peserta->getAllDataPeserta($id);
        $data['berkas'] = $this->m_peserta->getBerkas($id);
        $data['pendaftaran'] = $this->m_peserta->getPendaftaran($id);

        if (empty($data['detail'])) {
            $this->session->set_flashdata('msg_failed', 'Maaf, Peserta Belum Melengkapi Data');
            redirect('operator/pendaftar/list');
        }
        getViews($data, 'v_peserta/v_detail_peserta');
    }

    public function cabut_berkas()
    {
        $data['title'] = 'Cabut Berkas';
        $data['cabut_berkas'] = $this->m_operator->getCabutBerkas();
        $data['peserta'] = $this->m_operator->getDaftarPeserta(getIdTahun(getTahun()));

        getViews($data, 'v_operator/v_cabut_berkas');
    }

    public function cabut()
    {
        $this->form_validation->set_rules('peserta', 'Peserta', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan cabut berkas');
            redirect('operator/pendaftar/cabut_berkas');
        } else {
            //get id pendaftaran
            $pendaftaran = $this->m_peserta->getPendaftaran($this->input->post('peserta'));
            $id_pendaftaran = $pendaftaran['id_pendaftaran'];
            $id_jurusan = $pendaftaran['id_program_studi'];
            //get data berkas
            $data_berkas = $this->m_peserta->getBerkas($this->input->post('peserta'));
            //set data for insert
            $data = [
                'id_pendaftaran' => $id_pendaftaran,
                'keterangan' => $this->input->post('keterangan')
            ];

            if (insertData('pencabutan', $data)) {
                foreach ($data_berkas as $berkas) {
                    unlink('assets/uploads/berkas_peserta/' . $berkas);
                }
                $id_berkas = $data_berkas['id_berkas'];
                $deleteBerkas = $this->db->delete('data_berkas', ['id_berkas' => $id_berkas]);

                //get pencadangan
                $data_cadangan = $this->db->query("SELECT pencadangan.id_pencadangan FROM `pencadangan` JOIN pendaftaran AS daftar ON daftar.id_pendaftaran=pencadangan.id_pendaftaran WHERE daftar.id_program_studi = $id_jurusan")->result_array();

                //get sisa kuota
                $sisa = $this->m_peserta->cekSisaKuota($id_jurusan, getIdTahun(getTahun()));
                //cek ada sisa kuota atau tidak
                if ($sisa > 0) {
                    //ubah status pencadangan
                    for ($i = 0; $i < $sisa; $i++) {
                        //deleting peserta from pencadangan
                        $this->db->delete('pencadangan', ['id_pencadangan' => $data_cadangan[$i]['id_pencadangan']]);
                    }
                }

                //ubah status kelulusan
                if ($pendaftaran['status_kelulusan'] == 'lulus') {
                    $this->db->set('status_kelulusan', NULL);
                    $this->db->where('id_pendaftaran', $id_pendaftaran);
                    $this->db->update('pendaftaran');
                }

                if ($pendaftaran['status_kelengkapan_berkas'] == 'lengkap') {
                    $this->db->set('status_kelengkapan_berkas', 'belum');
                    $this->db->set('status_verifikasi_berkas', 'belum');
                    $this->db->where('id_pendaftaran', $id_pendaftaran);
                    $this->db->update('pendaftaran');
                }

                if ($deleteBerkas) {
                    $this->session->set_flashdata('msg_success', 'Selamt, berhasil cabut berkas');
                    redirect('operator/pendaftar/cabut_berkas');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan cabut berkas');
                    redirect('operator/pendaftar/cabut_berkas');
                }
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan cabut berkas');
                redirect('operator/pendaftar/cabut_berkas');
            }
        }
    }

    public function cabut_cancel($id)
    {
        $cancel = $this->db->delete('pencabutan', ['id_pendaftaran' => $id]);

        $id_jurusan = $this->db->query("SELECT `id_program_studi` FROM `pendaftaran` WHERE `id_pendaftaran` = $id")->row_array();
        $id_jurusan = $id_jurusan['id_program_studi'];

        if ($cancel) {
            //get sisa kuota
            $sisa = $this->m_peserta->cekSisaKuota($id_jurusan, getIdTahun(getTahun()));

            if ($sisa <= 0) {
                //masukan ke pencadangan
                $data_pencadangan = [
                    'id_pendaftaran' => $id,
                    'status_pencadangan' => 'true',
                    'keterangan' => 'Pembatalan pencabutan berkas'
                ];

                $this->db->insert('pencadangan', $data_pencadangan);
            }
            $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan pembatalan cabut berkas');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan pembatalan cabut berkas');
            http_response_code(500);
        }
    }

    public function penerimaan()
    {
        $data = [
            'title' => 'Penerimaan Peserta',
            'tahun_ajaran' => $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => getIdTahun(getTahun())])->row_array(),
            'jalur' => $this->db->get('jalur_pendaftaran')->result_array(),
            'daftar' => $this->m_operator->getDaftarPesertaDiterima(getIdTahun(getTahun()))
        ];

        getViews($data, 'v_operator/v_penerimaan');

        if (isset($_POST['simpan'])) {
            $terima = $_POST['terima'];
            $total = count($terima);
            $id_jurusan = $_POST['jurusan'];

            $flag = 1;
            foreach ($terima as $t) {
                $id_pendaftaran = $_POST['id_pendaftaran' . $t];

                $sisa = $this->m_peserta->cekSisaKuota($id_jurusan, getIdTahun(getTahun()));

                if ($flag > $sisa) {
                    //Insert Pencadangan
                    $data_cadangan = [
                        'id_pendaftaran' => $id_pendaftaran,
                        'status_pencadangan' => 'true',
                        'keterangan' => 'Kuota sudah penuh'
                    ];

                    $proses = $this->db->insert('pencadangan', $data_cadangan);
                } else {
                    //update status menjadi diterima
                    $this->db->set('status_kelulusan', 'lulus');
                    $this->db->where('id_pendaftaran', $id_pendaftaran);
                    $proses = $this->db->update('pendaftaran');
                }
                $flag++;
            }

            if ($proses) {
                $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan penerimaan peserta');
                redirect('operator/pendaftar/penerimaan');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan penerimaan peserta');
                redirect('operator/pendaftar/penerimaan');
            }
        }
    }

    public function get_jurusan()
    {
        $id_jalur = $_POST['id_jalur'];

        $data = $this->db->query("SELECT program_studi.id_program_studi, program_studi.nama_program_studi FROM `jalur_prodi` JOIN program_studi ON program_studi.id_program_studi=jalur_prodi.id_prodi WHERE id_jalur = $id_jalur")->result_array();

        echo json_encode($data);
    }

    public function get_peserta()
    {
        $id_jalur = $_POST['id_jalur'];
        $id_jurusan = $_POST['jurusan'];

        $data_peserta = $this->m_operator->getPesertaVerify($id_jalur, $id_jurusan, getIdTahun(getTahun()));

        if (!empty($data_peserta)) {
            foreach ($data_peserta as $peserta) {
                $cekTes = $this->db->get_where('hasil_tes_seleksi', ['id_peserta' => $peserta['id_peserta']])->result_array();

                if (!empty($cekTes)) {
                    foreach ($cekTes as $tes) {
                        $status[] = $tes['status'];
                    }

                    if (!in_array('tidak', $status)) {
                        $tes_status = '<i style="color: green" class="fa fa-check"></i>';
                    } else {
                        $tes_status = '<i style="color: maroon" class="fa fa-times"></i>';
                    }
                } else {
                    $tes_status = '<i style="color: orange" class="fa fa-history"></i>';
                }

                if ($peserta['status_verifikasi_data'] == 'sudah') {
                    $data_status = '<i style="color: green" class="fa fa-check"></i>';
                } else {
                    $data_status = '<i style="color: maroon" class="fa fa-times"></i>';
                }

                if ($peserta['status_verifikasi_berkas'] == 'sudah') {
                    $berkas_status = '<i style="color: green" class="fa fa-check"></i>';
                } else {
                    $berkas_status = '<i style="color: maroon" class="fa fa-times"></i>';
                }

                $data[] = [
                    'id_pendaftaran' => $peserta['id_pendaftaran'],
                    'no_pendaftaran' => $peserta['no_pendaftaran'],
                    'nama' => $peserta['nama_lengkap'],
                    'status_data' => $data_status,
                    'status_berkas' => $berkas_status,
                    'status_tes' =>  $tes_status
                ];
            }
            echo json_encode($data);
        } else {
            $data = '';
            echo json_encode($data);
        }
    }

    public function get_kuota()
    {
        $id_jurusan = $_POST['id_jurusan'];

        $sisa = $this->m_peserta->cekSisaKuota($id_jurusan, getIdTahun(getTahun()));

        echo json_encode($sisa);
    }

    public function rekap(){
        $data['rekap'] = $this->m_operator->getRekap(getIdTahun(getTahun()));
        $data['tahun'] = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => getIdTahun(getTahun())])->row_array();

        $tahun_ajaran = $data['tahun']['tahun_mulai'].'/'.$data['tahun']['tahun_akhir'];

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "rekap_peserta.pdf";
        $this->pdf->load_view('v_operator/v_rekap_peserta', $data);
    }
}
