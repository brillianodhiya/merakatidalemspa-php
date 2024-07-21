<?php
$tgl = date('Y-m-d');
$bulan = date('m');
$tahun = date('Y');
?>
<div>
<form action="" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="id_karyawan" value="<?= $r['id_karyawan'] ?>">
        <?php
        $queryNeraca = mysqli_query($koneksi, "SELECT * FROM tb_neraca WHERE MONTH(bulan) = MONTH(CURRENT_DATE())");
        // $abs = mysqli_fetch_array($absensiQuery);
        $row = mysqli_fetch_assoc($queryNeraca);

        $modal = $row["modal"];
        $peralatan = $row["peralatan"];

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
                                                    <label>Modal</label>
                                                    <input type="number" class="form-control" name="modal" value="<?= $modal ?>" id="modal">
                                                </div>
                                                <div class="form-group">
                                                    <label>Peralatan</label>
                                                    <input type="number" class="form-control" name="peralatan" value="<?= $peralatan ?>" id="peralatan">
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
                    <input type="submit" name="saveNeraca" class="btn btn-lg" style="background-color:#800080; color:#ffff;" />
                    <a href="modul/laporan/cetak_keuangan.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>&modal=<?= $modal ?>&peralatan=<?= $peralatan ?>" id="link-cetak" class="btn btn-info btn-lg" name="btnCetak" target="_blank" aria-expanded="false"><i class="fas fa-print"></i>
                        Cetak
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
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
    // gunakan fetch GET
    var url = ""
    if (window.location.origin.includes("localhost")) {
        url = '/adminsalon/config/fetch_neraca.php?bulan=' + bulan
    } else {
        url = '/config/fetch_neraca.php?bulan=' + bulan
    }
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // isi dropdown nama tamu
            // output {"totalMasuk":3,"totalIzin":1,"totalTidakValid":1,"bulan":"2024-06-25","idKaryawan":"1","totalGajiMasuk":30000,"totalCountIzinDanTidakValid":2,"totalGajiIzin":20000,"gajiPok":700000,"totalKomisi":126400,"countKomisi":4,"kalimatkomisi":"Facial Treatment, Facial Treatment, Treatment Satuan, Spa Treatment, ","totalGaji":836400}
            if (data) {
                document.getElementById('modal').value = data.modal;
                document.getElementById('peralatan').value = data.peralatan;

                var bulan2 = bulan.split("-")[1];
                var tahun = bulan.split("-")[0];
                var modal = data.modal;
                var peralatan = data.peralatan;
                document.getElementById('link-cetak').href = "modul/laporan/cetak_keuangan.php?bulan=" + bulan2 + "&tahun=" + tahun + "&modal=" + modal + "&peralatan=" + peralatan;
            }
        });
}
    // fungsi untuk merubah url href pada link di id = link-cetak ketika bulan / tahun / modal / peralatan dirubah    
    // document.getElementById('bulan').addEventListener('change', function() {
    //     var bulan = this.value;
    //     var tahun = document.getElementById('tahun').value;
    //     var modal = document.getElementById('modal').value;
    //     var peralatan = document.getElementById('peralatan').value;
    //     document.getElementById('link-cetak').href = "modul/laporan/cetak_keuangan.php?bulan=" + bulan + "&tahun=" + tahun + "&modal=" + modal + "&peralatan=" + peralatan;
    // });
    // document.getElementById('tahun').addEventListener('change', function() {
    //     var tahun = this.value;
    //     var bulan = document.getElementById('bulan').value;
    //     var modal = document.getElementById('modal').value;
    //     var peralatan = document.getElementById('peralatan').value;
    //     document.getElementById('link-cetak').href = "modul/laporan/cetak_keuangan.php?bulan=" + bulan + "&tahun=" + tahun + "&modal=" + modal + "&peralatan=" + peralatan;
    // });
    document.getElementById('modal').addEventListener('keyup', function() {
        var modal = this.value;
        var bulan = document.getElementById('bulan').value;
        var tahun = document.getElementById('tahun').value;
        var peralatan = document.getElementById('peralatan').value;
        document.getElementById('link-cetak').href = "modul/laporan/cetak_keuangan.php?bulan=" + bulan + "&tahun=" + tahun + "&modal=" + modal + "&peralatan=" + peralatan;
    });
    document.getElementById('peralatan').addEventListener('keyup', function() {
        var peralatan = this.value;
        var bulan = document.getElementById('bulan').value;
        var tahun = document.getElementById('tahun').value;
        var modal = document.getElementById('modal').value;
        document.getElementById('link-cetak').href = "modul/laporan/cetak_keuangan.php?bulan=" + bulan + "&tahun=" + tahun + "&modal=" + modal + "&peralatan=" + peralatan;
    });

</script>

<?php
// cek nis
if (isset($_POST['saveNeraca'])) {
    $modal = $_POST['modal'];
    $peralatan = $_POST['peralatan'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    // gabungan bulan dan tahun 
    $tgl = $tahun . '-' . $bulan . '-01';

    // Query Update jika sudah ada data dengan bulan yang sama create jika belum ada
    $queryNeraca = mysqli_query($koneksi, "SELECT * FROM tb_neraca WHERE MONTH(bulan) = '$bulan' AND YEAR(bulan) = '$tahun'");
    $cekNeraca = mysqli_num_rows($queryNeraca);
    if ($cekNeraca > 0) {
        $updateNeraca = mysqli_query($koneksi, "UPDATE tb_neraca SET modal = '$modal', peralatan = '$peralatan' WHERE MONTH(bulan) = '$bulan' AND YEAR(bulan) = '$tahun'");
        if ($updateNeraca) {
            echo " <script>
            alert('Data Berhasil diupdate !');
                  window.location='?page=laporan&act=keuangan';
            </script>";
        }
    } else {
        $saveNeraca = mysqli_query($koneksi, "INSERT INTO tb_neraca VALUES(NULL,'$tgl','$modal','$peralatan')");
        if ($saveNeraca) {
            echo " <script>
            alert('Data Berhasil disimpan !');
                  window.location='?page=laporan&act=keuangan';
            </script>";
        }
    }


    // //query INSERT disini
    // // $save = mysqli_query($koneksi, "INSERT INTO tb_gaji VALUES(NULL,'$tgl_gaji','$id','$potongan','$gapok','$tunjangan','$bonus', '$gaji_absen_masuk', '$komisi', '$keterangan_komisi', '$absen_izin_count', '$total_absen_izin', '$total_gaji', '$absen_masuk_count')");

    // if ($save) {
    //     echo " <script>
    //   alert('Data Berhasil disimpan !');
    //   window.location='?page=gaji';
    //   </script>";
    // }
}

?>