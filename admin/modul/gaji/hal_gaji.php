<?php
$tgl = date('Y-m-d');
$bulan = date('m');
$tahun = date('Y');
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
                            <!-- <tr>
                                <th>Pilih Bulan (<?= $tahun ?>)</th>
                                <th>:</th>
                          
                                    <th>
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option value="1" <?php if ($bulan == 1) {
                                                                    echo "selected";
                                                                } ?>>Januari</option>
                                            <option value="2" <?php if ($bulan == 2) {
                                                                    echo "selected";
                                                                } ?>>Februari</option>
                                            <option value="3" <?php if ($bulan == 3) {
                                                                    echo "selected";
                                                                } ?>>Maret</option>
                                            <option value="4" <?php if ($bulan == 4) {
                                                                    echo "selected";
                                                                } ?>>April</option>
                                            <option value="5" <?php if ($bulan == 5) {
                                                                    echo "selected";
                                                                } ?>>Mei</option>
                                            <option value="6" <?php if ($bulan == 6) {
                                                                    echo "selected";
                                                                } ?>>Juni</option>
                                            <option value="7" <?php if ($bulan == 7) {
                                                                    echo "selected";
                                                                } ?>>Juli</option>
                                            <option value="8" <?php if ($bulan == 8) {
                                                                    echo "selected";
                                                                } ?>>Agustus</option>
                                            <option value="9" <?php if ($bulan == 9) {
                                                                    echo "selected";
                                                                } ?>>September</option>
                                            <option value="10" <?php if ($bulan == 10) {
                                                                    echo "selected";
                                                                } ?>>Oktober</option>
                                            <option value="11" <?php if ($bulan == 11) {
                                                                    echo "selected";
                                                                } ?>>November</option>
                                            <option value="12" <?php if ($bulan == 12) {
                                                                    echo "selected";
                                                                } ?>>Desember</option>
                                        </select>
                                    </th>
                                                                  

                            </tr> -->
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
        $totalPengurangan = 0;
        $totalWaktuTelatDalamMenit = 0;
        while ($abs = mysqli_fetch_array($absensiQuery)) {
            # code...
            if ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] == 'hadir') {
                $jam_masuk = $abs['jam_masuk'];
                $jam_keluar = $abs['jam_keluar'];
                // jika jam keluar kosong gunakan jam 20:00:00
                if ($jam_keluar == "") {
                    $jam_keluar = "20:00:00";
                }
                if ($totalMasuk <= 25) {
                    $totalMasuk++;
                }
                // jika jam masuk melebihi jam 9:00 maka akan dihitung terlambat
                // contoh jika masuk jam 9:40 menit maka akan dihitung terlambat 40 menit
                // jam keluar melebihi dihitung maksimal jam 20:00 jika lebih maka tidak ada denda absen keluar 
                // ada pengurangan 10000 per 30 menit keterlambatan absen masuk
                // tambahkan perhitungan per 30 menit nya juga
                $telat = strtotime($jam_masuk) - strtotime("09:00:00");
                $telat = $telat / 60;
                if ($telat > 0) {
                    $totalWaktuTelatDalamMenit += ceil($telat);
                    $totalPengurangan += ceil($telat/30)*10000;
                }
                // jika jam keluar terdeteksi sebelum jam 20:00:00
                // maka akan dihitung telat dan juga dikenakan pemotongan per 30 menitnya
                if ($jam_keluar < "18:00:00") {
                    $telat = strtotime("20:00:00") - strtotime($jam_keluar);
                    $telat = $telat / 60;
                    if ($telat > 0) {
                        $totalWaktuTelatDalamMenit += ceil($telat);
                        $totalPengurangan += ceil($telat/30)*10000;
                    }
                }
                
               
            } elseif ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] != 'hadir') {
                $totalIzin++;
            } elseif ($abs['valid_absensi'] == "N") {
                $totalTidakValid++;
            }
        }

        // jika totalMasuk + totalIzin + totalTidakValid < 26 maka sisanya akan masuk ke izin
        if ($totalMasuk + $totalIzin + $totalTidakValid < 25) {
            $totalIzin += 25 - ($totalMasuk + $totalIzin + $totalTidakValid);
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
                                                    <label>Pilih Bulan</label>
                                                    <!-- buatkan pilihan dropdown untuk bulan dan dropdown untuk pilihan tahun -->
                                                    <select name="bulan" id="bulan" class="form-control">
                                                        <option value="01" <?php if ($bulan == 1) {
                                                                            echo "selected";
                                                                        } ?>>Januari</option>
                                                        <option value="02" <?php if ($bulan == 2) {
                                                                            echo "selected";
                                                                        } ?>>Februari</option>
                                                        <option value="03" <?php if ($bulan == 3) {
                                                                            echo "selected";
                                                                        } ?>>Maret</option>
                                                        <option value="04" <?php if ($bulan == 4) {
                                                                            echo "selected";
                                                                        } ?>>April</option>
                                                        <option value="05" <?php if ($bulan == 5) {
                                                                            echo "selected";
                                                                        } ?>>Mei</option>
                                                        <option value="06" <?php if ($bulan == 6) {
                                                                            echo "selected";
                                                                        } ?>>Juni</option>
                                                        <option value="07" <?php if ($bulan == 7) {
                                                                            echo "selected";
                                                                        } ?>>Juli</option>
                                                        <option value="08" <?php if ($bulan == 8) {
                                                                            echo "selected";
                                                                        } ?>>Agustus</option>
                                                        <option value="09" <?php if ($bulan == 9) {
                                                                            echo "selected";
                                                                        } ?>>September</option>
                                                        <option value="10" <?php if ($bulan == 10) {
                                                                            echo "selected";
                                                                        } ?>>Oktober</option>
                                                        <option value="11" <?php if ($bulan == 11) {
                                                                            echo "selected";
                                                                        } ?>>November</option>
                                                        <option value="12" <?php if ($bulan == 12) {
                                                                            echo "selected";
                                                                        } ?>>Desember</option>
                                                    </select>
                                                    
                                                </div>
                                            <div class="form-group">
                                                    <label>Gaji Pokok</label>
                                                    <input type="number" class="form-control" name="gapok" value="700000" id="gapok">
                                                    <input type="hidden" class="form-control" name="kode_karyawan" id="kode_karyawan" value="<?= $id ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label id="gaji_absen_masuk_label">Gaji Absen Masuk (<?= $totalMasuk ?> hari x Rp10.000)</label>
                                                    <input type="hidden" class="form-control" name="total_count_masuk" id="total_count_masuk" value="<?= $totalMasuk ?>">
                                                    <input type="number" class="form-control" name="gaji_absen_masuk" id="gaji_absen_masuk" value="<?= $totalGajiMasuk ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label id="komisi_label">Komisi (<?=  $countKomisi ?>)</label>
                                                    <input type="hidden" class="form-control" name="total_count_komisi" id="total_count_komisi" value="<?= $countKomisi ?>">
                                                    <input type="hidden" class="form-control" name="keterangan_komisi" id="keterangan_komisi" value="<?= $kalimatkomisi ?>">
                                                    <input type="number" class="form-control" name="komisi" id="komisi" value="<?= $totalKomisi ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label id="absen_izin_label">Absen Izin (<?=  $totalCountIzinDanTidakValid ?> hari)</label>
                                                    <input type="hidden" class="form-control" name="total_count_izin" id="total_count_izin" value="<?= $totalCountIzinDanTidakValid ?>">
                                                    <input type="number" class="form-control" name="izin" id="izin" value="<?= $totalGajiIzin ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label id="absen_keterlambatan_label">Absen Keterlambatan 10rb/30menit (<?= $totalWaktuTelatDalamMenit ?>menit)</label>
                                                    <input type="hidden" class="form-control" name="terlambat_dalam_menit" id="terlambat_dalam_menit" value="<?= $totalWaktuTelatDalamMenit ?>">
                                                    <input type="number" class="form-control" name="keterlambatan" id="keterlambatan" value="<?= $totalPengurangan ?>" readonly>
                                                </div>
                                                <!-- total form -->
                                                <div class="form-group
                                                ">
                                                    <label id="total_gaji_label">Total Gaji</label>
                                                    <input type="number" class="form-control" name="total_gaji" id="total_gaji" value="<?= ($gajiPok + $totalGajiMasuk + $totalKomisi) - $totalGajiIzin - $totalPengurangan ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Pilih Tahun</label>
                                                    <!-- buatkan pilihan dropdown untuk bulan dan dropdown untuk pilihan tahun -->
                                                    <select name="tahun" id="tahun" class="form-control">
                                                        <option value="2021" <?php if ($tahun == 2021) {
                                                                                echo "selected";
                                                                            } ?>>2021</option>
                                                        <option value="2022" <?php if ($tahun == 2022) {
                                                                                echo "selected";
                                                                            } ?>>2022</option>
                                                        <option value="2023" <?php if ($tahun == 2023) {
                                                                                echo "selected";
                                                                            } ?>>2023</option>
                                                        <option value="2024" <?php if ($tahun == 2024) {
                                                                                echo "selected";
                                                                            } ?>>2024</option>
                                                        <option value="2025" <?php if ($tahun == 2025) {
                                                                                echo "selected";
                                                                            } ?>>2025</option>
                                                        <option value="2026" <?php if ($tahun == 2026) {
                                                                                echo "selected";
                                                                            } ?>>2026</option>
                                                        <option value="2027" <?php if ($tahun == 2027) {
                                                                                echo "selected";
                                                                            } ?>>2027</option>
                                                        <option value="2028" <?php if ($tahun == 2028) {
                                                                                echo "selected";
                                                                            } ?>>2028</option>
                                                        <option value="2029" <?php if ($tahun == 2029) {
                                                                                echo "selected";
                                                                            } ?>>2029</option>
                                                        <option value="2030" <?php if ($tahun == 2030) {
                                                                                echo "selected";
                                                                            } ?>>2030</option>
                                                    </select>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="saveGaji" class="btn btn-lg" style="background-color:#800080; color:#ffff;" />
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
    $totalTerlambatDalamMenit = $_POST['terlambat_dalam_menit'];
    $keterlambatan = $_POST['keterlambatan'];

    //query INSERT disini
    $save = mysqli_query($koneksi, "INSERT INTO tb_gaji VALUES(NULL,'$tgl_gaji','$id','$potongan','$gapok','$tunjangan','$bonus', '$gaji_absen_masuk', '$komisi', '$keterangan_komisi', '$absen_izin_count', '$total_absen_izin', '$total_gaji', '$absen_masuk_count', '$totalTerlambatDalamMenit', '$keterlambatan')");

    if ($save) {
        echo " <script>
      alert('Data Berhasil disimpan !');
      window.location='?page=gaji';
      </script>";
    }
}

