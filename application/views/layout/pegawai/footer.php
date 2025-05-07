</div><!-- /#right-panel -->
<!-- Right Panel -->
<script src="<?= base_url() ?>assets/dashboard/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/assets/js/main.js"></script>


<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url() ?>assets/dashboard/assets/js/init-scripts/data-table/datatables-init.js"></script>

<script>
    $(document).ready(function() {
        $('.data-table').DataTable({
            "pageLength": 5,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
document.getElementById('select2').addEventListener('change', function() {
    var id_anggota = this.value;
    if (id_anggota) {
        fetch('<?= base_url('simpanan/get_simpanan_by_id') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id_anggota=' + id_anggota
        })
        .then(response => response.json())
        .then(data => {
            if (data.total_simpanan) {
                var formatted_amount = formatRupiah(data.total_simpanan);
                document.getElementById('jumlah_simpanan_pokok').value = formatted_amount;
            } else {
                document.getElementById('jumlah_simpanan_pokok').value = 'Rp 0';
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('jumlah_simpanan_pokok').value = 'Rp 0';
    }
});

function formatRupiah(angka) {
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
}
</script>

<script>
    function togglePesanPegawai() {
        var select = document.getElementById('verifikasi_pegawai');
        var pesanContainer = document.getElementById('pesan-container');
        var pesan = document.getElementById('pesan');

        if (select.value === 'Ditolak') {
            pesanContainer.style.display = 'flex';
            pesan.setAttribute('required', 'required');
        } else {
            pesanContainer.style.display = 'none';
            pesan.removeAttribute('required');
            pesan.value = '';
        }
    }
</script>

<script>
    function togglePesanAdmin() {
        var select = document.getElementById('verifikasi_admin');
        var pesanContainer = document.getElementById('pesan-container');
        var pesan = document.getElementById('pesan');

        if (select.value === 'Ditolak') {
            pesanContainer.style.display = 'flex';
            pesan.setAttribute('required', 'required');
        } else {
            pesanContainer.style.display = 'none';
            pesan.removeAttribute('required');
            pesan.value = '';
        }
    }
</script>

<script>
    function togglePesanAdminHapusSetoran() {
        var select = document.getElementById('status_verifikasi');
        var pesanContainer = document.getElementById('pesan-container');
        var pesan = document.getElementById('pesan');

        if (select.value === 'Ditolak') {
            pesanContainer.style.display = 'flex';
            pesan.setAttribute('required', 'required');
        } else {
            pesanContainer.style.display = 'none';
            pesan.removeAttribute('required');
            pesan.value = '';
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculateCicilan() {
        const jumlahPinjaman = parseFloat(document.getElementById('jumlah_pinjaman').value);
        const cicilanElement = document.getElementById('cicilan');
        const cicilan = parseInt(cicilanElement.value);
        const bunga = 0.05;
        
        // Pembatasan cicilan maksimal 6 bulan untuk pinjaman di bawah Rp 3.000.000
        if (jumlahPinjaman < 3000000) {
            for (let i = 0; i < cicilanElement.options.length; i++) {
                if (parseInt(cicilanElement.options[i].value) > 9) {
                    cicilanElement.options[i].disabled = true;
                } else {
                    cicilanElement.options[i].disabled = false;
                }
            }
            if (cicilan > 9) {
                cicilanElement.value = '';
                document.getElementById('cicilan_per_bulan').value = '';
                return;
            }
        } else {
            for (let i = 0; i < cicilanElement.options.length; i++) {
                cicilanElement.options[i].disabled = false;
            }
        }
        
        if (jumlahPinjaman && cicilan) {
            const totalPinjaman = jumlahPinjaman + (jumlahPinjaman * bunga);
            const cicilanPerBulan = totalPinjaman / cicilan;
            document.getElementById('cicilan_per_bulan').value = 'Rp ' + cicilanPerBulan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        } else {
            document.getElementById('cicilan_per_bulan').value = '';
        }
    }

    document.getElementById('jumlah_pinjaman').addEventListener('change', calculateCicilan);
    document.getElementById('cicilan').addEventListener('change', calculateCicilan);
});
</script>

</body>
</html>