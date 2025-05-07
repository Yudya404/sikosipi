<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_model extends CI_Model
{
    private $upload_config;

    // Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();

        // Konfigurasi unggahan file
        $this->upload_config = [
            'upload_path' => './assets/datakoperasi/imganggota/',
            'allowed_types' => 'jpg|png|jpeg',
            'max_size' => 2048, // 2MB
        ];

        // Memuat library unggahan
        $this->load->library('upload', $this->upload_config);
    }

	public function uploadFotoAnggota($fieldName, $type) 
	{
        $path = './assets/datakoperasi/imganggota/';
        $subPaths = [
            'ktp' => 'ktp/',
            'kyc' => 'kyc/'
        ];

        if (array_key_exists($type, $subPaths)) {
            $path .= $subPaths[$type];
        } else {
            return ['result' => 'failed', 'file' => '', 'error' => 'Invalid upload type.'];
        }

        // Generate file name
        $file_name = $_FILES[$fieldName]['name'];
        $newfile_name = str_replace(' ', '', $file_name);
        $newName = date('dmYHis') . $newfile_name;
        
        $config['upload_path'] = $path;
        $config['file_name'] = $newName;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE; // Enkripsi nama file untuk menghindari duplikasi

        // Load upload library dengan konfigurasi
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return ['result' => 'success', 'file' => $this->upload->data(), 'error' => ''];
        } else {
            if (strpos($this->upload->display_errors(), 'exceeds the maximum allowed size') !== false) {
                return ['result' => 'failed', 'file' => '', 'error' => '* Ukuran file foto melebihi batas maksimum 2MB!'];
            } else {
                return ['result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors()];
            }
        }
    }
	
	public function getAnggotaById($id)
    {
        $query = $this->db->query("SELECT * FROM anggota WHERE id_anggota = $id");
        return $query->result_array();
    }

    public function tambahAnggota($data)
	{
		$this->db->insert('anggota', $data);
		return $this->db->insert_id();
	}

    // Ambil data anggota berdasarkan ID
    public function ubahAnggota($id_anggota) {
        return $this->db->get_where('anggota', ['id_anggota' => $id_anggota])->row_array();
    }

    // Update data anggota
    public function updateAnggota($id_anggota, $updateData) {
        $this->db->where('id_anggota', $id_anggota);
        return $this->db->update('anggota', $updateData);
    }

    // Fungsi untuk memeriksa apakah email sudah digunakan oleh pegawai lain
    public function checkEmailExists($email, $id_anggota) {
        $this->db->where('email', $email);
        $this->db->where('id_anggota !=', $id_anggota);
        $query = $this->db->get('anggota');
        return $query->num_rows() > 0;
    }

    // Fungsi untuk memeriksa apakah username sudah digunakan oleh pegawai lain
    public function checkUsernameExists($username, $id_anggota) {
        $this->db->where('username', $username);
        $this->db->where('id_anggota !=', $id_anggota);
        $query = $this->db->get('anggota');
        return $query->num_rows() > 0;
    }

    public function getFilterAnggota() {
        $query = $this->db->query("SELECT * FROM anggota WHERE status_anggota LIKE 'Sedang Diverifikasi'");
        return $query->result_array();
    }

    public function getJumlahAnggotaAktif() {
        $this->db->where('status_anggota', 'Aktif');
        $query = $this->db->get('anggota');
        return $query->result_array();
    }
	
	public function getFilterAnggotaAktif() 
	{
		$query = $this->db->query("
			SELECT DISTINCT a.id_anggota, a.nama_anggota
			FROM anggota a
			JOIN simpanan s ON a.id_anggota = s.id_anggota
			JOIN (
				SELECT sd.id_simpanan, COUNT(*) AS jumlah_simpanan_wajib
				FROM simpanan_detail sd
				WHERE sd.jumlah_setor_tunai > 0
				GROUP BY sd.id_simpanan
			) sd_count ON s.id_simpanan = sd_count.id_simpanan
			LEFT JOIN penarikan_simpanan ps ON s.id_simpanan = ps.id_simpanan AND ps.status_penarikan = 'Sedang Diverifikasi'
			LEFT JOIN pengajuan_pinjaman pp2 ON a.id_anggota = pp2.id_anggota AND pp2.status_pengajuan = 'Sedang Diverifikasi'
			WHERE a.status_anggota = 'Aktif'
			AND s.status_simpanan = 'Belum Ditarik'
			AND s.jumlah_simpanan_pokok >= 100000
			AND sd_count.jumlah_simpanan_wajib >= 3
			AND ps.status_penarikan IS NULL
			AND pp2.status_pengajuan IS NULL
		");
		return $query->result_array();
	}

	public function getJumlahSimpananWajib($id_anggota) 
	{
		$query = $this->db->query("
			SELECT COUNT(*) AS jumlah_simpanan_wajib
			FROM simpanan_detail sd
			JOIN simpanan s ON sd.id_simpanan = s.id_simpanan
			WHERE s.id_anggota = ?
			AND sd.jumlah_setor_tunai > 0
		", array($id_anggota));
		$result = $query->row();
		return $result ? $result->jumlah_simpanan_wajib : 0;
	}

    public function getAllAnggota() {
        $query = $this->db->query("SELECT * FROM anggota ORDER BY id_anggota DESC");
        return $query->result_array();
    }
	
	public function updateStatusAnggota($id_anggota, $status)
    {
        $this->db->set('status_anggota', $status);
        $this->db->where('id_anggota', $id_anggota);
        $this->db->update('anggota');
    }
	
	// Menggunakan database remote
    public function cariAnggota($keyword) 
	{
        $remote_db = $this->load->database('remote', TRUE);

        $remote_db->like('arsip_kode', $keyword);
        $remote_db->or_like('nama_pemohon', $keyword);
        $remote_db->or_like('pemohon_nomor', $keyword);

        $query = $remote_db->get('arsip'); // Ganti 'anggota' dengan nama tabel yang sesuai
        return $query->result_array();
    }

}
?>