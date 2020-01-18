<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Jurusan extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function detail($slug) {
		$data['jurusan'] = $this->db->get_where('program_studi', ['slug' => $slug])->row_array();
		$this->load->view('v_home/v_jurusan', $data);
	}
}