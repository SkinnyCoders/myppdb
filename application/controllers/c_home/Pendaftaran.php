<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function petunjuk(){
		echo "string";
	}

	public function jalur(){
		$this->load->view('v_home/v_jalur_pendaftaran');
	}

	public function biaya(){
		echo "Biaya";
	}

	public function beasiswa(){
		echo "Beasiswa";
	}

}