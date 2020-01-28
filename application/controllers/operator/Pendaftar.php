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

    public function list(){
    	$data = [
    		'title' => 'Daftar Pendaftar',
            'daftar' => $this->m_operator->getDaftarPeserta(getIdTahun(getTahun()))
    	];

    	getViews($data, 'v_operator/v_daftar_pendaftar');
    }

    public function detail($id){
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

    public function cabut_berkas(){
        $data['title'] = 'Cabut Berkas';
        $data['cabut_berkas'] = $this->m_operator->getCabutBerkas();
        $data['peserta'] = $this->m_operator->getDaftarPeserta(getIdTahun(getTahun()));

        getViews($data, 'v_operator/v_cabut_berkas');
    }

    public function cabut(){
        $this->form_validation->set_rules('peserta', 'Peserta', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
             $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan cabut berkas');
             redirect('operator/pendaftar/cabut_berkas');
        }else{
            //get id pendaftaran
            $pendaftaran = $this->m_peserta->getPendaftaran($this->input->post('peserta'));
            $id_pendaftaran = $pendaftaran['id_pendaftaran'];
            //get data berkas
            $data_berkas = $this->m_peserta->getBerkas($this->input->post('peserta'));
            //set data for insert
            $data = [
                'id_pendaftaran' => $id_pendaftaran,
                'keterangan' => $this->input->post('keterangan')
            ];

            if (insertData('pencabutan', $data)) {
                foreach ($data_berkas as $berkas) {
                    unlink('assets/uploads/berkas_peserta/'.$berkas);
                }
                $id_berkas = $data_berkas['id_berkas'];
                $deleteBerkas = $this->db->delete('data_berkas', ['id_berkas' => $id_berkas]);

                if ($deleteBerkas) {
                    $this->session->set_flashdata('msg_success', 'Selamt, berhasil cabut berkas');
                    redirect('operator/pendaftar/cabut_berkas');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan cabut berkas');
                    redirect('operator/pendaftar/cabut_berkas');
                }
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan cabut berkas');
                redirect('operator/pendaftar/cabut_berkas');
            }
        }
    }

    public function cabut_cancel($id){
        $cancel = $this->db->delete('pencabutan', ['id_pendaftaran' => $id]);
        if ($cancel) {
            $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan pembatalan cabut berkas');
            http_response_code(200);
        }else{
            $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan pembatalan cabut berkas');
            http_response_code(500);
        }
    }   
}