<?php 

/**
 * 
 */
class Registrasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('m_pendaftaran');
		$this->load->helper('cektahun');
	}

	public function index(){
		$data = [
			'title' => 'Pendaftaran',
			'jurusan' => $this->m_pendaftaran->getJurusan(),
			'pilih_jurusan' => $this->m_pendaftaran->jurusan($this->uri->segment(2)),
			'jalur' => $this->db->get('jalur_pendaftaran')->result_array()
		];

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_cekEmail', ['required' => '{field} tidak boleh kosong', 'valid_email' => 'Email tidak valid', 'cekEmail' => 'Email sudah didaftarakan']);
		$this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('nisn', 'NISN', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka']);
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('jalur', 'Jalur Pendaftaran', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);

		$this->form_validation->set_rules('agree','agreements', 'required',['required' => 'anda belum menyetujui']);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_home/v_test', $data);
		}else{
			//get tahun ajaran
			$tahun_now = date('Y');
			$tahun_ajaran = $this->db->get_where('tahun_ajaran', ['tahun_mulai' => getTahun()])->row_array();
			$id_tahun_ajaran = $tahun_ajaran['id_tahun_ajaran'];

			$tgl_lahir = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_lahir'))->format('Y-m-d');

			$kodeJurusan = $this->m_pendaftaran->getKodeJurusan($this->input->post('jurusan'));

			//no pendaftaran
			$lastNo = $this->m_pendaftaran->getNoDaftar();
			$lastNo = $lastNo['no_pendaftaran'];
			$lastNo = explode('/', $lastNo);
			$lastNo = end($lastNo);

			$no_daftar = $lastNo + 1;

			if ($no_daftar > 10) {
				$no_pendaftaran_last  = '00'.$no_daftar;
			}elseif ($lastNo > 100) {
				$no_pendaftaran_last  = '0'.$no_daftar;
			}else{
				$no_pendaftaran_last  = '000'.$no_daftar;
			}

			$kodeJurusan = $kodeJurusan['kode_program_studi'];

			$tahun_now = substr($tahun_now, 2);

			$no_pendaftaran = $tahun_now.'/'.$kodeJurusan.'/'.$no_pendaftaran_last;

			$data = [
				'id_jalur_pendaftaran' => $this->input->post('jalur'),
				'id_program_studi' => $this->input->post('jurusan'),
				'id_tahun_ajaran' => $id_tahun_ajaran,
				'no_pendaftaran' => $no_pendaftaran
			];

			$data_diri = [
				'nama_lengkap' => $this->input->post('nama', true),
				'nisn' => $this->input->post('nisn', true),
				'tgl_lahir' => $tgl_lahir,
				'jenis_kelamin' => $this->input->post('gender'),
				'alamat_rumah' => $this->input->post('alamat', true)
			];

			//insert pendaftaran -> insert data diri -> insert peserta

			$insertPendaftaran = $this->db->insert('pendaftaran', $data);
			if ($insertPendaftaran) {
				$id_pendaftaran = $this->db->insert_id();

				//insert data diri
				$insertdatadiri = $this->db->insert('data_diri', $data_diri);

				if ($insertdatadiri) {
					$id_data_diri = $this->db->insert_id();

					$data_peserta = [
						'id_data_diri' => $id_data_diri,
						'id_pendaftaran' => $id_pendaftaran,
						'id_role' => 4,
						'email_peserta' => $this->input->post('email', true),
						'password_peserta' => $password_peserta = password_hash($this->input->post('password2'), PASSWORD_DEFAULT),
						'status_akun' => 'aktif',
						'login_status' => 'false'
					];

					//insert peserta
					$insertPeserta = $this->db->insert('peserta', $data_peserta);

					if ($insertPeserta) {

						//cek kuota sudah penuh blm
						//get kuota
						$kuota = $this->m_pendaftaran->getKuota($id_tahun_ajaran, $this->input->post('jurusan'));
						$kuota = $kuota['jumlah'];

						//get pendaftar berdasarkan tahun ajaran dan prodi
						$totalPendaftar = $this->m_pendaftaran->getTotalDaftar($id_tahun_ajaran, $this->input->post('jurusan'));
						$totalPendaftar = $totalPendaftar['total'];

						if ($totalPendaftar >= $kuota) {
							//sudah penuh
							//insert ke pencadangan
							$data_cadangan = [
								'id_pendaftaran' => $id_pendaftaran,
								'status_pencadangan' => 'true',
								'keterangan' => 'Kuota sudah penuh'
							];

							$insertCadangan = $this->db->insert('pencadangan', $data_cadangan);

							if ($insertCadangan) {
								$this->session->set_flashdata('msg_success', 'Selamat, Pendaftaran berhasil, namun dikarenakan kuota pendaftaran sudah terpenuhi maka status anda dicangkan, Silahkan Login');
                				redirect('registrasi');
							}else{
								$this->session->set_flashdata('msg_failed', 'Maaf, Pendaftaran Gagal');
                				redirect('registrasi');
							}

						}

						$this->session->set_flashdata('msg_success', 'Selamat, Pendaftaran berhasil, Silahkan Login');
                		redirect('registrasi');
					}else{
						$this->session->set_flashdata('msg_failed', 'Maaf, Pendaftaran Gagal');
                		redirect('registrasi');
					}
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, Pendaftaran Gagal');
                	redirect('registrasi');
				}
			}else{
				$this->session->set_flashdata('msg_failed', 'Maaf, Pendaftaran Gagal');
                redirect('registrasi');
			}
		}
		
	}

	public function cekEmail($str){
		$cek = $this->db->get_where('peserta', ['email_peserta' => $str])->num_rows();

		if ($cek > 0) {
			return false;
		}else{
			return true;
		}
	}

	public function cekPassword($str){
		$cek = strlen($str);
		if ($cek <= 6) {
			return false;
		}else{
			return true;
		}
	}

	public function getJalur(){
		$id_prodi = $_POST['id_prodi'];

		$jalur = $this->m_pendaftaran->jalurProdi($id_prodi);

		echo json_encode($jalur);
	}
}
 ?>