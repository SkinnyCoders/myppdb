<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Generate_kartu extends CI_Controller {
 
	public function pdf(){

		$this->load->model('m_peserta');

		$data['peserta'] = $this->m_peserta->getDataKartu($this->session->userdata('id_peserta'));

	    $this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "kartu-diterima.pdf";
	    $this->pdf->load_view('v_peserta/v_laporan_terima', $data);


	}
}