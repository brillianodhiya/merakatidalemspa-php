<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="text-center h3 m-0 font-weight-bold text-primary">Form Tambah Data Komisi</div>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Kode Komisi </label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Komisi" name="kode_komisi" required="required">
                </div>
                <div class="form-group">
                    <label>Jumlah Komisi</label>
                    <input type="text" class="form-control" placeholder="Masukkan Jumlah Komisi" name="jumlah" required="required">
                </div>

                <button name="saveBagian" type="submit" class="btn btn-success mr-2">Simpan</button>
                <button class="btn btn-success mr-2" a href="index.php">Kembali</button></a>
            </form>
        </div>
    </div>
</div>

<?php
// cek nis
if (isset($_POST['saveBagian'])) {
    $nama               = $_POST['kode_komisi'];
    $jumlah   = $_POST['jumlah'];

    //query INSERT disini
    $save = mysqli_query($koneksi, "INSERT INTO komisi VALUES(NULL,'$nama','$jumlah')");

    if ($save) {
        echo " <script>
      alert('Data Berhasil disimpan !');
      window.location='?page=komisi';
      </script>";
    }
}

?>