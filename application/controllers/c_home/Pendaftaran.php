<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('m_pendaftaran');
	}

	public function petunjuk(){
		echo "string";
	}

	public function jalur(){
		$data = [
			'jalur' => $this->m_pendaftaran->getJalurView()
		];

		$this->load->view('v_home/v_jalur_pendaftaran', $data);
	}

	public function biaya(){
		echo "Biaya";
	}

	public function beasiswa(){
		echo "Beasiswa";
	}

}