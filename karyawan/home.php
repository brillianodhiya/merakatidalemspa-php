<?php

if (@$_SESSION['Karyawan']) {
?>
    <?php
    if (@$_SESSION['Karyawan']) {
        $sesi = @$_SESSION['Karyawan'];
    }
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id_karyawan = '$sesi'") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($sql);
    ?>

    <div class="card mt-3">
        <div class="card-body text-center">
            <h2>Selamat Datang <strong><?= $data['nama_karyawan'] ?></strong></h2>
            <br>
            <h3>"Semangat Kerja Untuk Mengumpulkan Pundi Pundi Kehidupan
                <br> & Terus Meningkatkan Omset Bulanan :)"  </h3>
        </div>
    </div>
<?php
}
?>