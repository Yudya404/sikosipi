<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simpanan_model extends CI_Model
{
    public function getAllSimpanan()
	{
		$query = $this->db->query("
		SELECT * FROM simpanan s 
		JOIN pegawai p ON s.id_pegawai = p.id_pegawai 
		JOIN anggota a ON s.id_anggota = a.id_anggota 
		ORDER BY s.id_simpanan DESC");
		return $query->result_array();
	}

    public function getSimpananById($id)
    {
        $query = $this->db->query("
		SELECT * FROM simpanan s 
		JOIN anggota a ON s.id_anggota = a.id_anggota 
		WHERE s.id_simpanan = $id");
        return $query->result_array();
    }

    public function getAllSetoran()
    {
        $query = $this->db->query("
		SELECT * FROM simpanan_detail sd  
		JOIN pegawai p ON sd.id_pegawai = p.id_pegawai 
		JOIN simpanan s ON s.id_simpanan = sd.id_simpanan 
		JOIN anggota a ON s.id_anggota = a.id_anggota 
		ORDER BY sd.id_simpanan_detail DESC");
        return $query->result_array();
    }

    public function tambahSimpananPokok($data)
	{
		$data = [
			'id_anggota' => htmlspecialchars($data['id_anggota'], true),
			'jumlah_simpanan_pokok' => htmlspecialchars($data['jumlah_simpanan_pokok'], true),
			'jumlah_simpanan_wajib' => 0,
			'tgl_transaksi_sp' => htmlspecialchars($data['tanggal_transaksi'], true),
			'id_pegawai' => htmlspecialchars($data['id_pegawai'], true)
		];
		$this->db->insert('simpanan', $data);
	}
	
	public function ubahStatusSimpanan()
	{
		$status = $this->input->post('status_simpanan');
		$id_anggota = $this->input->post('id_anggota');

		$data = [
			"status_simpanan" => $status,
			"tgl_ubah_status" => date('Y-m-d') // Menambahkan tanggal perubahan status otomatis
		];

		if ($status == "Sudah Ditarik") {
			$data2 = [
				"status_anggota" => "Dinonaktifkan"
			];
			$this->db->where('id_anggota', $id_anggota);
			$this->db->update('anggota', $data2);
		}

		$this->db->where('id_simpanan', $this->input->post('id_simpanan'));
		$this->db->update('simpanan', $data);
	}

   public function getSetoranById($id)
    {
        $this->db->select('sd.*, s.*, a.nama_anggota, p.nama_pegawai');
        $this->db->from('simpanan_detail sd');
        $this->db->join('simpanan s', 'sd.id_simpanan = s.id_simpanan');
        $this->db->join('anggota a', 's.id_anggota = a.id_anggota');
        $this->db->join('pegawai p', 'sd.id_pegawai = p.id_pegawai');
        $this->db->where('sd.id_simpanan', $id);
        $this->db->order_by('sd.tanggal_setor_tunai', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSetoranByIdsetoran($id)
    {
        $query = $this->db->query("
			SELECT * FROM simpanan_detail sd 
			JOIN simpanan s ON sd.id_simpanan = s.id_simpanan 
			JOIN anggota a ON s.id_anggota = a.id_anggota 
			JOIN pegawai p on sd.id_pegawai = p.id_pegawai 
			WHERE sd.id_simpanan_detail=$id");
        return $query->result_array();
    }

    public function tambahSetoranSimpananWajib()
    {
        $id_simpanan = $this->input->post('id_simpanan');
        $jumlah_setor_tunai = $this->input->post('jumlah_setor_tunai');
        $date = date('Y-m-d');
        $data = [
            'id_simpanan' => $id_simpanan,
            'id_pegawai' => $this->session->userdata('id_pegawai'),
            'jumlah_setor_tunai' => $jumlah_setor_tunai,
            'tanggal_setor_tunai' => $date
        ];
        $this->db->insert('simpanan_detail', $data);

        $data1 = $this->db->query("SELECT * FROM simpanan WHERE id_simpanan = $id_simpanan");
        foreach ($data1->result_array() as $result) {
            $jumlah_simpanan_wajib = $result['jumlah_simpanan_wajib'];
        }
        $tambahSimpananWajib = $jumlah_setor_tunai + $jumlah_simpanan_wajib;
        $data = [
            "jumlah_simpanan_wajib" => $tambahSimpananWajib
        ];
        $this->db->where('id_simpanan', $id_simpanan);
        $this->db->update('simpanan', $data);
    }
	
	public function getAksiById($id) {
        $this->db->select('a.*, sd.tanggal_setor_tunai, sd.jumlah_setor_tunai, s.id_simpanan, s.jumlah_simpanan_wajib, s.jumlah_simpanan_pokok, m.nama_anggota');
        $this->db->from('aksi a');
        $this->db->join('simpanan_detail sd', 'a.id_data_kategori = sd.id_simpanan_detail');
        $this->db->join('simpanan s', 'sd.id_simpanan = s.id_simpanan');
        $this->db->join('anggota m', 's.id_anggota = m.id_anggota');
        $this->db->where('a.id_aksi', $id);
        return $this->db->get()->result_array();
    }

    public function verifikasiHapusSetoranByAdmin($id_aksi, $data, $id_simpanan_detail, $id_simpanan, $jumlah_setoran) {
        // Mulai transaksi
        $this->db->trans_begin();

        // Update tabel aksi
        $this->db->where('id_aksi', $id_aksi);
        $this->db->update('aksi', $data);

        // Dapatkan jumlah simpanan wajib saat ini
		if ($data['status_verifikasi'] == 'Diterima') {
        $this->db->select('jumlah_simpanan_wajib');
        $this->db->from('simpanan');
        $this->db->where('id_simpanan', $id_simpanan);
        $jumlah_simpanan_wajib = $this->db->get()->row()->jumlah_simpanan_wajib;

        // Hitung jumlah simpanan wajib setelah penghapusan setoran
        $hasilAkhirSimpananWajib = $jumlah_simpanan_wajib - $jumlah_setoran;

        // Update tabel simpanan
        $this->db->where('id_simpanan', $id_simpanan);
        $this->db->update('simpanan', ['jumlah_simpanan_wajib' => $hasilAkhirSimpananWajib]);
			
		// Jika status verifikasi diterima, update tabel simpanan_detail
		$this->db->where('id_simpanan_detail', $id_simpanan_detail);
		$this->db->update('simpanan_detail', array(
			'jumlah_setor_tunai' => 0,
			// Tambahkan kolom lain jika perlu
			));
		}

        // Cek status transaksi
        if ($this->db->trans_status() === FALSE) {
            // Rollback transaksi jika ada kesalahan
            $this->db->trans_rollback();
            return FALSE;
        } else {
            // Commit transaksi jika berhasil
            $this->db->trans_commit();
            return TRUE;
        }
    }
	
	public function getNamaPegawaiById($id_pegawai)
	{
		$this->db->select('nama_pegawai');
		$this->db->from('pegawai');
		$this->db->where('id_pegawai', $id_pegawai);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->nama_pegawai;
		}
		return null;
	}

    public function cetakPdf($id)
    {
        $query = $this->db->query("
		SELECT * FROM simpanan_detail sd 
		JOIN simpanan s ON sd.id_simpanan = s.id_simpanan 
		JOIN anggota a ON s.id_anggota = a.id_anggota 
		JOIN pegawai p on sd.id_pegawai = p.id_pegawai 
		WHERE sd.id_simpanan_detail=$id");
        return $query->result_array();
    }

    public function getAllSetoranDetail()
    {
        $query = $this->db->query("
		SELECT * FROM simpanan_detail sd 
		JOIN simpanan s ON sd.id_simpanan = s.id_simpanan 
		JOIN anggota a ON s.id_anggota = a.id_anggota 
		JOIN pegawai p on sd.id_pegawai = p.id_pegawai 
		ORDER BY sd.id_simpanan_detail DESC");
        return $query->result_array();
    }

    public function getSetoranByDate($startDate, $endDate)
    {
        $query = $this->db->query("
		SELECT * FROM simpanan_detail sd 
		JOIN simpanan s ON sd.id_simpanan = s.id_simpanan 
		JOIN anggota a ON s.id_anggota = a.id_anggota 
		JOIN pegawai p on sd.id_pegawai = p.id_pegawai 
		WHERE sd.tanggal_setor_tunai BETWEEN '$startDate' AND '$endDate'");
        return $query->result_array();
    }

    public function hapusSetoran()
	{
		// Ubah format tanggal menjadi Y-m-d yang umum digunakan di database
		$tanggal_aksi = date('Y-m-d');

		$data = [
			'id_data_kategori' => $this->input->post('id_simpanan_detail'),
			'tanggal_aksi' => $tanggal_aksi,
			'pesan_aksi' => $this->input->post('pesan_aksi'),
			'nama_pegawai' => $this->session->userdata('nama_pegawai'),
			'kategori_aksi' => 'Hapus Setoran'
		];
		$this->db->insert('aksi', $data);
	}

    public function getSimpananByIdAnggota($id)
    {
        $query = $this->db->query("SELECT * FROM simpanan s 
                                JOIN anggota a ON s.id_anggota = a.id_anggota 
                                WHERE s.id_anggota = $id");
        return $query->result_array();
    }

    public function requestPenarikan()
    {
        $data = [
            'id_simpanan' => $this->input->post('id_simpanan'),
            'tanggal_permintaan_penarikan' => date('Y-m-d'),
            'nominal_total_penarikan' => $this->input->post('nominal_total_penarikan'),
            'pesan' => 'Belum terdapat pesan'
        ];
        $this->db->insert('penarikan_simpanan', $data);
    }
	
	public function verifikasiPenarikan($data)
	{
		$status = $data['verifikasi_pegawai'];
		if ($status == "Diterima") {
			$data_update = [
				"verifikasi_pegawai" => $status,
				"total_akhir_simpanan" => $data['total_akhir_simpanan'],
				"pesan" => 'Verifikasi Diterima Pegawai, Menunggu Verifikasi Admin'
			];
		} else if ($status == "Ditolak") {
			$data_update = [
				"verifikasi_pegawai" => $status,
				"verifikasi_admin" => "Ditolak",
				"status_penarikan" => "Ditolak",
				"tgl_acc_penarikan" => date('Y-m-d'),
				"pesan" => $data['pesan']
			];
		}

		$this->db->where('id_penarikan', $data['id_penarikan']);
		$this->db->update('penarikan_simpanan', $data_update);
	}
	
    public function verifikasiPenarikanByAdmin($data)
    {
        // Pastikan 'verifikasi_admin' dan 'id_penarikan' ada dalam $data
        if (!isset($data['verifikasi_admin']) || !isset($data['id_penarikan'])) {
            return false;
        }

        $status = $data['verifikasi_admin'];
        $data_update = [
            "verifikasi_admin" => $status,
            "tgl_acc_penarikan" => date('Y-m-d') // Anda bisa juga ambil tanggal dari $data jika sudah diset di controller
        ];

        if ($status == "Diterima") {
            $data_update["status_penarikan"] = "Berhasil";
            $data_update["total_akhir_simpanan"] = $data['total_akhir_simpanan'];
            $data_update["pesan"] = 'Pengajuan telah Diverifikasi dan Diterima, Anggota dapat mengambil uang simpanannya di koperasi';
        } else if ($status == "Ditolak") {
            $data_update["verifikasi_pegawai"] = "Ditolak";
            $data_update["status_penarikan"] = "Ditolak";
            $data_update["pesan"] = $data['pesan'];
        }

        // Update penarikan_simpanan table
        $this->db->where('id_penarikan', $data['id_penarikan']);
        $result = $this->db->update('penarikan_simpanan', $data_update);

        return $result;
    }

    public function getIdSimpananByPenarikan($id_penarikan)
    {
        $this->db->select('id_simpanan');
        $this->db->from('penarikan_simpanan');
        $this->db->where('id_penarikan', $id_penarikan);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id_simpanan;
        }
        return null;
    }

    public function getIdAnggotaBySimpanan($id_simpanan)
    {
        $this->db->select('id_anggota');
        $this->db->from('simpanan');
        $this->db->where('id_simpanan', $id_simpanan);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id_anggota;
        }
        return null;
    }

    public function updateStatusAndJumlahSimpanan($id_simpanan, $status, $jumlah_simpanan_pokok, $jumlah_simpanan_wajib)
    {
        $data = [
            'status_simpanan' => $status,
            'jumlah_simpanan_pokok' => $jumlah_simpanan_pokok,
            'jumlah_simpanan_wajib' => $jumlah_simpanan_wajib
        ];
        $this->db->where('id_simpanan', $id_simpanan);
        $this->db->update('simpanan', $data);
    }

    public function updateSimpananDetail($id_simpanan, $id_pegawai, $jumlah_setor_tunai)
    {
        $data = [
            'jumlah_setor_tunai' => $jumlah_setor_tunai
        ];
        $this->db->where('id_simpanan', $id_simpanan);
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update('simpanan_detail', $data);
    }
	
    public function getAllPenarikan()
    {
        $query = $this->db->query("
		SELECT * FROM penarikan_simpanan ps 
        JOIN simpanan s ON ps.id_simpanan = s.id_simpanan
		JOIN anggota a ON a.id_anggota = s.id_anggota 
		ORDER BY ps.id_penarikan DESC");
        return $query->result_array();
    }
	
	public function getAllPenarikanDiverifikasi($limit, $offset)
    {
        $query = $this->db->query("
            SELECT * FROM penarikan_simpanan ps 
            JOIN simpanan s ON ps.id_simpanan = s.id_simpanan
            JOIN anggota a ON a.id_anggota = s.id_anggota 
            WHERE ps.status_penarikan = 'Sedang Diverifikasi'
            ORDER BY ps.id_penarikan DESC
            LIMIT $limit OFFSET $offset");
        return $query->result_array();
    }

    public function countAllPenarikanDiverifikasi()
    {
        $query = $this->db->query("
            SELECT COUNT(*) as total FROM penarikan_simpanan ps 
            JOIN simpanan s ON ps.id_simpanan = s.id_simpanan
            JOIN anggota a ON a.id_anggota = s.id_anggota 
            WHERE ps.status_penarikan = 'Sedang Diverifikasi'");
        return $query->row()->total;
    }

	public function getAllPenarikanByStatus()
	{
		$query = $this->db->query("
			SELECT DISTINCT a.id_anggota, a.nama_anggota
			FROM anggota a
			JOIN simpanan s ON a.id_anggota = s.id_anggota
			JOIN (
				SELECT id_simpanan, COUNT(*) AS jumlah_simpanan_wajib
				FROM simpanan_detail
				WHERE jumlah_setor_tunai > 0
				GROUP BY id_simpanan
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

	public function tambahPengajuanPenarikan($data)
	{
		$data = [
			'id_simpanan' => htmlspecialchars($data['id_simpanan'], true),
			'id_pegawai' => htmlspecialchars($data['id_pegawai'], true),
			'id_anggota' => htmlspecialchars($data['id_anggota'], true),
			'nominal_total_penarikan' => htmlspecialchars($data['nominal_total_penarikan'], true),
			'tanggal_permintaan_penarikan' => $data['tanggal_permintaan_penarikan'], // Tidak perlu htmlspecialchars
			'total_akhir_simpanan' => $data['total_akhir_simpanan'], // Tidak perlu htmlspecialchars
			'status_penarikan' => 'Sedang Diverifikasi',
			'verifikasi_pegawai' => 'Sedang Diproses',
			'verifikasi_admin' => 'Pending',
			'pesan' => htmlspecialchars($data['pesan'], true)
		];

		$this->db->insert('penarikan_simpanan', $data);
	}

    public function getPenarikanSimpananByIdAnggota($id_anggota)
    {
        $this->db->select('id_anggota, (jumlah_simpanan_pokok + jumlah_simpanan_wajib) as total_simpanan');
        $this->db->where('id_anggota', $id_anggota);
        $query = $this->db->get('simpanan');
        return $query->row_array();
    }

    public function getAllPenarikanSimpanan()
    {
        $query = $this->db->query("SELECT *, (s.jumlah_simpanan_pokok + s.jumlah_simpanan_wajib) as total_simpanan FROM penarikan_simpanan ps 
                                   JOIN simpanan s ON ps.id_simpanan = s.id_simpanan
                                   JOIN anggota a ON a.id_anggota = s.id_anggota");
        return $query->result_array();
    }
	
    public function getPenarikanSimpananById($id)
    {
        $query = $this->db->query("SELECT * FROM penarikan_simpanan ps 
                                JOIN simpanan s ON ps.id_simpanan = s.id_simpanan
                                JOIN anggota a ON a.id_anggota = s.id_anggota
                                WHERE ps.id_penarikan = $id");
        return $query->result_array();
    }
  
    public function getRiwayatPenarikanByAnggota($id)
    {
        $query = $this->db->query("SELECT * FROM penarikan_simpanan ps 
                                JOIN simpanan s ON ps.id_simpanan = s.id_simpanan
                                JOIN anggota a ON a.id_anggota = s.id_anggota
                                WHERE s.id_anggota = $id");
        return $query->result_array();
    }
	
	// Menghitung jumlah total simpanan pokok dan wajib
    public function sumTotalSimpanan() {
        // Menghitung total simpanan pokok
        $this->db->select_sum('jumlah_simpanan_pokok');
		$this->db->where('status_simpanan', 'Belum Ditarik');
        $query_pokok = $this->db->get('simpanan');
        $total_simpanan_pokok = $query_pokok->row()->jumlah_simpanan_pokok;

        // Menghitung total simpanan wajib
        $this->db->select_sum('jumlah_simpanan_wajib');
		$this->db->where('status_simpanan', 'Belum Ditarik');
        $query_wajib = $this->db->get('simpanan');
        $total_simpanan_wajib = $query_wajib->row()->jumlah_simpanan_wajib;

        // Menjumlahkan total simpanan pokok dan wajib
        $total_simpanan = $total_simpanan_pokok + $total_simpanan_wajib;

        return $total_simpanan;
    }
	
}
