<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Cabut_berkas extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuth(4);
        $this->load->model('m_peserta');
    }

    public function index()
    {
    	$pendaftaran = $this->m_peserta->getPendaftaran($this->session->userdata('id_peserta'));
    	$id_pendaftaran = $pendaftaran['id_pendaftaran'];
    	$data['title'] = 'Cabut Berkas';
    	$data['cabut'] = $this->db->get_where('pencabutan', ['id_pendaftaran' => $id_pendaftaran])->row_array();

    	getViews($data, 'v_peserta/v_cabut_berkas');
    }

    public function cabut($id){
    	$pendaftaran = $this->m_peserta->getPendaftaran($id);
    	$id_pendaftaran = $pendaftaran['id_pendaftaran'];

    	$data_berkas = $this->m_peserta->getBerkas($id);

    	$data = [
    		'id_pendaftaran' => $id_pendaftaran,
    		'keterangan' => $_POST['keterangan']
    	];

    	$insert = $this->db->insert('pencabutan', $data);

    	if ($insert) {

    		foreach ($data_berkas as $berkas) {
    			unlink('assets/uploads/berkas_peserta/'.$berkas);
    		}
    		$id_berkas = $data_berkas['id_berkas'];
    		$deleteBerkas = $this->db->delete('data_berkas', ['id_berkas' => $id_berkas]);

    		if ($deleteBerkas) {
    			$this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan pencabutan');
    			http_response_code(200);
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan pencabutan');
    			http_response_code(404);
    		}
    		
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan pencabutan');
    		http_response_code(404);
    	}
    }

    public function batal($id){
    	$pendaftaran = $this->m_peserta->getPendaftaran($id);
    	$id_pendaftaran = $pendaftaran['id_pendaftaran'];

    	$delete = $this->db->delete('pencabutan', ['id_pendaftaran' => $id_pendaftaran]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamt, berhasil mambatalkan pencabutan');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Maaf, gagal membatalkan pencabutan');
    		http_response_code(404);
    	}

    }
}