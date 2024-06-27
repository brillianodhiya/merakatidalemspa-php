<?php
$tgl = date('Y-m-d');
$bulan = date('m');
?>
<?php
$idk = $_POST['id'];
$id = $_POST['kode_karyawan'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE kode_karyawan='$id'");
$r = mysqli_fetch_array($query);
$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE kode_karyawan='$_POST[kode_karyawan]'"));
if ($cek == 0) {
    echo "<script>window.alert('Nomor Identitas Tidak Ada !')
    window.location='?page=gaji&act=add'</script>";
} else {
?>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Input Gaji Karyawan</h4>
            <div class="row purchace-popup">
                <div class="col-8">
                    <span class="d-flex alifn-items-center">
                        <table class="table">
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>:</th>
                                <th><?= $r['nama_karyawan'] ?></th>
                            </tr>
                            <tr>
                                <th>Kode Karyawan</th>
                                <th>:</th>
                                <th><?= $r['kode_karyawan'] ?></th>
                            </tr>
                            <tr>
                                <th>Bulan</th>
                                <th>:</th>
                                <th><?php
                                $bln = date('m');
                                if ($bln == 1) {
                                    echo "Januari";
                                } elseif ($bln == 2) {
                                    echo "Februari";
                                } elseif ($bln == 3) {
                                    echo "Maret";
                                } elseif ($bln == 4) {
                                    echo "April";
                                } elseif ($bln == 5) {
                                    echo "Mei";
                                } elseif ($bln == 6) {
                                    echo "Juni";
                                } elseif ($bln == 7) {
                                    echo "Juli";
                                } elseif ($bln == 8) {
                                    echo "Agustus";
                                } elseif ($bln == 9) {
                                    echo "September";
                                } elseif ($bln == 10) {
                                    echo "Oktober";
                                } elseif ($bln == 11) {
                                    echo "November";
                                } elseif ($bln == 12) {
                                    echo "Desember";
                                }
                                 ?></th>
                            </tr>
                        </table>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <form action="" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="id_karyawan" value="<?= $r['id_karyawan'] ?>">
        <?php
        $idKaryawan = $r['id_karyawan'];
        $absensiQuery = mysqli_query($koneksi, "SELECT * FROM tb_absenkaryawan WHERE id_karyawan='$idKaryawan' AND MONTH(tgl_absensi) = MONTH(CURRENT_DATE())");
        // $abs = mysqli_fetch_array($absensiQuery);
        $totalMasuk = 0;
        $totalIzin = 0;
        $totalTidakValid = 0;
        while ($abs = mysqli_fetch_array($absensiQuery)) {
            # code...
            if ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] == 'hadir') {
                $totalMasuk++;
            } elseif ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] != 'hadir') {
                $totalIzin++;
            } elseif ($abs['valid_absensi'] == "N") {
                $totalTidakValid++;
            }
        }

        // buat query mengambil data dari table riwayat_pelanggan dengan Where id_karyawan dan bulan nya sekarang, dan juga lakukan join dengan table komhar menggunakan id_tamu sebagai foreign_key untuk kemudian mengambil total_komisi
        $queryListKomisi = mysqli_query($koneksi, "SELECT rp.*, kh.total_komisi, kc.kode_komisi
    FROM riwayat_pelanggan rp
    JOIN komhar kh ON rp.id_tamu = kh.id_tamu
    JOIN komisi kc ON kh.id_kom = kc.id_kom WHERE rp.id_karyawan='$idKaryawan' AND MONTH(rp.tanggal_kunjung) = MONTH(CURRENT_DATE())");
        $totalKomisi = 0;
        $countKomisi = 0;
        $kalimatkomisi = "";
        while ($lk = mysqli_fetch_array($queryListKomisi)) {
            # code...
            $totalKomisi += $lk['total_komisi'];
            $countKomisi++;
            $kalimatkomisi .= $lk['kode_komisi'] . ", ";
        }
        // echo "<p>".$kalimatkomisi."</p>";

        $totalGajiMasuk = $totalMasuk*10000;
        $totalCountIzinDanTidakValid = $totalIzin + $totalTidakValid;
        $totalGajiIzin = $totalCountIzinDanTidakValid*10000;
        $gajiPok = 700000;

        ?>

        <div class=" container mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="col" role="main">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">

                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Gaji Pokok</label>
                                                    <input type="number" class="form-control" name="gapok" value="700000" id="gapok">
                                                    <input type="hidden" class="form-control" name="kode_karyawan" id="kode_karyawan" value="<?= $id ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Gaji Absen Masuk (<?= $totalMasuk ?> hari x Rp10.000)</label>
                                                    <input type="hidden" class="form-control" name="total_count_masuk" id="total_count_masuk" value="<?= $totalMasuk ?>">
                                                    <input type="number" class="form-control" name="gaji_absen_masuk" id="gaji_absen_masuk" value="<?= $totalGajiMasuk ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Komisi (<?=  $countKomisi ?>)</label>
                                                    <input type="hidden" class="form-control" name="total_count_komisi" id="total_count_komisi" value="<?= $countKomisi ?>">
                                                    <input type="hidden" class="form-control" name="keterangan_komisi" id="keterangan_komisi" value="<?= $kalimatkomisi ?>">
                                                    <input type="number" class="form-control" name="komisi" id="komisi" value="<?= $totalKomisi ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Absen Izin (<?=  $totalCountIzinDanTidakValid ?> hari)</label>
                                                    <input type="hidden" class="form-control" name="total_count_izin" id="total_count_izin" value="<?= $totalCountIzinDanTidakValid ?>">
                                                    <input type="number" class="form-control" name="izin" id="izin" value="<?= $totalGajiIzin ?>" readonly>
                                                </div>
                                                <!-- total form -->
                                                <div class="form-group
                                                ">
                                                    <label>Total Gaji</label>
                                                    <input type="number" class="form-control" name="total_gaji" id="total_gaji" value="<?= ($gajiPok + $totalGajiMasuk + $totalKomisi) - $totalGajiIzin ?>" readonly>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="saveGaji" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </div>
    </form>
<?php } ?>


