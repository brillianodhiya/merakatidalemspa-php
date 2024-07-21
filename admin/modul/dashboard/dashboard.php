
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Bulanan</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div style="display: flex; flex-direction: row; flex-wrap: wrap; gap: 16px; justify-content: left;">

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Total Pelanggan</h5>
<?php 
$totalPengeluaran = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total_pengeluaran FROM pengeluaran WHERE MONTH(tanggal_keluar) = MONTH(CURRENT_DATE())");
$totalPendapatan = mysqli_query($koneksi, "SELECT SUM(total) AS total_pendapatan FROM riwayat_pelanggan WHERE MONTH(tanggal_kunjung) = MONTH(CURRENT_DATE())");
$totalPelanggan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pelanggan FROM riwayat_pelanggan WHERE MONTH(tanggal_kunjung) = MONTH(CURRENT_DATE())");
$sql_neraca = "SELECT * FROM tb_neraca WHERE MONTH(bulan) = MONTH(CURRENT_DATE())";
$query_tampil = mysqli_query($koneksi, $sql_neraca);
$row = mysqli_fetch_assoc($query_tampil);

$modal = $row["modal"];
$peralatan = $row["peralatan"];
$totalBebanGaji = mysqli_query($koneksi, "SELECT SUM(total_gaji) AS total_gaji FROM tb_gaji WHERE MONTH(tgl_gaji) = MONTH(CURRENT_DATE())");
$totalBebanGaji = $totalBebanGaji->fetch_assoc()['total_gaji'];
$totalBebanGaji = $totalBebanGaji ? $totalBebanGaji : 0;
?>
<h2 style="text-align: center;"><?= $totalPelanggan->fetch_assoc()['total_pelanggan'] ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Total Pendapatan</h5>
<?php
$pendapatan = $totalPendapatan->fetch_assoc()['total_pendapatan'];
$pendapatan = $pendapatan ? $pendapatan : 0;
$prive = $pendapatan * 0.3;
$pengeluaran = $totalPengeluaran->fetch_assoc()['total_pengeluaran'];
$totalPendapatanKeseluruhan = $pendapatan - $prive ;
$kas = $pendapatan + 
    $modal - 
    $peralatan - 
    $prive - 
    $totalBebanGaji - 
    $pengeluaran;
$totalPengeluaranKeseluruhan = $pengeluaran + $kas + $totalBebanGaji;
?>
<h2 style="text-align: center;"><?= rupiah($totalPendapatanKeseluruhan) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Total Pengeluaran</h5>

<h2 style="text-align: center;"><?= rupiah($totalPengeluaranKeseluruhan) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Kas</h5>

<h2 style="text-align: center;"><?= rupiah($kas) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Beban Gaji</h5>

<h2 style="text-align: center;"><?= rupiah($totalBebanGaji) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Modal</h5>

<h2 style="text-align: center;"><?= rupiah($modal) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Peralatan</h5>

<h2 style="text-align: center;"><?= rupiah($peralatan) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="width: 100%;">
<h5 class="card-header">Grafik Tahun <?= date('Y') ?> </h5>
<div style="width: 100%; margin: 0 auto;">
        <canvas id="myChart"></canvas>
    </div>

</div>

</div>

<?php 
 $dataGrafik = mysqli_query($koneksi, "WITH RECURSIVE Months AS (
    SELECT 1 AS Bulan
    UNION ALL
    SELECT Bulan + 1
    FROM Months
    WHERE Bulan < 12
)

SELECT
    m.Bulan,
    COALESCE(SUM(rp.total), 0) AS Total
FROM
    Months m
LEFT JOIN
    riwayat_pelanggan rp ON m.Bulan = MONTH(rp.tanggal_kunjung)
GROUP BY
    m.Bulan
ORDER BY
    m.Bulan");
?>

<script>
        // Data bulanan (contoh)
        const dataBulanan = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', "Aug", "Sep", "Okt", "Nov", "Dec"],
            datasets: [{
                label: 'Pendapatan',
                data: [
                    <?php
                    $data = $dataGrafik->fetch_all(MYSQLI_ASSOC);
                    $data = array_map(function($item) {
                        return $item['Total'];
                    }, $data);
                    echo implode(',', $data);
                    ?>
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Konfigurasi grafik
        const config = {
            type: 'bar',
            data: dataBulanan,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Inisialisasi grafik
        const myChart = new Chart(document.getElementById('myChart'), config);
    </script>
</body>
</html>