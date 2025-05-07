<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') != "pegawai") {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->load->model('pegawai_model');
        $this->load->model('anggota_model');
        $this->load->model('pinjaman_model');
		$this->load->model('simpanan_model');
        $this->load->model('aksi_model');
		$this->load->library('pagination');
    }

    public function index()
	{
		$data['title'] = 'Dashboard';
		
		// Mengambil data pegawai berdasarkan id pegawai dari session
		$data['pegawai'] = $this->pegawai_model->getPegawaiById($this->session->userdata('id_pegawai'));

		$data['jumlah_pegawai'] = $this->pegawai_model->totalPegawai();
		
		// Mengambil jumlah anggota yang melakukan pinjaman
        $data['jumlah_anggota_pinjaman'] = $this->pinjaman_model->countAnggotaPinjaman();

        // Mengambil jumlah total pinjaman
        $data['total_pinjaman'] = $this->pinjaman_model->sumTotalPinjaman();
		
		// Mengambil jumlah total simpanan
        $data['total_simpanan'] = $this->simpanan_model->sumTotalSimpanan();

		// Query untuk mendapatkan data pengajuan pinjaman
		$data['pinjaman'] = $this->pinjaman_model->getAllPengajuanDiverifikasi();
		
		// Mengambil jumlah anggota aktif
		$anggota_aktif = $this->anggota_model->getJumlahAnggotaAktif();
		$data['jumlah_anggota'] = count($anggota_aktif);

		// Memuat view dengan data yang diperlukan
		$this->load->view('layout/pegawai/header', $data);
		$this->load->view('layout/pegawai/sidebar');
		$this->load->view('layout/pegawai/top');
		$this->load->view('pegawai/index', $data);
		$this->load->view('layout/pegawai/footer');
	}
	
	public function daftarPengajuanPinjamanIndex()
    {
        $data['title'] = 'Data Pengajuan Pinjaman Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getAllPengajuan();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/index', $data);
        $this->load->view('layout/pegawai/footer');
    }
	
	// Fungsi untuk memuat halaman ubah data pegawai
    public function profileDataPegawai($id_pegawai) {
		
        $data['title'] = 'Ubah Data Pegawai';
        $data['pegawai'] = $this->pegawai_model->getPegawaiById($id_pegawai);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/ubahdatapegawai', $data);
        $this->load->view('layout/pegawai/footer');
    }
	
	public function daftarPegawai()
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai');
        }
        $data['title'] = 'Data Pegawai';
        $data['pegawai'] = $this->pegawai_model->getAllPegawai();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/daftarpegawai');
        $this->load->view('layout/pegawai/footer');
    }

    public function detailPegawai($id)
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai');
        }
        $data['title'] = 'Detail Pegawai';
        $data['pegawai'] = $this->pegawai_model->getPegawaiById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/detailpegawai');
        $this->load->view('layout/pegawai/footer');
    }

    public function tambahDataPegawai()
	{
		if ($this->session->userdata('kategori') != "1") {
			redirect('pegawai');
		}
		$this->form_validation->set_rules('nik_pegawai', 'NIK Pegawai', 'required|numeric');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required');
		$this->form_validation->set_rules('no_telp_pegawai', 'No Telp Pegawai', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pegawai.email]', [
			'is_unique' => '* Email ini telah digunakan, Mohon gunakan email yang lain!'
		]);
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[pegawai.username]', [
			'is_unique' => '* Username ini telah digunakan, Mohon gunakan username yang lain!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
			'min_length' => '* Password minimal menggunakan 8 karakter kombinasi!'
		]);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Pegawai';
			$this->load->view('layout/pegawai/header', $data);
			$this->load->view('layout/pegawai/sidebar');
			$this->load->view('layout/pegawai/top');
			$this->load->view('pegawai/tambahDataPegawai');
			$this->load->view('layout/pegawai/footer');
		} else {
			$upload = $this->pegawai_model->uploadFoto();
			if ($upload['result'] == "success") {
				$data = $this->pegawai_model->tambahPegawai($upload['file']['file_name']);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Menambah Data Pegawai!</div>');
				redirect('pegawai/daftarPegawai');
			} elseif ($upload['error'] == "The file you are attempting to upload is larger than the permitted size.") {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">* Ukuran file terlalu besar. Maksimal 2MB!</div>');
				redirect('pegawai/tambahDataPegawai');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$upload['error'].'</div>');
				redirect('pegawai/tambahDataPegawai');
			}
		}
	}
	
	// Fungsi untuk memuat halaman ubah data pegawai
    public function ubahDataPegawai($id) {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai');
        }
        $data['title'] = 'Ubah Data Pegawai';
        $data['pegawai'] = $this->pegawai_model->getPegawaiById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/ubahdatapegawai', $data);
        $this->load->view('layout/pegawai/footer');
    }

    // Fungsi untuk memproses pengubahan data pegawai
    public function prosesUbahDataPegawai($id_pegawai) {
        // Cek apakah pengguna memiliki hak akses
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai');
        }

        // Ambil data pegawai berdasarkan id
        $data['pegawai'] = $this->pegawai_model->ubahPegawai($id_pegawai);

        // Aturan validasi form
        $this->form_validation->set_rules('nik_pegawai', 'NIK Pegawai', 'required|numeric');
        $this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori Pegawai', 'trim|required');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
        $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required');
        $this->form_validation->set_rules('no_telp_pegawai', 'No Telepon Pegawai', 'required|numeric');
		// Aturan validasi email
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists[' . $id_pegawai . ']', [
            'check_email_exists' => '* Email ini telah digunakan, Mohon gunakan email yang lain!'
        ]);

        // Aturan validasi username
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username_exists[' . $id_pegawai . ']', [
            'check_username_exists' => '* Username ini telah digunakan, Mohon gunakan username yang lain!'
        ]);

        // Aturan validasi password
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]', [
            'min_length' => '* Password minimal menggunakan 8 karakter kombinasi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Ubah Data Pegawai';
			$data['pegawai'] = $this->pegawai_model->getPegawaiById($id_pegawai);
            $this->load->view('layout/pegawai/header', $data);
            $this->load->view('layout/pegawai/sidebar');
            $this->load->view('layout/pegawai/top');
            $this->load->view('pegawai/ubahdatapegawai', $data);
            $this->load->view('layout/pegawai/footer');
        } else {
            // Proses upload foto jika ada
            $upload = $this->pegawai_model->uploadFoto();
            if ($upload['result'] == 'success') {
                // Jika upload berhasil, update data pegawai dengan foto baru
                $this->pegawai_model->updatePegawai($id_pegawai, $upload['file']['file_name']);
            } else {
                // Jika gagal, cek apakah error karena ukuran file
                if ($upload['error'] == '* Ukuran file foto melebihi batas maksimum 2MB!') {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $upload['error'] . '</div>');
                    redirect('pegawai/ubahDataPegawai/' . $id_pegawai);
                } else {
                    // Jika error lain, tetap update data pegawai tanpa foto baru
                    $this->pegawai_model->updatePegawai($id_pegawai);
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Mengubah Data Pegawai!</div>');
            redirect('pegawai/daftarPegawai');
        }
    }
	
	// Fungsi callback untuk validasi email
    public function check_email_exists($email, $id_pegawai) {
        if ($this->pegawai_model->checkEmailExists($email, $id_pegawai)) {
            $this->form_validation->set_message('check_email_exists', '* Email ini telah digunakan, Mohon gunakan email yang lain!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Fungsi callback untuk validasi username
    public function check_username_exists($username, $id_pegawai) {
        if ($this->pegawai_model->checkUsernameExists($username, $id_pegawai)) {
            $this->form_validation->set_message('check_username_exists', '* Username ini telah digunakan, Mohon gunakan username yang lain!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	public function hapusDataPegawai($id_pegawai) {
        if ($this->pegawai_model->deletePegawaiById($id_pegawai)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pegawai sukses dihapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data pegawai gagal dihapus</div>');
        }
        redirect('pegawai/daftarPegawai');
    }

    public function cariAnggota()
	{
		$data['title'] = 'Pencarian Anggota';

		// Ambil kata kunci pencarian dari POST
		$keyword = $this->input->post('keyword');

		// Cek apakah ada kata kunci pencarian
		if (!empty($keyword)) {
			// Panggil model untuk mencari data anggota berdasarkan kata kunci
			$data['anggota'] = $this->anggota_model->cariAnggota($keyword);
		}

		// Load view
		$this->load->view('layout/pegawai/header', $data);
		$this->load->view('layout/pegawai/sidebar');
		$this->load->view('layout/pegawai/top');
		$this->load->view('pegawai/carianggota');
		$this->load->view('layout/pegawai/footer');
	}

	public function daftarAnggota()
    {
        $data['title'] = 'Data Anggota';
        $data['anggota'] = $this->anggota_model->getAllAnggota();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/daftaranggota');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function tambahDataAnggota()
	{

		$this->form_validation->set_rules('nik_anggota', 'NIK anggota', 'required|numeric');
		$this->form_validation->set_rules('nama_anggota', 'Nama anggota', 'trim|required');
		$this->form_validation->set_rules('alamat_anggota', 'Alamat anggota', 'required');
		$this->form_validation->set_rules('no_telp_anggota', 'No Telp anggota', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[anggota.email]', [
			'is_unique' => '* Email ini telah digunakan, Mohon gunakan email yang lain!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Anggota';
			$this->load->view('layout/pegawai/header', $data);
			$this->load->view('layout/pegawai/sidebar');
			$this->load->view('layout/pegawai/top');
			$this->load->view('pegawai/tambahDataAnggota');
			$this->load->view('layout/pegawai/footer');
		} else {
			$uploadKTP = $this->anggota_model->uploadFotoAnggota('foto_ktp_anggota', 'ktp');
			$uploadSelfieKTP = $this->anggota_model->uploadFotoAnggota('foto_selfie_ktp_anggota', 'kyc');

			if ($uploadKTP['result'] == "success" && $uploadSelfieKTP['result'] == "success") {
				$data = [
					'nik_anggota' => $this->input->post('nik_anggota'),
					'nama_anggota' => $this->input->post('nama_anggota'),
					'alamat_anggota' => $this->input->post('alamat_anggota'),
					'no_telp_anggota' => $this->input->post('no_telp_anggota'),
					'email' => $this->input->post('email'),
					'foto_ktp_anggota' => $uploadKTP['file']['file_name'],
					'foto_selfie_ktp_anggota' => $uploadSelfieKTP['file']['file_name'],
					'status_anggota' => 'Sedang Diverifikasi'
				];
				$this->anggota_model->tambahAnggota($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Menambah Data Anggota!</div>');
				redirect('pegawai/daftarAnggota');
			} else {
				$error_message = '';
				if ($uploadKTP['result'] == "failed") {
					$error_message .= $uploadKTP['error'] . '<br>';
				}
				if ($uploadSelfieKTP['result'] == "failed") {
					$error_message .= $uploadSelfieKTP['error'] . '<br>';
				}
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error_message . '</div>');
				redirect('pegawai/tambahDataAnggota');
			}
		}
	}

    public function verifikasiAnggota($id)
    {
        $getDataAnggota = $this->db->query("SELECT * FROM anggota WHERE id_anggota = $id");
        foreach ($getDataAnggota->result_array() as $item) {
            $status_anggota = $item['status_anggota'];
        }
        if ($status_anggota == "Aktif" || $status_anggota == "Belum Aktif" || $status_anggota == "Tidak Aktif") {
            redirect('pegawai');
        } else {
            $data['title'] = 'Verifikasi Anggota';
            $data['anggota'] = $this->anggota_model->getAnggotaById($id);
            $this->load->view('layout/pegawai/header', $data);
            $this->load->view('layout/pegawai/sidebar');
            $this->load->view('layout/pegawai/top');
            $this->load->view('pegawai/verifikasianggota');
            $this->load->view('layout/pegawai/footer');
        }
    }

    public function prosesVerifikasiAnggota()
    {
        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim|required');
        $this->form_validation->set_rules('status_anggota', 'status_anggota', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            redirect('pegawai/daftarAnggota');
        } else {
            $data = $this->pegawai_model->verifikasiAnggota();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Sukses Verifikasi Anggota
          </div>');
            redirect('pegawai/daftarAnggota');
        }
    }
	
	public function detailAnggota($id)
    {
        $data['title'] = 'Detail Anggota';
        $data['anggota'] = $this->anggota_model->getAnggotaById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/detailAnggota');
        $this->load->view('layout/pegawai/footer');
    }

    public function ubahDataAnggota($id)
    {
        $data['title'] = 'Ubah Data Anggota';
        $data['anggota'] = $this->anggota_model->getAnggotaById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/ubahdataanggota');
        $this->load->view('layout/pegawai/footer');
    }

    public function prosesUbahDataAnggota($id_anggota) 
	{
		// Cek apakah pengguna memiliki hak akses
		if ($this->session->userdata('kategori') != "1") {
			redirect('pegawai');
		}

		// Ambil data anggota berdasarkan id
		$anggota = $this->anggota_model->ubahAnggota($id_anggota);
		$data['anggota'] = $anggota;

		// Aturan validasi form
		$this->form_validation->set_rules('nik_anggota', 'NIK Anggota', 'required|numeric');
		$this->form_validation->set_rules('nama_anggota', 'Nama Anggota', 'trim|required');
		$this->form_validation->set_rules('alamat_anggota', 'Alamat Anggota', 'required');
		$this->form_validation->set_rules('no_telp_anggota', 'No Telp Anggota', 'required|numeric');
		$this->form_validation->set_rules('email_anggota', 'Email', 'required|valid_email|callback_check_email_anggota[' . $id_anggota . ']', [
			'check_email_anggota' => '* Email ini telah digunakan, Mohon gunakan email yang lain!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Ubah Data Anggota';
			$data['anggota'] = $this->anggota_model->getAnggotaById($id_anggota);
			$this->load->view('layout/pegawai/header', $data);
			$this->load->view('layout/pegawai/sidebar');
			$this->load->view('layout/pegawai/top');
			$this->load->view('pegawai/ubahdataanggota', $data);
			$this->load->view('layout/pegawai/footer');
		} else {
			$updateData = [
				'nik_anggota' => $this->input->post('nik_anggota'),
				'nama_anggota' => $this->input->post('nama_anggota'),
				'email' => $this->input->post('email_anggota'),
				'no_telp_anggota' => $this->input->post('no_telp_anggota'),
				'alamat_anggota' => $this->input->post('alamat_anggota')
			];

			// Proses upload foto KTP jika ada
			if (!empty($_FILES['foto_ktp_anggota']['name'])) {
				$uploadKtp = $this->anggota_model->uploadFotoAnggota('foto_ktp_anggota', 'ktp');
				if ($uploadKtp['result'] == 'success') {
					$updateData['foto_ktp_anggota'] = $uploadKtp['file']['file_name'];
					// Hapus foto lama jika ada
					if (!empty($anggota['foto_ktp_anggota']) && file_exists('./assets/datakoperasi/imganggota/ktp/' . $anggota['foto_ktp_anggota'])) {
						unlink('./assets/datakoperasi/imganggota/ktp/' . $anggota['foto_ktp_anggota']);
					}
				} else {
					// Set flash data dan redirect jika terjadi error upload
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $uploadKtp['error'] . '</div>');
					redirect('pegawai/ubahDataAnggota/' . $id_anggota);
				}
			}

			// Proses upload foto KYC jika ada
			if (!empty($_FILES['foto_selfie_ktp_anggota']['name'])) {
				$uploadKcy = $this->anggota_model->uploadFotoAnggota('foto_selfie_ktp_anggota', 'kyc');
				if ($uploadKcy['result'] == 'success') {
					$updateData['foto_selfie_ktp_anggota'] = $uploadKcy['file']['file_name'];
					// Hapus foto lama jika ada
					if (!empty($anggota['foto_selfie_ktp_anggota']) && file_exists('./assets/datakoperasi/imganggota/kyc/' . $anggota['foto_selfie_ktp_anggota'])) {
						unlink('./assets/datakoperasi/imganggota/kyc/' . $anggota['foto_selfie_ktp_anggota']);
					}
				} else {
					$updateData['foto_selfie_ktp_anggota'] = $anggota['foto_selfie_ktp_anggota'];
				}
			}

			if ($this->anggota_model->updateAnggota($id_anggota, $updateData)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Mengubah Data Anggota!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Mengubah Data Anggota!</div>');
			}

			redirect('pegawai/daftarAnggota');
		}
	}

    public function daftarAksiPenonaktifanAnggota()
    {
        $data['title'] = 'Permintaan Penonaktifan Anggota';
        $data['aksi'] = $this->aksi_model->getAllAksiPenonaktifan();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/daftaraksipenonaktifananggota');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function cetakAksiPenonaktifanAnggota()
    {
        $data['anggota_detail'] = $this->aksi_model->getAllAksiPenonaktifan();
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/laporan_penonaktifan_anggota');
        $this->load->view('laporan/layout/footer');
    }

    public function nonaktifkanAnggota($id)
    {
        $data['title'] = 'Nonaktifkan Anggota';
        $data['anggota'] = $this->anggota_model->getAnggotaById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/nonaktifkanakun');
        $this->load->view('layout/pegawai/footer');
    }
	
    public function prosesNonaktifkanAnggota()
    {
        $kategori = 'Nonaktifkan Anggota';
        $id_data_kategori = $this->input->post('id_anggota');
        $data = $this->db->query("SELECT * FROM aksi WHERE id_data_kategori = $id_data_kategori AND kategori_aksi LIKE '$kategori'");
        foreach ($data->result_array() as $result) {
            $status = $result['status_verifikasi'];
        }
        if (!empty($status)) {
            if ($status != "Diterima Admin") {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Permintaan Penonaktifan Anggota Sedang Direview Oleh Admin. Harap bersabar menunggu verifikasi Admin.
				</div>');
                redirect('pegawai/daftarAnggota');
            } else {
                $this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    redirect('pegawai/daftarAnggota');
                } else {
                    $data = $this->pegawai_model->nonaktifkanAnggota();
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Permintaan Penonaktifan anggota sukses, Mohon bersabar permintaan Anda sedang direview oleh Admin.
					</div>');
                    redirect('pegawai/daftarAnggota');
                }
            }
        } else {
            $this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim|required');
            $this->form_validation->set_rules('pesan_aksi', 'pesan_aksi', 'required');
            if ($this->form_validation->run() == FALSE) {
                redirect('pegawai/daftarAnggota');
            } else {
                $data = $this->pegawai_model->nonaktifkanAnggota();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Permintaan penonaktifan anggota sukses ditambahkan, Mohon bersabar permintaan Anda sedang direview oleh Admin.
				</div>');
                redirect('pegawai/daftarAnggota');
            }
        }
    }

    public function reviewPenonaktifanAnggota($id)
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
        $getStatus = $this->db->query("SELECT * FROM aksi where id_aksi = $id");
        foreach ($getStatus->result_array() as $result) {
            $status_verifikasi = $result['status_verifikasi'];
        }
        if ($status_verifikasi == "Pending") {
            $data['title'] = 'Review Penonaktifkan Anggota';
            $data['aksi'] = $this->aksi_model->getAksiNonaktif($id);
            $this->load->view('layout/pegawai/header', $data);
            $this->load->view('layout/pegawai/sidebar');
            $this->load->view('layout/pegawai/top');
            $this->load->view('pegawai/reviewPenonaktifanAnggota');
            $this->load->view('layout/pegawai/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Aksi yang telah direview tidak dapat diubah kembali.
          </div>');
            redirect('pegawai/daftarAksiPenonaktifanAnggota');
        }
    }
	
    public function daftarPengajuanPinjaman()
    {
        $data['title'] = 'Data Pengajuan Pinjaman Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getAllPengajuan();
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/daftarPengajuanPinjaman');
        $this->load->view('layout/pegawai/footer');
    }
	
	public function verifikasiPengajuanPinjaman($id)
    {
        $data['title'] = 'Verifikasi Pengajuan Pinjaman Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getAllPengajuanById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/verifikasiPengajuanPinjaman');
        $this->load->view('layout/pegawai/footer');
    }
	
    public function prosesVerifikasiPengajuanPinjaman()
    {
        $this->form_validation->set_rules('id_pengajuan', 'id_pengajuan', 'trim|required');
        $this->form_validation->set_rules('verifikasi_pegawai', 'verifikasi_pegawai', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            redirect('pegawai/daftarPengajuanPinjaman');
        } else {
            $data = $this->pinjaman_model->verifikasiPengajuan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Sukses Verifikasi Pinjaman
          </div>');
            redirect('pegawai/daftarPengajuanPinjaman');
        }
    }

    public function verifikasiPengajuanPinjamanByAdmin($id)
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
        $data['title'] = 'Verifikasi Pengajuan Pinjaman By Admin';
        $data['pinjaman'] = $this->pinjaman_model->getAllPengajuanById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/verifikasiPengajuanPinjamanAdmin');
        $this->load->view('layout/pegawai/footer');
    }

    public function prosesVerifikasiPengajuanPinjamanByAdmin()
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
        $this->form_validation->set_rules('id_pengajuan', 'id_pengajuan', 'trim|required');
        $this->form_validation->set_rules('verifikasi_admin', 'verifikasi_admin', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            redirect('pegawai/daftarPengajuanPinjaman');
        } else {
            $data = $this->pinjaman_model->verifikasiPengajuanByAdmin();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Sukses Verifikasi Pinjaman
          </div>');
            redirect('pegawai/daftarPengajuanPinjaman');
        }
    }
	
    public function detailPengajuanPinjaman($id)
    {
        $data['title'] = 'Detail Pengajuan Pinjaman Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getAllPengajuanById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/detailPengajuanPinjaman');
        $this->load->view('layout/pegawai/footer');
    }
	
    public function daftarPinjaman()
    {
		if ($this->session->userdata('level') != "pegawai") {
			redirect('auth/loginPegawai', 'refresh');
		}
		
        $data['title'] = 'Data Pinjaman Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getAllPinjaman();
		
		// Ambil data setoran untuk setiap simpanan
		foreach ($data['pinjaman'] as &$item) {
			$item['data_angsuran'] = $this->pinjaman_model->getAngsuranById($item['id_pinjaman']);
		}
		
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/daftarPinjaman', $data);
        $this->load->view('layout/pegawai/footer');
    }
	
    public function tambahPinjaman($id)
    {
        $check = $this->db->query("SELECT * FROM pengajuan_pinjaman WHERE id_pengajuan = $id");
        foreach ($check->result_array() as $result) {
            $pesan = $result['pesan'];
        }
        if ($pesan == "Pinjaman anda telah terdaftar") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Maaf anda tidak dapat menambahkan pinjaman karena sudah terdaftar.
           </div>');
            redirect('pegawai/daftarPengajuanPinjaman');
        }
        $data['title'] = 'Tambah Pinjaman';
        $data['pinjaman'] = $this->pinjaman_model->getAllPengajuanById($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/accPinjaman');
        $this->load->view('layout/pegawai/footer');
    }
	
    public function prosesTambahPinjaman()
    {
        $this->form_validation->set_rules('id_pengajuan', 'id_pengajuan', 'trim|required');
        $this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim|required');
        $this->form_validation->set_rules('tanggal_meminjam', 'tanggal_meminjam', 'required');
        $this->form_validation->set_rules('total_pinjaman', 'total_pinjaman', 'required');
        $this->form_validation->set_rules('angsuran_bulanan', 'angsuran_bulanan', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect('pegawai/daftarPengajuanPinjaman');
        } else {
            $data = $this->pinjaman_model->insertPinjaman();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Sukses Tambah Pinjaman
          </div>');
            redirect('pegawai/daftarPinjaman');
        }
    }
	
    public function ubahPinjaman($id)
    {
        $data['title'] = 'Ubah Status Pinjaman Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getPinjamanByIdPinjaman($id);
        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/ubahPinjaman');
        $this->load->view('layout/pegawai/footer');
    }
	
    public function prosesUbahPinjaman()
    {
        $this->form_validation->set_rules('status_pinjaman', 'status_pinjaman', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            redirect('pegawai/ubahPinjaman');
        } else {
            $data = $this->pinjaman_model->ubahPinjaman();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Sukses Ubah Status Pinjaman. </div>');
            redirect('pegawai/daftarPinjaman');
        }
    }

    public function tambahAngsuran($id)
	{
		$data['title'] = 'Tambah Angsuran Pinjaman Anggota';
		$data['pinjaman'] = $this->pinjaman_model->getPinjamanByIdPinjaman($id);

		// Calculate the due date for the final installment
		if (!empty($data['pinjaman'])) {
			$tanggal_meminjam = new DateTime($data['pinjaman']['tanggal_meminjam']);
			$jml_tempo_angsuran = $data['pinjaman']['jml_tempo_angsuran'];
			$tanggal_meminjam->modify("+$jml_tempo_angsuran months");
			$data['pinjaman']['tanggal_pelunasan'] = $tanggal_meminjam->format('Y-m-d');
		}

		$this->load->view('layout/pegawai/header', $data);
		$this->load->view('layout/pegawai/sidebar');
		$this->load->view('layout/pegawai/top');
		$this->load->view('pegawai/tambahAngsuranPinjaman', $data);  // Ensure $data is passed correctly
		$this->load->view('layout/pegawai/footer');
	}
	
    public function prosesTambahAngsuran() 
	{
		$id_pinjaman = $this->input->post('id_pinjaman');
		$angsuran_pembayaran = $this->input->post('angsuran_pembayaran');
		$tanggal_pelunasan = $this->input->post('tanggal_pelunasan');

		// Insert angsuran
		$this->pinjaman_model->tambahAngsuran($id_pinjaman, $angsuran_pembayaran, $tanggal_pelunasan);
		
		// Cek apakah angsuran terakhir
		$is_lunas = $this->pinjaman_model->cekAngsuranTerakhir($id_pinjaman);

		if ($is_lunas) {
			$this->pinjaman_model->updateStatusPinjamanLunas($id_pinjaman);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Angsuran terakhir berhasil dibayarkan. Pinjaman sudah lunas.</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Angsuran berhasil ditambahkan.</div>');
		}

		redirect('pegawai/daftarPinjaman');
	}
	
	public function cetakTransaksiHapusAngsuran()
    {
        $data['angsuran_detail'] = $this->aksi_model->getAllAksiPenghapusanAngsuran();
        $this->load->view('laporan/layout/header', $data);
        $this->load->view('laporan/laporan_aksi_hapus_angsuran');
        $this->load->view('laporan/layout/footer');
    }
	
     public function riwayatAngsuran()
    {
        $data['title'] = 'Data Riwayat Setoran Angsuran Anggota';
        $data['pinjaman'] = $this->pinjaman_model->getAllAngsuran();
		
        // Ambil data setoran untuk setiap pinjaman
        foreach ($data['pinjaman'] as &$item) {
            $item['data_angsuran'] = $this->pinjaman_model->getAngsuranById($item['id_pinjaman']);
        }

        $this->load->view('layout/pegawai/header', $data);
        $this->load->view('layout/pegawai/sidebar');
        $this->load->view('layout/pegawai/top');
        $this->load->view('pegawai/riwayatAngsuran', $data);
        $this->load->view('layout/pegawai/footer');
    }	

    public function terimaAksiPenonaktifan($id)
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
        $getStatus = $this->db->query("SELECT * FROM aksi where id_aksi = $id");
        foreach ($getStatus->result_array() as $result) {
            $status_verifikasi = $result['status_verifikasi'];
        }
        if ($status_verifikasi == "Pending") {
            $this->pegawai_model->terimaAksiPenonaktifan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Permintaan Penonaktifan Diterima
            </div>');
            redirect('pegawai/daftarAksiPenonaktifanAnggota');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Permintaan yang telah Diverifikasi tidak dapat diubah kembali.
			</div>');
            redirect('pegawai/daftarAksiPenonaktifanAnggota');
        }
    }

    public function tolakAksiPenonaktifan($id)
    {
        if ($this->session->userdata('kategori') != "1") {
            redirect('pegawai', 'refresh');
        }
        $getStatus = $this->db->query("SELECT * FROM aksi where id_aksi = $id");
        foreach ($getStatus->result_array() as $result) {
            $status_verifikasi = $result['status_verifikasi'];
        }
        if ($status_verifikasi == "Pending") {
            $this->pegawai_model->tolakAksiPenonaktifan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Permintaan Penonaktifan Ditolak, Cek Detailnya Di Halaman Penonaktifan Anggota.
			</div>');
            redirect('pegawai/daftarAksiPenonaktifanAnggota');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       Aksi yang telah direview tidak dapat diubah kembali.
      </div>');
            redirect('pegawai/daftarAksiPenonaktifanAnggota');
        }
    }

}
