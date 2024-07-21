<?php
include '../../../config/koneksi.php';
include '../../../config/rupiah.php';


$bulan = $_GET["bulan"];
$tahun = $_GET["tahun"];
$dt1 = $tahun . "-" . $bulan . "-01";

// $sql_neraca = "SELECT * FROM tb_neraca WHERE MONTH(bulan) = MONTH('$dt1') AND YEAR(bulan) = YEAR('$dt1')";
// $query_tampil = mysqli_query($koneksi, $sql_neraca);

// - beban gaji (dari gaji) 
// - beban belanja bulanan (dari pengeluaran) 
// - pendapatan
// - prive (30% pendapatan)
// - Rumus kas = Pendapatan + modal - peralatan - prive - beban gaji -  beban belanja bulanan

$totalPendapatan = mysqli_query($koneksi, "SELECT SUM(total) AS total_pendapatan FROM riwayat_pelanggan WHERE MONTH(tanggal_kunjung) = MONTH('$dt1') AND YEAR(tanggal_kunjung) = YEAR('$dt1')");
$totalPendapatan = $totalPendapatan->fetch_assoc()['total_pendapatan'];

$totalPengeluaran = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total_pengeluaran FROM pengeluaran WHERE MONTH(tanggal_keluar) = MONTH('$dt1') AND YEAR(tanggal_keluar) = YEAR('$dt1')");
$totalPengeluaran = $totalPengeluaran->fetch_assoc()['total_pengeluaran'];

$peralatan = $_GET['peralatan'];
$modal = $_GET['modal'];

$totalPeralatan = $_GET['peralatan'];
$totalModal = $_GET['modal'];

$totalPrive = $totalPendapatan * 0.3;

$totalBebanGaji = mysqli_query($koneksi, "SELECT SUM(total_gaji) AS total_gaji FROM tb_gaji WHERE MONTH(tgl_gaji) = MONTH('$dt1') AND YEAR(tgl_gaji) = YEAR('$dt1')");
$totalBebanGaji = $totalBebanGaji->fetch_assoc()['total_gaji'];

$kas = $totalPendapatan + 
    $totalModal - 
    $totalPeralatan - 
    $totalPrive - 
    $totalBebanGaji - 
    $totalPengeluaran;

?>

<style>
    body {
        font-family: 'Times New Roman', Times, serif, Geneva, Tahoma, sans-serif;
    }

    h3 {
        font-family: 'Times New Roman', Times, serif, Geneva, Tahoma, sans-serif;
    }
</style>
<center>
    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM tb_aplikasi");
    while ($d = mysqli_fetch_array($data)) {
    ?>
        <img src="../../../assets/img/app/logo.png" class="img-thumbnail" style="height: 100px;width: 100px;">
    <?php } ?>
    <br>
    <h3><b>Laporan Keuangan</b></h3>
    <p><b>Merak Ati Dalem Spa</p></b>
    <hr style="font-weight:bold; font-size: 12px;">
</center>

<body>
    <p>Laporan Keuangan, Periode
        <?php $a = $dt1;
        echo date("M-Y", strtotime($dt1)) ?> 
        <!-- <?= $kas ?> -->
    </p>
    <table width="100%" border="2" style="border-collapse: collapse;" cellpadding="3">
        <thead>
            <tr>
                <th style="border: 2px solid black;">Keterangan</th>
                <th style="border: 2px solid black;">Saldo Debet</th>
                <th style="border: 2px solid black;">Saldo Kredit</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td style="border: 2px solid black;">Kas</td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($kas)  ?> </td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="border: 2px solid black;">Peralatan</td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($peralatan)  ?> </td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="border: 2px solid black;">Modal Awal</td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($modal)  ?> </td>
                </tr>
                <tr>
                    <td style="border: 2px solid black;">Beban Gaji</td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($totalBebanGaji ? $totalBebanGaji : 0)  ?></td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="border: 2px solid black;">Belanja bulanan</td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($totalPengeluaran)  ?></td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="border: 2px solid black;">Pendapatan Jasa</td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($totalPendapatan ? $totalPendapatan : 0)  ?> </td>
                </tr>
                <tr>
                    <td style="border: 2px solid black;">Prive</td>
                    <td style="border: 2px solid black; text-align: right;"><?= rupiah($totalPrive)  ?></td>
                    <td style="border: 2px solid black; text-align: right;"></td>
                </tr>
                <!-- total  -->
                <tr>
                    <td style="border: 2px solid black;"><b>Total</b></td>
                    <td style="border: 2px solid black; text-align: right;"><?php 
                    $total = $kas + $peralatan + $totalBebanGaji + $totalPengeluaran + $totalPrive;
                    echo rupiah($total);
                     ?> </td>
                    <td style="border: 2px solid black; text-align: right;"><?php 
                    $total = $modal + $totalPendapatan;
                    echo rupiah($total);
                     ?> </td>
                </tr>
        </tbody>
    </table>
</body>


<script>
    window.print();
</script>