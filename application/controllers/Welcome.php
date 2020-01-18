<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;


/**
 * This class describes a welcome.
 */
class Welcome extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}

	/**
	 * function index
	 */
	public function index()
	{
		//set default timezone
		date_default_timezone_set('Asia/Jakarta');

		$data['title'] = "MyPPDB";
		
		//use carbon class and get date now
		$date_now = Carbon::now();
		$time_now = dateTime::createFromFormat('Y-m-d H:i:s', $date_now)->format('H:i:s');
		$data['salam'] = $this->_salam($time_now);
		$this->load->view('v_wrapper', $data);
	}

	/**
	 * function salam
	 *
	 * @param      integer  $clock  time now
	 *
	 * @return     string   ucapan salam
	 */
	private function _salam($clock){
		if ($clock >= '05:00:00' && $clock <= '11:59:00') {
	        $data = 'Selamat Pagi';
	    } elseif ($clock >= '12:00:00' && $clock <= '15:59:00') {
	        $data = 'Selamat Siang';
	    } elseif ($clock >= '16:00:00' && $clock <= '18:59:00') {
	        $data = 'Selamat Sore';
	    } elseif ($clock >= '19:00:00') {
	        $data = 'Selamat Malam';
	    } elseif ($clock >= '00:00:00') {
	        $data = 'Selamat Malam';
	    }
	    return $data;
	}
}
