<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_home');
	}

	public function index(){

		$this->form_validation->set_rules('test', 'Test', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_home/v_test');
		}else{
			echo "string";
		}

		

		// $spesific = array('status_pengumuman' => true);
  //       $data['list_pengumuman'] = $this->m_home->get_specific_pengumuman($spesific);
  //       $data['yayasan'] = $this->m_home->get_yayasan();
  //       $data['list_jenjang'] = $this->m_home->get_all_jenjang_pendidikan();
		// $this->load->view('v_home/v_home', $data);
	}
}