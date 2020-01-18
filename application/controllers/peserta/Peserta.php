<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Peserta extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->load->view('v_peserta/v_login');
	}
}
