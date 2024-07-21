<?php
include '../../../config/koneksi.php';
include '../../../config/rupiah.php';


$dt1 = $_POST["tgl_1"];
$dt2 = $_POST["tgl_2"];

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
    <h3><b>Laporan Pendapatan</b></h3>
    <p><b>Merak Ati Dalem Spa</p></b>
    <hr style="font-weight:bold; font-size: 12px;">
</center>

<body>
    <p>Laporan Pendapatan Periode :
        <b><?php $a = $dt1;
        echo date("d-M-Y", strtotime($a)) ?>
        s/d
        <?php $b = $dt2;
        echo date("d-M-Y", strtotime($b)) ?></b>
    </p>
    <table width="75%" border="2" style="border-collapse: collapse; margin: auto;" cellpadding="3">
        <thead>
            <tr>
                <th style="border: 2px solid black;">No</th>
                <th style="border: 2px solid black;">Tanggal</th>
    
                <th style="border: 2px solid black;">Pendapatan</th>
              
                <th style="border: 2px solid black;">Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($_POST["btnCetak"])) {
                $sql_tampil = "SELECT *
FROM riwayat_pelanggan

WHERE riwayat_pelanggan.tanggal_kunjung BETWEEN '$dt1' AND '$dt2' order by tanggal_kunjung asc";
            }
            $query_tampil = mysqli_query($koneksi, $sql_tampil);
            $no = 1;
            while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
            ?>
                <tr>
                    <td style="border: 2px solid black;"><center><?= $no++; ?>.</center></td>
                    <td style="border: 2px solid black;"><center><?= date('d-m-Y', strtotime(($data['tanggal_kunjung']))); ?></center></td>
                   
                    <td style="border: 2px solid black;"><?= $data['treatment'] ?></td>
                    
                    <td style="border: 2px solid black;">
                    <center> <?php
                        echo rupiah($data['total']);
                        ?></center>
                    </td>

                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <br>
    Total Pendapatan Periode :
        <b><?php $a = $dt1;
        echo date("d-M-Y", strtotime($a)) ?>
        s/d
        <?php $b = $dt2;
        echo date("d-M-Y", strtotime($b)) ?></b>
    <?php
    $totalPendapatan = mysqli_query($koneksi, "SELECT SUM(total) AS total_pendapatan FROM riwayat_pelanggan WHERE tanggal_kunjung BETWEEN '$dt1' AND '$dt2'");
    ?>
    <h2 style=""><?= rupiah($totalPendapatan->fetch_assoc()['total_pendapatan']) ?></h2>


</body>


<script>
    window.print();
</script>