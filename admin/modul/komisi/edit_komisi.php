<?php
$id = $_GET['id_kom'];
$data = mysqli_query($koneksi, "SELECT * from komisi where id_kom='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <h5 class="card-header text-center">Form Edit Data Komisi</h5>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Komisi</label>
                        <input type="hidden" name="id_kom" value="<?php echo $d['id_kom']; ?>">
                        <input type="text" class="form-control" name="kode_komisi" value="<?php echo $d['kode_komisi']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Komisi</label>
                        <input type="text" class="form-control" name="jumlah" value="<?php echo $d['jumlah']; ?>">
                    </div>
                    <button name="updateTunjangan" type="submit" class="btn btn-success mr-2">Simpan</button>
                    <button class="btn btn-success mr-2" a href="index.php">Kembali</button></a>
                </form>
            </div>
        </div>
    </div>

<?php
}
?>

<?php
// cek nis
if (isset($_POST['updateTunjangan'])) {
    $id = $_POST['id_kom'];
    $nama = $_POST['kode_komisi'];
    $jumlah = $_POST['jumlah'];

    //query INSERT disini
    $save = mysqli_query($koneksi, "UPDATE komisi SET kode_komisi='$nama',jumlah='$jumlah' WHERE id_kom='$id'");

    if ($save) {
        echo " <script>
      alert('Data Berhasil Diubah !');
      window.location='?page=komisi';
      </script>";
    }
}

?>