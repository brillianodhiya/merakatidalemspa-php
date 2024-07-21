<?php
include "../config/koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM pricelist");

?>
<?php
$level = "admin";
?>
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold" style="color:#800080;">Tambah Data Pricelist</h6>
        </div>
        <div class="card-body">
        
        <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Treatment</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Nama Treatmnet" name="nama_treatment" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Harga" name="harga" required="required">
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
  $nama = $_POST['nama_treatment'];
  $harga = $_POST['harga'];
  

  $save = mysqli_query($koneksi, "INSERT INTO pricelist (nama_treatment, harga) VALUES ('$nama', '$harga')");

  if ($save) {
    echo " <script>
	          alert('Data Berhasil disimpan!');
	          window.location='?page=pricelist';
	          </script>";
  } else {
    echo "gagal";
  }
}

?>