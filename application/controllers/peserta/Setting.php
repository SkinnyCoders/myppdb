<?php 
/**
 * 
 */
class Setting extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		getAuth(4);
	}

	public function profil(){
		$id_peserta = $this->session->userdata('id_peserta');

		$data = [
			'title' => 'Setting Akun Peserta',
			'data_peserta' => $this->db->get_where('peserta', ['id_peserta' => $id_peserta])->row_array()
		];

		// $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_cekEmail|valid_email', ['required' => '{field} tidak boleh kosong', 'cekEmail' => '{field} sudah digunakan']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data, 'v_peserta/v_setting_profil');
		}else{
			$data = [
				'email_peserta' => $this->input->post('email', true)
			];

			$update = $this->db->update('peserta', $data, ['id_peserta' => $id_peserta]);

			if ($update) {
				$this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('peserta/setting/profil');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                redirect('peserta/setting/profil');
			}
		}
		
	}

	public function password(){
		$id_peserta = $this->session->userdata('id_peserta');	

		$data = [
			'title' => 'Perbarui Password'
		];

		$this->form_validation->set_rules('pass1', 'Password Baru', 'required', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('pass2', 'Konfirmasi Password Baru', 'required|matches[pass1]', ['matches' => 'Konfirmasi Password Tidak Sama','required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('pass3', 'Password Lama', 'required|callback_cekPass', ['required' => '{field} tidak boleh kosong', 'cekPass' => 'Password yang anda masukan salah']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data, 'v_peserta/v_setting_password');
		}else{
			//update password peserta
			$newPass = password_hash($this->input->post('pass2'), PASSWORD_DEFAULT);

			$this->db->set('password_peserta', $newPass);
			$this->db->where('id_peserta', $id_peserta);
			$updatePass = $this->db->update('peserta');

			if ($updatePass) {
				$this->session->set_flashdata('msg_success', 'Selamat, Password berhasil diperbarui');
                redirect('peserta/setting/password');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Password gagal diperbarui');
                redirect('peserta/setting/password');
			}
		}
	}


	public function cekPass($str){
		//get password lama
		$passUser = $this->db->get_where('peserta', ['id_peserta' => $this->session->userdata('id_peserta')])->row_array();

		 if (password_verify($str, $passUser['password_peserta'])) {
		 	return TRUE;
		 }else{
		 	return FALSE;
		 }
	}

	public function cekEmail($str){
		$cekmail = $this->db->get_where('peserta', ['email_peserta' => $str])->row_array();
		if ($this->db->get_where('peserta', ['email_peserta' => $str])->num_rows() > 0) {
			if ($cekmail['email_peserta'] == $this->input->post('email')) {
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
}

 ?>