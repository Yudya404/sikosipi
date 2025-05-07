<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pinjaman_model extends CI_Model
{

    public function getAllPengajuan()
    {
        $query = $this->db->query("SELECT * 
        FROM pengajuan_pinjaman as p
        JOIN anggota as a ON a.id_anggota = p.id_anggota 
		ORDER BY id_pengajuan DESC");
        return $query->result_array();
    }
	
	public function getAllPengajuanDiverifikasi() 
	{
		$this->db->select('*');
		$this->db->from('pengajuan_pinjaman as p');
		$this->db->join('anggota as a', 'a.id_anggota = p.id_anggota');
		$this->db->where('p.status_pengajuan', 'Sedang Diverifikasi');
		$this->db->order_by('p.id_pengajuan', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function countAllPengajuanDiverifikasi() {
		$this->db->where('status_pengajuan', 'Sedang Diverifikasi');
		return $this->db->count_all_results('pengajuan_pinjaman');
	}

    public function getAllPengajuanById($id)
    {
        $query = $this->db->query("SELECT * 
        FROM pengajuan_pinjaman as p
        JOIN anggota as a ON a.id_anggota = p.id_anggota
        WHERE p.id_pengajuan = $id");
        return $query->result_array();
    }
	
    public function tambahPinjaman($data)
    {
        $data = [
            'id_anggota' => htmlspecialchars($data['id_anggota'], ENT_QUOTES, 'UTF-8'),
            'total_pengajuan_pinjaman' => htmlspecialchars($data['total_pengajuan_pinjaman'], ENT_QUOTES, 'UTF-8'),
            'alasan_pinjaman' => htmlspecialchars($data['alasan_pinjaman'], ENT_QUOTES, 'UTF-8'),
            'tanggal_pengajuan' => htmlspecialchars($data['tanggal_pengajuan'], ENT_QUOTES, 'UTF-8'),
            'id_pegawai' => htmlspecialchars($data['id_pegawai'], ENT_QUOTES, 'UTF-8'),
            'jml_tempo_angsuran' => htmlspecialchars($data['jml_tempo_angsuran'], ENT_QUOTES, 'UTF-8'),
            'jml_angsuran_perbulan' => htmlspecialchars($data['jml_angsuran_perbulan'], ENT_QUOTES, 'UTF-8'),
            'status_pengajuan' => htmlspecialchars($data['status_pengajuan'], ENT_QUOTES, 'UTF-8'),
            'verifikasi_pegawai' => htmlspecialchars($data['verifikasi_pegawai'], ENT_QUOTES, 'UTF-8'),
            'verifikasi_admin' => htmlspecialchars($data['verifikasi_admin'], ENT_QUOTES, 'UTF-8'),
        ];
        $this->db->insert('pengajuan_pinjaman', $data);
    }

    public function getAllRiwayatPinjamanById($id)
    {
        $query = $this->db->query("SELECT * FROM pengajuan_pinjaman WHERE id_anggota = $id");
        return $query->result_array();
    }
	
	public function verifikasiPinjaman($data)
	{
		$status = $data['verifikasi_pegawai'];
		$data_update = [
			"verifikasi_pegawai" => $status,
			"pesan" => $status == "Diterima" ? 'Verifikasi Diterima Pegawai, Menunggu Verifikasi Admin' : $data['pesan']
		];

		if ($status == "Ditolak") {
			$data_update["verifikasi_admin"] = "Ditolak";
			$data_update["status_pengajuan"] = "Ditolak";
			$data_update["tgl_acc_pengajuan"] = date('Y-m-d'); // Assuming this is the correct column for the date of rejection
		}

		$this->db->where('id_pengajuan', $data['id_pengajuan']);
		$this->db->update('pengajuan_pinjaman', $data_update);
	}

    public function verifikasiPinjamanByAdmin($pengajuan_data) 
	{
        $status = $this->input->post('verifikasi_admin');
        $data = [
            "verifikasi_admin" => $status,
            "id_pengajuan" => $this->input->post('id_pengajuan')
        ];

        if ($status == "Diterima") {
            $data["status_pengajuan"] = "Berhasil";
            $data["pesan"] = 'Pengajuan telah diverifikasi dan diterima Admin, anda bisa mengambil uang pinjaman di koperasi';
            $data["tgl_acc_pengajuan"] = date('Y-m-d'); // Menambahkan tanggal persetujuan
        } else if ($status == "Ditolak") {
            $data["status_pengajuan"] = "Ditolak";
			$data["verifikasi_pegawai"] = "Ditolak";
            $data["pesan"] = $this->input->post('pesan');
            $data["tgl_acc_pengajuan"] = date('Y-m-d'); // Menambahkan tanggal persetujuan
        }

        $this->db->where('id_pengajuan', $this->input->post('id_pengajuan'));
        $this->db->update('pengajuan_pinjaman', $data);
    }
	
	public function insertPinjaman($pinjaman_data) 
	{
        // Memasukkan data ke tabel pinjaman
        $this->db->insert('pinjaman', $pinjaman_data);
        return $this->db->insert_id(); // Mengembalikan ID dari pinjaman yang baru saja dimasukkan
    }

    public function getAllPinjaman()
    {
        $query = $this->db->query("
		SELECT * FROM pinjaman as pin 
		JOIN pengajuan_pinjaman as pen ON pin.id_pengajuan = pen.id_pengajuan
		JOIN anggota as a ON pen.id_anggota = a.id_anggota 
		ORDER BY id_pinjaman DESC");
        return $query->result_array();
    }
	
    public function getPinjamanByIdAnggota($id)
    {
        $query = $this->db->query("SELECT * FROM pinjaman as pin 
        JOIN pengajuan_pinjaman as pen ON pin.id_pengajuan = pen.id_pengajuan
        JOIN anggota as a ON pen.id_anggota = a.id_anggota
        WHERE pen.id_anggota=$id");
        return $query->result_array();
    }

    public function getPinjamanByIdPinjaman($id)
	{
		$query = $this->db->query("
			SELECT 
				pin.*, 
				pen.jml_tempo_angsuran, 
				pen.tanggal_pengajuan, 
				a.nama_anggota,
				DATE_ADD(pin.tanggal_meminjam, INTERVAL pen.jml_tempo_angsuran MONTH) AS tanggal_pelunasan
			FROM pinjaman as pin 
			JOIN pengajuan_pinjaman as pen ON pin.id_pengajuan = pen.id_pengajuan
			JOIN anggota as a ON pen.id_anggota = a.id_anggota
			WHERE pin.id_pinjaman = ?
		", array($id));
		return $query->row_array();  // Change from result_array() to row_array()
	}

    public function getAllAngsuran()
    {
        $query = $this->db->query("
		SELECT * FROM angsuran_detail as ad 
		JOIN pinjaman as pin ON ad.id_pinjaman = pin.id_pinjaman
		JOIN pegawai as peg ON ad.id_pegawai = peg.id_pegawai
		JOIN anggota as a ON pin.id_anggota = a.id_anggota");
        return $query->result_array();
    }

    public function getAngsuranById($id)
    {
        $this->db->select('ad.*, pin.*, peg.*, a.*, ad.id_angsuran_detail as id_simpanan_detail');
        $this->db->from('angsuran_detail as ad');
        $this->db->join('pinjaman as pin', 'ad.id_pinjaman = pin.id_pinjaman');
        $this->db->join('pegawai as peg', 'ad.id_pegawai = peg.id_pegawai');
        $this->db->join('anggota as a', 'pin.id_anggota = a.id_anggota');
        $this->db->where('ad.id_pinjaman', $id);
        $this->db->order_by('ad.tanggal_angsuran', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
    public function getAngsuranByIdAngsuran($id)
    {
        $query = $this->db->query("
		SELECT * FROM angsuran_detail as ad 
		JOIN pinjaman as pin ON ad.id_pinjaman = pin.id_pinjaman
		JOIN pegawai as peg ON ad.id_pegawai = peg.id_pegawai
		JOIN anggota as a ON pin.id_anggota = a.id_anggota
		WHERE ad.id_angsuran_detail = $id
		ORDER BY ad.tanggal_angsuran DESC");
        return $query->result_array();
    }
	
    public function insertAngsuran()
    {
        $data = [
            "id_pinjaman" => $this->input->post('id_pinjaman', true),
            "id_pegawai" => $this->session->userdata('id_pegawai'),
            'tanggal_angsuran' => date("y-m-d"),
            'angsuran_pembayaran' => $this->input->post('angsuran_pembayaran', true)
        ];
        $this->db->insert('angsuran_detail', $data);
    }
	
	public function tambahAngsuran($id_pinjaman, $angsuran_pembayaran, $tanggal_pelunasan)
	{
		$data = [
			'id_pinjaman' => $id_pinjaman,
			'id_pegawai' => $this->session->userdata('id_pegawai'),
			'angsuran_pembayaran' => $angsuran_pembayaran,
			'tanggal_angsuran' => date('Y-m-d')
		];
		$this->db->insert('angsuran_detail', $data);

		// Update tanggal_pelunasan di tabel simpanan
		$this->updateTanggalPelunasan($id_pinjaman, $tanggal_pelunasan);
	}

	public function updateTanggalPelunasan($id_pinjaman, $tanggal_pelunasan)
	{
		// Asumsikan ada kolom id_pinjaman di tabel simpanan untuk relasi
		$data = ['tanggal_pelunasan' => $tanggal_pelunasan];
		$this->db->where('id_pinjaman', $id_pinjaman);
		$this->db->update('pinjaman', $data);
	}
	
	public function cekAngsuranTerakhir($id_pinjaman) 
	{
		// Ambil id_pengajuan berdasarkan id_pinjaman
		$this->db->select('id_pengajuan');
		$this->db->from('pinjaman');
		$this->db->where('id_pinjaman', $id_pinjaman);
		$query = $this->db->get();
		$pinjaman = $query->row();

		// Ambil jml_tempo_angsuran dari tabel pengajuan_pinjaman berdasarkan id_pengajuan
		$this->db->select('jml_tempo_angsuran');
		$this->db->from('pengajuan_pinjaman');
		$this->db->where('id_pengajuan', $pinjaman->id_pengajuan);
		$query = $this->db->get();
		$pengajuan = $query->row();

		// Hitung total angsuran yang telah dibayar
		$this->db->select('COUNT(*) as total_angsuran');
		$this->db->from('angsuran_detail');
		$this->db->where('id_pinjaman', $id_pinjaman);
		$query = $this->db->get();
		$result = $query->row();

		// Asumsikan total_angsuran adalah jumlah angsuran yang telah dibayar
		// dan jml_tempo_angsuran adalah total angsuran yang harus dibayar
		return $result->total_angsuran >= $pengajuan->jml_tempo_angsuran;
	}
	
	public function updateStatusPinjamanLunas($id_pinjaman) {
        $data = [
            'status_pinjaman' => 'Sudah Lunas'
        ];

        $this->db->where('id_pinjaman', $id_pinjaman);
        $this->db->update('pinjaman', $data);
    }
	
    public function ubahPinjaman()
    {
        $data = [
            "status_pinjaman" => $this->input->post('status_pinjaman', true),
            "tanggal_pelunasan" => date('Y-m-d')
        ];
        $this->db->where('id_pinjaman', $this->input->post('id_pinjaman'));
        $this->db->update('pinjaman', $data);
    }

    public function cetakPdf($id)
    {
        $query = $this->db->query("SELECT * FROM angsuran_detail ag JOIN pinjaman p ON ag.id_pinjaman = p.id_pinjaman 
        JOIN anggota a ON p.id_anggota = a.id_anggota
        JOIN pegawai pg on ag.id_pegawai = pg.id_pegawai WHERE ag.id_angsuran_detail=$id");
        return $query->result_array();
    }

    public function getAngsuranByDate($startDate, $endDate)
    {
        $query = $this->db->query("SELECT * FROM angsuran_detail ag JOIN pinjaman p ON ag.id_pinjaman = p.id_pinjaman
        JOIN anggota a ON p.id_anggota = a.id_anggota
        JOIN pegawai pg on ag.id_pegawai = pg.id_pegawai WHERE ag.tanggal_angsuran BETWEEN '$startDate' AND '$endDate'");
        return $query->result_array();
    }
    public function terimaAksiPenghapusanAngsuran($id)
    {
        $getIdAngsuranDetail = $this->db->query("SELECT * FROM aksi where id_aksi = $id");
        foreach ($getIdAngsuranDetail->result_array() as $result) {
            $id_angsuran_detail = $result['id_data_kategori'];
        }

        $this->db->where('id_angsuran_detail', $id_angsuran_detail);
        $this->db->delete('angsuran_detail');

        $this->db->where('id_aksi', $id);
        $this->db->delete('aksi');
    }

    public function tolakAksiPenghapusanAngsuran($id)
    {
        $this->db->where('id_aksi', $id);
        $this->db->delete('aksi');
    }
	
    public function hapusAngsuran()
    {
		// Ubah format tanggal menjadi Y-m-d yang umum digunakan di database
		$tanggal_aksi = date('Y-m-d');
		
        $data = [
            'id_data_kategori' => $this->input->post('id_angsuran_detail'),
            'tanggal_aksi' => $tanggal_aksi,
            'pesan_aksi' => $this->input->post('pesan_aksi'),
            'nama_pegawai' => $this->session->userdata('nama_pegawai'),
            'kategori_aksi' => 'Hapus Angsuran'
        ];
        $this->db->insert('aksi', $data);
    }
	
	// Menghitung jumlah anggota yang melakukan pinjaman dengan status 'belum lunas'
    public function countAnggotaPinjaman()
    {
        $this->db->distinct();
        $this->db->select('id_anggota');
		$this->db->where('status_pinjaman', 'Belum Lunas');
        $query = $this->db->get('pinjaman');
        return $query->num_rows();
    }

    private function convertToInteger($value)
	{
		// Menghapus teks "Rp" dan tanda titik dari nilai
		$cleaned_value = str_replace(['Rp', '.', ','], '', $value);
		// Mengubah nilai ke integer
		return (int)$cleaned_value;
	}

	// Menghitung jumlah total pinjaman dengan status 'Belum Lunas'
	public function sumTotalPinjaman()
	{
		$this->db->select('total_pinjaman');
		$this->db->where('status_pinjaman', 'Belum Lunas');
		$query = $this->db->get('pinjaman');

		$total_pinjaman = 0;
		foreach ($query->result() as $row) {
			// Mengonversi dan menambahkan nilai setiap pinjaman ke total
			$total_pinjaman += $this->convertToInteger($row->total_pinjaman);
		}
		
		return $total_pinjaman;
		
	}

}
