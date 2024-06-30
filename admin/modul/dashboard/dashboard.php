
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
<div style="display: flex; flex-direction: row; flex-wrap: wrap; gap: 16px; justify-content: space-between;">

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Total Pelanggan</h5>
<?php 
 $totalPelanggan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pelanggan FROM riwayat_pelanggan");
?>
<h2 style="text-align: center;"><?= $totalPelanggan->fetch_assoc()['total_pelanggan'] ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Total Pendapatan</h5>
<?php
$totalPendapatan = mysqli_query($koneksi, "SELECT SUM(total) AS total_pendapatan FROM riwayat_pelanggan");
?>
<h2 style="text-align: center;"><?= rupiah($totalPendapatan->fetch_assoc()['total_pendapatan']) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="min-width: 300px;">
<h5 class="card-header text-center">Total Pengeluaran</h5>
<?php
$totalPengeluaran = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total_pengeluaran FROM pengeluaran");
?>
<h2 style="text-align: center;"><?= rupiah($totalPengeluaran->fetch_assoc()['total_pengeluaran']) ?></h2>
</div>

<div class="card shadow mb-4 p-2" style="width: 100%;">
<h5 class="card-header">Grafik Bulanan</h5>
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