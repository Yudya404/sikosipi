<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simpanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->load->library('Pdf');
        $this->load->model('simpanan_model');
		$this->load->model('pegawai_model');
        $this->load->model('anggota_model');
        $this->load->model('aksi_model');
		$this->load->library('form_validation');
    }
	
	public function daftarAnggota()
    {
        $data['title'] = 'Daftar Anggota';
        $data['anggota'] = $this->anggota_model->getAllAnggota();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/daftaranggota');
        $this->load->view('layout/pegawai/footer');
    }

    public function dataSimpanan()
	{
		if ($this->session->userdata('level') != "pegawai") {
			redirect('auth/loginPegawai', 'refresh');
		}

		$data['title'] = 'Data Transaksi Simpanan Anggota';
		$data['simpanan'] = $this->simpanan_model->getAllSimpanan();

		// Ambil data setoran untuk setiap simpanan
		foreach ($data['simpanan'] as &$item) {
			$item['data_setoran'] = $this->simpanan_model->getSetoranById($item['id_simpanan']);
		}

		$this->load->view('layout/pegawai/header', $data);
		$this->load->view('layout/pegawai/sidebar');
		$this->load->view('layout/pegawai/top');
		$this->load->view('simpanan/dataSimpanan', $data);
		$this->load->view('layout/pegawai/footer');
	}
	
	public function cetakTransaksiDataSimpanan()
    {
        $data['data_simpanan'] = $this->simpanan_model->getAllSimpanan();
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/laporan_data_simpanan');
        $this->load->view('laporan/layout/footer');
    }

    public function tambah_simpanan()
	{
		if ($this->session->userdata('level') != "pegawai") {
			redirect('auth/loginPegawai', 'refresh');
		}

		$this->form_validation->set_rules('id_anggota', 'ID Anggota', 'trim|required');
		$this->form_validation->set_rules('jumlah_simpanan_pokok', 'Jumlah Simpanan Pokok', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Pembayaran Simpanan Anggota';
			$data['anggota'] = $this->anggota_model->getFilterAnggota();
			$this->load->view('layout/pegawai/header', $data);
			$this->load->view('layout/pegawai/sidebar');
			$this->load->view('layout/pegawai/top');
			$this->load->view('simpanan/tambah_simpanan', $data);
			$this->load->view('layout/pegawai/footer');
		} else {
			$simpanan_data = [
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah_simpanan_pokok' => $this->input->post('jumlah_simpanan_pokok'),
				'tanggal_transaksi' => date('Y-m-d'), // tanggal transaksi otomatis diisi dengan tanggal hari ini
				'id_pegawai' => $this->session->userdata('id_pegawai') // mengambil id_pegawai dari session
			];

			$anggota_data = [
				'id_anggota' => $this->input->post('id_anggota'),
				'tanggal_keanggotaan' => date('Y-m-d'),
				'status_anggota' => 'Aktif'
			];

			// Mulai transaksi
			$this->db->trans_start();
			$this->simpanan_model->tambahSimpananPokok($simpanan_data);
			$this->anggota_model->updateAnggota($anggota_data);
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				// Jika transaksi gagal
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah simpanan dan anggota.</div>');
			} else {
				// Jika transaksi berhasil
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Simpanan Pokok dan Anggota telah ditambah.</div>');
			}

			redirect('simpanan/dataSimpanan');
		}
	}
	
	public function ubahStatusSimpanan($id)
    {
        $data['title'] = 'Ubah Status Simpanan Anggota';
        $data['simpanan'] = $this->simpanan_model->getSimpananById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/ubahStatusSimpanan');
        $this->load->view('layout/pegawai/footer');
    }

    public function prosesUbahStatusSimpanan()
	{
		$this->form_validation->set_rules('id_simpanan', 'id_simpanan', 'trim|required');
		$this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim|required');
		$this->form_validation->set_rules('status_simpanan', 'status_simpanan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('simpanan/dataSimpanan');
		} else {
			$data = [
				'id_simpanan' => $this->input->post('id_simpanan'),
				'id_anggota' => $this->input->post('id_anggota'),
				'status_simpanan' => $this->input->post('status_simpanan'),
				'tgl_ubah_status' => date('Y-m-d') // Menambahkan tanggal perubahan status otomatis
			];

			$this->simpanan_model->ubahStatusSimpanan($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Sukses Ubah Status Simpanan. </div>');
			redirect('simpanan/dataSimpanan');
		}
	}
	
	public function get_simpanan_by_id()
    {
        $id_anggota = $this->input->post('id_anggota');
        if ($id_anggota) {
            $data = $this->simpanan_model->getPenarikanSimpananByIdAnggota($id_anggota);
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Invalid ID']);
        }
    }
	
	public function detailPenarikanSimpanan($id)
    {
        $data['title'] = 'Detail Penarikan Simpanan Anggota';
        $data['simpanan'] = $this->simpanan_model->getPenarikanSimpananById($id);
        $this->load->view('layout/anggota/header', $data);
        $this->load->view('layout/anggota/sidebar');
        $this->load->view('layout/anggota/top');
        $this->load->view('simpanan/detailPenarikanSimpanan');
        $this->load->view('layout/anggota/footer');
    }
	
	public function filterCetakSimpanan()
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $data['simpanan_detail'] = $this->simpanan_model->getSetoranByDate($startDate, $endDate);
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/nota-setoran');
        $this->load->view('laporan/layout/footer');
    }
	
	public function cetakTransaksiSimpanan()
    {
        $data['simpanan_detail'] = $this->simpanan_model->getAllSetoran();
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/laporan_simpanan_wajib');
        $this->load->view('laporan/layout/footer');
    }
	
	public function tambah_pengajuan()
	{
		if ($this->session->userdata('level') != "pegawai") {
			redirect('auth/loginPegawai', 'refresh');
		}

		$this->form_validation->set_rules('id_anggota', 'ID Anggota', 'trim|required');
		$this->form_validation->set_rules('jumlah_simpanan_pokok', 'Jumlah Simpanan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Pengajuan Penarikan Simpanan';
			$data['anggota'] = $this->simpanan_model->getAllPenarikanByStatus();
			$this->load->view('layout/pegawai/header', $data);
			$this->load->view('layout/pegawai/sidebar');
			$this->load->view('layout/pegawai/top');
			$this->load->view('simpanan/tambah_penarikan', $data);
			$this->load->view('layout/pegawai/footer');
		} else {
			$pengajuan_data = [
				'id_pegawai' => $this->session->userdata('id_pegawai'),
				'id_anggota' => $this->input->post('id_anggota'),
				'nominal_total_penarikan' => str_replace(['Rp ', '.'], '', $this->input->post('jumlah_simpanan_pokok')),
				'tanggal_permintaan_penarikan' => date('Y-m-d'),
				'total_akhir_simpanan' => 0,
				'status_penarikan' => 'Sedang Diverifikasi',
				'verifikasi_pegawai' => 'Sedang Diproses',
				'verifikasi_admin' => 'Pending',
				'pesan' => $this->input->post('pesan')
			];

			// Simpan pengajuan penarikan
			$this->simpanan_model->tambahPengajuanPenarikan($pengajuan_data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan penarikan simpanan berhasil ditambahkan.</div>');
			redirect('simpanan/dataAksiPenarikan');
		}
	}

    public function dataSetoran($id)
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Data Setoran Anggota';
        $data['data_setoran'] = $this->simpanan_model->getSetoranById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/dataSetoran');
        $this->load->view('layout/pegawai/footer');
    }

    public function tambah_setoran($id)
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Pembayaran Setoran Simpanan Wajib';
        $data['data_setoran'] = $this->simpanan_model->getSimpananById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/tambah_setoran');
        $this->load->view('layout/pegawai/footer');
    }

    public function proses_tambah_setoran()
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->form_validation->set_rules('id_simpanan', 'id_simpanan', 'trim|required');
        $this->form_validation->set_rules('jumlah_setor_tunai', 'jumlah_setor_tunai', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            redirect('simpanan/dataSimpanan');
        } else {
            $data = $this->simpanan_model->tambahSetoranSimpananWajib();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Simpanan Wajib Telah Ditambahkan. </div>');
            redirect('simpanan/dataSimpanan/' . $this->input->post("id_simpanan"));
        }
    }

    public function hapusSetoran($id)
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Permintaan Hapus Setoran Anggota';
        $data['setoran'] = $this->simpanan_model->getSetoranByIdsetoran($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/hapusSetoran');
        $this->load->view('layout/pegawai/footer');
    }

    public function prosesHapusSetoran()
	{
		$kategori = 'Hapus Setoran';
		$id_data_kategori = $this->input->post('id_simpanan_detail');
		$data = $this->db->query("SELECT * FROM aksi WHERE id_data_kategori = $id_data_kategori AND kategori_aksi LIKE '$kategori'");
		
		$status = null;
		foreach ($data->result_array() as $result) {
			$status = $result['status_aksi'];
		}

		if (!empty($status) && $status == "Sedang Diverifikasi") {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Permintaan hapus transaksi setoran Simpanan Wajib masih pending. Harap bersabar menunggu verifikasi dari Admin. </div>');
			redirect('simpanan/dataSimpanan');
		} else {
			$this->form_validation->set_rules('id_simpanan_detail', 'id_simpanan_detail', 'trim|required');
			$this->form_validation->set_rules('pesan_aksi', 'pesan_aksi', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				redirect('simpanan/dataSimpanan');
			} else {
				$data = $this->simpanan_model->hapusSetoran();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Permintaan hapus transaksi setoran sukses, tunggu admin mereview permintaan anda. </div>');
				redirect('simpanan/dataSimpanan');
			}
		}
	}

    public function daftarAksiPenghapusanSetoran()
    {
        $data['title'] = 'Permintaan Hapus Setoran Anggota';
        $data['aksi'] = $this->aksi_model->getAksiPenghapusanSetoran();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/daftaraksipenghapusansetoran');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function cetakTransaksiHapusSetoran()
    {
        $data['setoran_detail'] = $this->aksi_model->getAllAksiPenghapusanSetoran('Berhasil');
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/laporan_aksi_hapus');
        $this->load->view('laporan/layout/footer');
    }
	
	public function reviewPenghapusanSetoran($id) {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
		
		$data['title'] = 'Permintaan Hapus Setoran Anggota';
        $data['aksi'] = $this->simpanan_model->getAksiById($id);
        $this->load->view('layout/pegawai/header', $data);
		$this->load->view('layout/pegawai/sidebar');
		$this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/reviewPenghapusanSetoran', $data);
        $this->load->view('layout/pegawai/footer');
    }
	
	public function detailPenghapusanSetoran($id) 
	{
		
		$data['title'] = 'Detail Verifikasi Permintaan Hapus Setoran Anggota';
        $data['aksi'] = $this->simpanan_model->getAksiById($id);
        $this->load->view('layout/pegawai/header', $data);
		$this->load->view('layout/pegawai/sidebar');
		$this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/detailPenghapusanSetoran', $data);
        $this->load->view('layout/pegawai/footer');
    }

    public function prosesVerifikasiHapusSetoran() {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }

        $this->form_validation->set_rules('id_aksi', 'ID Aksi', 'trim|required');
        $this->form_validation->set_rules('status_verifikasi', 'Status Verifikasi', 'trim|required');

        if ($this->input->post('status_verifikasi') == 'Ditolak') {
            $this->form_validation->set_rules('pesan_admin', 'Pesan Admin', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {
            redirect('simpanan/reviewPenghapusanSetoran/' . $this->input->post('id_aksi'));
        } else {
            $status = $this->input->post('status_verifikasi');
            $id_aksi = $this->input->post('id_aksi');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $nama_admin = $this->simpanan_model->getNamaPegawaiById($id_pegawai);

            $data = [
                "nama_admin" => $nama_admin,
                "status_verifikasi" => $status,
                "tgl_acc" => date('Y-m-d')
            ];

            if ($status == "Diterima") {
                $data["status_aksi"] = "Berhasil";
                $data["pesan_admin"] = 'Permintaan telah Diverifikasi Admin';

                // Dapatkan informasi tambahan untuk proses update dan delete
                $aksi_data = $this->simpanan_model->getAksiById($id_aksi);
                $id_simpanan_detail = $aksi_data[0]['id_data_kategori'];
                $id_simpanan = $aksi_data[0]['id_simpanan'];
                $jumlah_setoran = $aksi_data[0]['jumlah_setor_tunai'];

                // Panggil fungsi verifikasiHapusSetoranByAdmin() dengan parameter yang sesuai
                if ($this->simpanan_model->verifikasiHapusSetoranByAdmin($id_aksi, $data, $id_simpanan_detail, $id_simpanan, $jumlah_setoran)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan Hapus Simpanan Wajib Sukses Diverifikasi.</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan saat memproses verifikasi.</div>');
                }
            } else if ($status == "Ditolak") {
                $data["status_aksi"] = "Ditolak";
                $data["pesan_admin"] = $this->input->post('pesan_admin');
                $this->simpanan_model->verifikasiHapusSetoranByAdmin($id_aksi, $data, $id_simpanan_detail, $id_simpanan, $jumlah_setoran);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan Hapus Simpanan Wajib Ditolak.</div>');
            }

            redirect('simpanan/daftarAksiPenghapusanSetoran');
        }
    }
	
    public function cetakRiwayatSetoran($id)
    {
        $data['simpanan_detail'] = $this->simpanan_model->cetakPdf($id);
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/nota-setoran');
        $this->load->view('laporan/layout/footer');
    }
	
	public function cetakSetoranSaya($id)
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Cetak Pembayaran Setoran Simpanan Wajib';
        $data['simpanan_detail'] = $this->simpanan_model->cetakPdf($id);
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/nota-setoran');
        $this->load->view('laporan/layout/footer');
    }

    public function laporan()
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Laporan Setoran Simpanan Wajib';
        $data['data_setoran'] = $this->simpanan_model->getAllSetoranDetail();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/laporan');
        $this->load->view('layout/pegawai/footer');
    }

    public function filterLaporanSetoran()
    {
        if ($this->session->userdata('level') != "pegawai") {

            redirect('auth/loginPegawai', 'refresh');
        }
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $data['title'] = 'Laporan Simpanan Anggota';
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['data_setoran'] = $this->simpanan_model->getSetoranByDate($startDate, $endDate);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/laporan');
        $this->load->view('layout/pegawai/footer');
    }
	
    public function dataAksiPenarikan()
    {
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Pengajuan Penarikan Simpanan';
        $data['simpanan'] = $this->simpanan_model->getAllPenarikan();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/daftarPengajuanPenarikan');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function cetakTransaksiPenarikanSimpanan()
    {
        $data['data_penarikan'] = $this->simpanan_model->getAllPenarikan();
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/laporan_data_penarikan');
        $this->load->view('laporan/layout/footer');
    }
	
    public function verifikasiPenarikanByPegawai($id)
    {
        $data['title'] = 'Verifikasi Penarikan Simpanan';
        $data['simpanan'] = $this->simpanan_model->getPenarikanSimpananById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/verifikasiPenarikan');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function prosesVerifikasiPenarikanByPegawai()
	{
		$this->form_validation->set_rules('id_penarikan', 'ID Penarikan', 'trim|required');
		$this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'trim|required');
		$this->form_validation->set_rules('verifikasi_pegawai', 'Verifikasi Pegawai', 'trim|required');
		
		if ($this->input->post('verifikasi_pegawai') == 'Ditolak') {
			$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required');
		}
		
		if ($this->form_validation->run() == FALSE) {
			redirect('simpanan/dataAksiPenarikan');
		} else {
			$status = $this->input->post('verifikasi_pegawai');
			$data = [
				"verifikasi_pegawai" => $status,
				"id_penarikan" => $this->input->post('id_penarikan'),
				"id_pegawai" => $this->input->post('id_pegawai')
			];

			if ($status == "Diterima") {
				$data["total_akhir_simpanan"] = $this->input->post('total_akhir_simpanan');
				$data["pesan"] = 'Verifikasi Diterima Pegawai, Menunggu Verifikasi Admin';
			} else if ($status == "Ditolak") {
				$data["verifikasi_admin"] = "Ditolak";
				$data["status_penarikan"] = "Ditolak";
				$data["tgl_acc_penarikan"] = date('Y-m-d');
				$data["pesan"] = $this->input->post('pesan');
			}

			$this->simpanan_model->verifikasiPenarikan($data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Penarikan Sukses Diverifikasi. </div>');
			redirect('simpanan/dataAksiPenarikan');
		}
	}

    public function verifikasiPenarikanByAdmin($id)
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
        $data['title'] = 'Verifikasi Pengajuan simpanan By Admin';
        $data['simpanan'] = $this->simpanan_model->getPenarikanSimpananById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('simpanan/verifikasiPenarikanAdmin');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function prosesVerifikasiPenarikanByAdmin()
	{
		if ($this->session->userdata('kategori') != "1") {
			redirect('pegawai', 'refresh');
		}

		// Set form validation rules
		$this->form_validation->set_rules('id_penarikan', 'ID Penarikan', 'trim|required');
		$this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'trim|required');
		$this->form_validation->set_rules('verifikasi_admin', 'Verifikasi Admin', 'trim|required');

		if ($this->input->post('verifikasi_admin') == 'Ditolak') {
			$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required');
		}

		// Run form validation
		if ($this->form_validation->run() == FALSE) {
			redirect('simpanan/dataAksiPenarikan');
		} else {
			$status = $this->input->post('verifikasi_admin');
			$data = [
				"verifikasi_admin" => $status,
				"id_penarikan" => $this->input->post('id_penarikan'),
				"id_pegawai" => $this->session->userdata('id_pegawai')
			];

			if ($status == "Diterima") {
				$data["status_penarikan"] = "Berhasil";
				$data["total_akhir_simpanan"] = $this->input->post('total_akhir_simpanan');
				$data["pesan"] = 'Pengajuan telah Diverifikasi dan Diterima, Anggota dapat mengambil uang simpanannya di koperasi';
				$data["tgl_acc_penarikan"] = date('Y-m-d');
			} else if ($status == "Ditolak") {
				$data["verifikasi_pegawai"] = "Ditolak";
				$data["status_penarikan"] = "Ditolak";
				$data["tgl_acc_penarikan"] = date('Y-m-d');
				$data["pesan"] = $this->input->post('pesan');
			}

			// Update database
			$this->simpanan_model->verifikasiPenarikanByAdmin($data);

			// Update status on simpanan table if status is "Diterima"
			if ($status == "Diterima") {
				$id_simpanan = $this->simpanan_model->getIdSimpananByPenarikan($data['id_penarikan']);
				if ($id_simpanan) {
					$this->simpanan_model->updateStatusAndJumlahSimpanan($id_simpanan, $id_pegawai, 'Sudah Ditarik', 0, 0);
					$id_anggota = $this->simpanan_model->getIdAnggotaBySimpanan($id_simpanan);
					if ($id_anggota) {
						$this->anggota_model->updateStatusAnggota($id_anggota, 'Dinonaktifkan');
					}

					// Update simpanan_detail table
					$this->simpanan_model->updateSimpananDetail($id_simpanan_detail, $id_pegawai, 0);
				}
			}

			// Set flashdata message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Penarikan Sukses Diverifikasi. </div>');
			redirect('simpanan/dataAksiPenarikan');
		}
	}

}
