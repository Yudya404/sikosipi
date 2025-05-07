<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aksi_model extends CI_Model
{
    public function getAllAksiPenonaktifan()
    {
        $query = $this->db->query("
		SELECT * FROM aksi a 
		JOIN anggota an ON a.id_data_kategori = an.id_anggota 
		WHERE kategori_aksi = 'Nonaktifkan Anggota'");
        return $query->result_array();
    }

    public function getAksiNonaktif($id)
    {
        $query = $this->db->query("
		SELECT * FROM aksi a 
		JOIN anggota an ON a.id_data_kategori = an.id_anggota 
		WHERE a.id_aksi = $id");
        return $query->result_array();
    }

    public function getAksiPenghapusanSetoran()
    {
        $query = $this->db->query("
		SELECT * FROM aksi a 
		JOIN simpanan_detail sd ON a.id_data_kategori = sd.id_simpanan_detail 
		JOIN simpanan s ON s.id_simpanan = sd.id_simpanan 
		JOIN anggota an ON an.id_anggota = s.id_anggota 
		WHERE kategori_aksi = 'Hapus Setoran' ORDER BY a.id_aksi DESC");
        return $query->result_array();
    }
	
	public function getAksiPenghapusanSetoranByid($id)
	{
		$query = $this->db->query("
		SELECT * FROM aksi a 
		JOIN simpanan_detail sd ON a.id_data_kategori = sd.id_simpanan_detail 
		JOIN simpanan s ON s.id_simpanan = sd.id_simpanan 
		JOIN anggota an ON an.id_anggota = s.id_anggota 
		WHERE kategori_aksi = 'Hapus Setoran' 
		AND a.id_aksi = $id ORDER BY a.id_aksi DESC");
		return $query->result_array();
	}
	
	public function getAllAksiPenghapusanSetoran()
	{
		$query = $this->db->query("
			SELECT * 
			FROM aksi a 
			JOIN simpanan_detail sd ON a.id_data_kategori = sd.id_simpanan_detail 
			JOIN simpanan s ON s.id_simpanan = sd.id_simpanan 
			JOIN anggota an ON an.id_anggota = s.id_anggota 
			WHERE a.kategori_aksi = 'Hapus Setoran' AND (a.status_aksi = 'Berhasil' OR a.status_aksi = 'Ditolak')
			ORDER BY a.id_aksi DESC");
		return $query->result_array();
	}
	
	public function getAllAksiPenghapusanAngsuran()
	{
		$query = $this->db->query("
			SELECT * 
			FROM aksi a 
			JOIN angsuran_detail sd ON a.id_data_kategori = sd.id_angsuran_detail 
			JOIN pinjaman s ON s.id_pinjaman = sd.id_pinjaman 
			JOIN anggota an ON an.id_anggota = s.id_anggota 
			WHERE a.kategori_aksi = 'Hapus Angsuran'
		");
		return $query->result_array();
	}
	
    public function getAksiPenghapusanAngsuranById($id)
    {
        $query = $this->db->query("
		SELECT * FROM aksi a 
		JOIN angsuran_detail sd ON a.id_data_kategori = sd.id_angsuran_detail 
		JOIN pinjaman s ON s.id_pinjaman = sd.id_pinjaman 
		JOIN anggota an ON an.id_anggota = s.id_anggota 
		WHERE a.id_data_kategori = $id AND a.kategori_aksi LIKE 'Hapus Angsuran'");
        return $query->result_array();
    }

    public function getAksiPenghapusanAngsuran()
    {
        $query = $this->db->query("
		SELECT * FROM aksi a 
		JOIN angsuran_detail sd ON a.id_data_kategori = sd.id_angsuran_detail 
		JOIN pinjaman s ON s.id_pinjaman = sd.id_pinjaman 
		JOIN anggota an ON an.id_anggota = s.id_anggota 
		WHERE kategori_aksi = 'Hapus Angsuran'");
        return $query->result_array();
    }
}
