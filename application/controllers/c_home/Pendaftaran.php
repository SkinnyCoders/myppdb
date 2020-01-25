<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('m_pendaftaran');
		$this->load->helper('cektahun');
	}

	public function petunjuk(){
		$data['petunjuk'] = $this->db->get('petunjuk_pendaftaran')->row_array();
		$this->load->view('v_home/v_petunjuk', $data);
	}

	public function jalur(){
		$data = [
			'jalur' => $this->m_pendaftaran->getJalurView()
		];

		$this->load->view('v_home/v_jalur_pendaftaran', $data);
	}

	public function biaya(){
		$data['biaya'] = $this->m_pendaftaran->getBiaya();
		$data['prodi'] = $this->m_pendaftaran->getJurusan();
		$data['id_tahun'] = $this->db->get_where('tahun_ajaran', ['tahun_mulai' => getTahun()])->row_array();
		
		$this->load->view('v_home/v_biaya', $data);
	}

	public function beasiswa(){
		echo "Beasiswa";
	}

}