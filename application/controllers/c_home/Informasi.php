<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Informasi extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function faq(){
		$data['faq'] = $this->db->get('faq')->result_array();
		$this->load->view('v_home/v_home_faq', $data);
	}

	public function pengumuman(){
		echo "pengumuman";
	}
}