<?php
// cek nis
if (isset($_POST['saveGaji'])) {
    $tgl_gaji = $tgl;
    $id = $_POST['id_karyawan'];
    $potongan = 0;
    $gapok = $_POST['gapok'];
    $kode_karyawan = $_POST['kode_karyawan'];
    $tunjangan = 0;
    $bonus = 0;
    // gaji_absen_masuk, komisi, detail_komisi, absen_izin_count, total_absen_izin, total_gaji, absen_masuk_count
    $gaji_absen_masuk = $_POST['gaji_absen_masuk'];
    $komisi = $_POST['komisi'];
    $absen_izin_count = $_POST['total_count_izin'];
    $total_absen_izin = $_POST['izin'];
    $total_gaji = $_POST['total_gaji'];
    $absen_masuk_count = $_POST['total_count_masuk'];
    $keterangan_komisi = $_POST['keterangan_komisi'];

    //query INSERT disini
    $save = mysqli_query($koneksi, "INSERT INTO tb_gaji VALUES(NULL,'$tgl_gaji','$id','$potongan','$gapok','$tunjangan','$bonus', '$gaji_absen_masuk', '$komisi', '$keterangan_komisi', '$absen_izin_count', '$total_absen_izin', '$total_gaji', '$absen_masuk_count')");

    if ($save) {
        echo " <script>
      alert('Data Berhasil disimpan !');
      window.location='?page=gaji';
      </script>";
    }
}

?>

<!-- buatkan script yang akan merubah total_gaji ketika form gapok diketik -->
<script>
    document.getElementById('gapok').addEventListener('keyup', function() {
        var gapok = this.value;
        var gaji_absen_masuk = document.getElementById('gaji_absen_masuk').value;
        var komisi = document.getElementById('komisi').value;
        var izin = document.getElementById('izin').value;
        var total_gaji = parseInt(gapok) + parseInt(gaji_absen_masuk) + parseInt(komisi) - parseInt(izin);
        document.getElementById('total_gaji').value = total_gaji;
    });
</script>