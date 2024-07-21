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
    <p>Laporan Pendapatan, Periode
        <?php $a = $dt1;
        echo date("d-M-Y", strtotime($a)) ?>
        s/d
        <?php $b = $dt2;
        echo date("d-M-Y", strtotime($b)) ?>
    </p>
    <table width="100%" border="2" style="border-collapse: collapse;" cellpadding="3">
        <thead>
            <tr>
                <th style="border: 2px solid black;">No</th>
                <th style="border: 2px solid black;">Tanggal</th>
                <th style="border: 2px solid black;">Nama Tamu</th>
                <th style="border: 2px solid black;">Karyawan</th>
                <th style="border: 2px solid black;">Treatment</th>
                <th style="border: 2px solid black;">Kode Komisi</th>
                <th style="border: 2px solid black;">Harga</th>
                <th style="border: 2px solid black;">Potongan</th>
                <th style="border: 2px solid black;">Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($_POST["btnCetak"])) {
                $sql_tampil = "SELECT *
FROM riwayat_pelanggan
JOIN tb_karyawan ON riwayat_pelanggan.id_karyawan = tb_karyawan.id_karyawan
JOIN komhar ON komhar.id_tamu = riwayat_pelanggan.id_tamu
JOIN komisi ON komhar.id_kom = komisi.id_kom
WHERE riwayat_pelanggan.tanggal_kunjung BETWEEN '$dt1' AND '$dt2' order by tanggal_kunjung asc";
            }
            $query_tampil = mysqli_query($koneksi, $sql_tampil);
            $no = 1;
            while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
            ?>
                <tr>
                    <td style="border: 2px solid black;"><?= $no++; ?>.</td>
                    <td style="border: 2px solid black;"><?= date('d-m-Y', strtotime(($data['tanggal_kunjung']))); ?></td>
                    <td style="border: 2px solid black;"><?= $data['nama_tamu'] ?> </td>
                    <td style="border: 2px solid black;"><?= $data['nama_karyawan'] ?> </td>
                    <td style="border: 2px solid black;"><?= $data['treatment'] ?> </td>
                    <td style="border: 2px solid black;"><?= $data['kode_komisi'] ?> </td>
                    <td style="border: 2px solid black;"><?= rupiah($data['harga']) ?> </td>
                    <td style="border: 2px solid black;"><?= rupiah($data['potongan']) ?> </td>
                    <td style="border: 2px solid black;">
                        <?php
                        echo rupiah($data['total']);
                        ?>
                    </td>

                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <br>
    Total Pendapatan, Periode
        <?php $a = $dt1;
        echo date("d-M-Y", strtotime($a)) ?>
        s/d
        <?php $b = $dt2;
        echo date("d-M-Y", strtotime($b)) ?>
    <?php
    $totalPendapatan = mysqli_query($koneksi, "SELECT SUM(total) AS total_pendapatan FROM riwayat_pelanggan WHERE tanggal_kunjung BETWEEN '$dt1' AND '$dt2'");
    ?>
    <h2 style=""><?= rupiah($totalPendapatan->fetch_assoc()['total_pendapatan']) ?></h2>


</body>


<script>
    window.print();
</script>