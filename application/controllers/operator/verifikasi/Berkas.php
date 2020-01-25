<?php 
/**
 * 
 */
class Berkas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$data = [
			'title' => 'Verifikasi Berkas'
		];

		getViews($data,'v_operator/v_verif_berkas');
	}

}