?>

<script>
    document.getElementById('gapok').addEventListener('keyup', function() {
        var gapok = this.value;
        var gaji_absen_masuk = document.getElementById('gaji_absen_masuk').value;
        var komisi = document.getElementById('komisi').value;
        var izin = document.getElementById('izin').value;
        var total_gaji = parseInt(gapok) + parseInt(gaji_absen_masuk) + parseInt(komisi) - parseInt(izin);
        document.getElementById('total_gaji').value = total_gaji;
    });

    // ketika bulan ataupun tahun berubah panggil fungsi fetchGajiData
    document.getElementById('bulan').addEventListener('change', function() {
        var bulan = this.value;
        var tahun = document.getElementById('tahun').value;
        fetchGajiData(tahun + "-" + bulan);
    });
    document.getElementById('tahun').addEventListener('change', function() {
        var tahun = this.value;
        var bulan = document.getElementById('bulan').value;
        fetchGajiData(tahun + "-" + bulan);
    });

    function fetchGajiData(bulan) {
    // Menggunakan teknologi Ajax (misalnya dengan jQuery atau fetch API)
    // Kirim permintaan ke server dengan parameter tanggal
    // Tangani respons dari server dan isi dropdown nama tamu
    // console.log(bulan);
    var id_karyawan =  <?php
    echo $idKaryawan;
    ?>;
    // gunakan fetch GET
    var url = ""
    if (window.location.origin.includes("localhost")) {
        url = '/adminsalon/config/fetch_gaji.php?bulan=' + bulan
    } else {
        url = '/config/fetch_gaji.php?bulan=' + bulan
    }
    fetch(url + "&id_karyawan=" + id_karyawan)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // isi dropdown nama tamu
            // output {"totalMasuk":3,"totalIzin":1,"totalTidakValid":1,"bulan":"2024-06-25","idKaryawan":"1","totalGajiMasuk":30000,"totalCountIzinDanTidakValid":2,"totalGajiIzin":20000,"gajiPok":700000,"totalKomisi":126400,"countKomisi":4,"kalimatkomisi":"Facial Treatment, Facial Treatment, Treatment Satuan, Spa Treatment, ","totalGaji":836400}
            if (data) {
                document.getElementById('total_count_masuk').value = data.totalMasuk;
                document.getElementById('gaji_absen_masuk').value = data.totalGajiMasuk;
                document.getElementById('total_count_izin').value = data.totalCountIzinDanTidakValid;
                document.getElementById('izin').value = data.totalGajiIzin;
                document.getElementById('komisi').value = data.totalKomisi;
                document.getElementById('total_count_komisi').value = data.countKomisi;
                document.getElementById('keterangan_komisi').value = data.kalimatkomisi;
                document.getElementById('total_gaji').value = data.totalGaji;
                document.getElementById('keterlambatan').value = data.totalPengurangan;
                document.getElementById('terlambat_dalam_menit').value = data.totalWaktuTelatDalamMenit;
                document.getElementById("gaji_absen_masuk_label").innerHTML = "Gaji Absen Masuk (" + data.totalMasuk + " hari x Rp10.000)";
                document.getElementById("komisi_label").innerHTML = "Komisi (" + data.countKomisi + ")";
                document.getElementById("absen_izin_label").innerHTML = "Absen Izin (" + data.totalCountIzinDanTidakValid + " hari)";
                document.getElementById("absen_keterlambatan_label").innerHTML = "Absen Keterlambatan 10rb/30menit (" + data.totalWaktuTelatDalamMenit + "menit)";

                // document.getElementById("total_gaji_label").innerHTML = "Total Gaji (" + data.totalMas
                // + " hari x Rp10.000) + " + data.totalKomisi + " +
                // " - " + data.totalGajiIzin + " - " + data.totalPengurangan;

            }
        });

}

</script>