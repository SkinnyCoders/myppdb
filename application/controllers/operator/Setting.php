<?php 
/**
 * 
 */
class Setting extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function profil(){
		$id_pengguna = $this->session->userdata('id');

		$data = [
			'title' => 'Setting Akun Operator',
			'data_peserta' => $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row_array()
		];

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_cekEmail|valid_email', ['required' => '{field} tidak boleh kosong', 'cekEmail' => '{field} sudah digunakan']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data, 'v_operator/v_setting_profil');
		}else{
			if (!empty($_FILES['foto']['name'])) {
				$gambar = uploadImage('foto', './assets/img/user/','');
			}else{
				$gambar = $data['data_peserta']['foto_pengguna'];
			}

			$data = [
				'nama_pengguna' => $this->input->post('nama', true),
				'foto_pengguna' => $gambar,
				'email_pengguna' => $this->input->post('email', true),
				'jenis_kelamin' => $this->input->post('gender', true)
			];

			$update = $this->db->update('pengguna', $data, ['id_pengguna' => $id_pengguna]);

			if ($update) {
				$this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('operator/setting/profil');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Data gagal diperbarui');
                redirect('operator/setting/profil');
			}
		}
		
	}

	public function password(){
		$id_pengguna = $this->session->userdata('id');

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

			$this->db->set('password', $newPass);
			$this->db->where('id_pengguna', $id_pengguna);
			$updatePass = $this->db->update('pengguna');

			if ($updatePass) {
				$this->session->set_flashdata('msg_success', 'Selamat, Password berhasil diperbarui');
                redirect('operator/setting/password');
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Password gagal diperbarui');
                redirect('operator/setting/password');
			}
		}
	}


	public function cekPass($str){
		//get password lama
		$passUser = $this->db->get_where('pengguna', ['id_pengguna' => $this->session->userdata('id')])->row_array();

		 if (password_verify($str, $passUser['password'])) {
		 	return TRUE;
		 }else{
		 	return FALSE;
		 }
	}

	public function cekEmail($str){
		$cekmail = $this->db->get_where('pengguna', ['email_pengguna' => $str])->row_array();
		if ($this->db->get_where('pengguna', ['email_pengguna' => $str])->num_rows() > 0) {
			if ($cekmail['email_pengguna'] == $this->input->post('email')) {
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