


<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_operator extends CI_Model
{
	//get data peserta daftar ulang
	public function getDataPeserta($data, $id_tahun)
	{
		return $this->db->query("SELECT peserta.id_peserta, pendaftaran.no_pendaftaran, pendaftaran.status_kelulusan,data_diri.nama_lengkap, program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran WHERE`status_kelulusan` = 'lulus' AND pendaftaran.id_tahun_ajaran = $id_tahun AND (data_diri.nisn = '$data' OR data_diri.nama_lengkap LIKE '%$data%' OR pendaftaran.no_pendaftaran = '$data')")->result_array();
	}

	public function getDaftarUlang()
	{
		$this->db->select('peserta.id_peserta,data_diri.nama_lengkap,pendaftaran.no_pendaftaran,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran,daftar_ulang.*');
		$this->db->join('peserta', 'peserta.id_peserta=daftar_ulang.id_peserta');
		$this->db->join('data_diri', 'data_diri.id_data_diri=peserta.id_data_diri');
		$this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
		$this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran');
		$this->db->join('program_studi', 'program_studi.id_program_studi=pendaftaran.id_program_studi');
		return $this->db->get('daftar_ulang')->result_array();
	}

	public function getDaftar($id)
	{
		return $this->db->get_where('daftar_ulang', ['id_daftar_ulang' => $id])->row_array();
	}

	public function getDaftarPeserta($tahun)
	{
		return $this->db->query("SELECT peserta.id_peserta,peserta.id_berkas,data_diri.nama_lengkap,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran,pendaftaran.* FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi WHERE pendaftaran.id_tahun_ajaran = $tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) ORDER BY status_kelulusan DESC")->result_array();
	}

	public function getDaftarPesertaDiterima($tahun)
	{
		return $this->db->query("SELECT peserta.id_peserta,peserta.id_berkas,data_diri.nama_lengkap,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran,pendaftaran.* FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi WHERE pendaftaran.id_tahun_ajaran = $tahun AND pendaftaran.status_kelulusan IS NOT NULL AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) ORDER BY pendaftaran.no_pendaftaran DESC")->result_array();
	}

	public function getDetailPeserta($id)
	{
		return $this->db->query("SELECT data_diri.nama_lengkap, pendaftaran.no_pendaftaran, pendaftaran.id_pendaftaran, pendaftaran.status_verifikasi_data, pendaftaran.status_verifikasi_berkas FROM `peserta` JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran WHERE peserta.id_peserta =$id")->row_array();
	}

	public function getCabutBerkas()
	{
		$this->db->select('pendaftaran.id_pendaftaran, pendaftaran.no_pendaftaran,program_studi.nama_program_studi, jalur_pendaftaran.nama_jalur_pendaftaran, tahun_ajaran.tahun_mulai, tahun_ajaran.tahun_akhir, data_diri.nama_lengkap');
		$this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=pencabutan.id_pendaftaran');
		$this->db->join('jalur_pendaftaran', 'jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran');
		$this->db->join('program_studi', 'program_studi.id_program_studi=pendaftaran.id_program_studi');
		$this->db->join('peserta', 'peserta.id_pendaftaran=pendaftaran.id_pendaftaran');
		$this->db->join('data_diri', 'data_diri.id_data_diri=peserta.id_data_diri');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran');
		return $this->db->get('pencabutan')->result_array();
	}

	public function verifikasiBerkas($id, $status)
	{
		$this->db->set('status_verifikasi_berkas', $status);
		$this->db->where('id_pendaftaran', $id);
		return $this->db->update('pendaftaran');
	}

	public function getPesertaVerify($id_jalur, $id_jurusan, $id_tahun)
	{
		return $this->db->query("SELECT pendaftaran.id_pendaftaran, peserta.id_peserta, pendaftaran.no_pendaftaran, data_diri.nama_lengkap,pendaftaran.status_verifikasi_data, pendaftaran.status_verifikasi_berkas FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri WHERE pendaftaran.id_jalur_pendaftaran = $id_jalur AND pendaftaran.id_program_studi = $id_jurusan AND status_verifikasi_data !='belum' AND status_verifikasi_berkas !='belum' AND status_kelulusan IS NULL AND pendaftaran.id_tahun_ajaran = $id_tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->result_array();
	}

	public function rincianPendaftaran($tahun){
		$totalPendaftar = $this->db->query("SELECT pendaftaran.`id_pendaftaran` FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran WHERE NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND id_tahun_ajaran =$tahun")->num_rows();

		$totalDiterima = $this->db->query("SELECT `no_pendaftaran` FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran WHERE `status_kelulusan` = 'lulus' AND `id_tahun_ajaran` = $tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->num_rows();

		$totalTidak = $this->db->query("SELECT `no_pendaftaran` FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran WHERE `status_kelulusan` = 'tidak_lulus' AND `id_tahun_ajaran` = $tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->num_rows();

		$totalOnProses = $this->db->query("SELECT `no_pendaftaran` FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran WHERE `status_kelulusan` IS NULL AND `id_tahun_ajaran` = $tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->num_rows();

		$totalCadangan = $this->db->query("SELECT * FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran WHERE EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=peserta.id_pendaftaran) AND pendaftaran.id_tahun_ajaran = $tahun AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran)")->num_rows();

		$totalCabut = $this->db->query("SELECT `id_pencabutan` FROM `pencabutan` JOIN pendaftaran ON pendaftaran.id_pendaftaran=pencabutan.id_pendaftaran JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran WHERE pendaftaran.id_tahun_ajaran = $tahun")->num_rows();

		$totalDaftarUlang = $this->db->query("SELECT `id_daftar_ulang` FROM `daftar_ulang` JOIN peserta ON peserta.id_peserta=daftar_ulang.id_peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran WHERE pendaftaran.id_tahun_ajaran = $tahun")->num_rows();

		$data = [
			'diterima' => $totalDiterima,
			'dicadangkan' => $totalCadangan,
			'onproses' => $totalOnProses,
			'tidakditerima' => $totalTidak,
			'pendaftar' => $totalPendaftar,
			'pencabutan' => $totalCabut,
			'daftar_ulang' => $totalDaftarUlang
		];

		return $data;
	}

	public function getPesertaVerifData($id_tahun){
		return $this->db->query("SELECT pendaftaran.no_pendaftaran, data_diri.nama_lengkap, program_studi.nama_program_studi,jalur_pendaftaran.nama_jalur_pendaftaran, pendaftaran.status_verifikasi_data,tahun_ajaran.tahun_mulai,tahun_ajaran.tahun_akhir FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.status_kelengkapan_data = 'lengkap' AND pendaftaran.status_verifikasi_data != 'belum' AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.`id_tahun_ajaran` = $id_tahun")->result_array();
	}

	public function getPesertaVerifBerkas($id_tahun){
		return $this->db->query("SELECT pendaftaran.no_pendaftaran, data_diri.nama_lengkap, program_studi.nama_program_studi,jalur_pendaftaran.nama_jalur_pendaftaran, pendaftaran.status_verifikasi_berkas,tahun_ajaran.tahun_mulai,tahun_ajaran.tahun_akhir FROM `pendaftaran` JOIN peserta ON peserta.id_pendaftaran=pendaftaran.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE pendaftaran.status_kelengkapan_berkas = 'lengkap' AND pendaftaran.status_verifikasi_berkas != 'belum' AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.`id_tahun_ajaran` = $id_tahun")->result_array();
	}

	public function getBelumVerifiData($id_tahun){
		return $this->db->query("SELECT pendaftaran.`id_pendaftaran` FROM `pendaftaran` WHERE `status_kelengkapan_data` = 'lengkap' AND `status_verifikasi_data` = 'belum' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.id_tahun_ajaran = $id_tahun");
	}

	public function getBelumVerifiBerkas($id_tahun){
		return $this->db->query("SELECT pendaftaran.`id_pendaftaran` FROM `pendaftaran` WHERE `status_kelengkapan_berkas` = 'lengkap' AND `status_verifikasi_berkas` = 'belum' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.id_tahun_ajaran =  $id_tahun");
	}

	public function getTotalLengkapBerkas($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran FROM `pendaftaran` WHERE `status_kelengkapan_berkas` = 'lengkap' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.id_tahun_ajaran = $id_tahun");
	}

	public function getTotalLengkapData($id_tahun){
		return $this->db->query("SELECT pendaftaran.id_pendaftaran FROM `pendaftaran` WHERE `status_kelengkapan_data` = 'lengkap' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.id_tahun_ajaran = $id_tahun");
	}

	public function getRekap($id_tahun){
		return $this->db->query("SELECT pendaftaran.no_pendaftaran, tahun_ajaran.tahun_mulai,tahun_ajaran.tahun_akhir, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran,program_studi.nama_program_studi,data_sekolah_asal.nama_sekolah_asal FROM peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN data_sekolah_asal ON data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.id_tahun_ajaran = $id_tahun ORDER BY pendaftaran.id_pendaftaran DESC")->result_array();
	}

	public function getRekapTolak($id_tahun){
		return $this->db->query("SELECT pendaftaran.no_pendaftaran, tahun_ajaran.tahun_mulai,tahun_ajaran.tahun_akhir, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran,program_studi.nama_program_studi,data_sekolah_asal.nama_sekolah_asal FROM peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN data_sekolah_asal ON data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.status_kelulusan = 'tidak_lulus' AND pendaftaran.id_tahun_ajaran = $id_tahun ORDER BY pendaftaran.id_pendaftaran DESC")->result_array();
	}

	public function getRekapTerima($id_tahun){
		return $this->db->query("SELECT pendaftaran.no_pendaftaran, tahun_ajaran.tahun_mulai,tahun_ajaran.tahun_akhir, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran,program_studi.nama_program_studi,data_sekolah_asal.nama_sekolah_asal FROM peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN data_sekolah_asal ON data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND pendaftaran.status_kelulusan = 'lulus' AND pendaftaran.id_tahun_ajaran = $id_tahun ORDER BY pendaftaran.id_pendaftaran DESC")->result_array();
	}

	public function getRekapDaftarUlang($id_tahun){
		return $this->db->query("SELECT pendaftaran.no_pendaftaran, tahun_ajaran.tahun_mulai,tahun_ajaran.tahun_akhir, data_diri.nama_lengkap, data_diri.jenis_kelamin, jalur_pendaftaran.nama_jalur_pendaftaran,program_studi.nama_program_studi,data_sekolah_asal.nama_sekolah_asal FROM peserta JOIN daftar_ulang ON daftar_ulang.id_peserta=peserta.id_peserta JOIN pendaftaran ON pendaftaran.id_pendaftaran=peserta.id_pendaftaran JOIN data_diri ON data_diri.id_data_diri=peserta.id_data_diri JOIN data_sekolah_asal ON data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=pendaftaran.id_jalur_pendaftaran JOIN program_studi ON program_studi.id_program_studi=pendaftaran.id_program_studi JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran=pendaftaran.id_tahun_ajaran WHERE NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran) AND daftar_ulang.status = 'sudah' AND pendaftaran.id_tahun_ajaran = $id_tahun ORDER BY pendaftaran.id_pendaftaran DESC")->result_array();
	}
}
