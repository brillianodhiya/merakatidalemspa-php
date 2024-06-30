<?php
include '../../../config/koneksi.php';
include '../../../config/rupiah.php';

?>
<?php
$id = $_GET['id'];
// $data = mysqli_query($koneksi, "SELECT * from tb_gaji where id_gaji='$id'");
// while ($d = mysqli_fetch_array($data)) {
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
            <img src="../../../assets/img/app/<?= $d['foto'] ?>" class="img-thumbnail" style="height: 100px;width: 100px;">
            <br>
            <h3><b>Laporan Penggajian Karyawan</b></h3>
            <p><b><?= $d['nama_instansi']; ?></p></b>
            <p><b><?= $d['nama_aplikasi']; ?></p></b>
            <hr style="font-weight:bold; font-size: 12px; width: 100%;">
        <?php } ?>
    </center>

    <body style="margin-left: auto; margin-right: auto; display: flex; justify-content: center; align-items: center; flex-direction:column; width: 100%;">

        <!-- <table width="100%" border="1" style="border-collapse: collapse;" cellpadding="3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Gaji Pokok</th>
                    <th>Gaji Absen Masuk</th>
                    <th>Komisi</th>
                    <th>Total Absen Izin</th>
                    <th>Gaji Bersih</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql_tampil = "SELECT * FROM tb_karyawan INNER JOIN tb_gaji ON tb_karyawan.id_karyawan = tb_gaji.id_karyawan WHERE id_gaji='$id'";
                $query_tampil = mysqli_query($koneksi, $sql_tampil);
                $no = 1;
                while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
                ?>
                    <tr>
                        <td><?= $no++; ?>.</td>
                        <td><?= date('d-m-Y', strtotime(($data['tgl_gaji']))); ?></td>
                        <td><?= $data['kode_karyawan'] ?> </td>
                        <td><?= $data['nama_karyawan'] ?> </td>
                        <td><?= rupiah($data['gapok']) ?> </td>
                        <td><?= rupiah($data['gaji_absen_masuk']) ?> </td>
                        <td><?= rupiah($data['komisi']) ?> </td>
                        <td><?= rupiah($data['total_absen_izin']) ?> </td>
                        <td>
                            <?php
                            echo rupiah($data['total_gaji']);
                            ?>
                        </td>

                    </tr>
            <?php
                    $no++;
                }
            // }
            ?>
            </tbody>
        </table> -->
        <table style="border-collapse: collapse;">
    <?php
    $sql_tampil = "SELECT * FROM tb_karyawan INNER JOIN tb_gaji ON tb_karyawan.id_karyawan = tb_gaji.id_karyawan WHERE id_gaji='$id'";
    $query_tampil = mysqli_query($koneksi, $sql_tampil);
    while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
    ?>
     
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Tanggal</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= date('d-m-Y', strtotime(($data['tgl_gaji']))); ?></td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Kode Karyawan</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= $data['kode_karyawan'] ?> </td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Nama Karyawan</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= $data['nama_karyawan'] ?> </td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Gaji Pokok</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= rupiah($data['gapok']) ?> </td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Gaji Absen Masuk</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= rupiah($data['gaji_absen_masuk']) ?> </td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Komisi</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= rupiah($data['komisi']) ?> </td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Total Absen Izin</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= rupiah($data['total_absen_izin']) ?> </td>
        </tr>
        <tr>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><strong>Gaji Bersih</strong></td>
            <td style="width:300px; border: 1.5px solid black; padding: 8px;"><?= rupiah($data['total_gaji']); ?></td>
        </tr>
    <?php
    }
    ?>
</table>


    </body>


    <script>
        window.print();
    </script>