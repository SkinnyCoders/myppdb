<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class About extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
	}

	public function profile(){
		$data['profil'] = $this->m_home->getProfil();
		$this->load->view('v_home/v_profile', $data);
	}

	public function facility(){
		$data['fasilitas'] = $this->m_home->getAllFacility();
		$this->load->view('v_home/v_fasilitas', $data);
	}

	public function achivment(){
		$data['penghargaan'] = $this->m_home->getArchive();
		$this->load->view('v_home/v_penghargaan' , $data);
	}
}