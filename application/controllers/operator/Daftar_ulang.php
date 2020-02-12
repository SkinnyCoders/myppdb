<?php 
/**
 * 
 */
class Daftar_ulang extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('cektahun');
		$this->load->model('m_operator');
	}

	public function index(){
		$data = [
			'title' => 'Daftar Ulang',
			'daftar_ulang' => $this->m_operator->getDaftarUlang()
		];

		getViews($data,'v_operator/v_daftar_ulang');
	}

	public function tambah(){
		$data = [
			'title' => 'Tambah Daftar Ulang'
		];

		$this->form_validation->set_rules('cari','Cari peserta', 'required|trim', ['required' => '{field} tidak boleh kosong']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data,'v_operator/v_add_daftar_ulang');
		}else{
			$data_cari = $this->input->post('cari', true);
			$id_tahun = getIdTahun(getTahun());

			$data['data_peserta'] = $this->m_operator->getDataPeserta($data_cari, $id_tahun);

			if (empty($data['data_peserta'])) {
				$this->session->set_flashdata('msg_failed', 'Maaf, Data peserta tidak ditemukan');
                redirect('operator/daftar_ulang/tambah');
			}else{
				getViews($data,'v_operator/v_add_daftar_ulang');
			}
		}
	}

	public function konfirmasi($id){
		$data = [
			'id_peserta' => $id,
			'status' => 'sudah'
		];

		//cek sudah daftar ulang blm

		if ($this->db->get_where('daftar_ulang', ['id_peserta' =>  $id])->num_rows() > 0) {
			$this->session->set_flashdata('msg_failed', 'Maaf, Peserta sudah melakukan daftar ulang');
            http_response_code(500);
            return false;
		}

		$daftar_ulang = $this->db->insert('daftar_ulang', $data);

		if ($daftar_ulang) {
			$this->session->set_flashdata('msg_success', 'Selamat, peserta berhasil daftar ulang');
            http_response_code(200);
		}else{
			$this->session->set_flashdata('msg_failed', 'Maaf, Gagal melakukan daftar ulang');
            http_response_code(500);
		}
	}

	public function update(){
		if (isset($_POST['id'])) {
			$data = $this->m_operator->getDaftar($_POST['id']);
			$tgl = DateTime::createFromFormat('Y-m-d H:i:s', $data['tanggal'])->format('m/d/Y');
			$data = [
				'tgl' => $tgl,
				'status' => $data['status'],
				'id' => $data['id_daftar_ulang']
			];

			echo json_encode($data);
		}

		if (isset($_POST['simpan'])) {
			$this->form_validation->set_rules('tgl', 'tanggal', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg_failed', 'Maaf, data daftar ulang gagal diperbarui');
		            redirect('operator/daftar_ulang');
			}else{
				$tgl = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl', true))->format('Y-m-d');

				$data = [
					'tanggal' => $tgl,
					'status' => $this->input->post('status')
				];

				$update = $this->db->update('daftar_ulang', $data, ['id_daftar_ulang' => $this->input->post('id')]);

				if ($update) {
					$this->session->set_flashdata('msg_success', 'Selamat, data daftar ulang berhasil diperbarui');
		            redirect('operator/daftar_ulang');
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, data daftar ulang gagal diperbarui');
		            redirect('operator/daftar_ulang');
				}
			}
		}
	}

	public function delete($id){
		$delete = $this->db->delete('daftar_ulang', ['id_daftar_ulang' => $id]);

		if ($delete) {
			$this->session->set_flashdata('msg_success', 'Selamat, data daftar ulang berhasil dihapus');
            http_response_code(200);
		}else{
			$this->session->set_flashdata('msg_failed', 'Maaf, data daftar ulang gagal dihapus');
            http_response_code(500);
		}
	}

	public function rekap(){
		$data['rekap'] = $this->m_operator->getRekapDaftarUlang(getIdTahun(getTahun()));
        $data['tahun'] = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => getIdTahun(getTahun())])->row_array();

        $tahun_ajaran = $data['tahun']['tahun_mulai'].'/'.$data['tahun']['tahun_akhir'];

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "rekap_peserta_daftar_ulang.pdf";
        $this->pdf->load_view('v_operator/v_rekap_peserta_daftar_ulang', $data);
		
	}

}