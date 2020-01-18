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
		$this->load->view('v_home/v_home_faq');
	}

	public function pengumuman(){
		echo "pengumuman";
	}
}