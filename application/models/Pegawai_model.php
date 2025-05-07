<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

    public function getAllPegawai()
    {
        $query = $this->db->query("SELECT * FROM pegawai ORDER BY id_pegawai DESC");
        return $query->result_array();
    }
	
	public function totalPegawai()
{
    $query = $this->db->query("SELECT COUNT(*) AS total_pegawai FROM pegawai");
    return $query->row_array()['total_pegawai'];
}

    public function getPegawaiById($id)
    {
        $query = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = $id");
        return $query->result_array();
    }

    public function verifikasiAnggota()
    {
        $status = $this->input->post('status_anggota');
        $date = date('d-m-Y');
        if ($status == "Aktif") {
            $data = [
                "tanggal_keanggotaan" => $date,
                "status_anggota" => $this->input->post('status_anggota')
            ];
        } else {
            $data = [
                "status_anggota" => $this->input->post('status_anggota')
            ];
        }

        $this->db->where('id_anggota', $this->input->post('id_anggota'));
        $this->db->update('anggota', $data);
    }

    public function nonaktifkanAnggota()
    {
        $data = [
            'id_data_kategori' => $this->input->post('id_anggota'),
            'tanggal_aksi' => date('d-m-Y'),
            'pesan_aksi' => $this->input->post('pesan_aksi'),
            'nama_pegawai' => $this->session->userdata('nama_pegawai'),
            'kategori_aksi' => 'Nonaktifkan Anggota'
        ];
        $this->db->insert('aksi', $data);
    }

    private $upload_config;

    // Constructor
    public function __construct() {
        parent::__construct();
        $this->load->database();

        // Konfigurasi unggahan file
        $this->upload_config = [
            'upload_path' => './assets/datakoperasi/foto/',
            'allowed_types' => 'jpg|png|jpeg',
            'max_size' => 2048, // 2MB
        ];

        // Memuat library unggahan dengan konfigurasi
        $this->load->library('upload', $this->upload_config);
    }

    // Fungsi untuk mengunggah foto
    public function uploadFoto() {
        $file_name = $_FILES['foto_pegawai']['name'];
        $newfile_name = str_replace(' ', '', $file_name);
        $newName = date('dmYHis') . $newfile_name;
        $this->upload_config['file_name'] = $newName;
        $this->upload->initialize($this->upload_config);

        if ($this->upload->do_upload('foto_pegawai')) {
            return ['result' => 'success', 'file' => $this->upload->data(), 'error' => ''];
        } else {
            // Cek apakah error karena ukuran file
            if (strpos($this->upload->display_errors(), 'exceeds the maximum allowed size') !== false) {
                return ['result' => 'failed', 'file' => '', 'error' => '* Ukuran file foto melebihi batas maksimum 2MB!'];
            } else {
                return ['result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors()];
            }
        }
    }

    // Fungsi untuk menambah pegawai
    public function tambahPegawai($foto = null) {
        $data = [
            'nik_pegawai' => $this->input->post('nik_pegawai'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'alamat_pegawai' => $this->input->post('alamat_pegawai'),
            'no_telp_pegawai' => $this->input->post('no_telp_pegawai'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'kategori' => $this->input->post('kategori'),
            'foto_pegawai' => $foto
        ];

        if (!empty($this->input->post('password'))) {
            $data['password'] = htmlspecialchars(md5($this->input->post('password')));
        }

        return $this->db->insert('pegawai', $data);
    }

    // Fungsi untuk mengambil data pegawai berdasarkan id
    public function ubahPegawai($id_pegawai) {
        $result = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        return $result ? $result : null;
    }

    // Fungsi untuk memperbarui data pegawai
    public function updatePegawai($id_pegawai, $foto = null) {
        $data = [
            'nik_pegawai' => $this->input->post('nik_pegawai'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'alamat_pegawai' => $this->input->post('alamat_pegawai'),
            'no_telp_pegawai' => $this->input->post('no_telp_pegawai'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'kategori' => $this->input->post('kategori')
        ];

        if (!empty($this->input->post('password'))) {
            $data['password'] = htmlspecialchars(md5($this->input->post('password')));
        }

        if (!empty($foto)) {
            // Hapus foto lama jika ada
            $pegawai = $this->ubahPegawai($id_pegawai);
            if ($pegawai && $pegawai['foto_pegawai']) {
                $oldPhotoPath = './assets/datakoperasi/foto/' . $pegawai['foto_pegawai'];
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            $data['foto_pegawai'] = $foto;
        }

        $this->db->where('id_pegawai', $id_pegawai);
        $update = $this->db->update('pegawai', $data);

        if (!$update) {
            log_message('error', 'Database error: ' . $this->db->last_query());
        }

        return $update;
    }

    // Fungsi untuk memeriksa apakah email sudah digunakan oleh pegawai lain
    public function checkEmailExists($email, $id_pegawai) {
        $this->db->where('email', $email);
        $this->db->where('id_pegawai !=', $id_pegawai);
        $query = $this->db->get('pegawai');
        return $query->num_rows() > 0;
    }

    // Fungsi untuk memeriksa apakah username sudah digunakan oleh pegawai lain
    public function checkUsernameExists($username, $id_pegawai) {
        $this->db->where('username', $username);
        $this->db->where('id_pegawai !=', $id_pegawai);
        $query = $this->db->get('pegawai');
        return $query->num_rows() > 0;
    }

    // Fungsi untuk menghapus pegawai berdasarkan id
    public function deletePegawaiById($id_pegawai) {
        $this->db->where('id_pegawai', $id_pegawai);
        return $this->db->delete('pegawai');
    }
	
    public function terimaAksiPenonaktifan($id)
    {
        $getIdAnggota = $this->db->query("SELECT * FROM aksi where id_aksi = $id");
        foreach ($getIdAnggota->result_array() as $result) {
            $id_anggota = $result['id_data_kategori'];
        }
        $data = [
            'nama_admin' => $this->session->userdata('nama_pegawai'),
            'status_aksi' => 'Berhasil',
			'tgl_acc' => date('d-m-Y'),
            'status_verifikasi' => 'Diterima',
			'pesan_admin' => 'Permintaan Telah Direview Admin'
        ];
        $this->db->where('id_aksi', $id);
        $this->db->update('aksi', $data);

        $data2 = [
            'status_anggota' => 'Dinonaktifkan'
        ];
        $this->db->where('id_anggota', $id_anggota);
        $this->db->update('anggota', $data2);
    }

    public function tolakAksiPenonaktifan($id)
    {
        $data = [
            'nama_admin' => $this->session->userdata('nama_pegawai'),
            'status_aksi' => 'Ditolak',
			'tgl_acc' => date('d-m-Y'),
            'status_verifikasi' => 'Ditolak',
			'pesan_admin' => 'Mohon Cek Kembali Data Transaksi Pinjaman Terkait Anggota Tersebut'
        ];
        $this->db->where('id_aksi', $id);
        $this->db->update('aksi', $data);
    }
}
