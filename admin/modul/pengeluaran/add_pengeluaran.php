<?php
include "../config/koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
$id_keluar=1;
?>
<?php
$level = "admin";
?>
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold" style="color:#800080;">Tambah Data Pengeluaran</h6>
        </div>
        <div class="card-body">
        
        <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pengeluaran</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Nama Pengeluaran" name="jenis_keluar" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Jumlah" name="jumlah" required="required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pengeluaran</label>
                        <input type="date" class="form-control"  name="tanggal_keluar" required="required">
                    </div>
                    
                    
                    <button name="saveKeluar" type="submit" class="btn mr-2" style="background-color:#800080; color:#ffff;">Simpan</button>
               </form>
            </div>
        </div>
    </div>
</div>



<?php
//...

if (isset($_POST['saveKeluar'])) {
  $jenis = $_POST['jenis_keluar'];
  $jumlah = $_POST['jumlah'];
  $tanggal_keluar = $_POST['tanggal_keluar'];

  $save = mysqli_query($koneksi, "INSERT INTO pengeluaran (jenis_keluar, jumlah, tanggal_keluar) VALUES ('$jenis', '$jumlah', '$tanggal_keluar')");

  if ($save) {
    echo " <script>
	          alert('Data Berhasil disimpan!');
	          window.location='?page=pengeluaran';
	          </script>";
  } else {
    echo "gagal";
  }
}

?>