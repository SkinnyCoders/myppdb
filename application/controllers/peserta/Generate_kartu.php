<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Generate_kartu extends CI_Controller {
 
	public function pdf(){

	    $data['users']=array(
			array('firstname'=>'Agung','lastname'=>'Setiawan','email'=>'ag@setiawan.com'),
			array('firstname'=>'Hauril','lastname'=>'Maulida Nisfar','email'=>'hm@setiawan.com'),
			array('firstname'=>'Akhtar','lastname'=>'Setiawan','email'=>'akh@setiawan.com'),
			array('firstname'=>'Gitarja','lastname'=>'Setiawan','email'=>'git@setiawan.com')
		);

	    $this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "kartu-diterima.pdf";
	    $this->pdf->load_view('v_peserta/v_laporan_terima', $data);


	}
}