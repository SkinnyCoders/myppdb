<?php

/**
 * 
 */
class m_peserta extends CI_model
{
    public function getDataDiri($id_peserta)
    {
        $this->db->select('data_diri.id_data_diri, nama_lengkap, nisn, tempat_lahir, tgl_lahir, jenis_kelamin, alamat_rumah, no_hp, agama');
        $this->db->from('data_diri');
        $this->db->join('peserta', 'peserta.id_data_diri = data_diri.id_data_diri');
        $this->db->where('peserta.id_peserta', $id_peserta);
        return $this->db->get()->row_array();
    }

    public function getAllDataPeserta($id_peserta)
    {
        $this->db->select('data_diri.*,data_ortu.*,data_sekolah_asal.*,peserta.id_data_diri,peserta.id_ortu,peserta.id_sekolah_asal,peserta.email_peserta');
        $this->db->from('peserta');
        $this->db->join('data_diri', 'data_diri.id_data_diri=peserta.id_data_diri');
        $this->db->join('data_ortu', 'data_ortu.id_ortu=peserta.id_ortu');
        $this->db->join('data_sekolah_asal', 'data_sekolah_asal.id_data_sekolah_asal=peserta.id_sekolah_asal');
        $this->db->where('id_peserta', $id_peserta);
        return $this->db->get()->row_array();
    }

    public function updateData($data, $id)
    {
        return $this->db->update('data_diri', $data, ['id_data_diri' => $id]);
    }

    public function cekNISN($data)
    {
        return $this->db->get_where('data_diri', ['nisn' => $data])->num_rows();
    }

    public function cekDataBerkas($id)
    {
        $query = $this->db->get_where('peserta', ['id_peserta' => $id])->row_array();
        if ($query['id_berkas'] == NULL) {
            return false;
        } else {
            return true;
        }
    }

    public function updateDataBerkasPeserta($data, $id)
    {
        $this->db->set('id_berkas', $data);
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta');
    }

    public function getBerkas($id)
    {
        $this->db->select('data_berkas.id_berkas, ijazah_terakhir,  skhun, kartu_keluarga,  keterangan_sehat, pas_foto');
        $this->db->join('peserta', 'peserta.id_berkas = data_berkas.id_berkas');
        return $this->db->get_where('data_berkas', ['peserta.id_peserta' => $id])->row_array();
    }

    public function getDataOrtu($id)
    {
        $this->db->select('data_ortu.*');
        $this->db->join('peserta', 'peserta.id_ortu=data_ortu.id_ortu');
        return $this->db->get_where('data_ortu', ['peserta.id_peserta' => $id])->row_array();
    }

    public function updatePesertaOrtu($id_ortu, $id)
    {
        $this->db->set('id_ortu', $id_ortu);
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta');
    }

    public function getDataSekolah($id)
    {
        $this->db->select('data_sekolah_asal.*');
        $this->db->join('peserta', 'peserta.id_sekolah_asal=data_sekolah_asal.id_data_sekolah_asal');
        return $this->db->get_where('data_sekolah_asal', ['peserta.id_peserta' => $id])->row_array();
    }

    public function updatePesertaSekolah($id_sekolah, $id)
    {
        $this->db->set('id_sekolah_asal', $id_sekolah);
        $this->db->where('id_peserta', $id);
        return $this->db->update('peserta');
    }

    public function cekStatus($id)
    {
        $this->db->select('pendaftaran.status_kelulusan');
        $this->db->from('peserta');
        $this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
        $this->db->where('peserta.id_peserta', $id);
        return $this->db->get()->row_array();
    }

    public function cekPencadangan($id)
    {
        $this->db->select('status_pencadangan');
        $this->db->from('peserta');
        $this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
        $this->db->join('pencadangan', 'pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran');
        $this->db->where('peserta.id_peserta', $id);
        $this->db->where('status_pencadangan', 'true');
        return $this->db->get()->num_rows();
    }

    public function getIdProdi($id)
    {
        $this->db->select('pendaftaran.id_program_studi');
        $this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
        return $this->db->get_where('peserta', ['id_peserta' => $id])->row_array();
    }

    public function tambah_mulai($token)
    {
        $mulai_sebelum = $this->db->get_where('token_seleksi', ['token' => $token])->row_array();
        $mulai_sebelum = $mulai_sebelum['mulai'] + 1;

        $this->db->set('mulai', $mulai_sebelum);
        $this->db->where('token', $token);
        return $this->db->update('token_seleksi');
    }

    public function getSoal($id)
    {
        return $this->db->get_where('soal_tes_seleksi', ['id_tes_seleksi' => $id])->result_array();
    }

    public function updateSelesai($token)
    {
        $this->db->set('selesai', 'true');
        $this->db->where('token', $token);
        return $this->db->update('token_seleksi');
    }

    public function cekHasil($id_tes, $id_peserta)
    {
        return $this->db->get_where('hasil_tes_seleksi', ['id_peserta' => $id_peserta, 'id_tes_seleksi' => $id_tes])->row_array();
    }

    public function getJadwal($id_jalur, $id_prodi)
    {
        return $this->db->query("SELECT nama_jadwal, tgl_mulai, tgl_selesai FROM `jalur_prodi` INNER JOIN jalur_pendaftaran ON jalur_pendaftaran.id_jalur_pendaftaran=jalur_prodi.id_jalur JOIN jadwal_pendaftaran ON jadwal_pendaftaran.id_jalur_pendaftaran=jalur_pendaftaran.id_jalur_pendaftaran WHERE jalur_prodi.id_prodi= $id_prodi AND jalur_prodi.id_jalur= $id_jalur ORDER BY tgl_mulai")->result_array();
    }

    public function getPendaftaran($id)
    {
        $this->db->select('*');
        $this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran=peserta.id_pendaftaran');
        return $this->db->get_where('peserta', ['id_peserta' => $id])->row_array();
    }

    public function getIdKonfigur($id_prodi, $id_seleksi)
    {
        $id_konfigur = $this->db->get_where('konfigurasi_tes_seleksi', ['id_program_studi' => $id_prodi, 'id_tes_seleksi' => $id_seleksi])->row_array();
        return $id_konfigur = $id_konfigur['id_konfigurasi_tes_seleksi'];
    }

    public function updateKelengkapanData($id)
    {
        $this->db->set('status_kelengkapan_data', 'lengkap');
        $this->db->where('id_pendaftaran', $id);
        return $this->db->update('pendaftaran');
    }

    public function updateKelengkapanBerkas($id)
    {
        $this->db->set('status_kelengkapan_berkas', 'lengkap');
        $this->db->where('id_pendaftaran', $id);
        return $this->db->update('pendaftaran');
    }

    public function cekSisaKuota($id_jurusan, $id_tahun)
    {
        $pesertaDiterima = $this->db->query("SELECT `id_pendaftaran` FROM `pendaftaran` WHERE `id_program_studi` = $id_jurusan AND `id_tahun_ajaran` = $id_tahun AND status_kelulusan = 'lulus' AND NOT EXISTS (SELECT * FROM pencabutan WHERE pencabutan.id_pendaftaran=pendaftaran.id_pendaftaran) AND NOT EXISTS (SELECT * FROM pencadangan WHERE pencadangan.id_pendaftaran=pendaftaran.id_pendaftaran)")->num_rows();

        $data = $this->db->get_where('kouta_pendaftaran', ['id_program_studi' => $id_jurusan, 'id_tahun_ajaran' => $id_tahun])->row_array();
        $totalKuota = $data['jumlah'];

        $sisa = $totalKuota - $pesertaDiterima;

        return $sisa;
    }
}
